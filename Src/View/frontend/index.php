<?php view('layouts.header'); ?>

<?php view('frontend.layouts.head') ?>

<?php view($view, $params) ?>

<?php
if (isset($hideFooter) && $hideFooter) {
} else {
?>
<!--======================= FOOTER =======================-->
<section id="footer" class="ftr-heading-o ftr-heading-mgn-1">

    <div id="footer-top" class="banner-padding ftr-top-grey ftr-text-white">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-5 footer-widget ftr-contact">
                    <h3 class="footer-heading">THÔNG TIN LIÊN HỆ</h3>
                    <ul class="list-unstyled">
                        <li><span><i class="fa fa-map-marker"></i></span>704 Phan Đình Phùng, phường Quang Trung, thành phố Kon Tum</li>
                        <li><span><i class="fa fa-phone"></i></span>0915822429</li>
                        <li><span><i class="fa fa-envelope"></i></span>khankeolaos1997@gmail.com</li>
                        <li>
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe width="100%" height="300px" id="gmap_canvas" src="https://maps.google.com/maps?q=704%20phan%20%C4%90%C3%ACnh%20Ph%C3%B9ng,%20ph%C6%B0%E1%BB%9Dng%20Quang%20Trung,%20Kon%20Tum&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com/divi-discount/"></a><br>
                                    <style>
                                        .mapouter {
                                            position: relative;
                                            text-align: right;
                                            height: 300px;
                                            width: 100%;
                                        }
                                    </style><a href="https://www.embedgooglemap.net">google map website widget</a>
                                    <style>
                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                            height: 300px;
                                            width: 100%;
                                        }
                                    </style>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-3 footer-widget ftr-links">
                    <h3 class="footer-heading">TRANG</h3>
                    <ul class="list-unstyled">
                        <li><a href="/trangchu/index">Trang chủ</a></li>
                        <li><a href="/tour/local">Tour trong nước</a></li>
                        <li><a href="/tour/foreign">Tour nước ngoài</a></li>
                        <li><a href="/blog/list">Blog</a></li>
                    </ul>
                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 footer-widget ftr-about">
                    <h3 class="footer-heading">THÔNG TIN</h3>
                    <img src="\Images_Tour\qr_code.png">
                    <p>QRCode my facebook</p>
                    <ul class="social-links list-inline list-unstyled">
                        <li><a href="#"><span><i class="fa fa-facebook"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-twitter"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-google-plus"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-pinterest-p"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-instagram"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-linkedin"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-youtube-play"></i></span></a></li>
                    </ul>
                </div><!-- end columns -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end footer-top -->

</section><!-- end footer -->
<?php
}
?>

</section>
<!-- End of footer -->

<?php view('layouts.footer'); ?>