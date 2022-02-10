<?php
if (isset($slides)) {
?>
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
<?php
} else {
?>
    <!--================= PAGE-COVER ================-->
    <section class="page-cover" id="cover-blog-listing">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title"><?= $myBlog == true ? 'My Blog' : 'Blog' ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Trang chủ</a></li>
                        <li class="active"><?= $myBlog == true ? 'My Blog' : 'Blog' ?></li>
                    </ul>
                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end page-cover -->
<?php
}
?>

<!--==== INNERPAGE-WRAPPER =====-->
<section class="innerpage-wrapper">
    <div id="blog-listings" class="innerpage-section-padding">
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

                        <?php
                        foreach ($results['data'] as $result) {
                        ?>
                            <div class="main-block blog-post blog-list">
                                <div class="main-img blog-post-img">
                                    <a href="/blog/view/<?= $result['id'] ?>">
                                        <img src="<?= asset('/images/blog/hinh' . $result['id'] . '.png') ?>" class="img-responsive" alt="blog-post-image" />
                                    </a>
                                    <div class="main-mask blog-post-info">
                                        <ul class="list-inline list-unstyled blog-post-info">
                                            <li><span><i class="fa fa-calendar"></i></span><?= date('d/m/Y', strtotime($result['ngay_dang'])) ?></li>
                                            <li><span><i class="fa fa-user"></i></span>Đăng bởi: <a href="#"><?= $result['ho_tai_khoan'] . ' ' . $result['ten_tai_khoan'] ?></a></li>
                                        </ul>
                                    </div>
                                </div><!-- end blog-post-img -->

                                <div class="blog-post-detail">
                                    <h2 class="blog-post-title"><a href="/blog/view/<?= $result['id'] ?>"><?= $result['tieu_de'] ?></a></h2>
                                    <p><?= $result['tom_tat'] ?></p>
                                    <a href="/blog/view/<?= $result['id'] ?>" class="btn btn-orange">Xem bài đăng</a>
                                    <?php
                                    if ($myBlog) {
                                    ?>
                                        <a href="/blog/userEdit/<?= $result['id'] ?>" class="btn btn-orange">Chỉnh sửa bài đăng</a>
                                        <button onclick="destroy(<?= $result['id'] ?>)" class="btn btn-orange">Xóa bài đăng</button>
                                    <?php
                                    }
                                    ?>
                                </div><!-- end blog-post-detail -->
                            </div><!-- end blog-post -->
                        <?php
                        }
                        ?>

                        <div class="pages">
                            <ol class="pagination">
                                <li><a href="/tour/list/<?= $results['page'] - 1 ?>" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>
                                <?php
                                for ($index = 1; $index <= $results['total']; $index++) {
                                ?>
                                    <li class="<?= $results['page'] == $index ? 'active' : '' ?>"><a href="/tour/list/<?= $index ?>"><?= $index ?></a></li>
                                <?php
                                }
                                ?>
                                <li><a href="/tour/list/<?= $results['page'] + 1 ?>" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
                            </ol>
                        </div><!-- end pages -->

                    </div><!-- end space-right -->
                </div><!-- end columns -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end blog-listings -->
</section><!-- end innerpage-wrapper -->

<!-- REMOVE MODAL -->
<div class="modal fade" id="destroy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa</h5>
            </div>
            <div class="modal-body">
                Xác nhận xóa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="confirmDestroy()">Xóa</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- END OF REMOVE MODAL -->

<script>
    let controller = 'blog';
    let id = 0;

    const destroy = (id_) => {
        id = id_;
        $('#destroy').modal('show');
    }

    const confirmDestroy = () => {
        $.ajax({
            type: 'POST',
            url: '/' + controller + '/destroy/' + id,
            dataType: 'json',
            success: (data) => {
                if (data.code === 'destroy_success') {
                    redirect('/' + controller + '/myBlog/<?= auth()->user()['id'] ?>', 'Xóa thành công');
                }
            },
            error: (xhr) => {
                redirect('/' + controller + '/index', 'Xóa không thành công', 'error');
            }
        })
    }
</script>