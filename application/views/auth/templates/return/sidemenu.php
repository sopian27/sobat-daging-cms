<body class="bg-dark text-white">

    <!-- <body class=""> -->
    <div class="container-fluid bg-dark" style="width: 1600px;">
        <div class="row">
            <div class="col mt-3">
                <a class="navbar-brand" href="index.html"><img class="img-responsive" src="<?php echo base_url() ?>/assets/client/images/img/Logo.png" alt="logo" width="200"></a>
            </div>
            <div class="col-md-5 mt-5 offset-md-2 justify-content-end">
                <div class="row">
                    <div class="col justify-content-end">
                        <div style="height: 135px;margin-left:190px">
                            <div class="collapse collapse-vertical" id="user-collapse">
                                <div class="card card-body bg-transparent " style="width: 400px; border: 2px solid white;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span span style="font-size: 50px;">
                                                <i class="fas fa-user-circle"></i>
                                            </span>
                                        </div>
                                        <div class="col-md-8" style="margin-top: 10px;">
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
                                        <div class="col-md-2 mt-4 ">
                                            <div class="row mt-5 d-flex justify-content-end">
                                                <span style="font-size: 9px;" class="justify-conter-end">Logout</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col justify-content-end" style="position:relative;margin-left:600px;margin-top:-134px">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false" aria-controls="user-collapse">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                 <a href="<?php echo site_url();?>/home" style="color:white"><img src="<?php echo base_url();?>/assets/client/images/img/Back.png"/><a>
            </div>
            <h1 class="text-center"><?php echo $subMenu;?></h1>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-dark text-uppercase" id="mainNav">
        <div class="container">
            <button class="navbar-toggler text-uppercase font-weight-bold bg-warning text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarResponsive">
                <ul class="navbar-nav " style="text-transform: none !important;">
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/return-cancel">Return Item</a></li>
                    <li class="nav-item mx-0 "><a class="nav-link py-3 px-0 px-lg-3 border border-default" href="<?= site_url() ?>/return-history">History Return</a></li>
                </ul>
            </div>
        </div>
    </nav>