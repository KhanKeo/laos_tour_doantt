<?php
$controller = 'blog';
?>

<!--BREADCRUMB -->
<section class="page-cover" id="cover-tour-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">Chỉnh sửa blog</h1>
                <ul class="breadcrumb">
                    <li><a href="/thongke/index">Trang chủ</a></li>
                    <li><a href="/<?= $controller ?>/myBlog/<?= auth()->user()['id'] ?>">Quản lý blog</a></li>
                    <li class="active">Chỉnh sửa blog</li>
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
    <form class="form-horizontal" id="edit" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Tiêu đề</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề" required value="<?= $result['tieu_de'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Tóm tắt</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="tom_tat" id="tom_tat" placeholder="Tiêu đề" required value="<?= $result['tom_tat'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="focusedinput" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-8">
                <textarea id="noi_dung" class="form-control" placeholder="Nhập nội dung" rows="10"></textarea>
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
                <img id="image-view" src="<?= asset('images/blog/hinh' . $result['id'] . '.png') ?>" height="100px" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" name="submit" class="btn-primary btn">Cập nhật</button>
            </div>
        </div>
    </form>
    <!-- END OF FORM -->
</div><!-- end container -->

<script>
    let controller = '<?= $controller ?>';
    let image = '';

    bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('noi_dung');
        nicEditors.findEditor("noi_dung").setContent('<?= $result['noi_dung'] ?>');
    });

    $('#edit').submit((event) => {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            data: {
                tieu_de: $('#tieu_de').val(),
                tom_tat: $('#tom_tat').val(),
                noi_dung: nicEditors.findEditor('noi_dung').getContent(),
                image: image,
            },
            url: '/' + controller + '/userUpdate/<?= $result['id'] ?>',
            dataType: 'json',
            success: (data) => {
                if (data.code == 'update_success') {
                    redirect('/' + controller + '/myBlog/<?= auth()->user()['id'] ?>', 'Chỉnh sửa thành công');
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