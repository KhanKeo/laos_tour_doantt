<?php
class TroGiupController extends Controller
{
    public function index($page = 1, $search = null)
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()->join('loai_tro_giup', 'loai_tro_giup.id', 'tro_giup.id_loai_tro_giup')
            ->join('tai_khoan', 'tai_khoan.id', 'tro_giup.id_tai_khoan_gui')
            ->join('tour', 'tour.id', 'tro_giup.id_tour')
            ->whereRaw('tra_loi', 'null', 'IS');
        if ($search != null) {
            $results = $results->where('loai_tro_giup.ten', "%$search%", 'LIKE', true)
                ->orWhere('noi_dung', "%$search%", 'LIKE')
                ->orWhere('CONCAT(tai_khoan.ho, " ", tai_khoan.ten)', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE')
                ->orWhere('tra_loi', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('tro_giup.id')->select('tro_giup.*', 'loai_tro_giup.ten AS loai_tro_giup', 'tai_khoan.ten AS ten_tai_khoan', 'tai_khoan.ho AS ho_tai_khoan', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tro_giup.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function sent()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()->join('loai_tro_giup', 'loai_tro_giup.id', 'tro_giup.id_loai_tro_giup')
            ->join('tai_khoan AS tai_khoan_gui', 'tai_khoan_gui.id', 'tro_giup.id_tai_khoan_gui')
            ->join('tai_khoan AS tai_khoan_tra_loi', 'tai_khoan_tra_loi.id', 'tro_giup.id_tai_khoan_tra_loi')
            ->join('tour', 'tour.id', 'tro_giup.id_tour')
            ->whereRaw('tra_loi', 'null', 'IS NOT');
        if ($search != null) {
            $results = $results->where('loai_tro_giup.ten', "%$search%", 'LIKE', true)
                ->orWhere('noi_dung', "%$search%", 'LIKE')
                ->orWhere('CONCAT(tai_khoan_gui.ho, " ", tai_khoan_gui.ten)', "%$search%", 'LIKE')
                ->orWhere('CONCAT(tai_khoan_tra_loi.ho, " ", tai_khoan_tra_loi.ten)', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE')
                ->orWhere('tra_loi', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('tro_giup.id')->select('tro_giup.*', 'loai_tro_giup.ten AS loai_tro_giup', 'tai_khoan_gui.ten AS ten_tai_khoan_gui', 'tai_khoan_gui.ho AS ho_tai_khoan_gui', 'tai_khoan_tra_loi.ten AS ten_tai_khoan_tra_loi', 'tai_khoan_tra_loi.ho AS ho_tai_khoan_tra_loi', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tro_giup.sent',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function asked($id)
    {
        Middleware::start()->check_user($id)->execute();

        $page = Request::get('page', 1);
        $types = model('LoaiTroGiup')->get();
        $user = model('TaiKhoan')->find($id)->first();

        $results = $this->model()
            ->join('loai_tro_giup', 'loai_tro_giup.id', 'tro_giup.id_loai_tro_giup')
            ->join('tour', 'tour.id', 'tro_giup.id_tour');
            if ($user['loai'] == 3)
                $results = $results->where('id_tai_khoan_gui', $id);
            else if ($user['loai'] == 2)
                $results = $results->where('tour.id_tai_khoan', $id);
            $results = $results->select('tro_giup.*', 'loai_tro_giup.ten AS loai_tro_giup', 'tour.ten AS ten_tour', 'tour.id_tai_khoan AS id_tai_khoan_tour')
            ->orderByDesc('tro_giup.id')->paginate($page);

        view('frontend.profile', [
            'view' => 'frontend.profile.asked',
            'results' => $results,
            'types' => $types,
        ]);
    }

    public function create()
    {
        Middleware::start()->check_admin()->execute();

        view('backend.index', [
            'view' => 'backend.quoc_gia.create',
        ]);
    }

    public function insert($id_tour)
    {
        Middleware::start()->check_login()->execute();

        Validation::validate(Request::all(), [
            'id_loai_tro_giup' => 'required|exists:tro_giup',
            'noi_dung' => 'required',
        ])->execute();

        $tour = model('Tour')->find($id_tour)->first();
        $helpType = model('LoaiTroGiup')->find(Request::input('id_loai_tro_giup'))->first();

        $userSend = model('TaiKhoan')->find(Auth::user()['id'])->first();
        $userReply = model('TaiKhoan')->find($tour['id_tai_khoan'])->first();

        $helpContent = execute('frontend.email.quan_ly.sendHelp', [
            'helped' => [
                'ho_nhan' => $userReply['ho'],
                'ten_nhan' => $userReply['ten'],
                'ho_gui' => $userSend['ho'],
                'ten_gui' => $userSend['ten'],
                'ten_loai_tro_giup' => $helpType['ten'],
                'noi_dung' => Request::input('noi_dung'),
                'id_tai_khoan_tra_loi' => $userReply['id'],
            ]
        ]);

        $status = Mail::send($userReply['email'], 'Yêu cầu trợ giúp', $helpContent);

        if ($status !== true) {
            echo $status;
            return error(['code' => 'update_mailFail']);
        }

        $this->model()->insert([
            'id_loai_tro_giup' => Request::input('id_loai_tro_giup'),
            'id_tai_khoan_gui' => Auth::user()['id'],
            'id_tour' => $id_tour,
            'noi_dung' => Request::input('noi_dung'),
            'ngay_gui' => date('Y-m-d H:i:s'),
        ]);

        return success(['code' => 'create_success']);
    }

    public function edit($id)
    {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)
            ->join('tai_khoan', 'tai_khoan.id', 'tro_giup.id_tai_khoan_gui')
            ->join('tour', 'tour.id', 'tro_giup.id_tour')
            ->join('loai_tro_giup', 'loai_tro_giup.id', 'tro_giup.id_loai_tro_giup')
            ->select('tro_giup.*', 'loai_tro_giup.ten AS loai_tro_giup', 'tai_khoan.ten AS ten_tai_khoan', 'tai_khoan.ho AS ho_tai_khoan', 'tour.ten AS ten_tour')->first();

        view('backend.index', [
            'view' => 'backend.tro_giup.edit',
            'result' => $result,
        ]);
    }

    public function update($id)
    {
        Request::add(['id' => $id]);

        Validation::validate(Request::all(), [
            'id' => 'required|exists:tro_giup',
            'tra_loi' => 'required',
        ])->execute();

        $help = $this->model()->find($id)->first();
        $tour = model('Tour')->find($help['id_tour'])->first();
        
        Middleware::start()->check_user($tour['id_tai_khoan'])->execute();

        $user = model('TaiKhoan')->find($help['id_tai_khoan_gui'])->first();

        $status = Mail::send($user['email'], 'Hồi đáp trợ giúp', Request::input('tra_loi'));
        
        if ($status !== true)
            return error(['code' => 'update_mailFail']);

        $this->model()->find($id)->update([
            'id_tai_khoan_tra_loi' => Auth::user()['id'],
            'tra_loi' => Request::input('tra_loi'),
            'ngay_tra_loi' => date('Y-m-d H:i:s'),
        ]);

        return success(['code' => 'update_success']);
    }

    public function destroy($id)
    {
        Middleware::start()->check_admin()->execute();
        if ($this->model()->find($id)->delete()) {
            return success(['code' => 'destroy_success']);
        } else return error(['code' => 'destroy_fail']);
    }
}
