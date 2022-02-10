<?php
class TaiKhoanKhachHangController extends Controller {
    public function __construct() {
        $this->modelName = 'TaiKhoan';
    }

    public function index() {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');
        
        $results = $this->model()->where('loai', 3)
            ->leftJoin('khach_hang', 'khach_hang.id_tai_khoan', 'tai_khoan.id')
            ->join('tinh', 'tinh.id', 'khach_hang.id_tinh')
            ->join('quoc_gia', 'quoc_gia.id', 'tinh.id_quoc_gia');
        if ($search != null) {
            $results = $results->where('tai_khoan.username', "%$search%", 'LIKE', true)
                ->orWhere('tai_khoan.ho', "%$search%", 'LIKE')
                ->orWhere('tai_khoan.ten', "%$search%", 'LIKE')
                ->orWhere('tai_khoan.email', "%$search%", 'LIKE')
                ->orWhere('khach_hang.dia_chi', "%$search%", 'LIKE')
                ->orWhere('tinh.ten', "%$search%", 'LIKE')
                ->orWhere('quoc_gia.ten', "%$search%", 'LIKE', false, true);
        }
        $results = $results->select('tai_khoan.id AS id', 'tai_khoan.ho AS ho', 'tai_khoan.ten AS ten', 'tai_khoan.email AS email', 'tai_khoan.sdt AS sdt', 'ngay_sinh', 'dia_chi', 'tinh.ten AS tinh', 'quoc_gia.ten AS quoc_gia')
            ->orderByDesc('tai_khoan.id')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tai_khoan_khach_hang.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function view($id) {
        Middleware::start()->check_user($id)->execute();

        $provinces = model('Tinh')->get();

        $result = $this->model()->find($id)
            ->join('khach_hang', 'khach_hang.id_tai_khoan', 'tai_khoan.id')
            ->join('tinh', 'tinh.id', 'khach_hang.id_tinh')
            ->join('quoc_gia', 'quoc_gia.id', 'tinh.id_quoc_gia')
            ->select('tai_khoan.*', 'ngay_sinh', 'dia_chi', 'id_tinh', 'tinh.ten AS ten_tinh', 'quoc_gia.ten AS ten_quoc_gia')
            ->first();

        view('frontend.profile', [
            'view' => 'frontend.profile.userCustomer',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function create() {
        Middleware::start()->check_admin()->execute();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        view('backend.index', [
            'view' => 'backend.tai_khoan_khach_hang.create',
            'provinces' => $provinces,
        ]);
    }

    public function insert() {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'username' => 'required|unique:tai_khoan',
            'password' => 'required|same:repassword',
            'repassword' => 'required|same:password',
            'ho' => 'required',
            'ten' => 'required',
            'sdt' => 'required|integer|unique:tai_khoan',
            'email' => 'required|unique:tai_khoan|email',
            'ngay_sinh' => 'required|date',
            'dia_chi' => 'required',
            'id_tinh' => 'required|exists:tinh,id',
        ])->execute();

        $id = $this->model()->insert([
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

        return success(['code' => 'create_success']);
    }

    public function edit($id) {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->leftJoin('khach_hang', 'khach_hang.id_tai_khoan', 'tai_khoan.id')->select('tai_khoan.*', 'ngay_sinh', 'dia_chi', 'id_tinh')->first();
        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();
        
        view('backend.index', [
            'view' => 'backend.tai_khoan_khach_hang.edit',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function editCustomer($id) {
        Middleware::start()->check_user($id)->execute();

        $result = $this->model()->find($id)->leftJoin('khach_hang', 'khach_hang.id_tai_khoan', 'tai_khoan.id')->select('tai_khoan.*', 'ngay_sinh', 'dia_chi', 'id_tinh')->first();

        $provinces = model('tinh')->query()->join('quoc_gia', 'tinh.id_quoc_gia', 'quoc_gia.id')->select('tinh.id AS id', 'tinh.ten AS ten', 'quoc_gia.ten as ten_quoc_gia')->get();

        view('frontend.profile', [
            'view' => 'frontend.profile.edit',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function update($id) {
        Middleware::start()->check_user($id)->execute();

        Validation::validate(Request::all(), [
            'password' => 'same:repassword',
            'repassword' => 'same:password',
            'ho' => 'required',
            'ten' => 'required',
            'sdt' => "required|integer|unique:tai_khoan,sdt,$id",
            'email' => "required|unique:tai_khoan,email,$id|email",
            'ngay_sinh' => 'required|date',
            'dia_chi' => 'required',
            'id_tinh' => 'required|exists:tinh,id',
        ])->execute();

        $dataTaiKhoan = [
            'ho' => Request::input('ho'),
            'ten' => Request::input('ten'),
            'email' => Request::input('email'),
            'sdt' => Request::input('sdt'),
        ];

        $dataKhachHang = [
            'ngay_sinh' => Request::input('ngay_sinh'),
            'dia_chi' => Request::input('dia_chi'),
            'id_tinh' => Request::input('id_tinh'),
        ];

        if (Request::input('password'))
            $data['password'] = Request::input('password');
        
        $this->model()->find($id)->update($dataTaiKhoan);

        model('KhachHang')->where('id_tai_khoan', $id)->update($dataKhachHang);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tai_khoan/hinh' . $id), 'png');
        }

        return success(['code' => 'update_success']);
    }

    public function destroy($id) {
        Middleware::start()->check_admin()->execute();
        if (model('KhachHang')->where('id_tai_khoan', $id)->delete() || $this->model()->find($id)->delete()) {
            if (file_exists('./' . asset('images/tai_khoan/hinh' . $id) . '.png'))
                unlink('./' . asset('images/tai_khoan/hinh' . $id) . '.png');
            return success(['code' => 'destroy_success']);
        }
        else return error(['code' => 'destroy_fail']);
    }
}