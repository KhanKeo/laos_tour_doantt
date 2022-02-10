<h1 style="text-align: center;">Đơn đặt tour của bạn đã được xác nhận</h1>
<h3 style="text-align: center;">Mã đặt tour của bạn là: <?= $data['ma_dat_tour'] ?></h3>
<hr />
<p>Chào <?= $data['ho'] . ' ' . $data['ten'] ?>,</p>
<p>Cảm ơn bạn đã đặt tour, chúc bạn có những phút giây trải nghiệm tour vui vẻ.</p>
<h3>Thông tin đặt tour:</h3>
<p>Tên tour: <?= $data['ten_tour'] ?></p>
<table>
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
            <td width="20%"><?= number_format($data['gia_nguoi_lon']) ?>đ</td>
            <td width="20%"><?= $data['so_nguoi_lon'] ?></td>
            <td width="20%"><?= number_format($data['gia_nguoi_lon'] * $data['so_nguoi_lon']) ?>đ</td>
        </tr>
        <tr>
            <td width="10%">2</td>
            <td width="30%">Đặt tour trẻ em</td>
            <td width="20%"><?= number_format($data['gia_tre_em']) ?>đ</td>
            <td width="20%"><?= $data['so_tre_em'] ?></td>
            <td width="20%"><?= number_format($data['gia_tre_em'] * $data['so_tre_em']) ?>đ</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width="30%"><b>Tổng</b></td>
            <td width="20%"></td>
            <td width="20%"></td>
            <td width="20%"><b><?= number_format($data['gia_nguoi_lon'] * $data['so_nguoi_lon'] + $data['gia_tre_em'] * $data['so_tre_em']) ?>đ</b></td>
        </tr>
    </tbody>
</table>
<p><b>Tổng tiền: <?= number_format($data['gia_nguoi_lon'] * $data['so_nguoi_lon'] + $data['gia_tre_em'] * $data['so_tre_em']) ?>đ</b></p>
<a href="<?= $_SERVER['HTTP_ORIGIN'] ?>/dattour/view/<?= $id ?>">Xem thông tin đặt tour</a>
<p><b>Lời nhắc: <?= $loiNhac ?></b></p>
<p>Trân trọng,</p>
LAOS TOUR.