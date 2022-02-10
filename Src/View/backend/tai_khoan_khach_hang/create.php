<?php
$controller = 'taikhoankhachhang';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm tài khoản khách hàng</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý tài khoản</a></li>
                <li class="active">Thêm tài khoản</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br />
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên tài khoản</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="username" id="username" placeholder="Tên tài khoản" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Mật khẩu</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Nhập lại mật khẩu" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Họ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ho" id="ho" placeholder="Họ" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
    </div>

    <div class="form-group">
        <label for="sdt" class="col-sm-2 control-label">Số điện thoại</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày sinh</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh" placeholder="Ngày sinh" required>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="dia_chi" id="dia_chi" placeholder="Địa chỉ" required>
        </div>
    </div>

    <div class="form-group">
        <label for="id_tinh" class="col-sm-2 control-label">Tỉnh</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_tinh">
                <?php
                foreach ($provinces as $province) {
                ?>
                    <option value="<?= $province['id'] ?>"><?= $province['ten'] ?> - <?= $province['ten_quoc_gia'] ?></option>
                <?php
                }
                ?>
            </select>
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
    $('#create').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                repassword: $('#repassword').val(),
                ho: $('#ho').val(),
                ten: $('#ten').val(),
                email: $('#email').val(),
                sdt: $('#sdt').val(),
                ngay_sinh: $('#ngay_sinh').val(),
                dia_chi: $('#dia_chi').val(),
                id_tinh: $('#id_tinh').val(),
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