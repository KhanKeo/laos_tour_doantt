<?php
class LoaiTroGiupController extends Controller {
    public function index() {
        Middleware::start()->check_admin()->execute();

        $page = Request::get('page', 1);
        $search = Request::get('search', '');
        
        $results = $this->model();
        if ($search != null) {
            $results = $results->where('ten', "%$search%", 'LIKE');
        }
        $results = $results->paginate($page);

        view('backend.index', [
            'view' => 'backend.loai_tro_giup.index',
            'results' => $results,
            'search' => $search
        ]);
    }

    public function create() {
        Middleware::start()->check_admin()->execute();

        view('backend.index', [
            'view' => 'backend.loai_tro_giup.create',
        ]);
    }

    public function insert() {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'ten' => 'required|unique:loai_tro_giup',
        ])->execute();

        $this->model()->insert([
            'ten' => Request::input('ten'),
        ]);

        return success(['code' => 'create_success']);
    }

    public function edit($id) {
        Middleware::start()->check_admin()->execute();;

        $result = $this->model()->find($id)->first();

        view('backend.index', [
            'view' => 'backend.loai_tro_giup.edit',
            'result' => $result,
        ]);
    }

    public function update($id) {
        Middleware::start()->check_admin()->execute();

        Validation::validate(Request::all(), [
            'ten' => "required|unique:loai_tro_giup,ten,$id",
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