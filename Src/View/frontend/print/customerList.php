<style>
    .text-center {
        text-align: center;
    }
    .table {
        padding: 5px;
    }
    .table th, .table td {
        border: 1px solid black;
    }
    .total {
        text-align: right;
    }
</style>

<h2 class="text-center">DANH SÁCH KHÁCH HÀNG ĐẶT TOUR</h2>
<table>
    <tr>
        <td>
         Tên tour: <b><?= $tour['ten'] ?></b>
        </td>
    </tr>
    <tr>
        <td>
            Mã tour: <b><?= $tour['id'] ?></b>
        </td>
    </tr>
    <tr>
        <td>
            Đi từ: <b><?= $tour['dia_chi_xuat_phat'] . ', ' . $tour['tinh_xuat_phat'] . ', ' . $tour['quoc_gia_xuat_phat'] ?></b> tới <b><?= $tour['dia_chi_diem_den'] . ', ' . $tour['tinh_diem_den'] . ', ' . $tour['quoc_gia_diem_den'] ?></b>
        </td>
    </tr>
    <tr>
        <td>
            Khởi hành lúc: <b><?= date('H:i', strtotime($tour['ngay_khoi_hanh'])) ?></b> ngày <b><?= date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) ?></b> tới <b><?= date('H:i', strtotime($tour['ngay_ket_thuc'])) ?></b> ngày <b><?= date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) ?></b>
        </td>
    </tr>
    <tr>
        <td>
            Thời gian: <b><?= $tour['so_ngay'] ?></b> ngày <b><?= $tour['so_ngay'] - 1 ?></b> đêm
        </td>
    </tr>
</table>
<br>
<table class="table">
    <thead>
        <tr>
            <th width="5%"><b>STT</b></th>
            <th width="20%"><b>Tên người đặt</b></th>
            <th width="10%"><b>SDT</b></th>
            <th width="25%"><b>Email</b></th>
            <th width="10%"><b>Người lớn</b></th>
            <th width="10%"><b>Trẻ em</b></th>
            <th width="10%"><b>Thành tiền</b></th>
            <th width="10%"><b>Ghi chú</b></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cnt = 1;
        $total = 0;
        foreach ($results as $result) {
        ?>
            <tr>
                <td width="5%"><?= $cnt ?></td>
                <td width="20%"><?= $result['ho'] . ' ' . $result['ten'] ?></td>
                <td width="10%"><?= $result['sdt'] ?></td>
                <td width="25%"><?= $result['email'] ?></td>
                <td width="10%"><?= $result['so_nguoi_lon'] ?></td>
                <td width="10%"><?= $result['so_tre_em'] ?></td>
                <td width="10%"><?= number_format($result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em']) ?>đ</td>
                <td width="10%"><?= $result['ghi_chu'] ?></td>
            </tr>
        <?php
            $cnt = $cnt + 1;
            $total += $result['gia_nguoi_lon'] * $result['so_nguoi_lon'] + $result['gia_tre_em'] * $result['so_tre_em'];
        }
        ?>
    </tbody>
</table>
<br>
<div><b class="total">Tổng tiền: <?= number_format($total) ?>Đ</b></div>
