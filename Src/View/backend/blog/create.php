<?php
$controller = 'blog';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm blog</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý blog</a></li>
                <li class="active">Thêm blog</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tiêu đề</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tóm tắt</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="tom_tat" id="tom_tat" placeholder="Tiêu đề" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nội dung</label>
        <div class="col-sm-8">
            <textarea id="noi_dung" class="form-control" placeholder="Nhập nội dung" rows="10"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ảnh đại diện</label>
        <div class="col-sm-8">
            <input type="file" name="image" id="image">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <img id="image-view" src="" height="100px" />
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
    let image = '';

    bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('noi_dung');
    });

    $('#create').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                tieu_de: $('#tieu_de').val(),
                tom_tat: $('#tom_tat').val(),
                noi_dung: nicEditors.findEditor('noi_dung').getContent(),
                image: image,
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

    $('#image').change((event) => {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-view');
            output.src = reader.result;
            image = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    })
</script>












