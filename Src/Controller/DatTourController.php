<?php
class DatTourController extends Controller
{
    public function index()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'dat_tour.id_tai_khoan')
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->where('trang_thai', 1);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('dat_tour.sdt', "%$search%", 'LIKE')
                ->orWhere('dat_tour.email', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.dat_tour.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function progress()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'dat_tour.id_tai_khoan')
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->where('trang_thai', 2);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('dat_tour.sdt', "%$search%", 'LIKE')
                ->orWhere('dat_tour.email', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.dat_tour.progress',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function finished()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'dat_tour.id_tai_khoan')
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->where('trang_thai', 3);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('dat_tour.sdt', "%$search%", 'LIKE')
                ->orWhere('dat_tour.email', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.dat_tour.finished',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function canceled()
    {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $results = $this->model()
            ->join('tai_khoan', 'tai_khoan.id', 'dat_tour.id_tai_khoan')
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->where('trang_thai', 0);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('dat_tour.sdt', "%$search%", 'LIKE')
                ->orWhere('dat_tour.email', "%$search%", 'LIKE')
                ->orWhere('tour.ten', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan', 'tour.ten AS ten_tour')->paginate($page);

        view('backend.index', [
            'view' => 'backend.dat_tour.canceled',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function indexUser($id)
    {
        //$user = model('Tour')->find($id)->first();
        Middleware::start()->check_permission([2])->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $tour = model('Tour')->find($id)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'TRIM((tour.gia_goc_nguoi_lon - tour.gia_nguoi_lon) / tour.gia_goc_nguoi_lon * 100)+0 AS giam_gia', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat')
            ->first();

        $results = $this->model()
            ->where('trang_thai', 1)
            ->where('id_tour', $id);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('sdt', "%$search%", 'LIKE')
                ->orWhere('email', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*')->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.dat_tour.index',
            'results' => $results,
            'tour' => $tour,
            'search' => $search,
        ]);
    }

    public function progressUser($id)
    {
        //$user = model('Tour')->find($id)->first();
        Middleware::start()->check_permission([2])->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $tour = model('Tour')->find($id)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'TRIM((tour.gia_goc_nguoi_lon - tour.gia_nguoi_lon) / tour.gia_goc_nguoi_lon * 100)+0 AS giam_gia', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat')
            ->first();

        $results = $this->model()
            ->where('trang_thai', 2)
            ->where('id_tour', $id);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('sdt', "%$search%", 'LIKE')
                ->orWhere('email', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*')->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.dat_tour.progress',
            'results' => $results,
            'tour' => $tour,
            'search' => $search,
        ]);
    }

    public function finishedUser($id)
    {
        //$user = model('Tour')->find($id)->first();
        Middleware::start()->check_permission([2])->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $tour = model('Tour')->find($id)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'TRIM((tour.gia_goc_nguoi_lon - tour.gia_nguoi_lon) / tour.gia_goc_nguoi_lon * 100)+0 AS giam_gia', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat')
            ->first();

        $results = $this->model()
            ->where('trang_thai', 3)
            ->where('id_tour', $id);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('sdt', "%$search%", 'LIKE')
                ->orWhere('email', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*')->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.dat_tour.finished',
            'results' => $results,
            'tour' => $tour,
            'search' => $search,
        ]);
    }

    public function canceledUser($id)
    {
        //$user = model('Tour')->find($id)->first();
        Middleware::start()->check_permission([2])->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');

        $tour = model('Tour')->find($id)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'TRIM((tour.gia_goc_nguoi_lon - tour.gia_nguoi_lon) / tour.gia_goc_nguoi_lon * 100)+0 AS giam_gia', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat')
            ->first();

        $results = $this->model()
            ->where('trang_thai', 0)
            ->where('id_tour', $id);
        if ($search != null) {
            $results = $results->where('CONCAT(dat_tour.ho, " ", dat_tour.ten)', "%$search%", 'LIKE', true)
                ->orWhere('ma_dat_tour', "%$search%", 'LIKE')
                ->orWhere('sdt', "%$search%", 'LIKE')
                ->orWhere('email', "%$search%", 'LIKE', false, true);
        }
        $results = $results->orderByDesc('dat_tour.id')->select('dat_tour.*')->paginate($page);

        view('frontend.index', [
            'view' => 'frontend.dat_tour.canceled',
            'results' => $results,
            'tour' => $tour,
            'search' => $search,
        ]);
    }

    public function confirmBook($id)
    {
        Middleware::start()->check_permission([1, 2])->execute();
        
        $bookedTour = $this->model()
            ->join('tour', 'dat_tour.id_tour', 'tour.id')
            ->find($id)
            ->select('dat_tour.*', 'tour.id_tai_khoan AS id_tai_khoan_tour', 'tour.ten AS ten_tour')->first();
        // Middleware::start()->check_user($bookedTour['id_tai_khoan_tour'])->execute();

        $loiNhac = Request::input('loi_nhac');


        if ($bookedTour['email']) {
            $confirmContent = execute('frontend.email.khach_hang.confirmTour', [
                'data' => $bookedTour,
                'loiNhac' => $loiNhac,
            ]);
            $status = Mail::send($bookedTour['email'], 'Đơn đặt tour đã được xác nhận', $confirmContent);
        }
        
        if ($status !== true)
            return error(['code' => 'update_mailFail']);

        $this->model()->find($id)->update([
            'trang_thai' => 2,
        ]);

        return success(['code' => 'confirm_success']);
    }

    public function confirmFinished($id)
    {
        Middleware::start()->check_permission([1, 2])->execute();

        $bookedTour = $this->model()
            ->join('tour', 'dat_tour.id_tour', 'tour.id')
            ->find($id)
            ->select('dat_tour.*', 'tour.id_tai_khoan AS id_tai_khoan_tour', 'tour.ten AS ten_tour')->first();
        //Middleware::start()->check_user($bookedTour['id_tai_khoan_tour'])->execute();

        $loiNhac = Request::input('loi_nhac');

        if ($bookedTour['email']) {
            $confirmContent = execute('frontend.email.khach_hang.confirmFinished', [
                'data' => $bookedTour,
                'loiNhac' => $loiNhac,
            ]);
            $status = Mail::send($bookedTour['email'], 'Đã hoàn thành tour du lịch', $confirmContent);
        }

        if ($status !== true)
            return error(['code' => 'update_mailFail']);

        $this->model()->find($id)->update([
            'trang_thai' => 3,
        ]);

        return success(['code' => 'confirm_success']);
    }

    public function view($id)
    {
        $result = $this->model()->find($id)->first();

        view('frontend.index', [
            'view' => 'frontend.tour.booked',
            'result' => $result,
        ]);
    }

    public function booked($id)
    {
        Middleware::start()->check_user($id)->execute();

        $page = Request::get('page', 1);

        $results = $this->model()
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->where('dat_tour.id_tai_khoan', $id)
            ->where('dat_tour.trang_thai', 0, '<>')
            ->select('dat_tour.*', 'tour.ten AS ten_tour')
            ->orderByDesc('ngay_dat')->paginate($page);

        view('frontend.profile', [
            'view' => 'frontend.profile.booked',
            'results' => $results,
        ]);
    }

    public function cancel($id)
    {
        $bookedTour = $this->model()
            ->join('tour', 'dat_tour.id_tour', 'tour.id')
            ->join('tai_khoan', 'tour.id_tai_khoan', 'tai_khoan.id')
            ->find($id)
            ->select('dat_tour.*', 'tour.id_tai_khoan AS id_tai_khoan_tour', 'tour.ten AS ten_tour', 'tai_khoan.email AS email_quan_ly')->first();

        $loiNhac = Request::input('loi_nhac');

        if ($bookedTour['email']) {
            $confirmContentCustomer = execute('frontend.email.khach_hang.cancelTour', [
                'booked' => $bookedTour,
                'loiNhac' => $loiNhac,
            ]);
            Mail::send($bookedTour['email'], 'Thông báo hủy tour', $confirmContentCustomer);
        }

        $confirmContentManager = execute('frontend.email.quan_ly.cancelTour', [
            'booked' => $bookedTour,
            'loiNhac' => $loiNhac,
        ]);

        Mail::send($bookedTour['email_quan_ly'], 'Thông báo hủy tour', $confirmContentManager);

        $this->model('DatTour')->find($id)->update([
            'trang_thai' => 0,
        ]);

        return success(['code' => 'cancel_success']);
    }

    public function print($id)
    {
        lib('TCPDF/tcpdf');

        $result = $this->model()->find($id)
            ->join('tour', 'tour.id', 'dat_tour.id_tour')
            ->select('dat_tour.*', 'tour.ten AS ten_tour')
            ->first();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->AddPage();
        $pdf->SetFont('freeserif', '', 13, '', true);

        $html = execute('frontend.print.bill', [
            'name' => 1,
            'result' => $result,
        ]);

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('HoaDon.pdf', 'I');
    }

    public function printList($id_tour)
    {
        lib('TCPDF/tcpdf');

        $tour = model('Tour')->find($id_tour)
            ->join('dat_tour', 'dat_tour.id_tour', 'tour.id')
            ->join('tinh AS tinh_xuat_phat', 'tinh_xuat_phat.id', 'tour.id_tinh_xuat_phat')
            ->join('tinh AS tinh_diem_den', 'tinh_diem_den.id', 'tour.id_tinh_diem_den')
            ->join('quoc_gia AS quoc_gia_xuat_phat', 'quoc_gia_xuat_phat.id', 'tinh_xuat_phat.id_quoc_gia')
            ->join('quoc_gia AS quoc_gia_diem_den', 'quoc_gia_diem_den.id', 'tinh_diem_den.id_quoc_gia')
            ->select('tour.*', 'DATEDIFF(ngay_ket_thuc, ngay_khoi_hanh) AS so_ngay', 'SUM(so_nguoi_lon + so_tre_em) AS da_dat', 'tinh_xuat_phat.ten AS tinh_xuat_phat', 'quoc_gia_xuat_phat.ten AS quoc_gia_xuat_phat', 'tinh_diem_den.ten AS tinh_diem_den', 'quoc_gia_diem_den.ten AS quoc_gia_diem_den')
            ->first();

        $results = $this->model()
            ->where('trang_thai', 2)
            ->where('id_tour', $id_tour)
            ->select('dat_tour.*')->get();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPageOrientation('L');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->AddPage();
        $pdf->SetFont('freeserif', '', 13, '', true);

        $html = execute('frontend.print.customerList', [
            'tour' => $tour,
            'results' => $results,
        ]);

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('DanhSach.pdf', 'I');
    }

    //Hàm đặt tour
    public function insert($id_tour)
    {
        //Middleware::start()->check_admin()->execute();

        $tour = model('Tour')->find($id_tour)
            ->join('tai_khoan', 'tai_khoan.id', 'tour.id_tai_khoan')
            ->select('tour.*', 'tai_khoan.ho AS ho_tai_khoan', 'tai_khoan.ten AS ten_tai_khoan', 'tai_khoan.email AS email_tai_khoan')
            ->first();
        $bookedTourCount = $this->model()->where('id_tour', $id_tour)->select('SUM(so_nguoi_lon + so_tre_em) AS so_nguoi')->first()['so_nguoi'];

        if ($bookedTourCount +  Request::input('so_nguoi_lon') + Request::input('so_tre_em') > $tour['so_nguoi']) {
            return error(['code' => 'insert_over', 'remainSlot' => $tour['so_nguoi'] - $bookedTourCount]);
        }

        $code = 0;
        do {
            $code = random_int(100000, 999999);
        } while ($this->model()->where('ma_dat_tour', $code)->count() > 0);

        $data = [
            'ma_dat_tour' => $code,
            'id_tour' => $tour['id'],
            'ho' => Request::input('ho'),
            'ten' => Request::input('ten'),
            'sdt' => Request::input('sdt'),
            'gia_nguoi_lon' => $tour['gia_nguoi_lon'],
            'gia_tre_em' => $tour['gia_tre_em'],
            'so_nguoi_lon' => Request::input('so_nguoi_lon'),
            'so_tre_em' => Request::input('so_tre_em'),
            'trang_thai' => 1,
            'ghi_chu' => Request::input('ghi_chu'),
            'ngay_dat' => date('Y/m/d H:i:s'),
        ];

        if (Auth::check() && Auth::user()['loai'] == 3)
            $data['id_tai_khoan'] = Auth::user()['id'];

        if (Request::input('email'))
            $data['email'] = Request::input('email');

        $id = $this->model()->insert($data);

        if (Request::input('email')) {
            $emailContent = execute('frontend.email.khach_hang.bookTour', [
                'data' => $data,
                'tour' => $tour,
                'code' => $code,
                'id' => $id,
            ]);
            Mail::send([Request::input('email')], 'Đặt tour thành công', $emailContent);
        }

        $emailContent = execute('frontend.email.quan_ly.bookTour', [
            'data' => $data,
            'tour' => $tour,
            'code' => $code,
        ]);
        Mail::send([$tour['email_tai_khoan']], 'Đơn đặt tour mới', $emailContent);

        return success([
            'code' => 'insert_success',
            'data' => [
                'id' => $id,
            ]
        ]);
    }

    public function edit($id)
    {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->first();

        view('backend.index', [
            'view' => 'backend.quoc_gia.edit',
            'result' => $result,
        ]);
    }

    public function update($id)
    {
        Middleware::start()->check_admin()->execute();

        $this->model()->find($id)->update(Request::all());

        return success(['code' => 'update_success']);
    }

    public function destroy($id)
    {
        // $booked = $this->model()
        //     ->join('tour', 'dat_tour.id_tour', 'tour.id')
        //     ->find($id)
        //     ->select('dat_tour.*', 'tour.id_tai_khoan AS id_tai_khoan')->first();
        //Middleware::start()->check_user($booked['id_tai_khoan'])->execute();
        Middleware::start()->check_permission([1, 2])->execute();

        if ($this->model()->find($id)->delete()) {
            return success(['code' => 'destroy_success']);
        } else return error(['code' => 'destroy_fail']);
    }
}
