<?php $crrRoute = \Route::currentRouteName(); ?>
<!--start sidebar-->
      <aside class="sidebar-wrapper">
          <div class="sidebar-header">
            <div class="logo-icon">
              <img src="{{ asset('public/web/assets/img/favicon-32x32.png') }}" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
              <h5 class="mb-0">ABV Tools</h5>
            </div>
            <div class="sidebar-close ">
              <span class="material-symbols-outlined">close</span>
            </div>
          </div>
          <div class="sidebar-nav" data-simplebar="true">
            
              <!--navigation-->
              <ul class="metismenu" id="menu">
                <li class="{{ ($crrRoute == 'admin-dashboard')?'mm-active':'' }}">
                  <a href="{{ route('admin-dashboard') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                  </a>
                </li>
                @if(\App\Models\ACL::isAccess())
                <li class="{{ (request()->routeIs('admin-users.*'))?'mm-active':'' }}">
                  <a href="{{ route('admin-users.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">account_circle</span>
                    </div>
                    <div class="menu-title">Users</div>
                  </a>
                </li>
                <li class="{{ (request()->routeIs('admin-clients.*'))?'mm-active':'' }}">
                  <a href="{{ route('admin-clients.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">add_reaction</span>
                    </div>
                    <div class="menu-title">Clients</div>
                  </a>
                </li>
                @endif
                <li class="{{ (request()->routeIs('admin-clients.print-address.*'))?'mm-active':'' }}">
                  <a href="{{ route('admin-clients.print-address') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">distance</span>
                    </div>
                    <div class="menu-title">Client's Address</div>
                  </a>
                </li>
                <li class="{{ (request()->routeIs('admin-quotations.*'))?'mm-active':'' }}">
                  <a href="{{ route('admin-quotations.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">backup_table</span>
                    </div>
                    <div class="menu-title">Quotations</div>
                  </a>
                </li>
                <li class="{{ (request()->routeIs('admin-orders.*'))?'mm-active':'' }}">
                  <a href="{{ route('admin-orders.index') }}">
                    <div class="parent-icon"><span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <div class="menu-title">Orders</div>
                  </a>
                </li>
                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">apps</span>
                    </div>
                    <div class="menu-title">Category</div>
                  </a>
                  <ul>
                    <li> <a href="{{ route('admin-category.index') }}"><span class="material-symbols-outlined">arrow_right</span>List</a>
                  </ul>
                </li>
                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">widgets</span>
                    </div>
                    <div class="menu-title">Product</div>
                  </a>
                  <ul>
                    <li> <a href="{{ route('admin-products.index') }}"><span class="material-symbols-outlined">arrow_right</span>List</a>
                  </ul>
                </li>
              </ul>
              <!--end navigation-->

              
          </div>
          <div class="sidebar-bottom dropdown dropup-center dropup">
              <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
                <div class="user-img">
                   <img src="{{ asset('public/admin-theme/assetsNew-2/images/avatars/01.png')}}" alt="">
                </div>
                <div class="user-info">
                  <h5 class="mb-0 user-name">Admin</h5>
                  <p class="mb-0 user-designation">Admin user</p>
                </div>
              </div>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  account_circle
                  </span><span>Profile</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                  dashboard
                  </span><span>Dashboard</span></a>
                </li>
                <li><a class="dropdown-item" href="{{ route('admin_logout') }}"><span class="material-symbols-outlined me-2">
                  logout
                  </span><span>Logout</span></a>
                </li>
              </ul>
          </div>
     </aside>
     <!--end sidebar-->