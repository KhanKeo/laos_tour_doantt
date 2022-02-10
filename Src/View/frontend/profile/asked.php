<div class="col-xs-12 col-sm-10 col-md-10 dashboard-content booking-trips">
    <h2 class="dash-content-title">Trợ giúp của bạn</h2>
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
                                    <h3><?= date('d', strtotime($result['ngay_gui'])) ?></h3>
                                    <p>Tháng <?= date('m', strtotime($result['ngay_gui'])) ?></p>
                                </div>
                            </td>
                            <td class="dash-list-text booking-list-detail">
                                <h3><?= $result['loai_tro_giup'] ?></h3>
                                <ul class="list-unstyled booking-info">
                                    <li>
                                        <p><span>Tour:</span> <?= $result['ten_tour'] ?>(<a href="/tour/view/<?= $result['id_tour'] ?>" target="_blank">Xem chi tiết</a>)</p>
                                    </li>
                                    <li><span>Ngày gửi:</span> lúc <?= date('H:i:s', strtotime($result['ngay_gui'])) ?> ngày <?= date('d/m/Y', strtotime($result['ngay_gui'])) ?></li>
                                    <li>
                                        <p><span>Nội dung gửi:</span> <?= $result['noi_dung'] ?></p>
                                    </li>
                                    <hr />
                                    <?php
                                    if ($result['tra_loi']) {
                                    ?>
                                        <li><span>Ngày trả lời:</span> lúc <?= date('H:i:s', strtotime($result['ngay_tra_loi'])) ?> ngày <?= date('d/m/Y', strtotime($result['ngay_tra_loi'])) ?></li>
                                        <li>
                                            <p><span>Nội dung trả lời:</span> <?= $result['tra_loi'] ?></p>
                                        </li>
                                        <?php
                                    } else {
                                        if ($result['id_tai_khoan_tour'] == auth()->user()['id']) {
                                        ?>
                                            <button class="btn btn-orange" data-toggle="modal" data-target="#reply-modal" onclick="setReply(<?= $result['id'] ?>)">Trả lời</button>
                                        <?php
                                        } else {
                                        ?>
                                            <p>Chưa trả lời</p>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <!--<button class="btn btn-orange" onclick="location.href='/dattour/view/<?= $result['id'] ?>'">Xem chi tiết</button>-->
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
                    <li class="<?= $results['page'] == $index ? 'active' : '' ?>"><a href="/trogiup/asked/<?= auth()->user()['id'] ?>?page=<?= $index ?>"><?= $index ?></a></li>
                <?php
                }
                ?>
                <li><a href="/tour/list/<?= $results['page'] + 1 ?>" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
            </ol>
        </div><!-- end pages -->
    </div><!-- end columns -->
</div><!-- end booking-listings -->

</div><!-- end columns -->

<div id="reply-modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Trả </h3>
            </div><!-- end modal-header -->

            <div class="modal-body">

                <div class="form-group">
                    <label>Nội dung trả lời</label>
                    <textarea class="form-control" placeholder="Nội dung" id="tra_loi"></textarea>
                </div><!-- end form-group -->

                <button id="confirm-reply" class="btn btn-orange">Gửi trả lời</button>

            </div><!-- end modal-bpdy -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

<script>
    id = null

    const setReply = (_id) => {
        id = _id;
    }

    $('#confirm-reply').click(() => {
        $.ajax({
            type: 'POST',
            url: '/trogiup/update/' + id,
            data: {
                tra_loi: $('#tra_loi').val(),
            },
            dataType: 'json',
            success: (data) => {
                if (data.code == 'update_success') {
                    redirect('/trogiup/asked/<?= auth()->user()['id'] ?>', 'Trợ giúp đã được gửi đi');
                }
            },
            error: (xhr) => {
                showError('Lỗi không xác định');
            }
        })
    })
</script>