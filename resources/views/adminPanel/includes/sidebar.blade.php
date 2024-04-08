<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('admin-dashboard') }}" class="logo logo-light">
        <span class="logo-lgs">
            <img src="{{ asset('public/web/assets/img/favicon.ico') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('public/web/assets/img/favicon-32x32.png') }}" alt="small logo">
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
            <li class="side-nav-item {{ (request()->routeIs('admin-users.*'))?'menuitem-active':'' }}">
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
                <a href="{{ route('admin-clients.print-address') }}" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Client's Address </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin-quotations.index') }}" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Quotations </span>
                </a>
            </li>
            <li class="side-nav-item {{ (request()->routeIs('admin-orders.*'))?'menuitem-active':'' }}">
                <a href="{{ route('admin-orders.index') }}" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Orders </span>
                </a>                
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin-category.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Product </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin-products.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->