<?php
class TourController extends Controller
{
    public function index()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model();
        if ($search) {
            $results = $results->where('ten', "%$search%", 'LIKE');
        }
        $results = $results->orderByDesc('tour.id')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tour.index',
            'results' => $results,
            'search' => $search,
        ]);
    }

    public function local()
    {
        $slides = model('Slide')->where('id_loai_slide', 2)->get();
        $tours = model('Tour')
            ->join('tinh', 'tinh.id', 'tour.id_tinh_diem_den')
            ->where('tinh.id_quoc_gia', 1)
            ->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>')
            ->select('tour.*', '(gia_nguoi_lon/(gia_nguoi_lon + gia_goc_nguoi_lon) * 100) AS giam_gia')->orderByDesc('giam_gia')->get();

        view('frontend.index', [
            'view' => 'frontend.tour.index',
            'slides' => $slides,
            'tours' => $tours,
            'type' => 'local',
        ]);
    }

    public function foreign()
    {
        $slides = model('Slide')->where('id_loai_slide', 2)->get();
        $tours = model('Tour')
            ->join('tinh', 'tinh.id', 'tour.id_tinh_diem_den')
            ->where('tinh.id_quoc_gia', 1, '<>')
            ->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>')
            ->select('tour.*', '(gia_nguoi_lon/(gia_nguoi_lon + gia_goc_nguoi_lon) * 100) AS giam_gia')->orderByDesc('giam_gia')->get();

        view('frontend.index', [
            'view' => 'frontend.tour.index',
            'slides' => $slides,
            'tours' => $tours,
            'type' => 'foreign',
        ]);
    }

    public function list($param1 = '')
    {
        $param1 = strtolower($param1);

        $countries = model('QuocGia')->get();
        $tours = $this->model()
            ->join('tinh AS tinh_xuat_phat', 'tinh_xuat_phat.id', 'tour.id_tinh_xuat_phat')
            ->join('tinh AS tinh_diem_den', 'tinh_diem_den.id', 'tour.id_tinh_diem_den')
            ->join('quoc_gia AS quoc_gia_xuat_phat', 'quoc_gia_xuat_phat.id', 'tinh_xuat_phat.id_quoc_gia')
            ->join('quoc_gia AS quoc_gia_diem_den', 'quoc_gia_diem_den.id', 'tinh_diem_den.id_quoc_gia');

        if (auth()->user()['loai'] == 3 || !auth()->check())
            $tours = $tours->where('ngay_ket_thuc', date('Y-m-d H:i:s'), '>');

        $page = Request::get('page', 1);
        $diemDen = Request::get('diem_den', '');
        $ngayKhoiHanh = Request::get('ngay_khoi_hanh', '');
        if ($ngayKhoiHanh)
            $ngayKhoiHanh = date('Y-m-d', strtotime(str_replace('/', '-', $ngayKhoiHanh)));
        $ngayKetThuc = Request::get('ngay_ket_thuc', '');
        if ($ngayKetThuc)
            $ngayKetThuc = date('Y-m-d', strtotime(str_replace('/', '-', $ngayKetThuc)));
        $thang = Request::get('thang', '');
        $filterCountries = Request::input('countries', []);

        if ($diemDen)
            $tours = $tours->where('CONCAT(tour.dia_chi_diem_den, \' \', tinh_diem_den.ten, \' \', quoc_gia_diem_den.ten)', "%$diemDen%", 'LIKE');
        if ($ngayKhoiHanh)
            $tours = $tours->where('ngay_khoi_hanh', $ngayKhoiHanh, '>=');
        if ($ngayKetThuc)
            $tours = $tours->where('ngay_ket_thuc', $ngayKetThuc, '<=');
        if ($thang)
            $tours = $tours->where('MONTH(ngay_khoi_hanh)', $thang, '=', true)->orWhere('MONTH(ngay_ket_thuc)', $thang, '=', false, true);

        if (!in_array(0, $filterCountries) && !empty($filterCountries)) {
            $tours = $tours->orWhereIn('quoc_gia_xuat_phat.id', $filterCountries)->orWhereIn('quoc_gia_diem_den.id', $filterCountries);
        }

        // if ($param1 == 'mylist') {
        //     $tours = $tours->where('id_tai_khoan', Auth::user()['id']);
        // }

        $tours = $tours->orderByDesc('ngay_dang')->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'tinh_diem_den.ten AS ten_tinh_diem_den', 'tinh_xuat_phat.ten AS ten_tinh_xuat_phat')->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.tour.list',
            'countries' => $countries,
            'tours' => $tours,
            'filterCountries' => $filterCountries,
            // 'myList' => $param1 == 'mylist' ? true : false,
        ]);
    }

    public function view($id)
    {
        $result = $this->model()->find($id)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->where('trang_thai', 0, '<>')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'TRIM((tour.gia_goc_nguoi_lon - tour.gia_nguoi_lon) / tour.gia_goc_nguoi_lon * 100)+0 AS giam_gia', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat')
            ->first();

        $user = null;
        if (Auth::check())
            $user = model('TaiKhoan')->find(Auth::user()['id'])->first();

        $images = [];
        if (file_exists('.' . asset('images/tour_detail/tour' . $id))) {
            $images = scandir('.' . asset('images/tour_detail/tour' . $id));
            unset($images[0]);
            unset($images[1]);
            $images = array_values($images);
        }

        $helpTypes = model('LoaiTroGiup')->get();

        view('frontend.index', [
            'view' => 'frontend.tour.view',
            'result' => $result,
            'images' => $images,
            'user' => $user,
            'helpTypes' => $helpTypes,
        ]);
    }

    public function create()
    {
        Middleware::start()->check_admin()->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        view('backend.index', [
            'view' => 'backend.tour.create',
            'provinces' => $provinces,
        ]);
    }

    public function userCreate()
    {

        Middleware::start()->check_permission([2])->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        view('frontend.index', [
            'view' => 'frontend.tour.create',
            'provinces' => $provinces,
        ]);
    }

    public function insert()
    {
        Middleware::start()->check_permission([1, 2])->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required',
            'so_nguoi' => 'required|integer',
            'ngay_khoi_hanh' => 'required|datetime',
            'ngay_ket_thuc' => 'required|datetime',
            'phuong_tien' => 'required',
            'gia_goc_nguoi_lon' => 'required|number',
            'gia_nguoi_lon' => 'required|number',
            'gia_goc_tre_em' => 'required|number',
            'gia_tre_em' => 'required|number',
            'id_tinh_xuat_phat' => 'required|exists:tinh, id',
            'id_tinh_diem_den' => 'required|exists:tinh, id',
            'dia_chi_xuat_phat' => 'required',
            'dia_chi_diem_den' => 'required',
            'gioi_thieu' => '',
        ])->execute();

        Request::add([
            'id_tai_khoan' => Auth::user()['id'],
            'ngay_dang' => date('Y-m-d H:i:s')
        ]);

        $data = Request::all();

        unset($data['image']);
        unset($data['images']);

        $id = $this->model()->insert($data);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tour/hinh' . $id), 'png');
        }
        $index = 1;
        mkdir('./' . asset('images/tour_detail/tour' . $id));
        foreach (Request::input('images', []) as $image) {
            if ($image) {
                if ($image == 'delete' && file_exists('./' . asset("images/tour_detail/tour$id/hinh$index.png")))
                    unlink('./' . asset("images/tour_detail/tour$id/hinh$index.png"));
                else if ($image != 'delete')
                    save_base64_image($image, './' . asset("images/tour_detail/tour$id/hinh$index"), 'png');
            }
            $index++;
        }

        return success(['code' => 'create_success']);
    }

    public function edit($id)
    {
        Middleware::start()->check_admin()->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        $result = $this->model()->find($id)->first();
        view('backend.index', [
            'view' => 'backend.tour.edit',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function userEdit($id)
    {
        //$id_user = model('Tour')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_permission([2])->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        $result = $this->model()->find($id)->first();
        view('frontend.index', [
            'view' => 'frontend.tour.edit',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function update($id)
    {
        ///$id_user = model('Tour')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_permission([2])->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required',
            'so_nguoi' => 'required|integer',
            'ngay_khoi_hanh' => 'required|datetime',
            'ngay_ket_thuc' => 'required|datetime',
            'phuong_tien' => 'required',
            'gia_goc_nguoi_lon' => 'required|number',
            'gia_nguoi_lon' => 'required|number',
            'gia_goc_tre_em' => 'required|number',
            'gia_tre_em' => 'required|number',
            'id_tinh_xuat_phat' => 'required|exists:tinh, id',
            'id_tinh_diem_den' => 'required|exists:tinh, id',
            'dia_chi_xuat_phat' => 'required',
            'dia_chi_diem_den' => 'required',
            'gioi_thieu' => '',
        ])->execute();

        $data = Request::all();

        unset($data['image']);
        unset($data['images']);

        $this->model()->find($id)->update($data);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tour/hinh' . $id), 'png');
        }

        $index = 1;
        foreach (Request::input('images', []) as $image) {
            if ($image) {
                if ($image == 'delete' && file_exists('./' . asset("images/tour_detail/tour$id/hinh$index.png")))
                    unlink('./' . asset("images/tour_detail/tour$id/hinh$index.png"));
                else if ($image != 'delete')
                    save_base64_image($image, './' . asset("images/tour_detail/tour$id/hinh$index"), 'png');
            }
            $index++;
        }

        return success(['code' => 'update_success']);
    }

    public function userCopy($id)
    {
        //$id_user = model('Tour')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_permission([2])->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        $result = $this->model()->find($id)->first();
        view('frontend.index', [
            'view' => 'frontend.tour.edit',
            'result' => $result,
            'provinces' => $provinces,
            'copy' => true,
        ]);
    }

    public function adminCopy($id)
    {
        //$id_user = model('Tour')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_permission([1])->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        $result = $this->model()->find($id)->first();
        view('backend.index', [
            'view' => 'backend.tour.edit',
            'result' => $result,
            'provinces' => $provinces,
            'copy' => true,
        ]);
    }

    public function copy($old_id)
    {
        Middleware::start()->check_permission([1, 2])->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required',
            'so_nguoi' => 'required|integer',
            'ngay_khoi_hanh' => 'required|datetime',
            'ngay_ket_thuc' => 'required|datetime',
            'phuong_tien' => 'required',
            'gia_goc_nguoi_lon' => 'required|number',
            'gia_nguoi_lon' => 'required|number',
            'gia_goc_tre_em' => 'required|number',
            'gia_tre_em' => 'required|number',
            'id_tinh_xuat_phat' => 'required|exists:tinh, id',
            'id_tinh_diem_den' => 'required|exists:tinh, id',
            'dia_chi_xuat_phat' => 'required',
            'dia_chi_diem_den' => 'required',
            'gioi_thieu' => '',
        ])->execute();

        Request::add([
            'id_tai_khoan' => Auth::user()['id'],
            'ngay_dang' => date('Y-m-d H:i:s')
        ]);

        $data = Request::all();

        unset($data['image']);
        unset($data['images']);

        $id = $this->model()->insert($data);

        if (file_exists('.' . asset("images/tour/hinh$old_id.png")))
            copy('.' . asset("images/tour/hinh$old_id.png"), '.' . asset("images/tour/hinh$id.png"));

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset("images/tour/hinh$id"), 'png');
        }

        mkdir('./' . asset("images/tour_detail/tour$id"));

        foreach (glob('.' . asset("images/tour_detail/tour$old_id/*.png")) as $image) {
            $image = str_replace('.' . asset("images/tour_detail/tour$old_id/"), '', $image);
            copy('./' . asset("images/tour_detail/tour$old_id/$image"), './' . asset("images/tour_detail/tour$id/$image"));
        }

        $index = 1;
        foreach (Request::input('images', []) as $image) {
            if ($image) {
                if ($image == 'delete' && file_exists('./' . asset("images/tour_detail/tour$id/hinh$index.png")))
                    unlink('./' . asset("images/tour_detail/tour$id/hinh$index.png"));
                else if ($image != 'delete')
                    save_base64_image($image, './' . asset("images/tour_detail/tour$id/hinh$index"), 'png');
            }
            $index++;
        }

        return success(['code' => 'update_success']);
    }

    public function destroy($id)
    {
        //$id_user = model('Tour')->find($id)->first()['id_tai_khoan'];

        //Middleware::start()->check_user($id_user)->execute();
        Middleware::start()->check_permission([1, 2])->execute();

        if ($this->model()->find($id)->delete()) {
            ob_start();
            if (file_exists('./' . asset('images/tour/hinh' . $id) . '.png'))
                unlink('./' . asset('images/tour/hinh' . $id) . '.png');
            if (file_exists('./' . asset("images/tour_detail/tour$id")))
                rmdir('./' . asset("images/tour_detail/tour$id"));
            ob_end_clean();
            return success(['code' => 'destroy_success']);
        } else return error(['code' => 'destroy_fail']);
    }
}
