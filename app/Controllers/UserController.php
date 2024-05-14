<?php

namespace app\Controllers;


use app\Http\Request;
use app\Http\Response;
use app\Models\User;

class UserController extends Controller {

    public static function home () {
        return view('welcome',[
            'message'=>'Salom'
        ]);
    }
    public static function login(Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::selectWhere([['username' => $attributes['username'], 'cn' => '='],['password'=>md5($attributes['password']),'cn'=>'=']]);
        if (User::rowCount()){
            unset($user['password']);
            return $user;
        }
        Response::setHttpstatus(401);
        return ['error'=>Response::getHttpstatus(), 'message'=>Response::getHttpHeaderText()];
    }

    public static function signup (Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'name'=>'required|string',
            'phone'=>'optional|string',
            'password'=>'required|string'
        ]);
        $attributes['token'] = uniqid(rand(0,100));
        $attributes['password'] = md5($attributes['password']);
        $user = User::create($attributes);
        unset($user['password']);
        return $user;
    }
}