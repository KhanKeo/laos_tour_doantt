<?php
class BlogController extends Controller
{
    public function index()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()->join('tai_khoan', 'tai_khoan.id', 'blog.id_tai_khoan');
        if ($search != null) {
            $results = $results->where('tai_khoan.ho', "%$search%", 'LIKE')
                ->orWhere('tai_khoan.ten', "%$search%", 'LIKE')
                ->orWhere('tieu_de', "%$search%", 'LIKE')
                ->orWhere('tom_tat', "%$search%", 'LIKE')
                ->orWhere('noi_dung', "%$search%", 'LIKE');
        }
        $results = $results->orderByDesc('blog.id')->select('blog.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan')->paginate($page);

        view('backend.index', [
            'view' => 'backend.blog.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function list($page = 1, $search = null)
    {
        $slides = model('Slide')->where('id_loai_slide', 3)->get();
        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'blog.id_tai_khoan')
            ->orderByDesc('ngay_dang')
            ->select('blog.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan')
            ->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.blog.index',
            'results' => $results,
            'search' => $search,
            'slides' => $slides,
            'myBlog' => false,
        ]);
    }

    public function myBlog($id, $page = 1) {
        Middleware::start()->check_user($id)->execute();

        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'blog.id_tai_khoan')
            ->where('tai_khoan.id', $id)
            ->orderByDesc('ngay_dang')
            ->select('blog.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan')
            ->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.blog.index',
            'results' => $results,
            'myBlog' => true,
        ]);
    }

    public function view($id) {
        $result = $this->model()->find($id)
            ->join('tai_khoan', 'tai_khoan.id', 'blog.id_tai_khoan')
            ->orderByDesc('ngay_dang')
            ->select('blog.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan')
            ->first();

        view('frontend.index', [
            'view' => 'frontend.blog.view',
            'result' => $result,
        ]);
    }

    public function create()
    {
        Middleware::start()->check_admin()->execute();

        view('backend.index', [
            'view' => 'backend.blog.create',
        ]);
    }

    public function userCreate()
    {
        Middleware::start()->check_permission([2])->execute();

        view('frontend.index', [
            'view' => 'frontend.blog.create',
        ]);
    }

    public function insert()
    {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'tieu_de' => 'required',
            'tom_tat' => 'required',
            'noi_dung' => 'required',
        ])->execute();

        $id = $this->model()->insert([
            'id_tai_khoan' => Auth::user()['id'],
            'tieu_de' => Request::input('tieu_de'),
            'tom_tat' => Request::input('tom_tat'),
            'noi_dung' => Request::input('noi_dung'),
            'ngay_dang' => date('Y-m-d H:i:s'),
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/blog/hinh' . $id), 'png');
        }

        return success(['code' => 'create_success']);
    }

    public function userInsert()
    {
        Middleware::start()->check_permission([2])->execute();

        Validation::validate(Request::all(), [
            'tieu_de' => 'required',
            'tom_tat' => 'required',
            'noi_dung' => 'required',
        ])->execute();

        $id = $this->model()->insert([
            'id_tai_khoan' => Auth::user()['id'],
            'tieu_de' => Request::input('tieu_de'),
            'tom_tat' => Request::input('tom_tat'),
            'noi_dung' => Request::input('noi_dung'),
            'ngay_dang' => date('Y-m-d H:i:s'),
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/blog/hinh' . $id), 'png');
        }

        return success(['code' => 'create_success']);
    }


    public function edit($id)
    {
        Middleware::start()->check_admin()->execute();

        $result = $this->model()->find($id)->first();

        view('backend.index', [
            'view' => 'backend.blog.edit',
            'result' => $result,
        ]);
    }

    public function userEdit($id)
    {
        $id_user = model('Blog')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_user($id_user)->execute();

        $result = $this->model()->find($id)->first();

        view('frontend.index', [
            'view' => 'frontend.blog.edit',
            'result' => $result,
        ]);
    }

    public function update($id)
    {
        Middleware::start()->check_admin()->execute();

        $this->model()->find($id)->update([
            'tieu_de' => Request::input('tieu_de'),
            'tom_tat' => Request::input('tom_tat'),
            'noi_dung' => Request::input('noi_dung'),
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/blog/hinh' . $id), 'png');
        }

        return success(['code' => 'update_success']);
    }

    public function userUpdate($id)
    {
        $id_user = model('Blog')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_user($id_user)->execute();

        $this->model()->find($id)->update([
            'tieu_de' => Request::input('tieu_de'),
            'tom_tat' => Request::input('tom_tat'),
            'noi_dung' => Request::input('noi_dung'),
        ]);

        if (Request::input('image')) {
            save_base64_image(Request::input('image'), './' . asset('images/blog/hinh' . $id), 'png');
        }

        return success(['code' => 'update_success']);
    }

    public function destroy($id)
    {
        $id_user = model('Blog')->find($id)->first()['id_tai_khoan'];

        Middleware::start()->check_user($id_user)->execute();
        
        if ($this->model()->find($id)->delete()) {
            if (file_exists('./' . asset('images/blog/hinh' . $id) . '.png'))
                unlink('./' . asset('images/blog/hinh' . $id) . '.png');
            return success(['code' => 'destroy_success']);
        } else return error(['code' => 'destroy_fail']);
    }
}
