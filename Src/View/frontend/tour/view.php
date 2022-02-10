<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<!--================ PAGE-COVER ================-->
<section class="page-cover" id="cover-tour-detail">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title"><?= $result['ten'] ?></h1>
                <ul class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Xem tour</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end page-cover -->
<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper">
    <div id="tour-details" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-side">

                    <div class="detail-slider">
                        <div class="feature-slider">
                            <?php
                            foreach ($images as $image) {
                            ?>
                                <div><img src="<?= asset('images/tour_detail/tour' . $result['id'] . '/' . $image) ?>" class="img-responsive" alt="feature-img" /></div>
                            <?php
                            }
                            ?>
                        </div><!-- end feature-slider -->

                        <div class="feature-slider-nav">
                            <?php
                            foreach ($images as $image) {
                            ?>
                                <div><img src="<?= asset('images/tour_detail/tour' . $result['id'] . '/' . $image) ?>" class="img-responsive" alt="feature-thumb" /></div>
                            <?php
                            }
                            ?>
                        </div><!-- end feature-slider-nav -->


                        <ul class="list-unstyled features tour-features">
                            <li>
                                <div class="f-icon"><i class="fa fa-wheelchair"></i></div>
                                <div class="f-text">
                                    <p class="f-heading">Số lượng</p>
                                    <p class="f-data"><?= $result['da_dat'] ? $result['da_dat'] : 0 ?>/<?= $result['so_nguoi'] ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="f-icon"><i class="fa fa-calendar"></i></div>
                                <div class="f-text">
                                    <p class="f-heading">Số ngày</p>
                                    <p class="f-data"><?= $result['so_ngay'] ?> NGÀY <?= $result['so_ngay'] - 1 ?> ĐÊM</p>
                                </div>
                            </li>
                            <li>
                                <div class="f-icon"><i class="fa fa-clock-o"></i></div>
                                <div class="f-text">
                                    <p class="f-heading">Giảm giá</p>
                                    <p class="f-data"><?= number_format($result['giam_gia']) ?>%</p>
                                </div>
                            </li>
                        </ul>
                    </div><!-- end detail-slider -->

                    <div class="detail-tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#tour-information" data-toggle="tab">Thông tin tour</a></li>
                            <li><a href="#flight" data-toggle="tab">Đánh giá</a></li>
                            <li><a href="#map-overview" data-toggle="tab">Bản đồ</a></li>
                        </ul>

                        <div class="tab-content">

                            <div id="tour-information" class="tab-pane in active">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12 tab-text">
                                        <h3>Thông tin tour</h3>
                                        <p><i class="fa fa-calendar-o" aria-hidden="true"></i> Ngày khởi hành: <?= date('d/m/Y', strtotime($result['ngay_khoi_hanh'])) ?></p>
                                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> Giờ khởi hành: <?= date('H:i', strtotime($result['ngay_khoi_hanh'])) ?></p>
                                        <p><i class="fa fa-calendar-o" aria-hidden="true"></i> Ngày kết thúc: <?= date('H:i', strtotime($result['ngay_ket_thuc'])) . ' ngày ' . date('d/m/Y', strtotime($result['ngay_ket_thuc'])) ?></p>
                                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ xuất phát: <?= $result['dia_chi_xuat_phat'] ?></p>
                                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ điểm đến: <?= $result['dia_chi_diem_den'] ?></p>
                                        <p><i class="fa fa-bus" aria-hidden="true"></i> Phương tiện: <?= $result['phuong_tien'] ?></p>
                                        <h3>Bảng giá</h3>
                                        <p><i class="fa fa-male" aria-hidden="true"></i> Giá người lớn: <?= number_format($result['gia_nguoi_lon']) ?>đ</p>
                                        <p><i class="fa fa-child" aria-hidden="true"></i> Giá trẻ em: <?= number_format($result['gia_tre_em']) ?>đ</p>
                                        <?php
                                        $contents = $result['gioi_thieu'];
                                        $splittedContent = explode('@', $contents);
                                        $descriptions = [];
                                        $schedules = [];
                                        $includes = [];
                                        $notIncludes = [];
                                        $policies = [];
                                        foreach ($splittedContent as $content) {
                                            if (!empty($content)) {
                                                if (str_starts_with($content, 'description')) {
                                                    $content = preg_split('/\r\n|\r|\n/', $content);
                                                    $descriptions = array_slice($content, 1);
                                                } else if (str_starts_with($content, 'schedule')) {
                                                    $content = explode('#', $content);
                                                    $schedules = array_slice($content, 1);
                                                } else if (str_starts_with($content, 'include')) {
                                                    $content = preg_split('/\r\n|\r|\n/', $content);
                                                    $includes = array_slice($content, 1);
                                                } else if (str_starts_with($content, 'not_include')) {
                                                    $content = preg_split('/\r\n|\r|\n/', $content);
                                                    $notIncludes = array_slice($content, 1);
                                                } else if (str_starts_with($content, 'policy')) {
                                                    $content = preg_split('/\r\n|\r|\n/', $content);
                                                    $policies = array_slice($content, 1);
                                                }
                                            }
                                        }

                                        for ($index = 0; $index < count($schedules); $index++) {
                                            $schedule = $schedules[$index];
                                            $schedules[$index] = preg_split('/\r\n|\r|\n/', $schedule);
                                        }
                                        ?>
                                        <h3>Giới thiệu</h3>
                                        <?php foreach ($descriptions as $description) { ?>
                                            <p><?= $description ?></p>
                                        <?php } ?>
                                        <h3>Lịch trình</h3>
                                        <?php
                                        $index = 0;
                                        foreach ($schedules as $schedule) {
                                        ?>
                                            <h4><b>Ngày <?= $index + 1 ?>: <?= $schedule[0] ?></b></h4>
                                            <?php
                                            for ($index2 = 1; $index2 < count($schedule); $index2++) {
                                                $content = $schedule[$index2];
                                                if (str_starts_with($schedule[$index2], '!')) {
                                            ?>
                                                    <img src="<?= asset('images/tour_detail/tour' . $result['id'] . '/hinh' . substr($content, 1)) . '.png' ?>" width="100%" />
                                                <?php
                                                } else {
                                                ?>
                                                    <p><?= $content ?></p>
                                            <?php
                                                }
                                            }
                                            ?>
                                        <?php
                                            $index++;
                                        }
                                        ?>
                                        <h3>Bao gồm:</h3>
                                        <?php foreach ($includes as $include) { ?>
                                            <p><?= $include ?></p>
                                        <?php } ?>
                                        <h3>Không bao gồm:</h3>
                                        <?php foreach ($notIncludes as $notInclude) { ?>
                                            <p><?= $notInclude ?></p>
                                        <?php } ?>
                                        <h3 id="policy">Chính sách:</h3>
                                        <?php foreach ($policies as $policy) { ?>
                                            <p><?= $policy ?></p>
                                        <?php } ?>
                                    </div><!-- end columns -->
                                </div><!-- end row -->
                            </div><!-- end hotel-overview -->

                            <div id="flight" class="tab-pane">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 tab-text">
                                        <h3>Đánh giá</h3>
                                        <p>Chức năng hiện chưa có</p>
                                    </div><!-- end columns -->
                                </div><!-- end row -->
                            </div><!-- end restaurant -->

                            <div id="map-overview" class="tab-pane">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12 tab-text">
                                        <h3>Bản đồ</h3>
                                        <p>Chưa hoàn thiện</p>
                                        <div class="mapouter-product">
                                            <div class="gmap_canvas-product"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=14.36095807690311,107.99958508111317&hl=es;z=14&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-org.net"></a><br>
                                                <style>
                                                    .mapouter-product {
                                                        position: relative;
                                                        text-align: right;
                                                        padding: 10px;
                                                        background-color: white;
                                                    }
                                                </style>
                                                <style>
                                                    .gmap_canvas-product {
                                                        overflow: hidden;
                                                        background: none !important;
                                                        width: 100%;
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div><!-- end columns -->
                                </div><!-- end row -->
                            </div><!-- end pick-up -->

                        </div><!-- end tab-content -->
                    </div><!-- end detail-tabs -->

                </div><!-- end row -->

                <div class="col-xs-12 col-sm-12 col-md-3 side-bar left-side-bar">

                    <div class="side-bar-block booking-form-block">
                        <h2 class="selected-price"><?= number_format($result['gia_nguoi_lon']) ?>đ</h2>

                        <div class="booking-form">
                            <h3>Đặt tour</h3>
                            <p>Đặt tour ngay để không bỏ lỡ gói tour hấp dẫn</p>
                            <?php
                            $now = date_create(date('Y-m-d H:i:s'));
                            $date = date_create($result['ngay_khoi_hanh']);
                            if ((!auth()->check() || auth()->user()['loai'] == 3) && $now < $date) {
                            ?>

                                <form id="book">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Họ" id="ho" required value="<?= $user ? $user['ho'] : '' ?>" />
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Tên" id="ten" required value="<?= $user ? $user['ten'] : '' ?>" />
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Số điện thoại" id="sdt" required value="<?= $user ? $user['sdt'] : '' ?>" />
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email (Tùy chọn)" id="email" value="<?= $user ? $user['email'] : '' ?>" />
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-12 col-lg-6 no-sp-r">
                                            <div class="form-group">
                                                <input type="so_nguoi_lon" class="form-control" placeholder="Số người lớn" id="so_nguoi_lon" required />
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-12 col-lg-6 no-sp-l">
                                            <div class="form-group">
                                                <input type="so_tre_em" class="form-control" placeholder="Số trẻ em" id="so_tre_em" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Ghi chú" id="ghi_chu"></textarea>
                                    </div>

                                    <div class="form-group right-icon">
                                        <select class="form-control">
                                            <option selected>Phương thức thanh toán</option>
                                            <option>Credit Card</option>
                                            <option>Paypal</option>
                                        </select>
                                        <i class="fa fa-angle-down"></i>
                                    </div>

                                    <div class="checkbox custom-check">
                                        <input type="checkbox" id="check" />
                                        <label for="check"><span><i class="fa fa-check"></i></span>Tôi đã đọc các chấp nhận </label><a id="policy-button" style="cursor: pointer;"> điều khoản và điều kiện.</a>
                                    </div>

                                    <button id="book-button" class="btn btn-block btn-orange" disabled>Đặt tour</button>
                                </form>
                            <?php
                            } else {
                            ?>
                                <br/>
                                <h5 class="text-danger">Tour đã hết hạn đăng ký</h5>
                            <?php
                            }
                            ?>

                            <div class="row">

                                <div class="col-xs-12 col-sm-6 col-md-12">
                                    <div class="side-bar-block support-block">
                                        <h3>Trợ giúp</h3>
                                        <p>Nếu bạn có bất kỳ thắc mắc nào hãy gửi trợ giúp cho chúng tôi!</p>
                                        <p>Đăng nhập để gưỉ trợ giúp</p>
                                        <?php
                                        if (auth()->check()) {
                                        ?>
                                            <button class="btn btn-orange" data-toggle="modal" data-target="#create-modal">Gửi trợ giúp</button>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="/trangchu/loginPage" class="btn btn-orange">Đăng nhập ngay</a>
                                        <?php
                                        }
                                        ?>
                                    </div><!-- end side-bar-block -->
                                </div><!-- end columns -->

                            </div><!-- end row -->
                        </div><!-- end columns -->

                    </div><!-- end booking-form -->
                </div><!-- end side-bar-block -->

            </div><!-- end container -->
        </div><!-- end tour-detail -->
</section><!-- end innerpage-wrapper -->

<div id="create-modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Gửi trợ giúp</h3>
            </div><!-- end modal-header -->

            <div class="modal-body">
                <div class="form-group">
                    <label>Loại trợ giúp</label>
                    <select required class="form-control" id="id_loai_tro_giup">
                        <?php
                        foreach ($helpTypes as $type) {
                        ?>
                            <option value="<?= $type['id'] ?>"><?= $type['ten'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div><!-- end form-group -->

                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" placeholder="Nội dung" id="noi_dung"></textarea>
                </div><!-- end form-group -->

                <button id="confirm-send-help" class="btn btn-orange">Gửi trợ giúp</button>

            </div><!-- end modal-bpdy -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

<script>
    $('#book').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                ho: $('#ho').val(),
                ten: $('#ten').val(),
                sdt: $('#sdt').val(),
                email: $('#email').val(),
                so_nguoi_lon: $('#so_nguoi_lon').val(),
                so_tre_em: $('#so_tre_em').val() ? $('#so_tre_em').val() : 0,
                ghi_chu: $('#ghi_chu').val(),
            },
            url: '/dattour/insert/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'insert_success') {
                    redirect('/dattour/view/' + data.data.id, 'Đặt tour thành công');
                }
            },
            error: (xhr) => {
                $('#book-button').prop('disabled', false);
                $('#book-button').html('Đặt tour');
                if (xhr.responseJSON.code == 'insert_over')
                    showError('Tour hiện tại chỉ có thể đặt cho tối đa ' + xhr.responseJSON.remainSlot + ' người, quý khách vui lòng tìm kiếm tour khác hoặc giảm bớt số lượng đặt');
                else if (xhr.responseJSON.code == 'insert_emailNotExist')
                    showError('Email không tồn tại');
                else
                    showError('Lỗi không xác định');
            }
        });
        $('#book-button').prop('disabled', true);
        $('#book-button').html('Đang đặt tour...');
    })

    $('#check').click(function() {
        if ($(this).is(':checked')) {
            $('#book-button').prop('disabled', false);
        } else {
            $('#book-button').prop('disabled', true);
        }
    });

    $('#confirm-send-help').click(() => {
        $.ajax({
            type: 'POST',
            url: '/trogiup/insert/<?= $result['id'] ?>',
            data: {
                id_loai_tro_giup: $('#id_loai_tro_giup').val(),
                noi_dung: $('#noi_dung').val(),
            },
            dataType: 'json',
            success: (data) => {
                if (data.code == 'create_success') {
                    redirect('/trogiup/asked/<?= auth()->check() ? auth()->user()['id'] : 0 ?>', 'Trợ giúp đã được gửi đi');
                }
            },
            error: (xhr) => {
                $('#confirm-send-help').prop('disabled', false);
                $('#confirm-send-help').html('Gửi trợ giúp');
                showError('Lỗi không xác định');
            }
        })
        $('#confirm-send-help').prop('disabled', true);
        $('#confirm-send-help').html('Đang gửi trợ giúp');
    });

    $("#policy-button").click(function() {
        $('html, body').animate({
            scrollTop: $("#policy").offset().top - 100,
        }, 0);
    });
</script>