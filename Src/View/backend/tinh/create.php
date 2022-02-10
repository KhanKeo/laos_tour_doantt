<?php
$controller = 'tinh';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm tỉnh</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý tỉnh</a></li>
                <li class="active">Thêm tỉnh</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên tỉnh</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên tỉnh" required>
        </div>
    </div>

    <div class="form-group">
        <label for="id_quoc_gia" class="col-sm-2 control-label">Quốc gia</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_quoc_gia">
                <?php
                foreach ($countries as $country) {
                ?>
                    <option value="<?= $country['id'] ?>"><?= $country['ten'] ?></option>
                <?php
                }
                ?>
            </select>
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
                id_quoc_gia: $('#id_quoc_gia').val(),
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