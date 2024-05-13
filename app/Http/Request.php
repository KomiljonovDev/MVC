<?php

namespace app\Http;

class Request {
    public static function currentUrl () {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getRequestUrl (): string {
        return explode("?", filter_var(trim($_SERVER['REQUEST_URI'], ""), FILTER_SANITIZE_URL))[0];
    }

    public static function getHeaders ($headerName=null) {
        $headers = apache_request_headers();
        return $headerName ? array_key_exists($headerName,$headers) ? $headers[$headerName] : null : $headers;
    }

    public static function scriptName () {
        return str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]);
    }

    public static function getMethod () {
        return $_SERVER['REQUEST_METHOD'];
    }
    public static function params ($key=null) {
        if ($key) return $_REQUEST[$key];
        return $_REQUEST;
    }

    public static function validate (array $request) {
        $required_fields = [];
        $params = [];
        foreach ($request as $key => $value) {
            $param_type = explode('|',$value);
            $param_data = self::params($key);
            $params[$key] = $param_data;
            if ((mb_stripos($value, 'required')!==false && !array_key_exists($key, self::params())) && array_key_exists(1, $param_type) ? !"is_$param_type[1]"($param_data) : 0){
                $required_fields[$key] = $value;
            }
        }
        if (count($required_fields)>0){
            Response::setHttpstatus(400);
            \app\Http\Response::setHeader('Content-type', 'json');
            echo json_encode($required_fields);
            exit();
        }
        return $params;
    }
}
