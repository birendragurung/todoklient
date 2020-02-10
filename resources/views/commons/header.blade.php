<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{ $notificationData['unreadCount'] }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notificationData['total'] }} Notifications</span>
                <div class="dropdown-divider"></div>
                @foreach($notificationData['latestNotifications'] as $notification)

                    <a href="#" class="dropdown-item">
                        @if(is_null($notification->read_at) )
                            <i class="fas fa-circle" style="color: dodgerblue;display: inline"></i>
                        @endif
                            {{ Str::limit($notification->title,20)  }}
                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }} </span>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
