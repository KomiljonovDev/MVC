<?php

namespace app\Controllers;


use app\Http\Request;
use app\Http\Response;
use app\Models\User;

class UserController extends Controller {
    public static function signup (Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'name'=>'required|string',
            'phone'=>'optional|string',
            'password'=>'required|string'
        ]);
        User::selectWhere([['username'=>$attributes['username'], 'cn'=>'=']]);
        if (User::rowCount()){
            Response::setHttpstatus(409);
            return ['error'=>Response::getHttpstatus(), 'message'=>Response::getHttpHeaderText() . ". Username already exist"];
        }
        $attributes['token'] = uniqid(rand(0,100));
        $attributes['password'] = md5($attributes['password']);
        $user = User::create($attributes);
        return $user;
    }
    public static function login(Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
        $user['data'] = User::selectWhere([['username' => $attributes['username'], 'cn' => '='],['password'=>md5($attributes['password']),'cn'=>'=']]);
        if (User::rowCount()){
            Response::setHttpstatus(200);
            $user['code'] = Response::getHttpstatus();
            $user['message'] = Response::getHttpHeaderText();
            return $user;
        }
        Response::setHttpstatus(401);
        return ['error'=>Response::getHttpstatus(), 'message'=>Response::getHttpHeaderText()];
    }

    public static function deleteUser (Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string'
        ]);
        User::selectWhere([['token'=>$request::getHeaders('Authorization-token'), 'cn'=>'=']]);
        if (User::rowCount()){
            $response = User::deleteWhere([['username'=>$attributes['username'], 'cn'=>'='], ['token'=>$request::getHeaders('Authorization-token'), 'cn'=>'=']]);
            Response::setHttpstatus(200);
            return ['code'=>Response::getHttpstatus(), 'message'=>Response::getHttpHeaderText() . ". Deleted"];
        }
        Response::setHttpstatus(401);
        return ['error'=>Response::getHttpstatus(), 'message'=>Response::getHttpHeaderText()];
    }
}