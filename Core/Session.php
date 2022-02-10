<?php
class Session {
    public static function get(string $key, $default = null) {
        if (array_key_exists($key, $_SESSION['data'])) {
            return $_SESSION['data'][$key];
        } else
            return $default;
    }

    public static function set(string $key, $value) {
        $_SESSION['data'][$key] = $value;
    }

    public static function add(array $data) {
        foreach ($data as $key => $value) {
            $_SESSION['data'][$key] = $value;
        }
    }

    public static function all() {
        return $_SESSION['data'];
    }

    public static function clear() {
        unset($_SESSION['data']);
    }
}