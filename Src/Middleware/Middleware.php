<?php
class Middleware extends MiddlewareBase
{
    public function check_login(): Middleware
    {
        if ($this->pass()) {
            if (!Auth::check())
                $this->set_status(['code' => 'not_logged_in', 'type' => 2]);
        }
        return $this;
    }

    public function check_permission(array $permissions): Middleware
    {
        $this->check_login();

        if ($this->pass()) {
            if (!in_array(Auth::user()['loai'], $permissions))
                $this->set_status(['code' => 'permission_limited', 'type' => 2]);
        }
        return $this;
    }

    public function check_user($id, $allow_admin = true): Middleware
    {
        $this->check_login();

        if ($this->pass()) {
            if ($allow_admin && Auth::user()['loai'] == 1)
                return $this;
            else if (Auth::user()['id'] != $id)
                $this->set_status(['code' => 'account_limited', 'type' => 2]);
        }
        return $this;
    }

    public function check_admin(): Middleware
    {
        $this->check_login();

        if ($this->pass()) {
            if (Auth::user()['loai'] != 1)
                $this->set_status(['code' => 'not_admin', 'type' => 2]);
        }
        return $this;
    }
}
