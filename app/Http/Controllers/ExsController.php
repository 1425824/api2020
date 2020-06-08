<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DB;


class ExsController extends Controller
{
    public function getExs(){
        $exs = [];
		$exs = DB::select("SELECT * FROM Exercise ");
        
		return $exs;
    }

    
}