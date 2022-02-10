<?php
function asset(string $filename): string
{
    return '/public/' . $filename;
}

function view(string $__name, $params = [])
{
    $__name = str_replace(".", "/", $__name);
    foreach ($params as $key => $value) {
        $$key = $value;
    }
    include_once $GLOBALS['view_path'] . '/' . $__name . '.php';
}

function model(string $model)
{
    if (file_exists($GLOBALS['model_path'] . '/' . $model . '.php')) {
        require_once $GLOBALS['model_path'] . '/' . $model . '.php';
        return new $model();
    } else
        return null;
}

function redirect($url)
{
    header("Location: $url");
}

function error($error, $code = 404)
{
    header("HTTP/1.1 $code Internal Server Booboo");
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($error));
}

function success($data)
{
    header('Content-Type: application/json');
    die(json_encode($data));
}

function auth(): Auth
{
    return new Auth;
}

function request(): Request
{
    return new Request;
}

function session(): Session
{
    return new Session;
}

function lib($name)
{
    require_once $GLOBALS['lib_path'] . '/' . $name . '.php';
}

function execute(string $__name, $params = [])
{
    ob_start();
    view($__name, $params);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

function headCompare(string|array $urls, $trueValue = true, $falseValue = false)
{
    $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (gettype($urls) == 'string')
        $urls = [$urls];
    $valid = false;
    foreach ($urls as $url) {
        $requestUriPart = explode('/', $requestUri);
        $urlPart = explode('/', $url);
        $urlEqual = true;
        for ($index = 0; $index < count($requestUriPart); $index++) {
            if ($requestUriPart[$index] != $urlPart[$index] && $urlPart[$index] != '*')
                $urlEqual = false;
        }
        if ($urlEqual)
            return $trueValue;
        else
            $valid = false;
    }

    if ($valid)
        return $trueValue;
    else
        return $falseValue;
}

function save_base64_image(string $base64_image_string, string $output_file_without_extension, string $custom_extension = null): string
{
    //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }      
    //
    //data is like:    data:image/png;base64,asdfasdfasdf
    $splited = explode(',', substr($base64_image_string, 5), 2);
    $mime = $splited[0];
    $data = $splited[1];

    $mime_split_without_base64 = explode(';', $mime, 2);
    $mime_split = explode('/', $mime_split_without_base64[0], 2);
    if (count($mime_split) == 2) {
        $extension = $mime_split[1];
        if ($extension == 'jpeg') $extension = 'jpg';
        //if($extension=='javascript')$extension='js';
        //if($extension=='text')$extension='txt';
        $output_file_with_extension = $output_file_without_extension . '.' . ($custom_extension != null ? $custom_extension : $extension);
    }
    file_put_contents($output_file_with_extension, base64_decode($data));
    return $output_file_with_extension;
}

function since($datetime, $full = false, $format = [
    'y' => 'năm trước',
    'm' => 'tháng trước',
    'w' => 'tuần trước',
    'd' => 'ngày trước',
    'h' => 'giờ trước',
    'i' => 'phút trước',
    's' => 'giây trước',
    'now' => 'vài giây trước',
], $manyLetter = '')
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = $format;
    unset($string['now']);
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? $manyLetter : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) : $format['now'];
}