<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use DB;


class NewExController extends Controller
{
    public function showTips(){
        $tips = [];
		$list_data = DB::select("SELECT tipName FROM Tipology ");
        foreach($list_data as $tipologia){
			array_push( $tips, $tipologia->tipName);	
		}
		return $tips;
    }

    public function newExToDB(Request $request){

        $exName = $request->input('exName');
        $exDescription = $request->input('exDescription');
        $exMaterials = $request->input('exMaterials');
        $exObservations = $request->input('exObservations');
        $exEstimatedTime = $request->input('exEstimatedTime');
        $exTipology = $request->input('exTipology');

        
        $result = DB::insert('INSERT INTO Exercise (exName, exDescription, exEstimatedTime, exMaterials, exObservations) 
                    VALUES (?,?,?,?,?)',[$exName, $exDescription, $exEstimatedTime, $exMaterials, $exObservations]);
        if($result){
            $rowId = DB::connection()->getPdo()->lastInsertId();
        }
        
        $tipId = DB::select("SELECT * FROM Tipology ");
        foreach($tipId as $tipo){
            if($tipo->tipName == $exTipology){
                $tipID = $tipo->tipID;
            }
            
        }

        DB::insert('INSERT INTO Exercise_Tipology (Exercise_Tipology.exID, Exercise_Tipology.tipID) VALUES (?,?)',[$rowId, $tipID]);
        

         return $tipID;

    }
    
}