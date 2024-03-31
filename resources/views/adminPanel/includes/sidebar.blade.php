<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="/admin" class="logo logo-light">
        <span class="logo-lgs">
            <img src="{{ asset('public/web/assets/img/abv.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('public/web/assets/img/abv.png') }}" alt="small logo">
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
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->