<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('public/web/assets/img/favicon-32x32.png')}}" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">ABV TOOL</h5>
        </div>
        <div class="sidebar-close ">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">

        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin-dashboard') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            @if(\App\Models\ACL::isAccess())
            <li>
                <a href="{{ route('admin-users.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">account_circle</span>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin-clients.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">account_circle</span>
                    </div>
                    <div class="menu-title">Clients</div>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('admin-clients.print-address') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">distance</span>
                    </div>
                    <div class="menu-title">Client's Address</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin-quotations.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">receipt_long</span>
                    </div>
                    <div class="menu-title">Quotations</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                <?php $img = \App\Models\Admin::getAvtar(\Auth::guard('admins')->user()->image); ?>

                <img src="{{$img}}" alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name">{{\Auth::guard('admins')->user()->name}}</h5>
                <p class="mb-0 user-designation">{{\Auth::guard('admins')->user()->phone}}</p>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                        account_circle
                    </span><span>Profile</span></a>
            </li>
            <li>
                <div class="dropdown-divider mb-0"></div>
            </li>
            <li><a class="dropdown-item" href="{{ route('admin_logout') }}"><span class="material-symbols-outlined me-2">
                        logout
                    </span><span>Logout</span></a>
            </li>
        </ul>
    </div>
</aside>