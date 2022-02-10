<?php
class ThongKeController extends Controller
{
    public function index()
    {
        Middleware::start()->check_admin()->execute();

        //Thống kê doanh thu ngày hôm nay
        $turnoverNow = model('DatTour')->where('trang_thai', 3)->select('CONCAT("Tháng ", MONTH(ngay_dat), " năm " , YEAR(ngay_dat)) AS thang', 'SUM((so_nguoi_lon * gia_nguoi_lon) + (so_tre_em * gia_tre_em)) AS tong_tien', 'SUM(so_nguoi_lon + so_tre_em) AS so_luong_dat')->groupBy('thang')->orderByDesc('YEAR(ngay_dat)')->orderByDesc('MONTH(ngay_dat)')->limit(2, 1)->get();
        //Thống kê doanh thu các tháng
        $turnoverMonths = model('DatTour')->where('trang_thai', 3)->select('CONCAT("Tháng ", MONTH(ngay_dat), " năm " , YEAR(ngay_dat)) AS thang', 'SUM((so_nguoi_lon * gia_nguoi_lon) + (so_tre_em * gia_tre_em)) AS tong_tien')->groupBy('thang')->orderByDesc('YEAR(ngay_dat)')->orderByDesc('MONTH(ngay_dat)')->limit(10)->get();
        //Thống kê doanh thu các quý
        //$turnoverQuarters = model('DatTour')->where('trang_thai', 3)->select('CONCAT("Quý ", QUARTER(ngay_dat), " năm " ,YEAR(ngay_dat)) AS quy', 'SUM((so_nguoi_lon * gia_nguoi_lon) + (so_tre_em * gia_tre_em)) AS tong_tien')->groupBy('quy')->orderBy('quy')->limit(10)->get();
        //Tour đặt nhiều nhất
        $topBookedTour = model('DatTour')->join('tour', 'tour.id', 'dat_tour.id_tour')->where('trang_thai', 3)->select('tour.ten AS ten_tour', 'SUM(so_nguoi_lon + so_tre_em) AS so_lan_dat', 'SUM((dat_tour.so_nguoi_lon * dat_tour.gia_nguoi_lon) + (dat_tour.so_tre_em * dat_tour.gia_tre_em)) AS tong_tien')->groupBy('id_tour')->orderBy('tong_tien')->limit(10)->get();

        //return $topBookedTour;
        view('backend.index', [
            'view' => 'backend.thong_ke.index',
            'data' => [
                'turnover' => [
                    'now' => $turnoverNow ? $turnoverNow : ['ngay' => date('d/m/Y'), 'tong_tien' => 0],
                    'months' => $turnoverMonths,
                    //'quarters' => $turnoverQuarters,
                ],
                'top' => [
                    'bookedTour' => $topBookedTour,
                ]
            ]
        ]);
    }
}
