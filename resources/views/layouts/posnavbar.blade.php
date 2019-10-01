<!-- Navbar -->
<nav class="navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item" style="font-size: 1.3em;padding: 5px;">
            <a href="{{ route('dashboard') }}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10"
                data-original-title="Dashboard">
                <strong><i class="fas fa-undo"></i> &nbsp; Dashboard</strong>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" style="font-size: 1.3em;padding: 5px;">
            <a class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i> <span>9</span>
            </a>
        </li>
    </ul>
    <div class="mx-auto">
        <ul class="navbar-nav">
            <li class="nav-item" style="display:inline-block;">
                <div class="font-weight-bold" id='date-part' style="font-size: 1.2em;padding: 5px;"></div>
            </li>
            <li c                           lass="nav-item" style="display:inline-block;">
                <div class="font-weight-bold" id='time-part' style="font-size: 1.3em;padding: 5px;"></div>
            </li>
        </ul>
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="dropdown user user-menu" style="font-size: 1.3em;padding: 5px>
            <a href=" #" class="dropdown-toggle user-panel"
            style="text-decoration: none;" data-toggle="dropdown">
            <img src="{{ auth()->user()->image_path }}" style="width:40px;" class="user-image img-circle" alt="User Image">
            <span class="hidden-xs">{{ auth()->user()->first_name }}
                {{ auth()->user()->last_name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right text-center">
                <img src="{{ auth()->user()->image_path }}" style="width:150px;" class="img-thumbnail dropdown-item"
                    alt="User Image">
                <div class="dropdown-divider"></div>
                <span class="dropdown-item dropdown-header">{{ auth()->user()->first_name }}
                    {{ auth()->user()->last_name }}</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-header"><i class="fas fa-user-circle"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-header" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                        class="fas fa-power-off"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
