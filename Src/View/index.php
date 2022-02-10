<!-- Slider -->
<section class="flexslider-container" id="flexslider-container-1">
  <div class="flexslider slider" id="slider-1">
    <ul class="slides">
      <li class="item-1" style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('<?= asset('images/y.jpg') ?>') 50% 0%;background-size:cover;height:100%;">
        <div class=" meta">
          <div class="container">
            <h2>Khám phá</h2>
            <h1>Thế giới</h1>
            <a href="tour-nuocngoai.php" class="btn btn-default">Xem thêm</a>
          </div>
        </div>
      </li>
      <li class="item-2" style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('<?= asset('images/autra.jpg') ?>') 50% 0%;background-size:cover;height:100%;">
        <div class=" meta">
          <div class="container">
            <h2>Khám phá</h2>
            <h1>Australia</h1>
            <a href="tour-nuocngoai.php?cbid=5" class="btn btn-default">Xem thêm</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <!--End of slider -->

  <!-- Tour lookup -->
  <div class="search-tabs" id="search-tabs-1">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="tab-content">
            <div id="tour" class="tab-pane in active">
              <form action="search.php" method="get" name="timkiem">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6">
                        <label>Nơi xuất phát:</label>
                        <div class="form-group left-icon">
                          <input type="text" class="form-control" placeholder="Nơi xuất phát" name="search">
                          <i class="fa fa-map-marker"></i>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-6">
                        <label>Điểm đến:</label>
                        <div class="form-group left-icon">
                          <input type="text" class="form-control" placeholder="Điểm đến" name="search1">
                          <i class="fa fa-map-marker"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <label>Khởi hành:</label>
                        <div class="form-group left-icon">
                          <input type="date" class="form-control dpd1" placeholder="Ngày đi" name="search2">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <label>Kết thúc:</label>
                        <div class="form-group left-icon">
                          <input type="date" class="form-control dpd2" placeholder="Ngày về" name="search3">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <label>Tên tour:</label>
                    <div class="form-group left-icon">
                      <input type="text" class="form-control dpd1" placeholder="Tên tour" name="search4">
                      <i class="fa fa-suitcase "></i>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 search-btn">
                    <button name="submit" class="btn btn-orange" style="margin-bottom: -65px;">Tìm kiếm</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End of tour lookup -->

</section>
<!-- End of Slider -->

<!-- Ads -->
<div class="container">
  <div class="rupes">
    <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
      <div class="rup-left" style="float: left;margin-right: 20px;">
        <a href="offers.html"><i class="fa fa-usd" style="font-size: 5em;color: #1f8dd6;"></i></a>
      </div>
      <div class="rup-rgt">
        <h3 style="font-size: 20px;color: #34ad00;font-weight: 700;">Giá thành hợp lí</h3>
        <h4><a href="offers.html">Phù hợp với nhu cầu</a></h4>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
      <div class="rup-left" style="float: left;margin-right: 20px;">
        <a href="offers.html"><i class="fa fa-h-square" style="font-size: 5em;color: #1f8dd6;"></i></a>
      </div>
      <div class="rup-rgt">
        <h3 style="font-size: 20px;color: #34ad00;font-weight: 700;">Giảm giá lên tới 70%</h3>
        <h4><a href="offers.html">Khi có chương trình khuyến mãi</a></h4>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-4 rupes-left wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
      <div class="rup-left" style="float: left;margin-right: 20px;">
        <a href="offers.html"><i class="fa fa-mobile" style="font-size: 5em;color: #1f8dd6;"></i></a>
      </div>
      <div class="rup-rgt">
        <h3 style="font-size: 20px;color: #34ad00;font-weight: 700;">Tiện lợi nhanh chóng</h3>
        <h4><a href="offers.html">Thông minh và đầy đủ</a></h4>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<!-- End of ads -->