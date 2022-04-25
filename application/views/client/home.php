<body style="background: url('<?php echo base_url() ?>assets/client/images/img/dashboard1.jpg'); background-size: cover;">

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
                                            <span style="font-size: 9px;" class="justify-conter-end"><a style="color: black;margin-top:60px" href="<?= site_url() ?>/logout">Logout</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false" aria-controls="user-collapse">
                            <i class="fas fa-bars" style="color:black"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5 justify-content-center" style="margin-top:50px">
            <div class="col-12 justify-content-center">
                <p class="text-center" style="color:white;font-family:macklins;font-size:40px">Sobat Daging Administrator</p>
            </div>
        </div>

        <div class="row justify-content-start">
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/inventory"><img height="100" width="100" src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_1_Inventory.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-3">Inventory</h5>
                    </div>
                    <p class="card-dashboard-text">Semua item yang berhubungan dengan stock</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/order-received"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_2_Order_Recieved.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-3 mb-3">Order Received</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan pengiriman</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/return-cancel"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_3_Return_Cancel.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-3 mb-3">Return/Cancel</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan pengembalian barang</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?php echo site_url() ?>/petty-cash"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_4_Patty_Cash.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-3 mb-3">Petty Cash</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan Petty Cash</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/expenses"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_5_Expenses.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-2 mb-2">Expenses</h5>
                    </div>
                    <p class="card-dashboard-text">Semua hal yang berhubungan dengan Pengeluaran</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 justify-content-start" >
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/expenses"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_6_Other_Income.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div>
                        <h5 class="card-dashboard-title mt-3 mb-3">Other Income</h5>
                    </div>
                    <p class="card-dashboard-text">Semua data pemasukkan tambahan</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/inventory"><img height="100" width="100" src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_7_Payment.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-dashboard-title mt-3 mb-3">Payment</h5>
                    </div>
                    <p class="card-dashboard-text">Menu untuk mengkonfirmasi sebuah pembayaran</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/order-received"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_8_Database.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div>
                        <h5 class="card-dashboard-title mt-3 mb-3">Database</h5>
                    </div>
                    <p class="card-dashboard-text">Sebuah recap data yang terkait dari semua menu</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-2" style="background: #3e3737;padding:10px;">
                <div class="card-dashboard card h-100">
                    <div class="dashboard-div">
                        <a href="<?= site_url() ?>/expenses"><img src="<?php echo base_url() ?>assets/client/images/img/Sobat_Daging_Icon_9_Summary.png" class="dashboard-image img-dashboard"></a>
                    </div>
                    <div>
                        <h5 class="card-dashboard-title mt-3 mb-3">Summary</h5>
                    </div>
                    <p class="card-dashboard-text">Tampilan data barang masuk dan keluar</p>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 100px;"></div>
</body>