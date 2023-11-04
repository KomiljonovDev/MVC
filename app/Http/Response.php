<?php

namespace app\Http;

class Response {
    public static function setHttpstatus ($HttpResponseCode) {
        switch ($HttpResponseCode) {
            case 100: $responseText = 'Continue'; break;
            case 101: $responseText = 'Switching Protocols'; break;
            case 200: $responseText = 'OK'; break;
            case 201: $responseText = 'Created'; break;
            case 202: $responseText = 'Accepted'; break;
            case 203: $responseText = 'Non-Authoritative Information'; break;
            case 204: $responseText = 'No Content'; break;
            case 205: $responseText = 'Reset Content'; break;
            case 206: $responseText = 'Partial Content'; break;
            case 300: $responseText = 'Multiple Choices'; break;
            case 301: $responseText = 'Moved Permanently'; break;
            case 302: $responseText = 'Moved Temporarily'; break;
            case 303: $responseText = 'See Other'; break;
            case 304: $responseText = 'Not Modified'; break;
            case 305: $responseText = 'Use Proxy'; break;
            case 400: $responseText = 'Bad Request'; break;
            case 401: $responseText = 'Unauthorized'; break;
            case 402: $responseText = 'Payment Required'; break;
            case 403: $responseText = 'Forbidden'; break;
            case 404: $responseText = 'Not Found'; break;
            case 405: $responseText = 'Method Not Allowed'; break;
            case 406: $responseText = 'Not Acceptable'; break;
            case 407: $responseText = 'Proxy Authentication Required'; break;
            case 408: $responseText = 'Request Time-out'; break;
            case 409: $responseText = 'Conflict'; break;
            case 410: $responseText = 'Gone'; break;
            case 411: $responseText = 'Length Required'; break;
            case 412: $responseText = 'Precondition Failed'; break;
            case 413: $responseText = 'Request Entity Too Large'; break;
            case 414: $responseText = 'Request-URI Too Large'; break;
            case 415: $responseText = 'Unsupported Media Type'; break;
            case 500: $responseText = 'Internal Server Error'; break;
            case 501: $responseText = 'Not Implemented'; break;
            case 502: $responseText = 'Bad Gateway'; break;
            case 503: $responseText = 'Service Unavailable'; break;
            case 504: $responseText = 'Gateway Time-out'; break;
            case 505: $responseText = 'HTTP Version not supported'; break;
            default:
                break;
        }

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        header($protocol . ' ' . $HttpResponseCode . ' ' . $responseText);
    }

    public static function geetHttpstatus () {
        return http_response_code();
    }

    public static function errorPage () {
        return view('errorPage',[
            'errorCode'=>Response::geetHttpstatus()
        ]);
    }
}