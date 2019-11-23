<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <div class="font-weight-bold" style="font-size: 1.2em;padding: 5px;">Welcome to your Store :
                {{ $store_name }}</div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="color: #000000;cursor:pointer" id="dropdown09"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ LaravelLocalization::getCurrentLocaleNative() }}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown09">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
                @endforeach
            </div>
        </li>
        <li class="nav-item" style="font-size: 1.3em;padding: 5px;">
            <a href="" title="" data-toggle="tooltip" data-placement="bottom"
                class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-original-title="Money Box">
                <strong><i class="fas fa-cash-register"></i> &nbsp; Money Box</strong>
            </a>
        </li>
        <li class="nav-item" style="font-size: 1.3em;padding: 5px;">
            <a href="{{ route('sale.create') }}" title="" data-toggle="tooltip" data-placement="bottom"
                class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-original-title="POS">
                <strong><i class="fa fa-th-large"></i> &nbsp; POS</strong>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" style="font-size: 1.3em;padding: 5px;">
            <a class="btn btn-primary btn-flat pull-left m-8 hidden-xs btn-sm mt-10" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i> <span>9</span>
            </a>
        </li>
        <li class="dropdown user user-menu" style="font-size: 1.3em;padding: 5px">
            <a href=" #" class="user-panel d-flex" style="text-decoration: none;" data-toggle="dropdown">
                <div class="image">
                    <img src="{{ auth()->user()->image_path }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block">{{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}</span>
                </div>
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
