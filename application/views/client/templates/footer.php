
    <!-- ===== All Javascript at the bottom of the page for faster page loading ===== -->
    <script src="<?php echo base_url()?>assets/client/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/wow.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/swiper.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/simple-expand.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.countTo.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.inview.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.nav.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.ajaxchimp.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/jquery.easypiechart.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url()?>assets/client/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        
    function show(){
        $("#popup-welcome-sobat").show();
    }

    function hide(){
        $("#popup-welcome-sobat").hide();
    }

    $(document).ready(function() {

        $('.owl-carousel').owlCarousel({
            mouseDrag:false,
            loop:true,
            margin:2,
            nav:true,
            responsive:{
                0:{
                items:1
                },
                600:{
                items:1
                },
                1000:{
                items:3
                }
            }
        });

        $('.owl-prev').click(function() {
            $active = $('.owl-item .item.show');
            $('.owl-item .item.show').removeClass('show');
            $('.owl-item .item').removeClass('next');
            $('.owl-item .item').removeClass('prev');
            $active.addClass('next');
            if($active.is('.first')) {
                $('.owl-item .last').addClass('show');
                $('.first').addClass('next');
                $('.owl-item .last').parent().prev().children('.item').addClass('prev');
            }
            else {
                $active.parent().prev().children('.item').addClass('show');
                if($active.parent().prev().children('.item').is('.first')) {
                $('.owl-item .last').addClass('prev');
                }
                else {
                $('.owl-item .show').parent().prev().children('.item').addClass('prev');
                }
            }
        });

        $('.owl-next').click(function() {
                $active = $('.owl-item .item.show');
                $('.owl-item .item.show').removeClass('show');
                $('.owl-item .item').removeClass('next');
                $('.owl-item .item').removeClass('prev');
                $active.addClass('prev');
                if($active.is('.last')) {
                    $('.owl-item .first').addClass('show');
                    $('.owl-item .first').parent().next().children('.item').addClass('prev');
                }
                else {
                    $active.parent().next().children('.item').addClass('show');
                    if($active.parent().next().children('.item').is('.last')) {
                        $('.owl-item .first').addClass('next');
                    }
                    else {
                        $('.owl-item .show').parent().next().children('.item').addClass('next');
                    }
                }
            });

        });
    </script>

</body>
</html>