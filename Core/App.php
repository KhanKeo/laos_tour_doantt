<?php
class App {
    protected $controller = '';
    protected $model = '';
    protected $action = '';
    protected $params = [];

    public function __construct() {
        $this->controller = $GLOBALS['default_controller'] . 'controller';
        $this->model = $GLOBALS['default_controller'];
        $this->action = $GLOBALS['default_action'];
        $this->params = $GLOBALS['default_params'];
        $this->process();
    }

    protected function process() {
        $url = $this->processURL();

        //set controller
        if (isset($url[0])) {
            if (file_exists($GLOBALS['controller_path'] . '/' . $url[0] . "controller.php")) {
                $this->controller = $url[0] . 'controller';
                $this->model = $url[0];
            } else {
                echo "Controller <b>$url[0]</b> not found";
                return;
            }
        }
        
        require_once $GLOBALS['controller_path'] . '/' . $this->controller . ".php";

        //set action
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1]))
                $this->action = $url[1];
            else {
                echo "At controller <b>$this->controller</b>, action <b>$url[1]</b> not found";
                return;
            }
        }

        //set params
        if (isset($url[2])) {
            unset($url[0]);
            unset($url[1]);
            $this->params = $url;
        }

        //Setup
        Request::setInput($_POST);
        Request::setGet($_GET);
        Request::add($_FILES);
        Request::add(json_decode(file_get_contents("php://input"), true) ?? []);
        Auth::$model = $GLOBALS['auth_model'];
        DB::connect();
        if (!isset($_SESSION['data']))
            $_SESSION['data'] = [];

        $controller = new $this->controller($this->model);
        $result = call_user_func_array([$controller, $this->action], $this->params);
        echo $result ? json_encode($result) : '';

        //Close db connection;
        DB::disconnect();
    }

    protected function processURL() {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = trim($url);
            //$url = filter_var($url, '/');
            $url = explode('/', $url);
            return $url;
        }
    }
}