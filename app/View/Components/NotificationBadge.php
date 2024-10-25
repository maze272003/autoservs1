<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply; // Import the Reply model

class NotificationBadge extends Component
{
    public $unreadCount;

    public function __construct()
    {
        // Count unread replies for the authenticated user
        $this->unreadCount = Reply::where('user_id', Auth::id())->where('read', false)->count();
    }

    public function render()
    {
        return view('components.notification-badge');
    }
}
