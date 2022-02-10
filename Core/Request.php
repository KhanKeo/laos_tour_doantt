<?php
class Request {
    private static array $gets = [];
    private static array $inputs = [];

    public static function get(string $key, $default = null) {
        if (array_key_exists($key, Request::$gets)) {
            return Request::$gets[$key];
        } else
            return $default;
    }

    public static function input(string $key, $default = null) {
        if (array_key_exists($key, Request::$inputs)) {
            return Request::$inputs[$key];
        } else
            return $default;
    }

    public static function setInput(array $inputs) {
        Request::$inputs = $inputs;
    }

    public static function setGet(array $gets) {
        Request::$gets = $gets;
    }

    public static function add(array $inputs) {
        foreach ($inputs as $key => $value) {
            Request::$inputs[$key] = $value;
        }
    }

    public static function all() {
        return Request::$inputs;
    }

    public static function getAll() {
        return Request::$gets;
    }

    public static function clear() {
        Request::$inputs = [];
    }
}