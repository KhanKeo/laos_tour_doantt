<section class="innerpage-wrapper">
    <div id="register" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="flex-content">
                        <div class="custom-form custom-form-fields">
                            <h3>Đăng ký</h3>
                            <p>Đăng nhập vào hệ thống để sử dụng đầy đủ các chức năng.</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" id="username" class="form-control" placeholder="Username" required />
                                    <span><i class="fa fa-user"></i></span>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="ho" class="form-control" placeholder="Họ" required />
                                            <span><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="ten" class="form-control" placeholder="Tên" required />
                                            <span><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" placeholder="Password" required />
                                    <span><i class="fa fa-lock"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="password" id="repassword" class="form-control" placeholder="Nhập lại mật khẩu" required />
                                    <span><i class="fa fa-lock"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="number" id="sdt" class="form-control" placeholder="Số điện thoại" required />
                                    <span><i class="fa fa-phone"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="email" class="form-control" placeholder="Email" required />
                                    <span><i class="fa fa-envelope"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="date" id="ngay_sinh" class="form-control" placeholder="Ngày sinh" required />
                                    <span><i class="fa fa-birthday-cake"></i></span>
                                </div>

                                <div class="form-group">
                                    <select id="id_tinh" class="form-control" placeholder="Tỉnh" required>
                                        <?php
                                        foreach ($provinces as $province) {
                                        ?>
                                            <option value="<?= $province['id'] ?>"><?= $province['ten'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="dia_chi" class="form-control" placeholder="Địa chỉ" required />
                                    <span><i class="fa fa-map-marker"></i></span>
                                </div>

                                <button class="btn btn-orange btn-block">Đăng ký</button>
                            </form>

                            <div class="other-links">
                                <p class="link-line">Đã có tài khoản ? <a href="/trangchu/loginPage">Đăng nhập ngay</a></p>
                            </div><!-- end other-links -->
                        </div><!-- end custom-form -->

                        <div class="flex-content-img custom-form-img">
                            <img src="<?= asset('images/main/register.png') ?>" class="img-responsive" alt="registration-img" />
                        </div><!-- end custom-form-img -->
                    </div><!-- end form-content -->

                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end login -->
</section><!-- end innerpage-wrapper -->

<script>
    let image = '';
    $('#register').submit((event) => {
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
            url: '/trangchu/register',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'register_success')
                    redirect('/trangchu/loginPage', 'Đăng ký thành công, đăng nhập để truy cập tài khoản');
            },
            error: (xhr) => {
                validate(xhr.responseJSON.errors);
            }
        });
    })
</script>