<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('logo.svg') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('logo.svg') }}" alt="" height="50">
            </span>
        </a>

        <a href="{{ route('index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('logo.svg') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('logo.svg') }}" alt="" height="50">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('index') }}">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('products.index') }}" class="waves-effect">
                        <i class="uil-store"></i>
                        <span>Products</span>
                    </a>
                </li>
                @role('Admin')
                    <li>
                        <a href="{{ route('orders.index') }}" class="waves-effect">
                            <i class="uil-shopping-basket"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vehicles.index') }}" class="waves-effect">
                            <i class="uil-bus-school"></i>
                            <span>Vehicles</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('customers.index') }}" class="waves-effect">
                            <i class="uil-users-alt"></i>
                            <span>Customers</span>
                        </a>

                    </li>

                    <hr>
                    <li>
                        <a href="{{ route('users.index') }}" class=" waves-effect">
                            <i class="uil-user"></i>
                            <span>Users</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}" class="waves-effect">
                            <i class="uil-key-skeleton-alt"></i>
                            <span>Roles</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('documentation.index') }}" class="waves-effect">
                            <i class="uil-document-layout-right"></i>
                            <span>Documentation</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
