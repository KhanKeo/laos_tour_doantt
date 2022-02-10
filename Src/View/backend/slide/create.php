<?php
$controller = 'slide';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm slide</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý slide</a></li>
                <li class="active">Thêm slide</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br />
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_loai_slide" class="col-sm-2 control-label">Loại slide</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_loai_slide">
                <?php
                foreach ($types as $type) {
                ?>
                    <option value="<?= $type['id'] ?>"><?= $type['ten'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tiêu đề</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nội dung</label>
        <div class="col-sm-8">
            <textarea id="noi_dung" class="form-control" placeholder="Nhập nội dung" rows="5"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày bắt đầu</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau" placeholder="Ngày bắt đầu">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày kết thúc</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Ngày kết thúc">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ truy cập</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="url" id="url" placeholder="Địa chỉ truy cập" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Hình ảnh</label>
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
    $('#create').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                id_loai_slide: $('#id_loai_slide').val(),
                tieu_de: $('#tieu_de').val(),
                noi_dung: $('#noi_dung').val(),
                ngay_bat_dau: $('#ngay_bat_dau').val(),
                ngay_ket_thuc: $('#ngay_ket_thuc').val(),
                url: $('#url').val(),
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