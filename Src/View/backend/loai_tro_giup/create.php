<?php
$controller = 'loaitrogiup';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm loại trợ giúp</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý loại trợ giúp</a></li>
                <li class="active">Thêm trợ giúp</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên loại trợ giúp</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên loại trợ giúp" required>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <button type="submit" name="submit" class="btn-primary btn">Tạo</button>
        </div>
    </div>
</form>
<!-- END OF FORM -->

<script>
    let controller = '<?= $controller ?>';
    $('#create').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                ten: $('#ten').val(),
            },
            url: '/' + controller + '/insert',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'create_success') {
                    redirect('/' + controller + '/index', 'Thêm thành công');
                }
            },
            error: (xhr) => {
                validate(xhr.responseJSON.errors);
                showError('Có lỗi xảy ra');
            }
        })
    })
</script>