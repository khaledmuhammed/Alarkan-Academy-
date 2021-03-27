<?php

require_once "../core.php";
require_once "../classes/salary.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if($_POST['action'] == 'tablehistory'){
	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);
    $recordsFiltered = $recordsTotal = salaries::count_all();
    $sqlParam = "";    
	$sqlParam .= " ORDER BY `id` DESC limit $start, $length";
    $salaries = salaries::all_sql($sqlParam);
	if($salaries){
		foreach ($salaries as $key => $salarie) {
            $employeeID = $salarie['employee_id'];
            $employee = employees::where('id',$employeeID);
            $salarie['employee_id'] = $employee['name'];
            $salarie['discount'] = $salarie['discount'].' L.E';
            $salarie['total'] = round($salarie['total'], 2).' L.E';
            if ($employee['type'] == 'Officer') {
                $salarie['working_time'] = $salarie['working_time'].' Day';
            }
            if ($employee['type'] == 'Lecturer') {
                $salarie['working_time'] = $salarie['working_time'].' Hour';
			}
			$salarie['id'] = "#".$salarie['id'];
			$data[] = $salarie;
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

if($_POST['action'] == 'adminSalRequest'){
	
	$total = $_POST['total'];
	
	salaryClass::submitSalaries($total);
}


if($_POST['action'] == 'tablerequest'){
	
	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);
	$salariesData = salaries::custom_sql("SELECT SUM(`total`) AS total,`date` FROM `salaries` WHERE `status` = 0 GROUP BY DATE(`date`) ");
	// echo "<pre>";print_r($salariesData);echo "</pre>";
	// foreach ($variable as $key => $value) {
	// 	# code...
	// }
    $recordsFiltered = $recordsTotal = count($salariesData);
	if($salariesData){
		foreach ($salariesData as $key => $salarieData) {
			$value = $salarieData['total'];
			$date = $salarieData['date'];
			$paySalariesExpense = expense_for::where('name', 'paying salaries')['id'];
			
			$salarieExpense = expenses::all_sql("WHERE `value` = '$value' AND `expense_for_id` = '$paySalariesExpense' ");
			//  var_dump($salarieExpense);
			if(!$salarieExpense){

				$salarieData['total'] = round($salarieData['total'] , 2);
				$total = $salarieData['total'];

				$salarieData['action'] ="<a class='btn btn-sm btn-success action' url='../../ajx/salary.php' data ='{\"action\":\"adminSalRequest\",\"total\":\"$total\"}' href='#'>Confirm</a>";

				$data[] = $salarieData;
			}
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

if ($action == 'calculatesalary') {
    $eType = model::secure($_POST['eType']);
    $date = model::secure($_POST['date']);
    $file = file_get_contents($_FILES['subj_file']['tmp_name']);
    $file = explode('|', rtrim(str_replace("\n", '|', $file), '|'));
    $results = [];
    foreach ($file as $res) {
        $stuRes = explode(',', $res);
        $results[$stuRes[0]] = $stuRes[1];
    }
    salaryClass::calculateSalary($eType,$date,$results);
}