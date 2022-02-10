<?php
class Validation
{
    private array $errors;
    private static array $messages = [
        'required' => 'Trường không được để trống',
        'same' => 'Giá trị không khớp',
        'between' => 'Giá trị phải nằm trong khoảng :param0 tới :param1',
        'max' => 'Giá trị phải lớn hơn hoặc bằng :param0',
        'min' => 'Giá trị phải nhỏ hơn hoặc bằng :param0',
        'unique' => 'Đã tồn tại',
        'exists' => 'Không tồn tại',
        'integer' => 'Phải là kiểu số nguyên',
        'float' => 'Phải là kiểu số thực',
        'string' => 'Không được chứa các ký tự đặc biệt',
        'email' => 'Phải là email',
        'date' => 'Ngày không hợp lệ (Năm-Tháng-Ngày)',
        'datetime' => 'Ngày giờ không hợp lệ (Năm-Tháng-Ngày Giờ:Phút:Giây)',
    ];

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public static function validate($values, $rules, $messages = []): Validation
    {
        $errors = [];

        foreach ($rules as $key => $rule) {
            foreach (explode('|', str_replace(' ', '', $rule)) as $attr) {
                $error = null;
                $value = $values[$key];
                $attrType = explode(':', $attr)[0];
                $attrParams = isset(explode(':', $attr)[1]) ? explode(',', explode(':', $attr)[1]) : [];

                //Check error
                switch ($attrType) {
                    case 'required':
                        $error = Validation::required($value);
                        break;
                    case 'same':
                        $error = Validation::same($values, $attrParams, $value);
                        break;
                    case 'between':
                        $error = Validation::between($attrParams, $value);
                        break;
                    case 'max':
                        $error = Validation::max($attrParams, $value);
                        break;
                    case 'min':
                        $error = Validation::min($attrParams, $value);
                        break;
                    case 'unique':
                        $error = Validation::unique($key, $attrParams, $value);
                        break;
                    case 'exists':
                        $error = Validation::exists($key, $attrParams, $value);
                        break;
                    case 'integer':
                        $error = Validation::integer($value);
                        break;
                    case 'float':
                        $error = Validation::float($value);
                        break;
                    case 'string':
                        $error = Validation::string($value);
                        break;
                    case 'email':
                        $error = Validation::email($value);
                        break;
                    case 'date':
                        $error = Validation::date($value);
                        break;
                    case 'datetime':
                        $error = Validation::datetime($value);
                        break;
                }

                //Add error
                if ($error) {
                    $error = ($messages && key_exists($key . '.' . $attrType, $messages)) ? $messages[$key . '.' . $attrType] : Validation::$messages[$attrType];

                    $error = str_replace(':key', $key, $error);
                    $error = str_replace(':rule', $rule, $error);
                    $error = str_replace(':value', $value, $error);
                    for ($index = 0; $index < count($attrParams); $index++)
                        str_replace("{param$index}", $attrParams[$index], $error);

                    if (isset($errors[$key])) {
                        array_push($errors[$key], $error);
                    } else
                        $errors[$key] = [$error];
                }
            }
        }

        return new Validation($errors);
    }

    public function fails(): bool
    {
        return $this->errors != [];
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function execute()
    {
        if ($this->fails())
            return error(['errors' => $this->errors]);
    }

    public static function required($value)
    {
        if ($value = '' || $value == null) {
            return true;
        }
        return false;
    }

    public static function same($values, $attrParams, $value)
    {
        $otherField = $attrParams[0];
        if ($values[$otherField] != $value) {
            return true;
        }
        return false;
    }

    public static function max(array $attrParams, $value)
    {
        if ($value > $attrParams[0])
            return true;
        return false;
    }

    public static function min(array $attrParams, $value)
    {
        if ($value < $attrParams[0])
            return true;
        return false;
    }

    public static function between(array $attrParams, $value)
    {
        if ($value < $attrParams[0] || $value > $attrParams[1])
            return true;
        return false;
    }

    public static function unique(string $key, array $attrParams, $value)
    {
        $table = $attrParams[0];
        $column = isset($attrParams[1]) ? $attrParams[1] : $key;
        $sql = "SELECT * FROM $table WHERE $column = '$value'";
        if (isset($attrParams[2]))
            $sql .= " AND id <> '$attrParams[2]'";
        $num_rows = DB::query($sql)->num_rows;
        if ($num_rows > 0)
            return true;
        return false;
    }

    public static function exists(string $key, array $attrParams, $value)
    {
        $table = $attrParams[0];
        $column = isset($attrParams[1]) ? $attrParams[1] : $key;
        $num_rows = DB::query("SELECT * FROM $table WHERE $column = '$value'")->num_rows;
        if ($num_rows == 0)
            return true;
        return false;
    }

    public static function integer($value)
    {
        if (!ctype_digit($value)) {
            return true;
        }
        return false;
    }

    public static function float($value)
    {
        if (!is_numeric($value)) {
            return true;
        }
        return false;
    }

    public static function string($value)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $value)) {
            return true;
        }
        return false;
    }

    public static function email($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function date($value)
    {
        if (!preg_match("/(19[5-9][0-9]|20[0-9][0-9])[\/-](0[1-9]|1[0-2])[\/-](0[1-9]|1[0-9]|2[0-9]|3[01])/", $value)) {
            return true;
        }
        return false;
    }

    public static function datetime($value)
    {
        if (strtotime($value) == false) {
            return true;
        }
        return false;
    }
}
