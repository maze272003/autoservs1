<?php

namespace Symfony\Component\VarDumper\Server;

use Psr\Log\LoggerInterface;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * A server collecting Data clones sent by a ServerDumper.
 */
class DumpServer
{
    private string $host;
    private ?LoggerInterface $logger;

    /**
     * @var resource|null
     */
    private $socket;

    /**
     * Flag to stop the server.
     */
    private bool $shouldStop = false;

    public function __construct(string $host, ?LoggerInterface $logger = null)
    {
        if (!str_contains($host, '://')) {
            $host = 'tcp://' . $host;
        }

        $this->host = $host;
        $this->logger = $logger;
    }

    /**
     * Start the server.
     */
    public function start(): void
    {
        if (!$this->socket = stream_socket_server($this->host, $errno, $errstr)) {
            throw new \RuntimeException(sprintf('Server start failed on "%s": ', $this->host) . $errstr . ' ' . $errno);
        }
    }

    /**
     * Listen for incoming messages and process them with the given callback.
     */
    public function listen(callable $callback): void
    {
        if (null === $this->socket) {
            $this->start();
        }

        foreach ($this->getMessages() as $clientId => $message) {
            $this->logger?->info('Received a payload from client {clientId}', ['clientId' => $clientId]);

            $payload = @unserialize(base64_decode($message), ['allowed_classes' => [Data::class, Stub::class]]);

            // Impossible to decode the message, give up.
            if (false === $payload) {
                $this->logger?->warning('Unable to decode a message from {clientId} client.', ['clientId' => $clientId]);
                continue;
            }

            if (!\is_array($payload) || \count($payload) < 2 || !$payload[0] instanceof Data || !\is_array($payload[1])) {
                $this->logger?->warning('Invalid payload from {clientId} client. Expected an array of two elements (Data $data, array $context)', ['clientId' => $clientId]);
                continue;
            }

            [$data, $context] = $payload;

            $callback($data, $context, $clientId);
        }
    }

    /**
     * Gracefully stop the server.
     */
    public function stop(): void
    {
        $this->shouldStop = true;
        if ($this->socket) {
            fclose($this->socket);
        }
    }

    /**
     * Get the host address of the server.
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Get incoming messages and yield them to the listener.
     */
    private function getMessages(): iterable
    {
        $sockets = [(int) $this->socket => $this->socket];
        $write = [];

        while (!$this->shouldStop) {
            $read = $sockets;

            // Add a 5-second timeout for stream_select to avoid infinite blocking.
            $numChangedSockets = stream_select($read, $write, $write, 5, 0);

            if ($numChangedSockets === false) {
                // Handle stream_select error (if necessary)
                $this->logger?->error('stream_select failed.');
                break;
            }

            foreach ($read as $stream) {
                if ($this->socket === $stream) {
                    $stream = stream_socket_accept($this->socket);
                    $sockets[(int) $stream] = $stream;
                } elseif (feof($stream)) {
                    unset($sockets[(int) $stream]);
                    fclose($stream);
                } else {
                    yield (int) $stream => fgets($stream);
                }
            }
        }
    }
}
