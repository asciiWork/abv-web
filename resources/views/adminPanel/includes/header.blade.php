<header class="top-header">
    <nav class="navbar navbar-expand justify-content-between">
        <div class="btn-toggle-menu">
            <span class="material-symbols-outlined">menu</span>
        </div>
        <ul class="navbar-nav top-right-menu gap-2">
            <li class="nav-item d-lg-none d-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <a class="nav-link" href="javascript:;"><span class="material-symbols-outlined">
                        search
                    </span></a>
            </li>
            <li class="nav-item dark-mode">
                <a class="nav-link dark-mode-icon" href="javascript:;"><span class="material-symbols-outlined">dark_mode</span></a>
            </li>
            <li class="nav-item dropdown dropdown-app">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><span class="material-symbols-outlined">
                        apps
                    </span></a>
                <div class="dropdown-menu dropdown-menu-end mt-lg-2 p-0">
                    <div class="app-container p-2 my-2">
                        <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="{{ asset('public/admin-theme/assetsRoksyn/images/icons/twitter.png') }}" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Twitter</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="{{ asset('public/admin-theme/assetsRoksyn/images/icons/linkedin.png') }}" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">linkedin</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="{{ asset('public/admin-theme/assetsRoksyn/images/icons/youtube.png') }}" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">YouTube</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-large" style="display: none;">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                  <div class="position-relative">
                    <span class="notify-badge">8</span>
                    <span class="material-symbols-outlined">
                      notifications_none
                      </span>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end mt-lg-2">
                  <a href="javascript:;">
                    <div class="msg-header">
                      <p class="msg-header-title">Notifications</p>
                      <p class="msg-header-clear ms-auto">Marks all as read</p>
                    </div>
                  </a>
                  <div class="header-notifications-list">
                    
                  </div>
                  <a href="javascript:;">
                    <div class="text-center msg-footer">View All</div>
                  </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#ThemeCustomizer"><span class="material-symbols-outlined">
                        settings
                    </span></a>
            </li>
        </ul>
    </nav>
</header>