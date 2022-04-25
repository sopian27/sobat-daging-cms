<body class="bg-dark text-white">
    <div class="container">
        <div class="row mt-5">
            <div class="col-3">
                <a class="navbar-brand" href="#"><img class="img-fluid" src="<?php echo base_url() ?>/assets/client/images/img/Logo.png" alt="logo" width="200"></a>
            </div>
            <div class="col-4 offset-5">
                <div class="row gx-0">
                    <div class="col-11">
                        <div class="collapse collapse-vertical" id="user-collapse">
                            <div class="card card-body" style="border: 2px solid white;color:#708090">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-3 col-xl-3">
                                        <span span style="font-size: 50px;">
                                            <i class="fas fa-user-circle"></i>
                                        </span>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-7 col-xl-7">
                                        <div class="row">
                                            <span style="font-size: 24px;  padding-left : 10%;">Admin</span>
                                        </div>
                                        <div class="row">
                                            <span style="font-size: 12px;  padding-left : 10%;">admin-type</span>
                                        </div>
                                        <div class="row d-flex justify-content-end">
                                            <span style="font-size: 9px; padding-left : 75%; font-style: italic;" class="justify-conter-end">edit <i class="fas fa-pen" style="padding-left : 10%;"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-2 col-xl-2 mt-4 ">
                                        <div class="row mt-5 d-flex justify-content-end">
                                            <span style="font-size: 9px;" class="justify-conter-end">Logout</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false" aria-controls="user-collapse">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3">
                <a href="<?php echo site_url(); ?>/home" style="color:white"><img class="img-fluid" src="<?php echo base_url(); ?>/assets/client/images/img/Back.png" alt="logo" width="100" height="100" /><a>
            </div>
            <div class="col-12 text-center">
                <h1 class="col-12"><?php echo $subMenu; ?></h1>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md bg-dark text-uppercase mb-3" id="mainNav">
        <div class="container">
            <button class="navbar-toggler text-uppercase font-weight-bold text-white rounded signin-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarResponsive">
                <ul class="navbar-nav text-center" style="text-transform: none !important;padding:5px">
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/payment">Payment In</a></li>
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/payment-out">Payment Out</a></li>
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/payment-invoice">Invoice</a></li>
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/payment-history">History Payment</a></li>
                </ul>
            </div>
        </div>
    </nav>