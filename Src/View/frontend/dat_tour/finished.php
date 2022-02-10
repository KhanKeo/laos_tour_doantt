<?php
$controller = 'dattour';
?>

<!--BREADCRUMB -->
<section class="page-cover page-cover-admin" id="cover-tour-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title"><?= $tour['ten'] ?></h1>
                <ul class="breadcrumb">
                    <li><a href="/thongke/index">Trang chủ</a></li>
                    <li class="active">Danh sách đặt tour</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div>
</section>
<!-- END OF BREADCRUMB -->
<br />
<br />
<br />

<div class="container tab-text">
    <div class="row">

        <div class="col-sm-2">
            <h3>Thông tin</h3>
            <p><i class="fa fa-calendar-o" aria-hidden="true"></i> Ngày khởi hành: <?= date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) ?></p>
            <p><i class="fa fa-clock-o" aria-hidden="true"></i> Giờ khởi hành: <?= date('H:i', strtotime($tour['ngay_khoi_hanh'])) ?></p>
            <p><i class="fa fa-calendar-o" aria-hidden="true"></i> Ngày kết thúc: <?= date('H:i', strtotime($tour['ngay_ket_thuc'])) . ' ngày ' . date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) ?></p>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ xuất phát: <?= $tour['dia_chi_xuat_phat'] ?></p>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ điểm đến: <?= $tour['dia_chi_diem_den'] ?></p>
            <p><i class="fa fa-bus" aria-hidden="true"></i> Phương tiện: <?= $tour['phuong_tien'] ?></p>
            <h3>Bảng giá</h3>
            <p><i class="fa fa-male" aria-hidden="true"></i> Người lớn: <?= number_format($tour['gia_nguoi_lon']) ?>đ</p>
            <p><i class="fa fa-child" aria-hidden="true"></i> Trẻ em: <?= number_format($tour['gia_tre_em']) ?>đ</p>
            <a class="btn btn-orange" href="/dattour/printList/<?= $tour['id'] ?>">In danh sách</a>
        </div>

        <div class="col-sm-10">
            <!-- USER TAB -->
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="/dattour/indexUser/<?= $tour['id'] ?>">Chưa xác nhận</a></li>
                <li role="presentation"><a href="/dattour/progressUser/<?= $tour['id'] ?>">Đang thực hiện</a></li>
                <li role="presentation" class="active"><a>Đã hoàn thành</a></li>
                <li role="presentation"><a href="/dattour/canceledUser/<?= $tour['id'] ?>">Đã hủy</a></li>
            </ul>
            <br />
            <!-- END OF USER TAB -->

            <!-- TOOLBOX -->
            <div class="mt-2">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <button class="btn btn-primary" onclick="location.href='/<?= $controller ?>/create'">Thêm mới</button> -->
                    </div>
                    <div class="col-sm-6">
                        <form id="search" style="display: flex; justify-content: end;">
                            <?php
                            if ($search != '') {
                            ?>
                                <button type="button" onclick="location.href='/<?= $controller ?>/finishedUser/<?= $tour['id'] ?>'" class="btn btn-white"><i class="fa fa-repeat"></i></button>
                            <?php
                            }
                            ?>
                            <input id="input-search" class="form-control" style="width: auto;" placeholder="Tìm kiếm..." value="<?= $search ?>" onClick="this.select();" />
                            <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END OF TOOLBOX -->

            <!-- TABLE GRID -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đặt tour</th>
                        <th>Tên người đặt</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Số lượng người lớn</th>
                        <th>Số lượng trẻ em</th>
                        <th>Thành tiền</th>
                        <th>Ngày đặt</th>
                        <th>Ghi chú</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 1;
                    foreach ($results['data'] as $result) {
                    ?>
                        <tr>
                            <td><?= $cnt ?></td>
                            <td><?= $result['ma_dat_tour'] ?></td>
                            <td><?= $result['ho'] . ' ' . $result['ten'] ?></td>
                            <td><?= $result['sdt'] ?></td>
                            <td><?= $result['email'] ?></td>
                            <td><?= $result['so_nguoi_lon'] ?></td>
                            <td><?= $result['so_tre_em'] ?></td>
                            <td><?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</td>
                            <td><?= $result['ngay_dat'] ?></td>
                            <td><?= $result['ghi_chu'] ?></td>
                            <td>
                                <div>
                                    <a onclick="destroy(<?= $result['id'] ?>)">
                                        <button type="button" class="btn btn-danger btn-block" style="display:inline;width:auto;margin-left:10px;">Xóa</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $cnt = $cnt + 1;
                    }
                    ?>
                </tbody>
            </table>
            <!-- END OF TABLE GRID -->

            <!-- PAGINATION -->
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-center">
                    <?php
                    for ($index = 1; $index <= $results['total']; $index++) {
                    ?>
                        <li class="page-item <?= $results['page'] == $index ? 'active' : '' ?>"><a class="page-link" href="/<?= $controller ?>/finishedUser/<?= $tour['id'] ?>?page=<?= $index ?>"><?= $index ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <!-- END OF PAGINATION -->
        </div>

    </div>

</div><!-- end container -->


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

<!-- REMOVE MODAL -->
<div class="modal fade" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
            </div>
            <div class="modal-body form-horizontal">
                <p>Xác nhận đặt tour</p>
                <div class="form-group">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="loi_nhac" id="loi_nhac" placeholder="Lời nhắc" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="confirm-button" type="button" class="btn btn-primary" onclick="confirmAccept()">Xác nhận đặt tour</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- END OF REMOVE MODAL -->

<script>
    let controller = '<?= $controller ?>';
    let id = 0;

    $('#search').submit(() => {
        event.preventDefault();

        let search = $('#input-search').val();
        redirect('/' + controller + '/finishedUser/<?= $tour['id'] ?>?page=<?= $results['page'] ?>' + '&search=' + search);
    });

    const destroy = (id_) => {
        id = id_;
        $('#destroy').modal('show');
    }

    const accept = (id_) => {
        id = id_;
        $('#accept').modal('show');
    }

    const confirmDestroy = () => {
        $.ajax({
            type: 'POST',
            url: '/' + controller + '/destroy/' + id,
            dataType: 'json',
            success: (data) => {
                if (data.code === 'destroy_success') {
                    redirect('/' + controller + '/finishedUser/<?= $tour['id'] ?>', 'Xóa thành công');
                }
            },
            error: (xhr) => {
                redirect('/' + controller + '/finishedUser/<?= $tour['id'] ?>', 'Xóa không thành công', 'error');
            }
        })
    }

    const confirmAccept = () => {
        $.ajax({
            type: 'POST',
            url: '/' + controller + '/confirmFinished/' + id,
            dataType: 'json',
            data: {
                loi_nhac: $('#loi_nhac').val(),
            },
            success: (data) => {
                $('#confirm-button').prop('disabled', false);
                $('#confirm-button').html('Xác nhận đặt tour');

                if (data.code === 'confirm_success') {
                    redirect('/' + controller + '/finishedUser/<?= $tour['id'] ?>', 'Xác nhận thành công');
                }
            },
            error: (xhr) => {
                $('#confirm-button').prop('disabled', false);
                $('#confirm-button').html('Xác nhận đặt tour');

                if (xhr.responseJSON.code == 'update_mailFail')
                    showError('Không thể gửi email, kiểm tra lại mạng!')
                else
                    showError('Lỗi không xác định')
            }
        });

        $('#confirm-button').prop('disabled', true);
        $('#confirm-button').html('Đang xác nhận...');
    }
</script>