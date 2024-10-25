<li class="nav-item">
    <a href="{{ route('messages.notification') }}" class="nav-link">
        <i class="nav-icon fas fa-bell"></i>
        <p>Notification</p>
        @if($unreadCount > 0)
            <span class="badge badge-danger right">{{ $unreadCount }}</span>
        @endif
    </a>
</li>
