<!--========================= FLEX SLIDER =====================-->
<section class="flexslider-container" id="flexslider-container-4">

    <div class="flexslider slider tour-slider" id="slider-4">
        <ul class="slides">

            <?php
            foreach ($slides as $slide) {
            ?>
                <li class="item-1 back-size" style="background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(<?= asset('images/slide/hinh' . $slide['id'] . '.png') ?>) 50% 15%;background-size:cover;height:100%;">
                    <div class="meta">
                        <div class="container">
                            <span class="highlight-price highlight-2"></span>
                            <h2><?= $slide['tieu_de'] ?></h2>
                            <p><?= $slide['noi_dung'] ?></p>
                            <a href="<?= $slide['url'] ?>"><h5>Xem thêm</h5></a>
                        </div><!-- end container -->
                    </div><!-- end meta -->
                </li><!-- end item-1 -->
            <?php
            }
            ?>

        </ul>
    </div><!-- end slider -->
</section><!-- end flexslider-container -->

<!--=============== TOUR OFFERS ===============-->
<section id="hotel-offers" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2><?= $type == 'local' ? 'Tour trong nước' : 'Tour nước ngoài' ?></h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->

                <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-tour-offers">

                    <?php
                    foreach ($tours as $tour) {
                    ?>
                        <div class="item">
                            <div class="main-block tour-block">
                                <div class="main-img">
                                    <a href="/tour/view/<?= $tour['id'] ?>">
                                        <img src="<?= asset('images/tour/hinh' . $tour['id'] . '.png') ?>" class="img-responsive" alt="tour-img" />
                                    </a>
                                </div><!-- end offer-img -->

                                <div class="offer-price-2">
                                    <ul class="list-unstyled">
                                        <li class="price"><?= number_format($tour['gia_nguoi_lon']) ?>đ<a href="/tour/view/<?= $tour['id'] ?>"><span class="arrow"><i class="fa fa-angle-right"></i></span></a></li>
                                    </ul>
                                </div><!-- end offer-price-2 -->

                                <div class="main-info tour-info">
                                    <div class="main-title tour-title">
                                        <a href="/tour/view/<?= $tour['id'] ?>"><?= $tour['ten'] ?></a>
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

                <div class="view-all text-center">
                    <a href="/tour/list" class="btn btn-black">Xem thêm</a>
                </div><!-- end view-all -->
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end tour-offers -->