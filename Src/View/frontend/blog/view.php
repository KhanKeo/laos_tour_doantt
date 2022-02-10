<!--================= PAGE-COVER ================-->
<section class="page-cover" id="cover-blog-details">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title"><?= $result['tieu_de'] ?></h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Blog</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->


<!--==== INNERPAGE-WRAPPER =====-->
<section class="innerpage-wrapper">
    <div id="blog-details" class="innerpage-section-padding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 side-bar blog-sidebar left-side-bar">
                    
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <div class="side-bar-block tags">
                                <h2 class="side-bar-heading">Tags</h2>
                                <ul class="list-unstyled list-inline">
                                    <li><a href="#" class="btn btn-g-border">SPA</a></li>
                                    <li><a href="#" class="btn btn-g-border">Restaurant</a></li>
                                    <li><a href="#" class="btn btn-g-border">Searvices</a></li>
                                    <li><a href="#" class="btn btn-g-border">Wifi</a></li>
                                    <li><a href="#" class="btn btn-g-border">Tv</a></li>
                                    <li><a href="#" class="btn btn-g-border">Rooms</a></li>
                                    <li><a href="#" class="btn btn-g-border">Pools</a></li>
                                    <li><a href="#" class="btn btn-g-border">Work</a></li>
                                    <li><a href="#" class="btn btn-g-border">Sports</a></li>
                                </ul>
                            </div><!-- end side-bar-block -->
                        </div><!-- end columns -->

                    </div><!-- end row -->
                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-side">
                    <div class="space-right">

                        <div class="blog-post">
                            <div class="main-img blog-post-img">
                                <img src="<?= asset('/images/blog/hinh' . $result['id'] . '.png') ?>" class="img-responsive" alt="blog-post-image" />
                                <div class="main-mask blog-post-info">
                                    <ul class="list-inline list-unstyled blog-post-info">
                                        <li><span><i class="fa fa-calendar"></i></span><?= date('d/m/Y', strtotime($result['ngay_dang'])) ?></li>
                                        <li><span><i class="fa fa-user"></i></span>Đăng bởi: <a href="#"><?= $result['ho_tai_khoan'] . ' ' . $result['ten_tai_khoan'] ?></a></li>
                                    </ul>
                                </div>
                            </div><!-- end blog-post-img -->

                            <div class="blog-post-detail">
                                <h2 class="blog-post-title"><?= $result['tieu_de'] ?></h2>
                                <?= $result['noi_dung'] ?>
                            </div><!-- end blog-post-detail -->
                        </div><!-- end blog-post -->

                        <div id="comment-form">
                            <div class="innerpage-heading">
                                <h1>Add Comment</h1>
                            </div><!-- end innerpage-heading -->

                            <form>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control input input-lg" placeholder="Your Name" required />
                                        </div>
                                    </div><!-- end columns -->

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control input input-lg" placeholder="Your Email" required />
                                        </div>
                                    </div><!-- end columns -->
                                </div><!-- end row -->

                                <div class="form-group">
                                    <textarea class="form-control input-lg" rows="5" placeholder="Your Message"></textarea>
                                </div>

                                <button class="btn btn-orange">Submit</button>
                            </form>
                        </div><!-- end comment-form -->

                    </div><!-- end space-right -->
                </div><!-- end columns -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end blog-details -->
</section><!-- end innerpage-wrapper -->