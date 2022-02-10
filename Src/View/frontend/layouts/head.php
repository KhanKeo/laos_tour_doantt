<!--============= TOP-BAR ===========-->
<nav class="navbar navbar-default main-navbar navbar-custom navbar-white" id="mynavbar-1">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" id="menu-button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="header-search hidden-lg">
                <a href="javascript:void(0)" class="search-button"><span><i class="fa fa-search"></i></span></a>
            </div>
            <a href="/trangchu/index" class="navbar-brand"><img src="<?= asset('images/main/logo.png') ?>" height="100%" /></a>
        </div><!-- end navbar-header -->

        <div class="collapse navbar-collapse" id="myNavbar1">
            <ul class="nav navbar-nav navbar-right navbar-search-link">

                <li class="dropdown <?= headCompare(['/', '/trangchu/index'], 'active', '') ?>"><a href="/trangchu/index">Trang chủ</a></li>

                <li class="dropdown <?= headCompare('/tour/*/*', 'active', '') ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tour<span><i class="fa fa-angle-down"></i></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        //Nếu đăng nhập và là tài khoản quản lý
                        if (auth()->check() && auth()->user()['loai'] == 2) {
                        ?>
                            <li><a href="/tour/usercreate">Thêm tour</a></li>
                            <li><a href="/tour/list/mylist">Danh sách tour</a></li>
                        <?php
                        }
                        ?>
                        <li><a href="/tour/local">Tour trong nước</a></li>
                        <li><a href="/tour/foreign">Tour nước ngoài</a></li>
                    </ul>
                </li>

                <!-- BLOG -->
                <?php
                //Nếu đăng nhập và là tài khoản quản lý
                if (auth()->check() && auth()->user()['loai'] == 2) {
                ?>
                    <li class="dropdown <?= headCompare('/blog/*/*', 'active', '') ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog<span><i class="fa fa-angle-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/blog/list">Xem blog</a></li>
                            <li><a href="/blog/myBlog/<?= auth()->user()['id'] ?>">Blog của tôi</a></li>
                            <li><a href="/blog/userCreate">Thêm blog</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="dropdown <?= headCompare(['/blog/list', 'blog/view/*'], 'active', '') ?>"><a href="/blog/list">Blog</a></li>
                <?php
                }
                ?>
                <!-- END OF BLOG -->

                <!-- ACCOUNT -->
                <?php
                //Nếu đăng nhập và là tài khoản quản lý
                if (auth()->check()) {
                ?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tài khoản<span><i class="fa fa-angle-down"></i></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            if (auth()->user()['loai'] == 3) {
                            ?>
                                <li><a href="/taikhoankhachhang/view/<?= auth()->user()['id'] ?>">Quản lý tài khoản</a></li>
                                <li><a href="/trangchu/logout">Đổi mật khẩu</a></li>
                                <li><a href="/dattour/booked/<?= auth()->user()['id'] ?>">Tour đã đặt</a></li>
                                <li><a href="/trangchu/logout">Thông tin thẻ</a></li>
                            <?php
                            } else if (auth()->user()['loai'] == 2) {
                            ?>
                                <li><a href="/taikhoanquanly/view/<?= auth()->user()['id'] ?>">Quản lý tài khoản</a></li>
                            <?php
                            } ?>
                            <li><a href="/trogiup/asked/<?= auth()->user()['id'] ?>">Trợ giúp</a></li>
                            <li><a href="/trangchu/logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="dropdown <?= headCompare('/trangchu/loginPage', 'active', '') ?>"><a href="/trangchu/loginPage">Đăng nhập</a></li>
                <?php
                }
                ?>
                <!-- END OF ACCOUNT -->

                <li>
                    <!-- <a href="javascript:void(0)" class="search-button"><span></span></a> -->
                </li>
            </ul>
        </div><!-- end navbar collapse -->
    </div><!-- end container -->
</nav><!-- end navbar -->

<div class="sidenav-content">
    <div id="mySidenav" class="sidenav">
        <h2 id="web-name"><span><i class="fa fa-plane"></i></span>LAO TOUR</h2>

        <div id="main-menu">
            <div class="closebtn">
                <button class="btn btn-default" id="closebtn">&times;</button>
            </div><!-- end close-btn -->

            <div class="list-group panel">

                <a href="#home-links" class="list-group-item <?= headCompare('/trangchu/*', 'active', '') ?>" data-toggle="collapse" data-parent="#main-menu"><span><i class="fa fa-home link-icon"></i></span>Trang chủ<span><i class="fa fa-chevron-down arrow"></i></span></a>
                <div class="collapse sub-menu" id="home-links">
                    <a href="/trangchu/index" class="list-group-item">Trang chủ</a>
                </div><!-- end sub-menu -->

                <a href="#flights-links" class="list-group-item <?= headCompare('/tour/*/*', 'active', '') ?>" data-toggle="collapse" data-parent="#main-menu"><span><i class="fa fa-plane link-icon"></i></span>Tour<span><i class="fa fa-chevron-down arrow"></i></span></a>
                <div class="collapse sub-menu" id="flights-links">
                    <?php
                    //Nếu đăng nhập và là tài khoản quản lý
                    if (auth()->check() && auth()->user()['loai'] == 2) {
                    ?>
                        <a href="/tour/usercreate" class="list-group-item">Thêm tour</a>
                        <a href="/tour/list/mylist" class="list-group-item">Danh sách tour</a>
                    <?php
                    }
                    ?>
                    <a href="/tour/local" class="list-group-item">Tour trong nước</a>
                    <a href="/tour/foreign" class="list-group-item">Tour nước ngoài</a>
                </div><!-- end sub-menu -->

                <a href="#blog-links" class="list-group-item <?= headCompare(['/blog/list', 'blog/view/*'], 'active', '') ?>" data-toggle="collapse" data-parent="#main-menu"><span><i class="fa fa-book link-icon"></i></span>Blog<span><i class="fa fa-chevron-down arrow"></i></span></a>
                <div class="collapse sub-menu" id="blog-links">
                    <a href="/blog/list" class="list-group-item">Xem blog</a>
                    <?php
                    //Nếu đăng nhập và là tài khoản quản lý
                    if (auth()->check() && auth()->user()['loai'] == 2) {
                    ?>
                        <a href="/blog/myBlog/<?= auth()->user()['id'] ?>" class="list-group-item">Blog của tôi</a>
                        <a href="/blog/userCreate" class="list-group-item">Thêm blog</a>
                    <?php
                    }
                    ?>
                </div><!-- end sub-menu -->

                <a href="#account-links" class="list-group-item" data-toggle="collapse" data-parent="#main-menu"><span><i class="fa fa-user link-icon"></i></span>Tài khoản<span><i class="fa fa-chevron-down arrow"></i></span></a>
                <div class="collapse sub-menu" id="account-links">
                    <?php
                    //Nếu đăng nhập và là tài khoản quản lý
                    if (auth()->check()) {
                    ?>
                        <?php
                        if (auth()->user()['loai'] == 3) {
                        ?>
                            <a href="/taikhoankhachhang/view/<?= auth()->user()['id'] ?>" class="list-group-item">Quản lý tài khoản</a>
                            <a href="/trangchu/logout" class="list-group-item">Đổi mật khẩu</a>
                            <a href="/dattour/booked/<?= auth()->user()['id'] ?>" class="list-group-item">Tour đã đặt</a>
                            <a href="/trangchu/logout" class="list-group-item">Thông tin thẻ</a>
                        <?php
                        } else if (auth()->user()['loai'] == 2) {
                        ?>
                            <a href="/taikhoanquanly/view/<?= auth()->user()['id'] ?>" class="list-group-item">Quản lý tài khoản</a>
                        <?php
                        }
                        ?>
                        <a href="/trogiup/asked/<?= auth()->user()['id'] ?>" class="list-group-item">Trợ giúp</a>
                        <a href="/trangchu/logout" class="list-group-item">Đăng xuất</a>
                    <?php
                    } else {
                    ?>
                        <a href="/trangchu/loginPage" class="list-group-item">Đăng nhập</a>
                    <?php
                    }
                    ?>
                </div><!-- end sub-menu -->

            </div><!-- end list-group -->
        </div><!-- end main-menu -->
    </div><!-- end mySidenav -->
</div><!-- end sidenav-content -->