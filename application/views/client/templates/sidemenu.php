<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <!--<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i>Zoter</a>-->
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo-lg.png" alt="" class="logo-large">
                    </a>
                </div>
            </div>

            <div class="sidebar-inner niceScrollleft">

                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="<?= base_url() ?>/home" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i> <span> Personalia </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url() ?>/user">User</a></li>
                                <li><a href="<?= base_url() ?>/pegawai">Pegawai</a></li>
                            </ul>
                        </li>


                        <li class="menu-title">Transaksi</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullseye"></i> <span> Kegiatan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?= base_url() ?>/kegiatan">Kegitan</a></li>
                                <li><a href="<?= base_url() ?>/anggaran">Anggaran</a></li>
                                <li><a href="<?= base_url() ?>/pajak">Pajak</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Laporan</li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file-document"></i> <span> Laporan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <!-- <li><a href="<?= base_url() ?>/laporan/kegiatan">Kegiatan</a></li>
                                <li><a href="<?= base_url() ?>/laporan/anggaran">Anggaran</a></li> -->
                                <li><a href="<?= base_url() ?>/laporan/pajak">Pajak</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">

                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?= base_url() ?>/login/logOut"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <div class="clearfix"></div>

                    </nav>
                </div>
                <!-- Top Bar End -->