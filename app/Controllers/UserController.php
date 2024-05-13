<?php

namespace app\Controllers;


use app\Http\Request;
use app\Http\Response;
use app\Models\User;

class UserController extends Controller {
    public static function login(Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::selectWhere([['username' => $attributes['username'], 'cn' => '=']]);
        if (User::rowCount()){
            return view('login', $user);
        }
        Response::setHttpstatus(401);
        return ['error', 'message'=>Response::getHttpstatus()];
    }

    public static function signup (Request $request) {
        $attributes = $request->validate([
            'username'=>'required|string',
            'name'=>'required|string',
            'phone'=>'optional|string',
            'password'=>'required|string'
        ]);
        $attributes['token'] = uniqid(rand(0,100));
        return User::create($attributes);
    }
}