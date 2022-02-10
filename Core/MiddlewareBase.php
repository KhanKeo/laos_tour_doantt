<?php
class MiddlewareBase {
    private $status = null;

    public static function start() : Middleware {
        $class = get_called_class();
        return new $class();
    }

    public function execute() {
        if ($this->status !== null) {
            exit(json_encode($this->status));
        }
    }

    public function status() : bool {
        if ($this->status === null)
            return true;
        return false;
    }

    public function set_status($status, $override = false) {
        if ($this->status === null || $override === true)
            $this->status = $status;
    }

    public function pass() : bool {
        return $this->status === null;
    }
}