<?php
$controller = 'trogiup';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Trả lời trợ giúp</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý trợ giúp</a></li>
                <li class="active">Chỉnh sửa trợ giúp</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br />
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Loại trợ giúp</label>
        <div class="col-sm-8">
        <div class="form-control"><?= $result['loai_tro_giup'] ?></div>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Người gửi</label>
        <div class="col-sm-8">
        <div class="form-control"><?= $result['ho_tai_khoan'] . ' ' . $result['ten_tai_khoan'] ?></div>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên tour</label>
        <div class="col-sm-8">
        <div class="form-control"><?= $result['ten_tour'] ?><a href="/tour/view/<?= $result['id_tour'] ?>" target="_blank">(Xem)</a></div>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nội dung trợ giúp</label>
        <div class="col-sm-8">
            <div class="form-control"><?= $result['noi_dung'] ?></div>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nội dung trả lời</label>
        <div class="col-sm-8">
            <textarea id="tra_loi" class="form-control" placeholder="Nhập nội dung trả lời" rows="5"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <button id="submit-button" type="submit" name="submit" class="btn-primary btn">Gưi câu trả lời</button>
        </div>
    </div>
</form>
<!-- END OF FORM -->

<script>
    let controller = '<?= $controller ?>';

    bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('tra_loi');
    });

    $('#edit').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                tra_loi: nicEditors.findEditor('tra_loi').getContent(),
            },
            url: '/' + controller + '/update/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                $('#submit-button').prop('disabled', false);
                $('#submit-button').html('Gửi câu trả lời');

                if (data.code == 'update_success') {
                    redirect('/' + controller + '/index', 'Gửi hồi đáp thành công');
                }
            },
            error: (xhr) => {
                validate(xhr.responseJSON.errors);
                showError('Có lỗi xảy ra');
            }
        });

        $('#submit-button').prop('disabled', true);
        $('#submit-button').html('Đang gửi...');
    })
</script>