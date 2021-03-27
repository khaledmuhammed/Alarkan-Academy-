<?php

require_once "../core.php";
require '../classes/request.php';

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");


if ($action == 'table'){

	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $requests = payment::all_sql(" WHERE `status` = 0 limit $start, $length");

    $recordsTotal = $recordsFiltered = payment::count_sql("where `status` = 0");
    
    if(!empty($_POST['search']['value'])){
        $search = trim(model::secure($_POST['search']['value']));
        $requests = model::custom_sql("SELECT `p`.* ,`s`.`name` FROM `student` AS `s`
                                        LEFT JOIN `payment` AS `p`
                                        ON `s`.`id` = `p`.`student_id`
                                        WHERE `s`.`name_ar` LIKE '%$search%'
                                        AND `p`.`status` = 0");
    
        $recordsTotal = $recordsFiltered= count($requests); 
    } 

    if($requests){
        foreach ($requests as $key => $value) {

            $id = $value['id'];
            $sId = $value['student_id'];
            $payForId = $value['pay_for_id'];

            $value['id'] = "#".$value['id'];

            $value['student_name'] = student::find($sId)['name_ar'];
            $value['request'] = pay_for::find($payForId)['name'];

            $request = $value['request'];

            $value['request'] =  '<a class="btn btn-info" href="../safe/confirmRequest.php?pay_id='.$id.'&id='.$sId.'">'.$request.'</a>';

            $data[] = $value ; 

        }
    }else{
    	$draw="0";
    	$recordsTotal = $recordsFiltered = "0";
    	$data = [] ;
    }

	$response = array(
		"draw" => intval($draw),
		"recordsTotal" => $recordsTotal,
		"recordsFiltered" => $recordsFiltered,
		"data" => $data
	);
	echo json_encode($response); 
}