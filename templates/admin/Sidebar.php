<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=URL('');?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=$LINH->site('zalo_admin');?>" target="_blank" class="nav-link">Liên hệ</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=URL('admin');?>" class="brand-link">
                <center><img src="<?=URL('assets/img/theme/')?><?=$LINH->site('logo');?>" alt="LINH" width="100%"></center>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=URL('public/admin/home.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">ĐƠN HÀNG</li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/order.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Đơn hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/user.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Thành viên
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/service.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Danh mục dịch vụ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/accounts.php');?>" class="nav-link">
                            <i class="nav-icon fa-solid fa-envelope"></i>
                                <p>
                                    Gmail
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">NẠP TIỀN</li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/bank.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Ngân hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CÀI ĐẶT</li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/api.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cấu hình api
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/devices.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Devices
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/theme.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Giao Diện
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=URL('public/admin/setting.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cấu hình
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>