<!--================= PAGE-COVER ================-->
<section class="page-cover" id="cover-thank-you">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">Thông tin đặt tour</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thông tin đặt tour</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->


<!--==== INNERPAGE-WRAPPER =====-->
<section class="innerpage-wrapper">
    <div id="thank-you" class="innerpage-section-padding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-side">
                    <div class="space-right">
                        <div class="thank-you-note">
                            <h3>Thông tin đặt tour</h3>
                            <p>Lorem ipsum dolor sit amet, conse adipiscing elit curabitur.</p>
                            <a href="/dattour/print/<?= $result['id'] ?>" class="btn btn-orange">In thông tin tour</a>
                        </div><!-- end thank-you-note -->

                        <div class="traveler-info">
                            <h3 class="t-info-heading"><span><i class="fa fa-info-circle"></i></span>Thông tin khách hàng</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Mã đặt tour:</td>
                                            <td><?= $result['ma_dat_tour'] ?> (<a href="/tour/view/<?= $result['id_tour'] ?>">Xem thông tin tour</a>)</td>
                                        </tr>
                                        <tr>
                                            <td>Họ:</td>
                                            <td><?= $result['ho'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tên:</td>
                                            <td><?= $result['ten'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ email:</td>
                                            <td><?= $result['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Giá người lớn:</td>
                                            <td><?= number_format($result['gia_nguoi_lon']) ?>đ</td>
                                        </tr>
                                        <tr>
                                            <td>Giá trẻ em:</td>
                                            <td><?= number_format($result['gia_tre_em']) ?>đ</td>
                                        </tr>
                                        <tr>
                                            <td>Số người lớn:</td>
                                            <td><?= $result['so_nguoi_lon'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Số trẻ em:</td>
                                            <td><?= $result['so_tre_em'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tổng tiền:</td>
                                            <td><?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</td>
                                        </tr>
                                        <tr>
                                            <td>Trạng thái:</td>
                                            <td>
                                                <?php
                                                if ($result['trang_thai'] == 1)
                                                    echo '<span class="text-danger">Đang đợi xác nhận</span>';
                                                else if ($result['trang_thai'] == 2)
                                                    echo '<span class="text-success">Đã được xác nhận</span>';
                                                else if ($result['trang_thai'] == 3)
                                                    echo '<span class="text">Đã hoàn thành</span>';
                                                else
                                                    echo 'Chưa xác định';
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- end table-responsive -->

                            <div class="payment-method">
                                <h3 class="t-info-heading"><span><i class="fa fa-credit-card"></i></span>Phương thức thanh toán</h3>
                                <p></p>
                                <ul class="list-inline">
                                    <li><img src="images/payment-1.png" class="img-responsive" alt="payment-img" /></li>
                                    <li><img src="images/payment-2.png" class="img-responsive" alt="payment-img" /></li>
                                    <li class="active"><img src="images/payment-3.png" class="img-responsive" alt="payment-img" /></li>
                                    <li><img src="images/payment-4.png" class="img-responsive" alt="payment-img" /></li>
                                </ul>
                            </div><!-- end payment-method -->
                        </div><!-- end traveler-info -->
                    </div><!-- end space-right -->
                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 side-bar blog-sidebar right-side-bar">

                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <div class="side-bar-block contact">
                                <h2 class="side-bar-heading">LIÊN HỆ</h2>
                                <div class="c-list">
                                    <div class="icon"><span><i class="fa fa-envelope"></i></span></div>
                                    <div class="text">
                                        <p>khankeolaos1997@gmail.com</p>
                                    </div>
                                </div><!-- end c-list -->

                                <div class="c-list">
                                    <div class="icon"><span><i class="fa fa-phone"></i></span></div>
                                    <div class="text">
                                        <p>0915822429</p>
                                    </div>
                                </div><!-- end c-list -->

                                <div class="c-list">
                                    <div class="icon"><span><i class="fa fa-map-marker"></i></span></div>
                                    <div class="text">
                                        <p>Địa chỉ: 306 Duy Tân, Thành phố Kon Tum, Tỉnh Kon Tum</p>
                                    </div>
                                </div><!-- end c-list -->
                            </div><!-- end side-bar-block -->
                        </div><!-- end columns -->

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="side-bar-block follow-us">
                                <h2 class="side-bar-heading">THEO DÕI</h2>
                                <ul class="list-unstyled list-inline">
                                    <li><a href="#"><span><i class="fa fa-facebook"></i></span></a></li>
                                    <li><a href="#"><span><i class="fa fa-twitter"></i></span></a></li>
                                    <li><a href="#"><span><i class="fa fa-linkedin"></i></span></a></li>
                                    <li><a href="#"><span><i class="fa fa-google-plus"></i></span></a></li>
                                    <li><a href="#"><span><i class="fa fa-pinterest-p"></i></span></a></li>
                                </ul>
                            </div><!-- end side-bar-block -->
                        </div><!-- end columns -->

                    </div><!-- end row -->
                </div><!-- end columns -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end thank-you -->
</section><!-- end innerpage-wrapper -->