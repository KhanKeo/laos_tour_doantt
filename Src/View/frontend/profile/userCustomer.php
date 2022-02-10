<h2 class="dash-content-title">Hồ sơ của tôi</h2>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Thông tin hồ sơ</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-5 col-md-4 user-img">
                <img src="<?= asset('images/tai_khoan/hinh' . auth()->user()['id'] . '.png') ?>" class="img-responsive" alt="user-img" />
            </div><!-- end columns -->

            <div class="col-sm-7 col-md-8  user-detail">
                <ul class="list-unstyled">
                    <li><span>Tên:</span> <?= $result['ho'] . ' ' . $result['ten'] ?></li>
                    <li><span>Số điện thoại:</span> <?= $result['sdt'] ?></li>
                    <li><span>Email:</span> <?= $result['email'] ?></li>
                    <li><span>Ngày sinh:</span> <?= date('d/m/Y', strtotime($result['ngay_sinh'])) ?></li>
                    <li><span>Địa chỉ:</span> <?= $result['dia_chi'] . ', ' . $result['ten_tinh'] . ', ' . $result['ten_quoc_gia'] ?></li>
                </ul>
                <button class="btn" data-toggle="modal" data-target="#edit-profile">Chỉnh sửa hồ sơ</button>
            </div><!-- end columns -->
        </div><!-- end row -->

    </div><!-- end panel-body -->
</div><!-- end panel-detault -->

<div id="edit-profile" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Chỉnh sửa thông tin</h3>
            </div><!-- end modal-header -->

            <div class="modal-body">
                <form id="edit">
                    <div class="form-group">
                        <label>Họ</label>
                        <input type="text" class="form-control" placeholder="Họ" id="ho" value="<?= $result['ho'] ?>" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" placeholder="Tên" id="ten" value="<?= $result['ten'] ?>" />
                    </div><!-- end form-group -->

                    <?php if (auth()->user()['loai'] == 3) { ?>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" placeholder="mm-dd-yy" id="ngay_sinh" value="<?= $result['ngay_sinh'] ?>" />
                        </div><!-- end form-group -->
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" value="<?= $result['email'] ?>" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" placeholder="Số điện thoại" id="sdt" value="<?= $result['sdt'] ?>" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" placeholder="Ngày sinh" id="ngay_sinh" value="<?= $result['ngay_sinh'] ?>" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" id="dia_chi" value="<?= $result['dia_chi'] ?>" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Tỉnh</label>
                        <select required class="form-control" id="id_tinh">
                            <?php
                            foreach ($provinces as $province) {
                            ?>
                                <option value="<?= $province['id'] ?>" <?= $province['id'] == $result['id_tinh'] ? 'selected' : '' ?>><?= $province['ten'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input type="file" class="form-control" id="image" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label></label>
                        <div class="col-sm-8">
                            <img id="image-view" src="<?= asset('images/tai_khoan/hinh' . $result['id'] . '.png') ?>" height="100px" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Mật khẩu mới" id="password" />
                    </div><!-- end form-group -->

                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" id="repassword" />
                    </div><!-- end form-group -->

                    <button class="btn btn-orange">Lưu thay đổi</button>
                </form>
            </div><!-- end modal-bpdy -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end edit-profile -->

<script>
    let image = '';

    $('#edit').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                repassword: $('#repassword').val(),
                ho: $('#ho').val(),
                ten: $('#ten').val(),
                sdt: $('#sdt').val(),
                email: $('#email').val(),
                ngay_sinh: $('#ngay_sinh').val(),
                dia_chi: $('#dia_chi').val(),
                id_tinh: $('#id_tinh').val(),
                image: image,
            },
            url: '/taikhoankhachhang/update/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'update_success') {
                    redirect('/taikhoankhachhang/view/<?= $result['id'] ?>', 'Chỉnh sửa thành công');
                }
            },
            error: (xhr) => {
                if (xhr.responseJSON.code == 'update_passwordExisted')
                    showError('Email đã tồn tại, Email khác');
                else if (xhr.responseJSON.code == 'update_wrongPassword')
                    showError('Mật khẩu và nhập lại mật khẩu không khớp');
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