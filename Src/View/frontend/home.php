<!--========================= FLEX SLIDER =====================-->
<section class="flexslider-container" id="flexslider-container-1">

    <div class="flexslider slider" id="slider-1">
        <ul class="slides">

            <?php
            foreach ($slides as $slide) {
            ?>
                <li class="item-1" style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url(<?= asset('images/slide/hinh' . $slide['id'] . '.png') ?>) 50% 0%; background-size:cover; height:100%;">
                    <div class=" meta">
                        <div class="container">
                            <h1><?= $slide['tieu_de'] ?></h1>
                            <h2><?= $slide['noi_dung'] ?></h2>
                            <a href="<?= $slide['url'] ?>" class="btn btn-default" style="margin-top: 20px">Xem chi tiết</a>
                        </div><!-- end container -->
                    </div><!-- end meta -->
                </li><!-- end item-1 -->
            <?php
            }
            ?>

        </ul>
    </div><!-- end slider -->

    <div class="search-tabs" id="search-tabs-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="tab-content">

                        <div id="tours" class="tab-pane in active">
                            <form action="/tour/list" method="get">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">
                                        <div class="form-group left-icon">
                                            <input type="text" name="diem_den" class="form-control" placeholder="Điểm đến" />
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                    </div><!-- end columns -->

                                    <div class="col-xs-12 col-sm-2">
                                        <div class="form-group left-icon">
                                            <input type="text" name="ngay_khoi_hanh" class="form-control dpd1" placeholder="Ngày bắt đầu">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div><!-- end columns -->

                                    <div class="col-xs-12 col-sm-2">
                                        <div class="form-group left-icon">
                                            <input type="text" name="ngay_ket_thuc" class="form-control dpd1" placeholder="Ngày kết thúc">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div><!-- end columns -->

                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                        <div class="form-group right-icon">
                                            <select class="form-control" name="thang">
                                                <option selected value="">Tháng</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div><!-- end columns -->

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 search-btn">
                                        <button class="btn btn-orange">Search</button>
                                    </div><!-- end columns -->

                                </div><!-- end row -->
                            </form>
                        </div><!-- end tours -->

                    </div><!-- end tab-content -->

                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end search-tabs -->

</section><!-- end flexslider-container -->
<!--=============== TOUR OFFERS ===============-->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2>TOUR NỔI BẬT</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->

                <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-tour-offers">

                    <?php
                    foreach ($hotTours as $hotTour) {
                    ?>
                        <div class="item">
                            <div class="main-block tour-block">
                                <div class="main-img">
                                    <a href="/tour/view/<?= $hotTour['id'] ?>">
                                        <img src="<?= asset('images/tour/hinh' . $hotTour['id'] . '.png') ?>" class="img-responsive" alt="tour-img" />
                                    </a>
                                </div><!-- end offer-img -->

                                <div class="offer-price-2">
                                    <ul class="list-unstyled">
                                        <li class="price"><?= number_format($hotTour['gia_nguoi_lon']) ?>Đ<a href="/trangchu/tour_detail/<?= $hotTour['id'] ?>"><span class="arrow"><i class="fa fa-angle-right"></i></span></a></li>
                                    </ul>
                                </div><!-- end offer-price-2 -->

                                <div class="main-info tour-info">

                                    <div class="tour-detail">
                                        <div>
                                            <div><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
                                            <div><?= $hotTour['phuong_tien'] ?></div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                            <div><?= $hotTour['thoi_gian'] ?> ngày <?=$hotTour['thoi_gian'] - 1 ?> đêm</div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
                                            <div><?= $hotTour['dia_chi_diem_den'] ?></div>
                                        </div>
                                    </div>

                                    <div class="main-title tour-title">
                                        <a href="/tour/view/<?= $hotTour['id'] ?>"><?= $hotTour['ten'] ?></a>
                                        <div class="rating">
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star grey"></i></span>
                                        </div>
                                    </div><!-- end tour-title -->
                                </div><!-- end tour-info -->
                            </div><!-- end tour-block -->
                        </div><!-- end item -->
                    <?php
                    }
                    ?>

                </div><!-- end columns -->
                <div class="view-all text-center">
                    <a href="/tour/list" class="btn btn-orange">Xem thêm</a>
                </div><!-- end view-all -->
            </div><!-- end row -->
        </div><!-- end container -->
</section><!-- end tour-offers -->

<!--=============== TOUR OFFERS ===============-->
<section id="hotel-offers" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2>TOUR KHUYẾN MÃI</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->

                <div class="row">

                    <?php
                    foreach ($promotionTours as $promotionTour) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6" style="margin-bottom: 30px">
                            <div class="main-block tour-block">
                                <div class="main-img">
                                    <a href="/tour/view/<?= $promotionTour['id'] ?>">
                                        <img src="<?= asset('images/tour/hinh' . $promotionTour['id'] . '.png') ?>" class="img-responsive" alt="tour-img" />
                                    </a>
                                </div><!-- end offer-img -->

                                <div class="offer-price-2">
                                    <ul class="list-unstyled">
                                        <li class="price"><?= number_format($promotionTour['gia_nguoi_lon']) ?>đ <del class="text-danger"><small><?= number_format($promotionTour['gia_goc_nguoi_lon']) ?>đ </small></del></li>
                                    </ul>
                                </div><!-- end offer-price-2 -->

                                <div class="main-info tour-info">

                                    <div class="tour-detail">
                                        <div>
                                            <div><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
                                            <div><?= $promotionTour['phuong_tien'] ?></div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                            <div><?= $promotionTour['thoi_gian'] ?> ngày <?=$promotionTour['thoi_gian'] - 1 ?> đêm</div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
                                            <div><?= $promotionTour['dia_chi_diem_den'] ?></div>
                                        </div>
                                    </div>

                                    <div class="main-title tour-title">
                                        <a href="/tour/view/<?= $promotionTour['id'] ?>"><?= $promotionTour['ten'] ?></a>
                                        <div class="rating">
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star grey"></i></span>
                                        </div>
                                    </div><!-- end tour-title -->
                                </div><!-- end tour-info -->
                            </div><!-- end tour-block -->
                        </div><!-- end item -->
                    <?php
                    }
                    ?>

                </div><!-- end owl-tour-offers -->

            </div><!-- end columns -->

            <div class="view-all text-center">
                <a href="/tour/list" class="btn btn-black">Xem thêm</a>
            </div><!-- end view-all -->

        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end tour-offers -->

<!--======================= BEST FEATURES =====================-->
<section id="best-features" class="banner-padding black-features">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="b-feature-block">
                    <span><i class="fa fa-dollar"></i></span>
                    <h3>Giá cả hợp lý</h3>
                    <p>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis.</p>
                </div><!-- end b-feature-block -->
            </div><!-- end columns -->

            <div class="col-sm-6 col-md-3">
                <div class="b-feature-block">
                    <span><i class="fa fa-lock"></i></span>
                    <h3>An toàn và bảo mật</h3>
                    <p>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis.</p>
                </div><!-- end b-feature-block -->
            </div><!-- end columns -->

            <div class="col-sm-6 col-md-3">
                <div class="b-feature-block">
                    <span><i class="fa fa-thumbs-up"></i></span>
                    <h3>Các đại lý du lịch tốt nhất</h3>
                    <p>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis.</p>
                </div><!-- end b-feature-block -->
            </div><!-- end columns -->

            <div class="col-sm-6 col-md-3">
                <div class="b-feature-block">
                    <span><i class="fa fa-bars"></i></span>
                    <h3>Hướng dẫn viên du lịch chuyên nghiệp</h3>
                    <p>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis.</p>
                </div><!-- end b-feature-block -->
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end best-features -->

<!--=============== TOUR OFFERS ===============-->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2>TOUR MỚI NHẤT</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->

                <div class="row">

                    <?php
                    foreach ($newestTours as $newestTour) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6" style="margin-bottom: 30px">
                            <div class="main-block tour-block">
                                <div class="main-img">
                                    <a href="/tour/view/<?= $newestTour['id'] ?>">
                                        <img src="<?= asset('images/tour/hinh' . $newestTour['id'] . '.png') ?>" class="img-responsive" alt="tour-img" />
                                    </a>
                                </div><!-- end offer-img -->

                                <div class="offer-price-2">
                                    <ul class="list-unstyled">
                                        <li class="price"><?= number_format($newestTour['gia_nguoi_lon']) ?>đ<a href="/trangchu/tour_detail/<?= $newestTour['id'] ?>"><span class="arrow"><i class="fa fa-angle-right"></i></span></a></li>
                                    </ul>
                                </div><!-- end offer-price-2 -->

                                <div class="main-info tour-info">

                                    <div class="tour-detail">
                                        <div>
                                            <div><i class="fa fa-motorcycle" aria-hidden="true"></i></div>
                                            <div><?= $newestTour['phuong_tien'] ?></div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                            <div><?= $newestTour['thoi_gian'] ?> ngày <?=$newestTour['thoi_gian'] - 1 ?> đêm</div>
                                        </div>
                                        <div>
                                            <div><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
                                            <div><?= $newestTour['dia_chi_diem_den'] ?></div>
                                        </div>
                                    </div>

                                    <div class="main-title tour-title">
                                        <a href="/tour/view/<?= $newestTour['id'] ?>"><?= $newestTour['ten'] ?></a>
                                        <div class="rating">
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star orange"></i></span>
                                            <span><i class="fa fa-star grey"></i></span>
                                        </div>
                                    </div><!-- end tour-title -->
                                </div><!-- end tour-info -->
                            </div><!-- end tour-block -->
                        </div><!-- end item -->
                    <?php
                    }
                    ?>

                </div><!-- end columns -->
                <div class="view-all text-center">
                    <a href="/tour/list" class="btn btn-orange">Xem thêm</a>
                </div><!-- end view-all -->
            </div><!-- end row -->
        </div><!-- end container -->
</section><!-- end tour-offers -->

<!--==================== TESTIMONIALS ====================-->
<section id="testimonials" class="section-padding back-size">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading white-heading">
                    <h2>Lời chứng thực</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->

                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    <div class="carousel-inner text-center">

                        <div class="item active">
                            <blockquote>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper.</blockquote>
                            <div class="rating">
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star lightgrey"></i></span>
                            </div><!-- end rating -->
                            <small>SODP Khankeo</small>
                        </div><!-- end item -->

                        <div class="item">
                            <blockquote>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper.</blockquote>
                            <div class="rating">
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star lightgrey"></i></span>
                            </div><!-- end rating -->

                            <small>SODP Khankeo</small>
                        </div><!-- end item -->

                        <div class="item">
                            <blockquote>Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper Lorem ipsum dolor sit amet, ad duo fugit aeque fabulas, in lucilius prodesset pri. Veniam delectus ei vis. Est atqui timeam mnesarchum at, pro an eros perpetua ullamcorper.</blockquote>
                            <div class="rating">
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star orange"></i></span>
                                <span><i class="fa fa-star lightgrey"></i></span>
                            </div><!-- end rating -->

                            <small> Khankeo</small>
                        </div><!-- end item -->

                    </div><!-- end carousel-inner -->

                    <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"><img src="\Images_Tour\profile1.jpg" class="img-responsive" alt="client-img">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="1"><img src="\Images_Tour\profile1.jpg" class="img-responsive" alt="client-img">
                        </li>
                        <li data-target="#quote-carousel" data-slide-to="2"><img src="\Images_Tour\profile1.jpg" class="img-responsive" alt="client-img">
                        </li>
                    </ol>

                </div><!-- end quote-carousel -->
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end testimonials -->