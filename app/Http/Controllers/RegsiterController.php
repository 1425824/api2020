<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    //

    public function registerToDB(Request $request){
        $url = $request->fullUrl();
        $user = $request->input('username');
        $pass = $request->input('password');
        $mail = $request->input('email');
        //dd($pass);
        //dd($user);
        //dd($mail);
        DB::insert('INSERT INTO User (userName, userPasswd, userEmail) VALUES (?,?,?)',[$user, $pass, $mail]);
        return $url;
    }
}