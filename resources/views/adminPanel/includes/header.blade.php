<header class="top-header">
    <nav class="navbar navbar-expand justify-content-between">
        <div class="btn-toggle-menu">
            <span class="material-symbols-outlined">menu</span>
        </div>
        <div class="d-lg-block d-none search-bar">
            <button class="btn btn-sm w-100 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="material-symbols-outlined">search</span>Search
            </button>
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

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#ThemeCustomizer"><span class="material-symbols-outlined">
                        settings
                    </span></a>
            </li>
        </ul>
    </nav>
</header>