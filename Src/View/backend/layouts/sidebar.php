<style>
    .__sidebar_container {
        background-color: black;
        min-height: 100vh;
        padding-top: 20px;
        padding-left: 20px;
        color: white;
    }

    .__sidebar {
        
    }

    .__sidebar > * {
        height: 50px;
        display: flex;
        align-items: center;
        padding: 0 10px;
    }

    .__sidebar > *:hover {
        cursor: pointer;
    }

    .__sidebar > * > a {
        color: white;
        text-decoration: none;
        width: 100%;
    }
    
    .__sidebar > *:hover {
        background-color: #575757;
    }

    .__sidebar_active {
        background-color: #454545;
    }
</style>
<div class="__sidebar_container">
    <h2>TRANG ADMIN</h2>
    <img src="<?= asset('images/tai_khoan/hinh' . auth()->user()['id'] . '.png') ?>" height="100px" class="px-2" style="border-radius: 50%;" >
    <p>Tên tài khoản: <?= auth()->user()['username'] ?></p>
    <p>Họ tên: <?= auth()->user()['ho'] . ' ' . auth()->user()['ten'] ?></p>
    <hr/>
    <div class="__sidebar">
        <div class=""><a href="/trangchu/index">Trang chủ</a></div>
        <div class="<?= headCompare(['/thongke/*'], '__sidebar_active', '')?>"><a href="/thongke/index">Thống kê</a></div>
        <div class="<?= headCompare(['/taikhoanadmin/*', '/taikhoanquanly/*', '/taikhoankhachhang/*'], '__sidebar_active', '')?>"><a href="/taikhoanadmin/index">Quản lý tài khoản</a></div>
        <div class="<?= headCompare(['/tinh/*', '/quocgia/*'], '__sidebar_active', '')?>"><a href="/tinh/index">Quản lý tỉnh</a></div>
        <div class="<?= headCompare(['/blog/*'], '__sidebar_active', '')?>"><a href="/blog/index">Quản lý Blog</a></div>
        <div class="<?= headCompare(['/trogiup/*', '/loaitrogiup/*'], '__sidebar_active', '')?>"><a href="/trogiup/index">Quản lý trợ giúp</a></div>
        <div class="<?= headCompare(['/tour/*'], '__sidebar_active', '')?>"><a href="/tour/index">Quản lý tour</a></div>
        <div class="<?= headCompare(['/dattour/*'], '__sidebar_active', '')?>"><a href="/dattour/index">Quản lý đặt tour</a></div>
        <div class="<?= headCompare(['/slide/*', '/loaislide/*'], '__sidebar_active', '')?>"><a href="/slide/index">Quản lý slide</a></div>
        <div><a href="/trangchu/logout">Đăng xuất</a></div>
    </div>
</div>