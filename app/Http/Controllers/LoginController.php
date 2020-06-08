<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

use DB;

class LoginController extends Controller
{
    //
    protected function jwt(User $user){
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $user,
            'iat' => time(),
            'exp' => time() + 60*60
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function login(Request $request){
        $user = $request->input('username');
        $pass = $request->input('password');
        $exist = false;
       
        $userdata = DB::select("SELECT userName, userPasswd FROM User " ) ;
        //dd($userdata);
        
        foreach ($userdata as $aux ){
            //dd($userdata[i].userName);
            if($aux->userName == $user && $aux->userPasswd == $pass){
                $exist = true;
                //response() = json(['token' => $this->jwt($user)],200);
                return response($exist);
                //return $exist;  //$exist
                }
            
        }
        //dd($exist);
        return  "false" ;
    }
}