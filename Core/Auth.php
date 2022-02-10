<?php
class Auth {
    public static $model = '';

    public static function logout() {
        unset($_SESSION[$GLOBALS['app_key'] . '_user']);
    }

    public static function check() {
        return isset($_SESSION[$GLOBALS['app_key'] . '_user']);
    }

    public static function user() {
        if (Auth::check())
            return $_SESSION[$GLOBALS['app_key'] . '_user'];
        return [];
    }

    public static function login(array $input) : bool {
        $user = model(Auth::$model);
        //format array
        foreach ($input as $key => $value) {
            $user = $user->where($key, $value);
        }

        //array to string
        if ($user->clone()->count() > 0) {
            $_SESSION[$GLOBALS['app_key'] . '_user'] = $user->clone()->first();
            return true;
        } else
            return false;
    }

    public static function update() {
        $user = model(Auth::$model);
        if (Auth::check()) {
            $_SESSION[$GLOBALS['app_key'] . '_user'] = $user->clone()->first();
            return true;
        } else return false;
    }
}