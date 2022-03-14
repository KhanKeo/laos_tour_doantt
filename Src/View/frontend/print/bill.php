<style>
    .title {
        text-align: center;
    }
    .total {
        text-align: right;
    }
    .table th, .table td {
        border: solid 1px black;
        margin: 5px;
    }
    .table {
        padding: 3px;
    }
</style>

<h1 class="title">LAOS TOUR</h1>
<h3>Thông tin đặt tour</h3>
Tên tour: <?= $result['ten_tour'] ?><br/>
Mã đặt tour: <?= $result['ma_dat_tour'] ?><br/>
Địa chỉ: <b><?= $result['dia_chi_xuat_phat'] . ', ' . $result['tinh_xuat_phat'] . ', ' . $result['quoc_gia_xuat_phat'] ?></b> tới <b><?= $result['dia_chi_diem_den'] . ', ' . $result['tinh_diem_den'] . ', ' . $result['quoc_gia_diem_den'] ?></b><br />
Ngày đặt: <?= date('H:i:s', strtotime($result['ngay_dat'])) ?> ngày <?= date('d/m/Y', strtotime($result['ngay_dat'])) ?><br/>
Họ và tên: <?= $result['ho'] ?> <?= $result['ten'] ?><br/>
<hr />
<table class="table">
    <thead>
        <tr>
            <th width="10%"><b>STT</b></th>
            <th width="30%"><b>Mô tả</b></th>
            <th width="20%"><b>Đơn giá</b></th>
            <th width="20%"><b>Số lượng</b></th>
            <th width="20%"><b>Thành tiền</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="10%">1</td>
            <td width="30%">Đặt tour người lớn</td>
            <td width="20%"><?= number_format($result['gia_nguoi_lon']) ?>đ</td>
            <td width="20%"><?= $result['so_nguoi_lon'] ?></td>
            <td width="20%"><?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon']) ?>đ</td>
        </tr>
        <tr>
            <td width="10%">2</td>
            <td width="30%">Đặt tour trẻ em</td>
            <td width="20%"><?= number_format($result['gia_tre_em']) ?>đ</td>
            <td width="20%"><?= $result['so_tre_em'] ?></td>
            <td width="20%"><?= number_format($result['gia_tre_em'] * $result['so_tre_em']) ?>đ</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width="30%"><b>Tổng</b></td>
            <td width="20%"></td>
            <td width="20%"></td>
            <td width="20%"><b><?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</b></td>
        </tr>
    </tbody>
</table>
<br>
<div class="total"><b>Tổng tiền: <?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</b></div>