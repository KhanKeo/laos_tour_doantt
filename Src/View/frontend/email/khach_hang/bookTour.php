<h1 style="text-align: center;">Cảm ơn bạn đã đặt tour</h1>
<h3 style="text-align: center;">Mã đặt tour của bạn là: <?= $code ?></h3>
<hr />
<p>Chào <?= $data['ho'] . ' ' . $data['ten'] ?>,</p>
<p>Cảm ơn bạn đã đặt tour, chúng tôi sẽ sớm xác nhận đơn đặt hàng của bạn.</p>
<h3>Thông tin đặt tour:</h3>
<p>Tên tour: <?= $tour['ten'] ?></p>
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
<p style="color:#d60000;"><b>Vui lòng chuyển khoản qua tài khoản dưới đây trước <?= date('H:i', strtotime($tour['ngay_ket_thuc'])) . ' ngày ' . date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) ?> với nội dung chuyển tiền là "Chuyển khoản cho mã đặt tour <?= $code ?>" để người quản lý tour xác nhận tour cho bạn.</b></p>
<p><b>Số tài khoản: XXXXXX</b></p>
<p><b>Ngân hàng: Vietcombank</b></p>
<p><b>Họ tên người nhận: Nguyễn A</b></p>
<p>Trân trọng cảm ơn,</p>
LAOS TOUR.