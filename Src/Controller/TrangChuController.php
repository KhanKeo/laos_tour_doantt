<?php
class TrangChuController extends Controller
{
    public function index()
    {
        if (Auth::user() && Auth::user()['loai'] == 1) {
            $counter = [
                'user' => model('TaiKhoan')->count(),
                'province' => model('Tinh')->count(),
                'blog' => model('Blog')->count(),
                'help' => model('TroGiup')->whereRaw('tra_loi', 'NULL', 'IS')->count(),
                'tour' => model('Tour')->count(),
                'bookedTour' => model('DatTour')->where('trang_thai', 1)->count(),
                'slide' => model('Slide')->count(),
            ];
            view('backend.index', [
                'bs4' => true,
                'view' => 'backend.home',
                'counter' => $counter,
            ]);
        } else {
            $slides = model('Slide')
                ->where('id_loai_slide', 1)
                ->where('ngay_bat_dau', date('Y-m-d H:i:s'), '<', true)
                ->orWhereRaw('ngay_bat_dau', 'NULL', 'IS', false, true)
                ->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>', true)
                ->orWhereRaw('ngay_ket_thuc', 'NULL', 'IS', false, true)
                ->get();
            
            $hotTours = model('Tour')->join('dat_tour', 'dat_tour.id_tour', 'tour.id')->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>')->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS thoi_gian', 'COUNT(dat_tour.id) AS so_luong_dat')->groupBy('tour.id')->orderByDesc('tour.id')->limit(6)->get();
            $promotionTours = model('Tour')->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>')->select('*', '(gia_nguoi_lon/(gia_nguoi_lon + gia_goc_nguoi_lon) * 100) AS giam_gia', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS thoi_gian')->orderByDesc('giam_gia')->limit(6)->get();
            $newestTours = model('Tour')->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>')->select('*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS thoi_gian')->orderByDesc('ngay_dang')->limit(6)->get();
    
            view('frontend.index', [
                'view' => 'frontend.home',
                'slides' => $slides,
                'newestTours' => $newestTours,
                'promotionTours' => $promotionTours,
                'hotTours' => $hotTours,
            ]);
        }

    }

    public function registerPage()
    {
        $provinces = model('Tinh')->get();

        view('frontend.index', [
            'view' => 'frontend.register',
            'provinces' => $provinces,
            'hideFooter' => true,
        ]);
    }

    public function register()
    {
        Validation::validate(Request::all(), [
            'username' => 'required|unique:tai_khoan',
            'password' => 'required|same:repassword',
            'repassword' => 'required|same:password',
            'ho' => 'required',
            'ten' => 'required',
            'sdt' => 'required|integer',
            'email' => 'required|unique:tai_khoan|email',
            'ngay_sinh' => 'required|date',
            'dia_chi' => 'required',
            'id_tinh' => 'required|exists:tinh,id',
        ])->execute();

        $id = model('TaiKhoan')->insert([
            'username' => Request::input('username'),
            'password' => Request::input('password'),
            'ho' => Request::input('ho'),
            'ten' => Request::input('ten'),
            'email' => Request::input('email'),
            'sdt' => Request::input('sdt'),
            'loai' => 3,
        ]);

        model('KhachHang')->insert([
            'id_tai_khoan' => $id,
            'ngay_sinh' => Request::input('ngay_sinh'),
            'dia_chi' => Request::input('dia_chi'),
            'id_tinh' => Request::input('id_tinh'),
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tai_khoan/hinh' . $id), 'png');
        }

        return success(['code' => 'register_success']);
    }

    public function loginPage()
    {
        view('frontend.index', [
            'view' => 'frontend.login',
            'hideFooter' => true,
        ]);
    }

    public function login()
    {
        //if user has logged in
        if (Auth::check()) {
            return error(['code' => 'login_loggedIn']);
        }

        //Login
        $succeed = Auth::login([
            'username' => Request::input('username'),
            'password' => Request::input('password'),
        ]);

        if (!$succeed)
            $succeed = Auth::login([
                'email' => Request::input('username'),
                'password' => Request::input('password'),
            ]);

        return $succeed ? success(['code' => 'login_success']) : error(['code' => 'login_fail']);
    }

    public function logout()
    {
        Auth::logout();
        redirect('/trangchu/index');
    }
}
