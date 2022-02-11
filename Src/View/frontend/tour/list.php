<!--================== PAGE-COVER =================-->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">TOUR</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Tour</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->

<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper">
    <div id="tour-listing" class="innerpage-section-padding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-3 side-bar left-side-bar">

                    <div class="side-bar-block filter-block">
                        <h3>Bộ lọc</h3>
                        <p>Sử dụng bộ lọc để tìm kiếm dễ dàng hơn</p>

                        <form action="/tour/list" method="post">
                            <div class="panels-group">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="#panel-1" data-toggle="collapse">Chọn quốc gia <span><i class="fa fa-angle-down"></i></span></a>
                                    </div><!-- end panel-heading -->

                                    <div id="panel-1" class="panel-collapse collapse">
                                        <div class="panel-body text-left">
                                            <ul class="list-unstyled">
                                                <li class="custom-check"><input type="checkbox" id="country0" name="countries[]" value="0" <?= in_array(0, $filterCountries) ? 'checked' : '' ?> />
                                                    <label for="country0"><span><i class="fa fa-check"></i></span>Tất cả</label>
                                                </li>
                                                <?php
                                                foreach ($countries as $country) {
                                                ?>
                                                    <li class="custom-check"><input type="checkbox" id="country<?= $country['id'] ?>" name="countries[]" value="<?= $country['id'] ?>" <?= in_array($country['id'], $filterCountries) ? 'checked' : '' ?> />
                                                        <label for="country<?= $country['id'] ?>"><span><i class="fa fa-check"></i></span><?= $country['ten'] ?></label>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="#panel-2" data-toggle="collapse">Số ngày <span><i class="fa fa-angle-down"></i></span></a>
                                    </div><!-- end panel-heading -->

                                    <div id="panel-2" class="panel-collapse collapse">
                                        <div class="panel-body text-left">
                                            <ul class="list-unstyled">
                                                <li class="custom-check"><input type="checkbox" id="check11" name="checkbox" />
                                                    <label for="check11"><span><i class="fa fa-check"></i></span>Tất cả</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check12" name="checkbox" />
                                                    <label for="check12"><span><i class="fa fa-check"></i></span>2 Ngày</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check13" name="checkbox" />
                                                    <label for="check13"><span><i class="fa fa-check"></i></span>3 Ngày</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check14" name="checkbox" />
                                                    <label for="check14"><span><i class="fa fa-check"></i></span>5 Ngày</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check15" name="checkbox" />
                                                    <label for="check15"><span><i class="fa fa-check"></i></span>7 Ngày</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check16" name="checkbox" />
                                                    <label for="check16"><span><i class="fa fa-check"></i></span>10 Ngày</label>
                                                </li>
                                            </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="#panel-3" data-toggle="collapse">Đánh giá <span><i class="fa fa-angle-down"></i></span></a>
                                    </div><!-- end panel-heading -->

                                    <div id="panel-3" class="panel-collapse collapse">
                                        <div class="panel-body text-left">
                                            <ul class="list-unstyled">
                                                <li class="custom-check"><input type="checkbox" id="check17" name="checkbox" />
                                                    <label for="check17"><span><i class="fa fa-check"></i></span>1 Sao</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check18" name="checkbox" />
                                                    <label for="check18"><span><i class="fa fa-check"></i></span>2 Sao</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check19" name="checkbox" />
                                                    <label for="check19"><span><i class="fa fa-check"></i></span>3 Sao</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check20" name="checkbox" />
                                                    <label for="check20"><span><i class="fa fa-check"></i></span>4 Sao</label>
                                                </li>
                                                <li class="custom-check"><input type="checkbox" id="check21" name="checkbox" />
                                                    <label for="check21"><span><i class="fa fa-check"></i></span>5 Sao</label>
                                                </li>
                                            </ul>
                                        </div><!-- end panel-body -->
                                    </div><!-- end panel-collapse -->
                                </div><!-- end panel-default -->

                            </div><!-- end panel-group -->

                            <button class="btn btn-orange btn-lg">Lọc</button>

                        </form>


                        <div class="price-slider">
                            <p><input type="text" id="amount" readonly></p>
                            <div id="slider-range"></div>
                        </div><!-- end price-slider -->
                    </div><!-- end side-bar-block -->

                </div><!-- end columns -->

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-side">

                    <?php
                    if (count($tours['data']) === 0) {
                    ?>
                        <h3 class="text-center" style="margin-top: 50px">Không tìm thấy kết quả</h3>
                    <?php
                    }
                    ?>

                    <?php
                    foreach ($tours['data'] as $tour) {
                        $now = date_create(date('Y-m-d H:i:s'));
                        $date = date_create($tour['ngay_ket_thuc']);
                    ?>
                        <div class="list-block t-list-block">
                            <div class="list-content">
                                <div class="main-img list-img t-list-img">
                                    <a href="/tour/view/<?= $tour['id'] ?>">
                                        <img src="<?= asset('images/tour/hinh' . $tour['id'] . '.png') ?>" class="img-responsive" alt="tour-img" />
                                    </a>
                                    <div class="main-mask">
                                        <ul class="list-unstyled list-inline offer-price-1">
                                            <li class="price"><?= number_format($tour['gia_nguoi_lon']) ?>đ<span class="divider">|</span><span class="pkg"><?= $tour['so_ngay'] ?> NGÀY <?= $tour['so_ngay'] - 1 ?> ĐÊM</span></li>
                                            <li class="rating">
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star lightgrey"></i></span>
                                            </li>
                                        </ul>
                                    </div><!-- end main-mask -->
                                </div><!-- end t-list-img -->

                                <div class="list-info t-list-info">
                                    <h3 class="block-title">
                                        <a href="/tour/view/<?= $tour['id'] ?>">
                                            <?php
                                                if ($now < $date) {
                                            ?>
                                                <?= $tour['ten'] ?>
                                            <?php
                                                } else {
                                            ?>
                                                <span class="text-danger"><?= $tour['ten'] ?> (Đã đóng)</span>
                                            <?php } ?>
                                        </a>
                                    </h3>
                                    <p class="block-minor"><?= $tour['ten_tinh_xuat_phat'] . ' - ' . $tour['ten_tinh_diem_den'] ?></p>
                                    <!-- <p><?= $tour['gioi_thieu'] ?></p> -->
                                    <?php
                                    if (auth()->check() && auth()->user()['loai'] == 2) {
                                    ?>
                                        <a href="/dattour/indexUser/<?= $tour['id'] ?>" class="btn btn-orange btn-lg">Xem đơn đặt hàng</a>
                                        <a href="/tour/userCopy/<?= $tour['id'] ?>" class="btn btn-orange btn-lg"><i class="fa fa-copy" aria-hidden="true"></i></a>
                                        <a href="/tour/userEdit/<?= $tour['id'] ?>" class="btn btn-orange btn-lg"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a onclick="destroy(<?= $tour['id'] ?>)" class="btn btn-danger btn-lg"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <?php
                                    }
                                    ?>
                                </div><!-- end t-list-info -->
                            </div><!-- end list-content -->
                        </div><!-- end t-list-block -->
                    <?php
                    }
                    ?>

                    <div class="pages">
                        <ol class="pagination">
                            <li><a href="/tour/list?page=<?= $tours['page'] - 1 ?>" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>
                            <?php
                            for ($index = 1; $index <= $tours['total']; $index++) {
                            ?>
                                <li class="<?= $tours['page'] == $index ? 'active' : '' ?>"><a href="/tour/list?page=<?= $index ?>"><?= $index ?></a></li>
                            <?php
                            }
                            ?>
                            <li><a href="/tour/list?page=<?= $tours['page'] + 1 ?>" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
                        </ol>
                    </div><!-- end pages -->
                </div><!-- end columns -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end tour-listing -->
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
    let controller = 'tour';
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
                    redirect('/' + controller + '/list/mylist', 'Xóa thành công');
                }
            },
            error: (xhr) => {
                redirect('/' + controller + '/list/mylist', 'Xóa không thành công', 'error');
            }
        })
    }
</script>