<?php
class TaiKhoanQuanLyController extends Controller {
    public function __construct() {
        $this->modelName = 'TaiKhoan';
    }

    public function index() {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');
        
        $results = $this->model()->where('loai', 2);
        if ($search != null) {
            $results = $results->where('username', "%$search%", 'LIKE', true)
                ->orWhere('ho', "%$search%", 'LIKE')
                ->orWhere('ten', "%$search%", 'LIKE')
                ->orWhere('email', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('tai_khoan.id')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tai_khoan_quan_ly.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function view($id) {
        Middleware::start()->check_user($id)->execute();

        $provinces = model('Tinh')->get();

        $result = $this->model()->find($id)
            ->select('*')
            ->first();

        view('frontend.profile', [
            'view' => 'frontend.profile.userManager',
            'result' => $result,
            'provinces' => $provinces,
        ]);
    }

    public function create() {
        Middleware::start()->check_admin()->execute();

        view('backend.index', [
            'view' => 'backend.tai_khoan_quan_ly.create'
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
        ])->execute();

        $id = $this->model()->insert([
            'username' => Request::input('username'),
            'password' => Request::input('password'),
            'ho' => Request::input('ho'),
            'ten' => Request::input('ten'),
            'email' => Request::input('email'),
            'loai' => 2,
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tai_khoan/hinh' . $id), 'png');
        }

        return success(['code' => 'create_success']);
    }

    public function edit($id) {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->first();
        view('backend.index', [
            'view' => 'backend.tai_khoan_quan_ly.edit',
            'result' => $result
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
        ])->execute();

        $data = [
            'ho' => Request::input('ho'),
            'ten' => Request::input('ten'),
            'sdt' => Request::input('sdt'),
            'email' => Request::input('email'),
        ];

        if (Request::input('password'))
            $data['password'] = Request::input('password');
        $this->model()->find($id)->update($data);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/tai_khoan/hinh' . $id), 'png');
        }

        return success(['code' => 'update_success']);
    }

    public function destroy($id) {
        Middleware::start()->check_admin()->execute();
        if ($this->model()->find($id)->delete()) {
            if (file_exists('./' . asset('images/tai_khoan/hinh' . $id) . '.png'))
                unlink('./' . asset('images/tai_khoan/hinh' . $id) . '.png');
            return success(['code' => 'destroy_success']);
        }
        else return error(['code' => 'destroy_fail']);
    }
}