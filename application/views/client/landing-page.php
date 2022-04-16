<body id="page-top">

    <!-- ===== Loader ===== -->
    <div class="loader">
        <div class="spinner">
            <div class="cloud1"><img src="<?php echo base_url()?>/assets/client/images/clouds/cloud-blue.svg" alt=""></div>
            <div class="cloud2"><img src="<?php echo base_url()?>/assets/client/images/clouds/cloud-green.svg" alt=""></div>
        </div>
    </div>
    <!-- ===== End of Loader ===== -->

     <!-- ===== Top Header ===== -->
     <div class="top-header" style="display: none;">
        <div class="container">
            <div class="row">
                <!-- phone and social begin -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <ul class="social list-inline ptb10">
                        <li><a href="tel:12345678912">123 - 456 - 78912</a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <!-- phone and social end -->

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- chat and account button begin -->
                    <ul class="top-button ptb10">
                        <li>
                            <a href="#" class="btn btn-small btn-border btn-green customer-support"><i class="fa fa-phone"></i>(+62) 895-1687-2777</a>
                        </li>
                        <li>
                            <a class="btn btn-small btn-border btn-green" href="#"><i class="fa fa-envelope"></i>sobatdaging@gmail.com</a>
                        </li>
                    </ul>
                    <!-- chat and account button end -->
                </div>
            </div>
        </div>
    </div>
    <!-- ===== End of Top Header ===== -->

    <!-- ===== Start of Header Navigation ===== -->
    <header class="fixed">
        <nav class="navbar navbar-default navbar-static-top fluid_header centered transparent">
            <div class="container" style="width: 1600px;">

                <!-- Logo -->
                <div class="col-md-2 col-sm-3 col-xs-3">
                    <a class="navbar-brand" href="index.html"><img class="img-responsive" src="<?php echo base_url()?>/assets/client/images/img/Logo.png" width="200" alt="logo"></a>
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

                    

                    <div class="collapse navbar-collapse pull-left cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="main-nav" style="margin-left: 400px;">
                        <ul class="nav navbar-nav navbar-left onepage-nav">
                            <li class="active"><a href="#home" class="page-scroll" role="button" style="color:white;text-transform: lowercase;margin-top:50px;"><img src="<?php echo base_url()?>/assets/client/images/img/phone.png" width="20" height="15" alt="logo">  (+62) 895-1687-2777</a></li>
                        </ul>
                    </div>

                    <div class="collapse navbar-collapse pull-left cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="main-nav" style="margin-left: 400px;">
                        <ul class="nav navbar-nav navbar-left onepage-nav">
                            <li class="active"><a href="#home" class="page-scroll" role="button" style="color:white;text-transform: lowercase;margin-top:50px;"><img src="<?php echo base_url()?>/assets/client/images/img/email.png" width="20" height="15" alt="logo">  sobatdaging@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <!-- ======== End of Main Menu ======== -->
                
            </div>
        </nav>
    </header>
    <!-- ===== End of Header Navigation ===== -->

    <!-- ===== Main Section - Slider ===== -->
    <section class="demo4" id="home">
        <!-- Swiper -->
        <div class="swiper-container fullscreen" style="height: 100vh;">
            <div class="swiper-wrapper" >
                <!-- Slide 1 -->
                <div class="swiper-slide overlay-black" data-swiper-autoplay="50000" style="background: url('<?php echo base_url()?>/assets/client/images/img/bg3.jpg'); background-size: cover;">
                    <div class="slider-content container" style="text-align: left;width:1600px">
                        <div class="col-md-6">
                            <h2 class="landing-sobat">Welcome To </h2>
                            <h1>SOBAT DAGING</h1>
                            <h3 style="color:#B89874">Menyediakan Daging Pilihan Keluarga Nusantara.</h3>
                            <br>
                            <div>
                                <a href="#" class="btn btn-border btn-blue btn-sobat-lg" onclick="show();">Order Now</a>
                                 <!-- start of blog post 1 -->
                                <!-- End of blog post 1 -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right" id="popup-welcome-sobat" style="margin-right:-200px;margin-top:100px;display:none">
                                    <div class="col-md-3" style="width:500px;">
                                        <div style="background: #B89874;width:100%;height:90px;border-radius: 30px 0px 0px 0px">
                                            <p style="color: white;font-size:27px;padding:35px;text-align:center">Welcome to Sobat Daging <a href="#" onclick="hide()" style="margin-left:20px;font-size:30px"><span class="fa fa-bars"></span></a></p>
                                        </div>
                                        <article class="" style="background: rgba(0, 0, 0, 0.5);padding:36px;">
                                            <div class="blog-post-details">
                                                <p class="nomargin pb30 text-left" style="font-size:18px;color:white">Hallo, selamat datang di sobat daging. Untuk informasi dan pemesanan
                                                    kakak / Bapak / Ibu bisa melihat dan menanyakan produk kami melalui tautan dibawah ini. 
                                                    Terima kasih, Enjoy your day !
                                                </p>
                                                <br>
                                                <a href="#" class="btn btn-border btn-blue btn-sobat-md">TOKOPEDIA</a>
                                                <a href="#" class="btn btn-border btn-blue btn-sobat-md">WHATSAPP</a>
                                                <br><br><br>
                                                <p class="nomargin pb20 text-left" style="color:white"> * Toko kami buka setiap hari senin-sabtu, tanyakan stock dan list harga secara langsung
                                                    melalui link diatas.
                                                </p>
                                                
                                                <p class="nomargin pb20 text-left" style="color:white">  Kami akan terus selalu mencoba memberikan pelayanan dan kualitas yang terbaik untuk anda.
                                                </p>
                                            
                                            </div>
                                        </article>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- End of Slide 1 -->
                
                <!-- Slide 2 -->
                <div class="swiper-slide overlay-black" data-swiper-autoplay="5000" style="background: url('<?php echo base_url()?>/assets/client/images/img/bg4.jpg'); background-size: cover;">
                    <div class="slider-content container">
                        <div class="col-md-12">
                            <p style="color:white;font-size:30px">Our Product Recommendation</p>
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <img class="img-thumbnail" src="<?php echo base_url()?>/assets/client/images/img/rec_image1.png" alt="ribeye slice" width="360px" height="360px" style="background-color: transparent;background-size: cover;border:0;border-radius: 20px;">
                                </div>
                                <div class="col-md-6 text-left">
                                    <div class="col-md-12">
                                        <img class="img-thumbnail " src="<?php echo base_url()?>/assets/client/images/img/rec_image2.png" alt="ribeye slice" width="200px" height="200px" style="background-color: transparent;background-size: cover;border:0;border-radius: 20px;">
                                        <img class="img-thumbnail" src="<?php echo base_url()?>/assets/client/images/img/rec_image3.png" alt="ribeye slice" width="200px" height="200px" style="background-color: transparent;background-size: cover;border:0;border-radius: 20px;">
                                    </div>
                                    <div class="col-md-12" style="margin-top:20px;">
                                        <img class="img-thumbnail" src="<?php echo base_url()?>/assets/client/images/img/rec_image4.png" alt="ribeye slice" width="200px" height="200px" style="background-color: transparent;background-size: cover;border:0;border-radius: 20px;">
                                        <img class="img-thumbnail" src="<?php echo base_url()?>/assets/client/images/img/rec_image5.png" alt="ribeye slice" width="200px" height="200px" style="background-color: transparent;background-size: cover;border:0;border-radius: 20px;">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p style="color:white;font-size:20px">Tidak menemukan product yang anda cari? klik order now untuk <br>
                            informasi product dan layanan kami.</p>
                            <div>
                                <a href="#" class="btn btn-border btn-blue btn-sobat-lg" onclick="show();">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Slide 2 -->

                <!-- Slide 3 -->
                <div class="swiper-slide overlay-black" data-swiper-autoplay="5000" style="background: url('<?php echo base_url()?>/assets/client/images/img/bg5.jpg'); background-size: cover;">
                    <div class="slider-content container">
                        <div class="col-md-12" style="margin-top:-90px">
                            <p style="color:white;font-size:34px">Testimoni Konsumen</p>
                            <div class="container-fluid px-3 px-sm-5 my-5 text-center">
                                <div class="owl-carousel owl-theme">
                                    <div class="item first prev">
                                        <div class="card-testimoni">
                                            <div class="col-sm-5"> <img src="<?php echo base_url()?>/assets/client/images/img/bintang5.png"></div>
                                            <br>
                                            <p class="content-testimoni" style="margin-top:20px">"Dagingnya masih merah, rasanya enak dan gk banyak
                                            lemaknya. Pengiriman cepet meskipun ada kendala di kurir tapi adminya fast response buat bantuin pengirimannya. Makasih 
                                            Sobat Daging"</p>
                                            <div class="content-testimoni-footer" style="margin-top:100px">
                                                <h3 class="text-left" style="color:#B89874">Mrs Subjik</h3>
                                                <p class="text-left" style="color:white;font-size:11px">by WA Sobat Daging</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item show">
                                        <div class="card-testimoni">
                                            <div class="col-sm-5"> <img src="<?php echo base_url()?>/assets/client/images/img/bintang5.png"></div>
                                            <br>
                                            <p class="content-testimoni" style="margin-top:100px">"Dagingnya enak banget juicys<br>dan pas banget potonganya. Kualitas oke harga the best."</p>
                                            <div class="content-testimoni-footer">
                                                <h3 class="text-left" style="color:#B89874">Mrs Tiara</h3>
                                                <p class="text-left" style="color:white;font-size:11px">by Tokopedia Sobat Daging</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item next">
                                        <div class="card-testimoni">
                                            <div class="col-sm-5"> <img src="<?php echo base_url()?>/assets/client/images/img/bintang5.png"></div>
                                            <br>
                                            <p class="content-testimoni" style="margin-top:20px">"Alhamdulilah daging Wagyu slices untuk bulgoginya
                                            sampai dgn tepat waktu dan dlm kondisi segar dan bagus, ini order yg kedua kalinya, service dr seller 
                                            dan kurirnya sangat ramah dan baik, saya sangat puas, terimakasih tuk seller, tokped dan kurir, semoga
                                            qualitas produk dan pelayanan baiknya tetap dijaga dgn baik"</p>
                                            <div class="content-testimoni-footer" style="margin-top:60px">
                                                <h3 class="text-left" style="color:#B89874">Mrs Elya</h3>
                                                <p class="text-left" style="color:white;font-size:11px">by Tokopedia Sobat Daging</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item last">
                                        <div class="card-testimoni">
                                            <div class="col-sm-5"> <img src="<?php echo base_url()?>/assets/client/images/img/bintang5.png"></div>
                                            <br>
                                            <p class="content-testimoni" style="margin-top:20px">"Dagingnya masih merah, rasanya enak dan gk banyak
                                            lemaknya. Pengiriman cepet meskipun ada kendala di kurir tapi adminya fast response buat bantuin pengirimannya. Makasih 
                                            Sobat Daging"</p>
                                            <div class="content-testimoni-footer" style="margin-top:100px">
                                                <h3 class="text-left" style="color:#B89874">Mrs Filaxsis</h3>
                                                <p class="text-left" style="color:white;font-size:11px">by WA Sobat Daging</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    </div>
                </div>
                <!-- End of Slide 3 -->
            </div>
            <!-- End of Swiper Wrapper -->

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

        </div>       
        <!-- End of Swiper Container -->
    </section>
    <!-- ===== End of Main Section - Slider ===== -->
