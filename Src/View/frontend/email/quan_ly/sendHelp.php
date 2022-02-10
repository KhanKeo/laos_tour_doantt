<h1 style="text-align: center;">Bạn có yêu cầu trợ giúp mới từ khách hàng</h1>
<hr />
<p>Chào <?= $helped['ho_nhan'] . ' ' . $helped['ten_nhan'] ?>,</p>
<p>Có một yêu cầu trợ giúp mới từ khách hàng!</p>
<h3>Thông tin trợ giúp:</h3>
<p>Tên khách hàng: <?= $helped['ho_gui'] . ' ' . $helped['ten_gui'] ?></p>
<p>Loại trợ giúp: <?= $helped['ten_loai_tro_giup'] ?></p>
<p>Nội dung trợ giúp: <?= $helped['noi_dung'] ?></p>

Trả lời trợ giúp của khách hàng <a href="<?= $_SERVER['HTTP_ORIGIN'] ?>/trogiup/asked/<?= $helped['id_tai_khoan_tra_loi'] ?>">tại đây</a>

<p>Chúc bạn một ngày tốt lành,</p>
<p>Laos tour.</p>