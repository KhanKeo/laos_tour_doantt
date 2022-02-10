<?php
class TinhController extends Controller {
    public function index($page = 1, $search = null) {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');
        
        $results = $this->model()->join('quoc_gia', 'quoc_gia.id', 'tinh.id_quoc_gia');
        if ($search != null) {
            $results = $results->where('tinh.ten', "%$search%", 'LIKE')->orWhere('quoc_gia.ten', "%$search%", 'LIKE');
        }
        $results = $results->orderByDesc('tinh.id')->select('tinh.*', 'quoc_gia.ten AS quoc_gia')->paginate($page);

        view('backend.index', [
            'view' => 'backend.tinh.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function create() {
        Middleware::start()->check_admin()->execute();

        $countries = model('QuocGia')->get();

        view('backend.index', [
            'view' => 'backend.tinh.create',
            'countries' => $countries,
        ]);
    }

    public function insert() {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required',
            'id_quoc_gia' => 'required|exists:quoc_gia,id',
        ])->execute();

        $this->model()->insert([
            'ten' => Request::input('ten'),
            'id_quoc_gia' => Request::input('id_quoc_gia'),
        ]);

        return success(['code' => 'create_success']);
    }

    public function edit($id) {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->first();
        $countries = model('QuocGia')->get();

        view('backend.index', [
            'view' => 'backend.tinh.edit',
            'result' => $result,
            'countries' => $countries,
        ]);
    }

    public function update($id) {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required',
            'id_quoc_gia' => "required|exists:quoc_gia,id,$id",
        ])->execute();

        $this->model()->find($id)->update(Request::all());

        return success(['code' => 'update_success']);
    }

    public function destroy($id) {
        Middleware::start()->check_admin()->execute();
        if ($this->model()->find($id)->delete()) {
            return success(['code' => 'destroy_success']);
        }
        else return error(['code' => 'destroy_fail']);
    }
}