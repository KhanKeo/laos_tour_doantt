<?php
$controller = 'tour';
$copy = isset($copy) ? true : false;
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title"><?= $copy ? 'Sao chép tour' : 'Chỉnh sửa tour' ?></h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li><a href="/<?= $controller ?>/index">Quản lý tour</a></li>
                <li class="active"><?= $copy ? 'Sao chép tour' : 'Chỉnh sửa tour' ?></li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<br />
<!-- END OF BREADCRUMB -->

<!-- FORM -->
<form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Tên tour</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="ten" id="ten" placeholder="Tên tour" required value="<?= $result['ten'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Số người tối đa</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="so_nguoi" id="so_nguoi" placeholder="Số người tối đa" required value="<?= $result['so_nguoi'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày khởi hành</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_khoi_hanh" id="ngay_khoi_hanh" placeholder="Ngày khởi hành" required value="<?= date("Y-m-d\TH:i:s", strtotime($result['ngay_khoi_hanh'])) ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Ngày kết thúc</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Ngày kết thúc" required value="<?= date("Y-m-d\TH:i:s", strtotime($result['ngay_ket_thuc'])) ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Phương tiện</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="phuong_tien" id="phuong_tien" placeholder="Phương tiện" required value="<?= $result['phuong_tien'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Giá gốc người lớn</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="gia_goc_nguoi_lon" id="gia_goc_nguoi_lon" placeholder="Giá gốc người lớn" required value="<?= $result['gia_goc_nguoi_lon'] ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Giá người lớn</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="gia_nguoi_lon" id="gia_nguoi_lon" placeholder="Giá người lớn" required value="<?= $result['gia_nguoi_lon'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Giá gốc trẻ em</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="gia_goc_tre_em" id="gia_goc_tre_em" placeholder="Giá gốc trẻ em" required value="<?= $result['gia_goc_tre_em'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Giá trẻ em</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" name="gia_tre_em" id="gia_tre_em" placeholder="Giá trẻ em" required value="<?= $result['gia_tre_em'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="id_tinh_xuat_phat" class="col-sm-2 control-label">Tỉnh xuất phát</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_tinh_xuat_phat">
                <?php
                foreach ($provinces as $province) {
                ?>
                    <option value="<?= $province['id'] ?>" <?= $province['id'] == $result['id_tinh_xuat_phat'] ? 'selected' : '' ?>><?= $province['ten'] ?> - <?= $province['ten_quoc_gia'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ xuất phát</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="dia_chi_xuat_phat" id="dia_chi_xuat_phat" placeholder="Địa chỉ xuất phát" required value="<?= $result['dia_chi_xuat_phat'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="id_tinh_diem_den" class="col-sm-2 control-label">Tỉnh điểm đến</label>
        <div class="col-sm-8">
            <select required class="form-control" id="id_tinh_diem_den">
                <?php
                foreach ($provinces as $province) {
                ?>
                    <option value="<?= $province['id'] ?>" <?= $province['id'] == $result['id_tinh_diem_den'] ? 'selected' : '' ?>><?= $province['ten'] ?> - <?= $province['ten_quoc_gia'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ điểm đến</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="dia_chi_diem_den" id="dia_chi_diem_den" placeholder="Địa chỉ điểm đến" required value="<?= $result['dia_chi_diem_den'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="focusedinput" class="col-sm-2 control-label">Giới thiệu</label>
        <div class="col-sm-8">
            <textarea id="gioi_thieu" class="form-control" placeholder="Nội dung giới thiệu" rows="10"><?= $result['gioi_thieu'] ?></textarea>
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
            <img id="image-view" src="<?= asset('images/tour/hinh' . $result['id'] . '.png') ?>" height="100px" />
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
                <img id="image-view_<?= $index ?>" src="<?= asset('images/tour_detail/tour' . $result['id'] . '/hinh' . ($index + 1) . '.png') ?>" height="100px" />
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
            <button type="submit" name="submit" class="btn-primary btn"><?= $copy ? 'Sao chép' : 'Cập nhật' ?></button>
        </div>
    </div>
</form>
<!-- END OF FORM -->

<script>
    let controller = '<?= $controller ?>';
    let image = '';
    let images = [];

    /*bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('gioi_thieu');
        nicEditors.findEditor("gioi_thieu").setContent('<?= $result['gioi_thieu'] ?>');
    });*/
    
    $('#edit').submit((event) => {
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
                gioi_thieu: $('#gioi_thieu').val(), //nicEditors.findEditor('gioi_thieu').getContent(),
                image: image,
                images: images,
            },
            url: '/' + controller + '/<?= $copy ? 'copy' : 'update' ?>/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'update_success') {
                    redirect('/' + controller + '/index', '<?= $copy ? 'Sao chép thành công' : 'Chỉnh sửa thành công' ?>');
                }
            },
            error: (xhr) => {
                validate(xhr.responseJSON.errors);
                showError('Có lỗi xảy ra');
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