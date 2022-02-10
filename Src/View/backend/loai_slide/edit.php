<?php
$controller = 'loaislide';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Chỉnh sửa loại slide</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý loại slide</a></li>
                <li class="active">Chỉnh sửa loại slide</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên loại slide</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên loại slide" required value="<?= $result['ten'] ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <button type="submit" name="submit" class="btn-primary btn">Cập nhật</button>
        </div>
    </div>
</form>
<!-- END OF FORM -->

<script>
    let controller = '<?= $controller ?>';
    $('#edit').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                ten: $('#ten').val(),
            },
            url: '/' + controller + '/update/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'update_success') {
                    redirect('/' + controller + '/index', 'Chỉnh sửa thành công');
                }
            },
            error: (xhr) => {
                validate(xhr.responseJSON.errors);
                showError('Có lỗi xảy ra');
            }
        })
    })
</script>