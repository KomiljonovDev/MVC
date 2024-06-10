<?php

namespace app\Http;

class Response {
    private static $HttpResponseCode = null;
    private static $responseText = null;
    public static function setHttpstatus ($HttpResponseCode) {
        switch ($HttpResponseCode) {
            case 100: self::$responseText = 'Continue'; break;
            case 101: self::$responseText = 'Switching Protocols'; break;
            case 200: self::$responseText = 'OK'; break;
            case 201: self::$responseText = 'Created'; break;
            case 202: self::$responseText = 'Accepted'; break;
            case 203: self::$responseText = 'Non-Authoritative Information'; break;
            case 204: self::$responseText = 'No Content'; break;
            case 205: self::$responseText = 'Reset Content'; break;
            case 206: self::$responseText = 'Partial Content'; break;
            case 300: self::$responseText = 'Multiple Choices'; break;
            case 301: self::$responseText = 'Moved Permanently'; break;
            case 302: self::$responseText = 'Moved Temporarily'; break;
            case 303: self::$responseText = 'See Other'; break;
            case 304: self::$responseText = 'Not Modified'; break;
            case 305: self::$responseText = 'Use Proxy'; break;
            case 400: self::$responseText = 'Bad Request'; break;
            case 401: self::$responseText = 'Unauthorized'; break;
            case 402: self::$responseText = 'Payment Required'; break;
            case 403: self::$responseText = 'Forbidden'; break;
            case 404: self::$responseText = 'Not Found'; break;
            case 405: self::$responseText = 'Method Not Allowed'; break;
            case 406: self::$responseText = 'Not Acceptable'; break;
            case 407: self::$responseText = 'Proxy Authentication Required'; break;
            case 408: self::$responseText = 'Request Time-out'; break;
            case 409: self::$responseText = 'Conflict'; break;
            case 410: self::$responseText = 'Gone'; break;
            case 411: self::$responseText = 'Length Required'; break;
            case 412: self::$responseText = 'Precondition Failed'; break;
            case 413: self::$responseText = 'Request Entity Too Large'; break;
            case 414: self::$responseText = 'Request-URI Too Large'; break;
            case 415: self::$responseText = 'Unsupported Media Type'; break;
            case 500: self::$responseText = 'Internal Server Error'; break;
            case 501: self::$responseText = 'Not Implemented'; break;
            case 502: self::$responseText = 'Bad Gateway'; break;
            case 503: self::$responseText = 'Service Unavailable'; break;
            case 504: self::$responseText = 'Gateway Time-out'; break;
            case 505: self::$responseText = 'HTTP Version not supported'; break;
            default:
                break;
        }

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        header($protocol . ' ' . $HttpResponseCode . ' ' . self::$responseText);
    }

    public static function setHeader ($headerName, $value) {
        header($headerName . ": " . $value);
    }

    public static function getHttpstatus () {
        return http_response_code();
    }
    public static function getHttpHeaderText () {
        return self::$responseText;
    }

    public static function redirect ($next) {
        header('Location: ' . Request::scriptName() . $next);
    }
    public static function errorPage () {
        return view('pages/errorPage',[
            'errorCode'=>Response::getHttpstatus(),
            'headerText'=>Response::getHttpHeaderText()
        ]);
    }
}