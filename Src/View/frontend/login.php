<section class="innerpage-wrapper">
    <div id="login" class="innerpage-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="flex-content">
                        <div class="custom-form custom-form-fields">
                            <h3>Đăng nhập</h3>
                            <p>Đăng nhập vào hệ thống để sử dụng đầy đủ các chức năng.</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" id="username" class="form-control" placeholder="Tên tài khoản hoặc email" required />
                                    <span><i class="fa fa-user"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" placeholder="Mật khẩu" required />
                                    <span><i class="fa fa-lock"></i></span>
                                </div>

                                <div class="checkbox">
                                    <label><input type="checkbox"> Nhớ tài khoản</label>
                                </div>

                                <button class="btn btn-orange btn-block">Đăng nhập</button>
                            </form>

                            <div class="other-links">
                                <p class="link-line">Chưa có tài khoản ? <a href="/trangchu/registerPage">Đăng ký ngay</a></p>
                                <a class="simple-link" href="#">Quên mật khẩu ?</a>
                            </div><!-- end other-links -->
                        </div><!-- end custom-form -->

                        <div class="flex-content-img custom-form-img">
                            <img src="<?= asset('images/main/login.jfif') ?>" class="img-responsive" alt="registration-img" />
                        </div><!-- end custom-form-img -->
                    </div><!-- end form-content -->

                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end login -->
</section><!-- end innerpage-wrapper -->

<script>
    $('#login').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
            },
            url: '/trangchu/login',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'login_success')
                redirect('/trangchu', 'Đăng nhập thành công');
            },
            error: (xhr) => {
                if (xhr.responseJSON.code == 'login_loggedIn')
                    showError('Đăng xuất trước khi đăng nhập');
                else if (xhr.responseJSON.code == 'login_fail')
                    showError('Tên tài khoản hoặc mật khẩu không đúng');
            }
        });
    })
</script>