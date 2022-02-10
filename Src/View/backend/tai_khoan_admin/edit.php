<?php
$controller = 'taikhoanadmin';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Chỉnh sửa khoản Admin</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý tài khoản</a></li>
                <li class="active">Chỉnh sửa tài khoản</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên tài khoản</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="username" id="username" placeholder="Tên tài khoản" disabled value="<?= $result['username'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Mật khẩu mới</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Nhập lại mật khẩu mới</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Nhập lại mật khẩu">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Họ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ho" id="ho" placeholder="Họ Admin" required value="<?= $result['ho'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên Admin" required value="<?= $result['ten'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="<?= $result['email'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="sdt" class="col-sm-2 control-label">Số điện thoại</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại" required value="<?= $result['sdt'] ?>">
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
            <img id="image-view" src="<?= asset('images/tai_khoan/hinh' . $result['id'] . '.png') ?>" height="100px" />
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
    let image = '';
    $('#edit').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                password: $('#password').val(),
                repassword: $('#repassword').val(),
                ho: $('#ho').val(),
                ten: $('#ten').val(),
                email: $('#email').val(),
                sdt: $('#sdt').val(),
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