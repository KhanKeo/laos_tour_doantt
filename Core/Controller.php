<?php
class Controller {
    protected $modelName;

    public function __construct($modelName) {
        $this->modelName = $modelName;
    }

    public function model() {
        $modelName = $this->modelName;
        if (file_exists($GLOBALS['model_path'] . '/' . $modelName . '.php')) {
            require_once $GLOBALS['model_path'] . '/' . $modelName . '.php';
            return new $modelName();
        } else
            return null;
    }
}