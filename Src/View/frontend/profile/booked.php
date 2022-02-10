<div class="col-xs-12 col-sm-10 col-md-10 dashboard-content booking-trips">
    <h2 class="dash-content-title">Tour đã đặt</h2>
    <div class="dashboard-listing booking-listing">

        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>

                    <?php
                    foreach ($results['data'] as $result) {
                    ?>
                        <tr>
                            <td class="dash-list-icon booking-list-date">
                                <div class="b-date">
                                    <h3><?= date('d', strtotime($result['ngay_dat'])) ?></h3>
                                    <p>Tháng <?= date('m', strtotime($result['ngay_dat'])) ?></p>
                                </div>
                            </td>
                            <td class="dash-list-text booking-list-detail">
                                <h3><?= $result['ten_tour'] ?></h3>
                                <ul class="list-unstyled booking-info">
                                    <li><span>Mã đặt tour:</span> <?= $result['ma_dat_tour'] ?></li>
                                    <li><span>Ngày đặt:</span> lúc <?= date('H:i:s', strtotime($result['ngay_dat'])) ?> ngày <?= date('d/m/Y', strtotime($result['ngay_dat'])) ?></li>
                                    <li><span>Số lượng:</span> <?= $result['so_nguoi_lon'] ?> người lớn và <?= $result['so_tre_em'] ?> trẻ em</li>
                                    <li><span>Giá:</span> <?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</li>
                                    <li><span>Trạng thái:</span> 
                                        <?php
                                            if ($result['trang_thai'] == 1)
                                                echo '<span class="text-danger">Đang đợi xác nhận</span>';
                                            else if ($result['trang_thai'] == 2)
                                                echo '<span class="text-success">Đã được xác nhận</span>';
                                            else if ($result['trang_thai'] == 3)
                                                echo '<span class="text">Đã hoàn thành tour</span>';
                                            else
                                                echo 'Chưa xác định';
                                        ?>
                                    </li>
                                </ul>
                                <button class="btn btn-orange" onclick="location.href='/dattour/view/<?= $result['id'] ?>'">Xem chi tiết</button>
                                <button class="btn" onclick="location.href='/dattour/print/<?= $result['id'] ?>'">In hóa đơn đặt tour</button>
                                <?php
                                if ($result['trang_thai'] == 1) {
                                ?>
                                    <button id="cancel" class="btn" onclick="id_dat_tour = <?= $result['id'] ?>" data-toggle="modal" data-target="#cancel-modal">Hủy tour</button>
                                <?php
                                }
                                ?>
                            </td>
                            <!--<td class="dash-list-btn"><button class="btn btn-orange">Hủy</button><button class="btn">Approve</button></td>-->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div><!-- end table-responsive -->

        <hr/>
        <div class="pages">
            <ol class="pagination">
                <li><a href="/tour/list/<?= $results['page'] - 1 ?>" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>
                <?php
                for ($index = 1; $index <= $results['total']; $index++) {
                ?>
                    <li class="<?= $results['page'] == $index ? 'active' : '' ?>"><a href="/dattour/booked/<?= auth()->user()['id'] ?>?page=<?= $index ?>"><?= $index ?></a></li>
                <?php
                }
                ?>
                <li><a href="/tour/list/<?= $results['page'] + 1 ?>" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
            </ol>
        </div><!-- end pages -->
        
    </div><!-- end booking-listings -->

</div><!-- end columns -->

<div id="cancel-modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Chỉnh sửa thông tin</h3>
            </div><!-- end modal-header -->

            <div class="modal-body">
                <p>Bạn có muốn hủy đặt tour này?</p>
                <button id="cancel-button" class="btn btn-orange">Hủy</button>

            </div><!-- end modal-bpdy -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

<script>
    let id_dat_tour = 0;
    $('#cancel-button').click(() => {
        $.ajax({
            type: 'POST',
            url: '/dattour/cancel/' + id_dat_tour,
            dataType: 'json',
            success: (data) => {
                if (data.code == 'cancel_success') {
                    redirect('/dattour/booked/<?= auth()->user()['id'] ?>', 'Tour đã bị hủy');
                }
            },
            error: (xhr) => {
                $('#cancel-button').prop('disabled', false);
                $('#cancel-button').html('Hủy');
                showError('Lỗi không xác định');
            }
        })
        $('#cancel-button').prop('disabled', true);
        $('#cancel-button').html('Đang hủy...');
    })
</script>