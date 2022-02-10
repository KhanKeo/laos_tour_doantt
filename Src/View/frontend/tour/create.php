<?php
$controller = 'tour';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">Thêm tour</h1>
                <ul class="breadcrumb">
                    <li><a href="/thongke/index">Trang chủ</a></li>
                    <li><a href="/<?= $controller ?>/list/mylist">Quản lý tour</a></li>
                    <li class="active">Thêm tour</li>
                </ul>
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<br />
<br />
<br />
<!-- END OF BREADCRUMB -->

<div class="container">
    <!-- FORM -->
    <form class="form-horizontal" id="create" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Tên tour</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên tour" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Số người tối đa</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="so_nguoi" id="so_nguoi" placeholder="Số người tối đa" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Ngày khởi hành</label>
            <div class="col-sm-8">
                <input type="datetime-local" class="form-control" name="ngay_khoi_hanh" id="ngay_khoi_hanh" placeholder="Ngày khởi hành" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Ngày kết thúc</label>
            <div class="col-sm-8">
                <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Ngày kết thúc" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Phương tiện</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="phuong_tien" id="phuong_tien" placeholder="Phương tiện" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Giá gốc người lớn</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="gia_goc_nguoi_lon" id="gia_goc_nguoi_lon" placeholder="Giá gốc người lớn" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Giá người lớn</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="gia_nguoi_lon" id="gia_nguoi_lon" placeholder="Giá người lớn" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Giá gốc trẻ em</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="gia_goc_tre_em" id="gia_goc_tre_em" placeholder="Giá gốc trẻ em" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Giá trẻ em</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="gia_tre_em" id="gia_tre_em" placeholder="Giá trẻ em" required>
            </div>
        </div>

        <div class="form-group">
            <label for="id_tinh_xuat_phat" class="col-sm-2 control-label">Tỉnh xuất phát</label>
            <div class="col-sm-8">
                <select required class="form-control" id="id_tinh_xuat_phat">
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
            <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ xuất phát</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="dia_chi_xuat_phat" id="dia_chi_xuat_phat" placeholder="Địa chỉ xuất phát" required>
            </div>
        </div>

        <div class="form-group">
            <label for="id_tinh_diem_den" class="col-sm-2 control-label">Tỉnh điểm đến</label>
            <div class="col-sm-8">
                <select required class="form-control" id="id_tinh_diem_den">
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
            <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ điểm đến</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="dia_chi_diem_den" id="dia_chi_diem_den" placeholder="Địa chỉ điểm đến" required>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Giới thiệu</label>
            <div class="col-sm-8">
                <textarea id="gioi_thieu" class="form-control" placeholder="Nội dung giới thiệu" rows="10"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Ảnh nền</label>
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
        <hr />

        <?php
        for ($index = 0; $index < 6; $index++) {
        ?>
            <div class="form-group">
                <label for="focusedinput" class="col-sm-2 control-label">Hình ảnh</label>
                <div class="col-sm-8">
                    <input type="file" name="image" id="image_<?= $index ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <img id="image-view_<?= $index ?>" src="<?= asset('images/main/empty.png') ?>" height="100px" />
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <button type="button" class="btn btn-primary" onclick="deleteImage(<?= $index ?>)">Xóa</button>
            </div>
        </div>
            <hr />
        <?php
        }
        ?>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="submit" class="btn-primary btn">Tạo</button>
            </div>
        </div>
    </form>
    <!-- END OF FORM -->
</div><!-- end container -->

<script>
    let controller = '<?= $controller ?>';
    let image = '';
    let images = [];

    // bkLib.onDomLoaded(function() {
    //     new nicEditor().panelInstance('gioi_thieu');
    // });

    $('#create').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                ten: $('#ten').val(),
                so_nguoi: $('#so_nguoi').val(),
                ngay_khoi_hanh: $('#ngay_khoi_hanh').val(),
                ngay_ket_thuc: $('#ngay_ket_thuc').val(),
                phuong_tien: $('#phuong_tien').val(),
                gia_goc_nguoi_lon: $('#gia_goc_nguoi_lon').val(),
                gia_nguoi_lon: $('#gia_nguoi_lon').val(),
                gia_goc_tre_em: $('#gia_goc_tre_em').val(),
                gia_tre_em: $('#gia_tre_em').val(),
                id_tinh_xuat_phat: $('#id_tinh_xuat_phat').val(),
                dia_chi_xuat_phat: $('#dia_chi_xuat_phat').val(),
                id_tinh_diem_den: $('#id_tinh_diem_den').val(),
                dia_chi_diem_den: $('#dia_chi_diem_den').val(),
                gioi_thieu: $('#gioi_thieu').val(),//nicEditors.findEditor('gioi_thieu').getContent(),
                image: image,
                images: images,
            },
            url: '/' + controller + '/insert',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'create_success') {
                    redirect('/' + controller + '/list/mylist', 'Thêm thành công');
                }
            },
            error: (xhr) => {
                showError('Lỗi không xác định');
            }
        })
    })

    const deleteImage = (index) => {
        images[index] = 'delete';
        var output = document.getElementById('image-view_' + index);
        output.src = '';
    }

    $('#image').change((event) => {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-view');
            output.src = reader.result;
            image = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    })

    for (index = 0; index < 6; index++) {
        let indexNow = index;
        $('#image_' + index).change((event) => {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-view_' + indexNow);
                output.src = reader.result;
                images[indexNow] = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        })
    }
</script>