<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="/admin" class="logo logo-light">
        <span class="logo-lgs">
            <img src="{{ asset('web/images/svg/logo_inline.svg') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('web/images/svg/logo_inline.svg') }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('web/images/svg/logo_inline.svg') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('web/images/svg/logo_inline.svg') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin-dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            @if(\App\Models\ACL::isAccess())
            <li class="side-nav-item">
                <a href="{{ route('admin-users.index') }}" class="side-nav-link">
                    <i class="ri-user-line"></i>
                    <span> Users </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin-clients.index') }}" class="side-nav-link">
                    <i class="ri-user-line"></i>
                    <span> Clients </span>
                </a>
            </li>
            @endif
            <li class="side-nav-item">
                <a href="{{ route('admin-quotations.index') }}" class="side-nav-link">
                    <i class="ri-list-line"></i>
                    <span> Quotations </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin-dashboard') }}">All Vehicles</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-dashboard') }}">Add Vehicle</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-dashboard') }}">Manage Manufactures</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-dashboard') }}">Manage Fuel Types</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-dashboard') }}">Manage Transmission Types</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->