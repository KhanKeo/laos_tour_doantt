<?php
$controller = 'quocgia';
?>

<!--BREADCRUMB -->
<section class="page-cover page-cover-admin" id="cover-tour-grid-list">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="page-title">Quản lý quốc gia</h1>
            <ul class="breadcrumb">
                <li><a href="/thongke/index">Trang chủ</a></li>
                <li class="active">Danh sách quốc gia</li>
            </ul>
        </div><!-- end columns -->
    </div><!-- end row -->
</section>
<!-- END OF BREADCRUMB -->

<!-- USER TAB -->
<ul class="nav nav-tabs">
    <li role="presentation"><a href="/tinh/index">Tỉnh</a></li>
    <li role="presentation" class="active"><a href="#">Quốc gia</a></li>
</ul>
<br />
<!-- END OF USER TAB -->

<!-- TOOLBOX -->
<div class="mt-2">
    <div class="row">
        <div class="col-sm-6">
            <button class="btn btn-primary" onclick="location.href='/<?= $controller ?>/create'">Thêm mới</button>
        </div>
        <div class="col-sm-6">
            <form id="search" style="display: flex; justify-content: end;">
                <?php
                if ($search != '') {
                ?>
                    <button type="button" onclick="location.href='/<?= $controller ?>/index'" class="btn btn-white"><i class="fa fa-repeat"></i></button>
                <?php
                }
                ?>
                <input id="input-search" class="form-control" style="width: auto;" placeholder="Tìm kiếm..." value="<?= $search ?>" onClick="this.select();" />
                <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- END OF TOOLBOX -->

<!-- TABLE GRID -->
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên quốc gia</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cnt = 1;
        foreach ($results['data'] as $result) {
        ?>
            <tr>
                <td><?= $cnt ?></td>
                <td><?= $result['ten'] ?></td>
                <td>
                    <div>
                        <a href="/<?= $controller ?>/edit/<?= $result['id'] ?>">
                            <button type="button" class="btn btn-primary btn-block" style="display:inline;width:auto;margin-left:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </a>
                        <a onclick="destroy(<?= $result['id'] ?>)">
                            <button type="button" class="btn btn-danger btn-block" style="display:inline;width:auto;margin-left:10px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt = $cnt + 1;
        }
        ?>
    </tbody>
</table>
<!-- END OF TABLE GRID -->

<!-- PAGINATION -->
<nav aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
        <?php
        for ($index = 1; $index <= $results['total']; $index++) {
        ?>
            <li class="page-item <?= $results['page'] == $index ? 'active' : '' ?>"><a class="page-link" href="/<?= $controller ?>/index?page=<?= $index ?>"><?= $index ?></a></li>
        <?php
        }
        ?>
    </ul>
</nav>
<!-- END OF PAGINATION -->

<!-- REMOVE MODAL -->
<div class="modal fade" id="destroy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa</h5>
            </div>
            <div class="modal-body">
                Xác nhận xóa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="confirmDestroy()">Xóa</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- END OF REMOVE MODAL -->

<script>
    let controller = '<?= $controller ?>';
    let id = 0;

    $('#search').submit(() => {
        event.preventDefault();

        let search = $('#input-search').val();
        redirect('/' + controller + '/index/?page=<?= $results['page'] ?>' + '&search=' + search);
    });

    const destroy = (id_) => {
        id = id_;
        $('#destroy').modal('show');
    }

    const confirmDestroy = () => {
        $.ajax({
            type: 'POST',
            url: '/' + controller + '/destroy/' + id,
            dataType: 'json',
            success: (data) => {
                if (data.code === 'destroy_success') {
                    redirect('/' + controller + '/index', 'Xóa thành công');
                }
            },
            error: (xhr) => {
                redirect('/' + controller + '/index', 'Xóa không thành công', 'error');
            }
        })
    }
</script>