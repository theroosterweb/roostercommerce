<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
                <img src="{{ asset('ufe_assets/images/logo.png') }}" width="180" alt="" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Categorias</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.categories.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Categorias</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.categories.create')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-grid-add"></i>
                        </span>
                        <span class="hide-menu">Crea Categoria</span>
                    </a>
                </li>
                
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Sub Categorias</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.subcategories.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Sub Categorias</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.subcategories.create')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-grid-add"></i>
                        </span>
                        <span class="hide-menu">Crea SubCategoria</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Brands</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.brands.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Brands</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.brands.create')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-grid-add"></i>
                        </span>
                        <span class="hide-menu">Crea Brand</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Productos</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{-- route('admin.brands.index') --}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Productos</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('admin.products.create')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-grid-add"></i>
                        </span>
                        <span class="hide-menu">Crea Producto</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>