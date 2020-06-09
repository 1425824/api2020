<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DateTime;
use DB;


class ReportController extends Controller
{
    public function showExs(){
        $list_data = [];
		$list_data = DB::select("SELECT Exercise.exID ,Exercise.exName , Tipology.tipName  FROM Exercise 
								JOIN Exercise_Tipology ON Exercise.exID = Exercise_Tipology.exID 
								JOIN Tipology ON Exercise_Tipology.tipID = Tipology.tipID ");
		foreach($list_data as $exercise){
			$exercise->id = $exercise->exID;
			$exercise->label = $exercise->exName;
			$exercise->group = $exercise->tipName;
			unset($exercise->exID,$exercise->exName, $exercise->tipName );
		}
		return $list_data;
	}
	
	public function getExsFromIds(Request $request){
		
		$uri = $request->fullUrl();
		
		$cleanIds = explode("=", $uri);  //localhost.....selected?ids=1_2_
		$ids = explode("_", $cleanIds[1]); // 1_2_

		for($i = 0 ; $i < sizeof($ids); $i++){
			$id = $ids[$i];
			if($id != ""){
				$exs_to_pdf[$i] = DB::select("SELECT * FROM Exercise WHERE Exercise.exID = $id ")[0];
			}
		}
		$date = new DateTime();
		$dateStr = $date->format('d F Y');
        $output = '
		<div style="margin-left:6%;  width:18cm; height:100px; " >
			<img style="height:100px; width:200px;" src="https://firebasestorage.googleapis.com/v0/b/itennistfg.appspot.com/o/itennisBlack.png?alt=media&token=eedf1a86-bc1c-46c8-afff-fe3364c92041" >
			<div style="margin-left:11%; padding:0px; top:0px; font-size:11px;"  > '.$dateStr.' </div>
		</div>
		<br>
        <p style="font-weight:bold; font-size:24px;" align="center">Informe entrenament</p>
        ';
        foreach($exs_to_pdf as $exercici){
        $output .= '
        
		<div style="align-self:top; width:18cm; margin-left:6%; margin-bottom:4.5%; "  >
			<div style=" flex: 1;" >
				<p style="font-weight:bold; font-size:13px;" > '.$exercici->exID.'. '.$exercici->exName.' ('.$exercici->exEstimatedTime.'min)</p>
				<img  style="position:absolute;" alt="exImage" src="'.$exercici->exImage.'" width="275" height="125" >
				<p  style="position:relative; width:9cm; left:280px; margin-right:20px; font-size:11px;" > <b>Descripció: </b>'.$exercici->exDescription.' </p>
				<p  style="position:relative; width:9cm; left:280px; margin-right:20px; font-size:11px;" > <b>Material: </b>'.$exercici->exMaterials.' </p>
				<p  style="position:relative; width:9cm; left:280px; margin-right:20px; font-size:11px;" > <b>Observacions: </b>'.$exercici->exObservations.' </p>
			</div >
        </div>
		';
		
		}
		
		return $output; 

		}
	}
