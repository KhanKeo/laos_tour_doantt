<?= view('layouts.header') ?>

<?= view('frontend.layouts.head') ?>

<?php
    $loai = auth()->user()['loai'] == 2 ? 'taikhoanquanly' : 'taikhoankhachhang';
?>

<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper">
    <div id="dashboard" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dashboard-heading">
                        <h2>Tài khoản <span>
                                <?php
                                switch (auth()->user()['loai']) {
                                    case 2:
                                        echo 'Người quản lý';
                                        break;
                                    case 3:
                                        echo 'Khách hàng';
                                        break;
                                }
                                ?>
                            </span></h2>
                        <p>Chào <?= auth()->user()['ten'] ?>, chào mừng tới LAO TOUR!</p>
                        <p>Tất cả thông tin về tài khoản, đặt tour, trợ giúp và thẻ của bạn sẽ hiển thị ở đây</p>
                    </div><!-- end dashboard-heading -->

                    <div class="dashboard-wrapper">
                        <div class="row">

                            <div class="col-xs-12 col-sm-2 col-md-2 dashboard-nav">
                                <ul class="nav nav-tabs nav-stacked text-center">
                                    <li class="<?= headCompare("/$loai/view/" . auth()->user()['id']) ? 'active' : '' ?>">
                                        <a href="/<?= $loai ?>/view/<?= auth()->user()['id'] ?>"><span><i class="fa fa-user"></i></span>Hồ sơ</a>
                                    </li>
                                    <?php
                                    if (auth()->user()['loai'] == 3) {
                                    ?>
                                        <li class="<?= headCompare('/dattour/booked/' . auth()->user()['id']) ? 'active' : '' ?>">
                                            <a href="/dattour/booked/<?= auth()->user()['id'] ?>"><span><i class="fa fa-briefcase"></i></span>Tour đã đặt</a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="<?= headCompare('/trogiup/asked/' . auth()->user()['id']) ? 'active' : '' ?>">
                                        <a href="/trogiup/asked/<?= auth()->user()['id'] ?>"><span><i class="fa fa-briefcase"></i></span>Trợ giúp</a>
                                    </li>
                                    <li>
                                        <a href="cards.html"><span><i class="fa fa-credit-card"></i></span>Thẻ của tôi</a>
                                    </li>
                                </ul>
                            </div><!-- end columns -->

                            <div class="col-xs-12 col-sm-10 col-md-10 dashboard-content user-profile">
                                <?php view($view, $params) ?>
                            </div><!-- end columns -->

                        </div><!-- end row -->
                    </div><!-- end dashboard-wrapper -->
                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end dashboard -->
</section><!-- end innerpage-wrapper -->

<?= view('layouts.footer') ?>