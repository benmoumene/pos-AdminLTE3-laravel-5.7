<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('/uploads/settings/'.$logo) }}" style="width: 200px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color:red"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasPermission('read_categories'))
                <li class="nav-item">
                    <a href="{{ url('/category') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_products'))
                <li class="nav-item">
                    <a href="{{ url('/product') }}" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_sales'))
                <li class="nav-item">
                    <a href="{{ url('/sale') }}" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            Sales
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_purchases'))
                <li class="nav-item">
                    <a href="{{ url('/purchase') }}" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            Purchases
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_providers'))
                <li class="nav-item">
                    <a href="{{ url('/provider') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Provider
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_clients'))
                <li class="nav-item">
                    <a href="{{ url('/client') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clients
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_spendings'))
                <li class="nav-item">
                    <a href="{{ url('/spending') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Spendings
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ url('/report') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/moneybox') }}" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Box Money
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasPermission('read_users'))
                <li class="nav-item">
                    <a href="{{ url('/moderator') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Moderator
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/generalsetting')  }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
