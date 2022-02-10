<?php
$controller = 'slide';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Chỉnh sửa slide</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý slide</a></li>
                <li class="active">Chỉnh sửa slide</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br />
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_loai_slide" class="col-sm-2 control-label">Loại slide</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_loai_slide">
                <?php
                foreach ($types as $type) {
                ?>
                    <option value="<?= $type['id'] ?>" <?= $type['id'] == $result['id_loai_slide'] ? 'selected' : '' ?>><?= $type['ten'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tiêu đề</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề" required value="<?= $result['tieu_de'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nội dung</label>
        <div class="col-sm-8">
            <textarea id="noi_dung" class="form-control" placeholder="Nhập nội dung" rows="5"><?= $result['noi_dung'] ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày bắt đầu</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau" placeholder="Ngày bắt đầu" value="<?= $result['ngay_bat_dau'] ? date("Y-m-d\TH:i:s", strtotime($result['ngay_bat_dau'])) : '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày kết thúc</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Ngày kết thúc" value="<?= $result['ngay_ket_thuc'] ? date("Y-m-d\TH:i:s", strtotime($result['ngay_ket_thuc'])) : '' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ truy cập</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="url" id="url" placeholder="Địa chỉ truy cập" required value="<?= $result['url'] ?>">
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
            <img id="image-view" src="<?= asset('images/slide/hinh' . $result['id'] . '.png') ?>" height="100px" />
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
    controller = '<?= $controller ?>';
    let image = '';

    $('#edit').submit((event) => {
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