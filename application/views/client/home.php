<body style="height: 100vh;background: url('<?php echo base_url() ?>assets/client/images/img/dashboard1.jpg'); background-size: cover;">

    <!-- ===== Start of Header Navigation ===== -->
    <header class="fixed" style="margin-top: -200px;">
        <nav class="navbar navbar-default navbar-static-top fluid_header centered transparent">
            <div class="container" style="width: 1600px;">

                <!-- Logo -->
                <div class="col-md-2 col-sm-3 col-xs-3">
                    <a class="navbar-brand" href="index.html"><img class="img-responsive" src="<?php echo base_url() ?>assets/client/images/img/Logo.png" alt="logo"></a>
                    <!-- INSERT YOUR LOGO HERE -->
                </div>

                <!-- ======== Start of Main Menu ======== -->
                <div class="col-md-10 col-sm-9 col-xs-9">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-right cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
                        <div class="row" style="width: 450px;height:100%;background:#F0ECE3;padding:10px;font-weight: bold;">
                            <div class="col-md-4" style="color: black;">
                                <a href="#"><img src="<?php echo base_url() ?>assets/client/images/img/user-black.png" class="dashboard-image"></a>
                            </div>
                            <div class="col-md-6" style="margin-top: 30px;">
                                <p style="color: black;font-size:20px">Sabrina Laudray</p>
                                <p style="color: black;">Admin-1 <a style="color: black;margin-left:60px">Edit <span class="fa fa-pencil"><span></a></p>
                            </div>
                            <div class="col-md-2" style="color: black;">
                                <a href="#" style="margin-left:20px;font-size:30px;color: black;"><span class="fa fa-bars"></span></a>
                                <a style="color: black;margin-top:60px" href="<?= site_url()?>/logout">Logout</a>
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- ======== End of Main Menu ======== -->

            </div>
        </nav>
    </header>
    <!-- ===== End of Header Navigation ===== -->

    <div class="container-fluid" style="margin-top: 240px; margin-left:160px;margin-right:280px">
        <div class="text-center">
            <p style="color: white;font-size:50px;font-family:macklins;">Sobat Daging Administrator
            <p>
        </div>
        <div class="row text-center" style="background: #3e3737;padding:0px 0px 20px 0px;margin-top:70px">
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/inventory"><img src="<?php echo base_url() ?>assets/client/images/img/inventory.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Inventory</h5>
                    </div>
                    <p class="card-dashboard-text">Semua item yang berhubungan dengan stock</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/order-received"><img src="<?php echo base_url() ?>assets/client/images/img/order_received.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Order Received</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan pengiriman</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/return-cancel"><img src="<?php echo base_url() ?>assets/client/images/img/return.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Return/Cancel</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan pengembalian barang</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?php echo site_url() ?>/petty-cash"><img src="<?php echo base_url() ?>assets/client/images/img/petty_cash.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Petty Cash</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan Petty Cash</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?=site_url()?>/expenses"><img src="<?php echo base_url() ?>assets/client/images/img/expense.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-2 mb-2">Expenses</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan Pengeluaran</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 80px; margin-left:160px;margin-right:280px">
        <div class="row text-center" style="background: #3e3737;padding:0px 0px 40px 0px;">
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?=site_url()?>/other"><img src="<?php echo base_url() ?>assets/client/images/img/order_income.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Other Income</h5>
                    </div>
                    <p class="card-dashboard-text">Semua data pemasukkan tambahan</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?php echo site_url() ?>/payment"><img src="<?php echo base_url() ?>assets/client/images/img/payment.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Payment</h5>
                    </div>
                    <p class="card-dashboard-text">Menu untuk mengkonfirmasi sebuah pembayaran</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?=site_url()?>/ap"><img src="<?php echo base_url() ?>assets/client/images/img/database.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Database</h5>
                    </div>
                    <p class="card-dashboard-text">Sebuah recap data yang terkait dari semua menu</p>
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="width: 20%;">
                <div class="card-dashboard card-dashboard-block">
                    <div class="dashboard-div">
                        <a href="<?=site_url()?>/expenses"><img src="<?php echo base_url() ?>assets/client/images/img/summary.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div style="margin-top: 60px;">
                        <h5 class="card-dashboard-title mt-3 mb-3">Summary</h5>
                    </div>
                    <p class="card-dashboard-text">Tampilan data barang masuk dan keluar</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 100px;"></div>
</body>