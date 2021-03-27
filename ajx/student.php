<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addStudent') {
    $data = [];
    foreach($_POST as $k => $val) {
        $k != 'action' ? $data[$k] = model::secure($val) : '';
    }

    student::addStudent($data);
}

if ($action == 'getStudents') {
    $draw	= model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);
    $condation = (isset($_POST['condation'])) ? model::secure($_POST['condation']) : " where 1 = 1 " ;

    student::getStudents($draw, $start, $length,$condation);
}

if ($action == 'findStudent') {
    $search = model::secure($_POST['search']);
    student::findStudent($search);
}

if ($action == 'studentDetails') {
    $id = model::secure($_POST['id']);
    student::studentDetails($id);
}

if ($action == 'addInterviewResForm') {
    $id = model::secure($_POST['id']);
    student::addInterviewResForm($id);
}

if ($action == 'addInterRes') {
    $id = model::secure($_POST['id']);
    $status_id = model::secure($_POST['stu_sta_id']);
    student::addInterRes($id, $status_id);
}

if ($action == 'optionBtns') {
    $id = model::secure($_POST['id']);
    student::optionBtns($id);
}

if ($action == 'interviewInfo') {
    $id = model::secure($_POST['id']);
    student::interviewInfo($id);
}

if ($action == 'payFormFundForm') {
    $id = model::secure($_POST['id']);
    student::payFormFundForm($id);
}

if ($action == 'payFormFund') {
    $id = model::secure($_POST['id']);
    $fund = model::secure($_POST['fund_value']);
    $pay_id = model::secure($_POST['pay_for_id']);
    $status = 1 ;
    student::payFormFund($id, $fund, $pay_id ,$status);
}

if ($action == 'payFirstFundForm') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    student::payFirstFundForm($id,$payId);
}

if ($action == 'payFirstFund') {

    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    $fund = model::secure($_POST['fund_value']);
    $payForId = model::secure($_POST['pay_for_id']);
    $status = 1;
    student::payFirstFund($id,$payId, $fund, $payForId,$status);
}

if ($action == 'paySecondFundForm') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    student::paySecondFundForm($id,$payId);
}

if ($action == 'paySecondFund') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    $fund = model::secure($_POST['fund_value']);
    $payForId = model::secure($_POST['pay_for_id']);
    $status = 1;
    student::paySecondFund($id,$payId, $fund, $payForId,$status);
}


if ($action == 'payLostCardForm') {

    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    student::payLostCardForm($id,$payId);
}

if ($action == 'payLostCard') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    $fund = model::secure($_POST['fund_value']);
    $payForId = model::secure($_POST['pay_for_id']);
    $status = 1;
    student::payLostCard($id,$payId, $fund, $payForId,$status);
}



if ($action == 'returnFirstFundForm') {
    $id = model::secure($_POST['id']);
    student::returnFirstFundForm($id);
}

if ($action == 'returnFirstFund') {
    $id = model::secure($_POST['id']);
    $fund = model::secure($_POST['fund_value']);
    $expense_id = model::secure($_POST['expense_for_id']);
    student::returnFirstFund($id, $fund, $expense_id);
}

if ($action == 'studentResult') {
    $id = model::secure($_POST['id']);
    student::studentResult($id);
}

if ($action == 'studentTrainingForm') {
    student::studentTrainingForm();
}

if ($action == 'addStudentTraining') {
    $studentId = model::secure($_POST['student']);
    $traningId = model::secure($_POST['training_id']);
    student::addStudentTraining($studentId, $traningId);
}

if ($action == 'payTraining') {
    $sId = model::secure($_POST['id']);
    $price = model::secure($_POST['price']);
    $trainingId = model::secure($_POST['trainingId']);
    student::payTraining($trainingId, $sId, $price);
}





if ($action == 'payReEnrollmentForm') {

    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    student::payReEnrollmentForm($id,$payId);
}

if ($action == 'payReEnrollment') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    $fund = model::secure($_POST['fund_value']);
    $payForId = model::secure($_POST['pay_for_id']);
    $status = 1;
    student::payReEnrollment($id,$payId, $fund, $payForId,$status);
}

if ($action == 'payCollectionForm') {
    
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    student::payCollectionForm($id,$payId);
}

if ($action == 'payCollection') {
    $id = model::secure($_POST['id']);
    $payId = model::secure($_POST['payId']);
    $fund = model::secure($_POST['fund_value']);
    $payForId = model::secure($_POST['pay_for_id']);
    $status = 1;
    student::payCollection($id,$payId, $fund, $payForId,$status);
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    $tblName = model::secure($_POST['tblName']);
    student::getOldVal($id, $tblName);
}







//start image section
function imagehandler($image) {

  $base_file = pathinfo($_FILES[$image]["name"]);
  $db_file = "img/".$base_file['basename'];
  $target_file = "../" . $db_file;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $uploadOk = 1;

  $check = getimagesize($_FILES[$image]["tmp_name"]);
  if($check == false) {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>File# </b> is not an image.</div>";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES[$image]["size"] > 3145728) {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Image# </b> error, file is too large.</div>";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
    echo "<div class=\"alert alert-danger\" role=\"alert\"><b>Image# </b> error, only JPG, PNG,JPEG are allowed.</div>";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Sorry, <b>Image# </b>  was not uploaded.</div>";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$image]["tmp_name"], $target_file)) {
      
      return($db_file);
    } 
  }
}
if ($action == 'formAddImage') {
    $id = model::secure($_POST['id']);

    student::formAddImage($id);
}

if ($action == 'addImage') {
    // echo "hello";
    // die();
    $id = model::secure($_POST['id']);
    $image = imagehandler("image");
    //echo "error";
    student::addImage($id, $image);
}



if ($action == 'formExtractLostCard') {
    $id = model::secure($_POST['id']);
    student::formExtractLostCard($id);
}

if ($action == 'extractLostCard') {
    $id = model::secure($_POST['id']);
    $image = imagehandler("image");

    student::extractLostCard($id, $image);
}

if ($action == 'formPrintCard') {
    $id = model::secure($_POST['id']);
    student::formPrintCard($id);
}

if ($action == 'formChangeBranch') {
    $id = model::secure($_POST['id']);
    student::formChangeBranch($id);
}

if ($action == 'formChangeStatus') {
    $id = model::secure($_POST['id']);
    student::formChangeStatus($id);
}
if ($action == 'changeStatus') {
    $id = model::secure($_POST['id']);
    $newStatus = model::secure($_POST['newStatus']);
    student::changeStatus($id,$newStatus);
}
if ($action == 'formReEnrollment') {
    $id = model::secure($_POST['id']);
    student::formReEnrollment($id);
}

if ($action == 'reEnrollment') {
    $id = model::secure($_POST['id']);
    student::ReEnrollment($id);
}


if ($action == 'changeBranch') {
    $id = model::secure($_POST['id']);
    $newBranch = model::secure($_POST['newBranch']);
    student::changeBranch($id,$newBranch);
}

if ($action == 'formCashBack') {
    $id = model::secure($_POST['id']);
    student::formCashBack($id);
}
if ($action == 'cashBack') {
    $id = model::secure($_POST['id']);
    $expenseForId = model::secure($_POST['expense_for_id']);
    $fundValue = model::secure($_POST['fund_value']);
    student::cashBack($id , $expenseForId , $fundValue);
}

if ($action == 'studentAttendance') {
    $id = model::secure($_POST['id']);
    student::studentAttendance($id);
}
if ($action == 'formSelectGroup') {
    $id = model::secure($_POST['id']);
    student::formSelectGroup($id);
}
if ($action == 'SelectGroup') {
    $id = model::secure($_POST['id']);
    $newGroup = model::secure($_POST['newGroup']);
    student::SelectGroup($id,$newGroup);
}
if ($action == 'formAddNote') {
    $id = model::secure($_POST['id']);
    student::formAddNote($id);
}
if ($action == 'addNote') {
    $id = model::secure($_POST['id']);
    $studentNote = model::secure($_POST['student_note']);
    student::AddNote($id,$studentNote);
}




if ($action == 'addGroupForm') {
    //$id = model::secure($_POST['id']);
    student::addGroupForm();
}
if ($action == 'addGroup') {
    $id = model::secure($_POST['id']); 
    $name = model::secure($_POST['name']);
    $dep_id = model::secure($_POST['dep_id']);
    $status = model::secure($_POST['status']);
    student::addGroup($id,$name,$dep_id,$status);
}
if ($action == 'updateGroup') {
    $id = $_POST['id'];
    student::addGroupForm($id);
}

if ($action == 'groupsTable') {
 
    $data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $groups = groups::all_sql(" limit $start, $length");

    $recordsTotal = $recordsFiltered = count(groups::all_sql());
    


    if($groups){
        foreach ($groups as $key => $value) {

            $id = $value['id'];

            $value['id'] = "#".$value['id'];

            $name =  $value['name'];
            $value['name'] = " <a class='btn btn-info' href='#'  onclick=\"modalShow('student.php',{action:'updateGroup',id:'$id'})\">$name</a>";
            $value['dep_id'] = departments::find($value['dep_id'])['name'];
            $status =  $value['status'];
            if($status == 1){
            $value['status'] = "<span class='badge badge-success' >مفتوحة </span>";
            }else if($status == 0){
                $value['status'] = "<span class='badge badge-danger'> مغلقة </span>";
            }
            $value['student_count'] = student::count_sql(" WHERE `group_id` = $id ");


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





if ($action == 'addStudentGroup') {
    $id = model::secure($_POST['id']);
    student::addStudentGroup($id);
}

if ($action == 'submitStudentGroup') {
    $id = model::secure($_POST['id']);
    $group_id = model::secure($_POST['id']);
    student::submitStudentGroup($id,$group_id);
}




if ($action == 'addGroupTable') {
 
    $data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $students = student::all_sql(" WHERE `group_id` = 0 ORDER BY `group_id` limit $start, $length");

    $recordsTotal = $recordsFiltered = count(student::all_sql(" WHERE `group_id` = 0  ORDER BY `group_id` "));
    


    if($students){

        foreach ($students as $key => $value) {

            $id = $value['id'];

            $value['id'] = "#".$value['id'];

            $value['name'] = $value['name_ar'];
            
            $value['dep_id'] = departments::find(student_details::where('student_id',$id)['dep_id'])['name']; 

            $value['group_id'] = " <a class='btn btn-info' href='#'  onclick=\"modalShow('student.php',{action:'addStudentGroup',id:'$id'})\">إضافة مجموعة</a>";


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
