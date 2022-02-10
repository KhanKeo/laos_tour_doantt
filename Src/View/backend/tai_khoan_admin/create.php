<?php
$controller = 'taikhoanadmin';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Thêm tài khoản Admin</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý tài khoản</a></li>
                <li class="active">Thêm tài khoản</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br/>
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Tên tài khoản</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="username" placeholder="Tên tài khoản" required>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" required>
        </div>
    </div>

    <div class="form-group">
        <label for="repassword" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="repassword" placeholder="Nhập lại mật khẩu" required>
        </div>
    </div>

    <div class="form-group">
        <label for="ho" class="col-sm-2 control-label">Họ</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="ho" placeholder="Họ Admin" required>
        </div>
    </div>

    <div class="form-group">
        <label for="ten" class="col-sm-2 control-label">Tên</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="ten" placeholder="Tên Admin" required>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="email" placeholder="Email" required>
        </div>
    </div>
    
    <div class="form-group">
        <label for="sdt" class="col-sm-2 control-label">Số điện thoại</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại" required>
        </div>
    </div>

    <div class="form-group">
        <label for="image" class="col-sm-2 control-label">Ảnh đại diện</label>
        <div class="col-sm-8">
            <input type="file" id="image">
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
            <button type="submit" class="btn-primary btn">Tạo</button>
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