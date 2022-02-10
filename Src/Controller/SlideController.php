<?php
class SlideController extends Controller
{
    public function index()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()
            ->join('loai_slide', 'loai_slide.id', 'slide.id_loai_slide')
            ->join('tai_khoan', 'tai_khoan.id', 'slide.id_tai_khoan');
        if ($search != null) {
            $results = $results->where('slide.tieu_de', "%$search%", 'LIKE')->orWhere('slide.mo_ta', "%$search%", 'LIKE')->orWhere('loai_slide.ten', "%$search%", 'LIKE');
        }
        $results = $results->orderByDesc('slide.id')->select('slide.*', 'loai_slide.ten AS loai_slide', 'tai_khoan.ten AS ten_tai_khoan', 'tai_khoan.ho AS ho_tai_khoan')->paginate($page);

        view('backend.index', [
            'view' => 'backend.slide.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function create()
    {
        Middleware::start()->check_admin()->execute();

        $types = model('LoaiSlide')->get();

        view('backend.index', [
            'view' => 'backend.slide.create',
            'types' => $types,
        ]);
    }

    public function insert()
    {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'id_loai_slide' => 'required|exists:loai_slide, id',
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ])->execute();

        $data = [
            'id_tai_khoan' => Auth::user()['id'],
            'id_loai_slide' => Request::input('id_loai_slide'),
            'tieu_de' => Request::input('tieu_de'),
            'noi_dung' => Request::input('noi_dung'),
            'url' => Request::input('url'),
            'ngay_dang' => date('Y-m-d H:i:s'),
        ];

        if (Request::input('ngay_bat_dau')) {
            $data['ngay_bat_dau'] = Request::input('ngay_bat_dau');
        }

        if (Request::input('ngay_ket_thuc')) {
            $data['ngay_ket_thuc'] = Request::input('ngay_ket_thuc');
        }

        $id = $this->model()->insert($data);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/slide/hinh' . $id), 'png');
        }

        return success(['code' => 'create_success']);
    }

    public function edit($id)
    {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->first();
        $types = model('LoaiSlide')->get();

        view('backend.index', [
            'view' => 'backend.slide.edit',
            'result' => $result,
            'types' => $types,
        ]);
    }

    public function update($id)
    {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'id_loai_slide' => 'required|exists:loai_slide, id',
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ])->execute();

        $data = [
            'id_tai_khoan' => Auth::user()['id'],
            'id_loai_slide' => Request::input('id_loai_slide'),
            'tieu_de' => Request::input('tieu_de'),
            'noi_dung' => Request::input('noi_dung'),
            'url' => Request::input('url'),
            'ngay_dang' => date('Y-m-d H:i:s'),
        ];

        if (Request::input('ngay_bat_dau')) {
            $data['ngay_bat_dau'] = Request::input('ngay_bat_dau');
        } else DB::execute("UPDATE slide SET ngay_bat_dau = NULL WHERE id = $id");

        if (Request::input('ngay_ket_thuc')) {
            $data['ngay_ket_thuc'] = Request::input('ngay_ket_thuc');
        } else DB::execute("UPDATE slide SET ngay_ket_thuc = NULL WHERE id = $id");

        $this->model()->find($id)->update($data);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/slide/hinh' . $id), 'png');
        }

        return success(['code' => 'update_success']);
    }

    public function destroy($id)
    {
        Middleware::start()->check_admin()->execute();
        if ($this->model()->find($id)->delete()) {
            if (file_exists('./' . asset('images/slide/hinh' . $id) . '.png'))
                unlink('./' . asset('images/slide/hinh' . $id) . '.png');
            return success(['code' => 'destroy_success']);
        } else return error(['code' => 'destroy_fail']);
    }
}
