<h1 style="text-align: center;">Có đơn đặt tour mới</h1>
<h3 style="text-align: center;">Mã đặt tour là: <?= $code ?></h3>
<hr />
<p>Chào , <?= $tour['ho_tai_khoan'] . ' ' . $tour['ten_tai_khoan'] ?></p>
<p>Có một khách hàng mới đã đặt tour của bạn.</p>
<h3>Thông tin đặt tour:</h3>
<p>Tên khách hàng: <?= $data['ho'] . ' ' . $data['ten'] ?></p>
<p>Tên tour: <?= $tour['ten'] ?></p>
<p>Giá tour: <?= number_format($data['gia']) ?>đ</p>
<p>Giá người lớn: <?= number_format($data['gia_nguoi_lon']) ?>đ</p>
<p>Giá trẻ em: <?= number_format($data['gia_tre_em']) ?>đ</p>
<p>Số lượng người lớn: <?= $data['so_nguoi_lon'] ?></p>
<p>Số lượng trẻ em: <?= $data['so_tre_em'] ?></p>
<p>Tổng tiền: <?= number_format($data['gia'] + $data['gia_nguoi_lon'] * $data['so_nguoi_lon'] + $data['gia_tre_em'] * $data['so_tre_em']) ?>đ</p>
<a href="<?= $_SERVER['HTTP_ORIGIN'] ?>/dattour/indexUser/<?= $tour['id'] ?>">Xem thông tin đặt tour</a>
<p>Cảm ơn,</p>
Laos tour.