<?php
require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");


if ($action == 'addStudent') {
    
    $name_ar = model::secure($_POST['name_ar']);
    $national_id =  model::secure($_POST['national_id']);
    $phone_num =  model::secure($_POST['phone_num']);
    $department =  model::secure($_POST['department']);
    $first = (isset($_POST['first_fund'])) ?  "first" : "" ;
    $secound = (isset($_POST['secound_fund'])) ?  "secound" : "" ;
    $third = (isset($_POST['third_fund'])) ? "third" : "" ;
    safeClass::addStudent($name_ar,$national_id,$phone_num,$department,$first,$secound,$third);
}
if ($action == 'addTrainee') {
    
    $name = model::secure($_POST['name']);
    $national_id =  model::secure($_POST['national_id']);
    $phone =  model::secure($_POST['phone']);
    $course =  model::secure($_POST['course']);
    safeClass::addTrainee($name,$national_id,$phone,$course);
}
if ($action == 'addExpense') {
    
    $value = model::secure($_POST['value']);
    $description =  model::secure($_POST['description']);
    safeClass::addExpense($value,$description);
}
if ($action == 'changeStatusForm') {
    
    $id = model::secure($_POST['id']);

    safeClass::changeStatusForm($id);
}
if ($action == 'changeStatus') {
    
    $id = model::secure($_POST['id']);
    $note = model::secure($_POST['note']);

    safeClass::changeStatus($id,$note);

}
if ($action == 'addPaymentBarCode') {
    
    $student_id = model::secure($_POST['student_id']);
    $pay_for_id = model::secure($_POST['pay_for_id']);
    $pay_for_price = model::secure($_POST['pay_for_price']);
    $description = model::secure($_POST['description']);

    safeClass::addPayment($student_id,$pay_for_id,$pay_for_price,$description);
}
if ($action == 'secoundRound') {
    
    $student_id = model::secure($_POST['student_id']);
    $subject_id = model::secure($_POST['subject_id']);
    $pay_for_id = model::secure($_POST['pay_for_id']);
    $pay_for_price = model::secure($_POST['pay_for_price']);
    $description = model::secure($_POST['description']);

    safeClass::secoundRound($student_id,$subject_id,$pay_for_id,$pay_for_price,$description);
}


if ($action == 'noInterviewtable') {
	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $requests = student::all_sql("WHERE `status` = 1 limit $start, $length");

    $recordsTotal = $recordsFiltered =  student::count_sql("WHERE `status` = 1");
    
    if(!empty($_POST['search']['value'])){
        $search = trim(model::secure($_POST['search']['value']));
        $requests = student::all_sql("WHERE `status` = 1 and `name_ar` like '%$search%' ");
    
        $recordsTotal = $recordsFiltered= count($requests); 
    } 

    if($requests){
        foreach ($requests as $key => $value) {

            $id =  $value['id'];
            $value['id'] = "#".$value['id'];
            $value['student_name'] = $value['name_ar'];


            $value['change_status'] = "<a class='btn btn-danger' onclick = \"modalShow('safe.php',{action:'changeStatusForm',id:'$id'})\" href='#'>Close</a>";

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


if ($action == 'secoundRoundAction') {

    $id = model::secure($_POST['id']);
    $action = model::secure($_POST['status']);


    safeClass::secoundRoundAction($id,$action);
}

if ($action == 'secoundRoundTable') {
	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $payments = secound_round::all_sql(" WHERE `action` = 2 limit $start, $length");

    $recordsTotal = $recordsFiltered =  secound_round::count_sql(" WHERE `action` = 2 ");
    
    // if(!empty($_POST['search']['value'])){
    //     $search = trim(model::secure($_POST['search']['value']));
    //     $requests = student::all_sql("WHERE `status` = 1 and `name_ar` like '%$search%' ");
    
    //     $recordsTotal = $recordsFiltered= count($requests); 
    // } 

    if($payments){
        foreach ($payments as $key => $value) {

            $action = $value['action'];

            $id =  $value['id'];
            $value['id'] = "#".$value['id'];
            $value['student_id'] = student::where('id',$value['student_id'])['name_ar'];
            $value['action'] = "
                                <a class='btn btn-danger action' url='../../ajx/safe.php'data = '{\"action\":\"secoundRoundAction\",\"id\":\"$id\",\"status\":0}' href='#' >إالغاء</a>
                                <a class='btn btn-success action' url='../../ajx/safe.php'data = '{\"action\":\"secoundRoundAction\",\"id\":\"$id\",\"status\":1}' href='#' >تأكيد</a>
                                ";



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


