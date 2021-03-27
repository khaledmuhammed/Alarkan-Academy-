<?php
require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");


if ($action == 'addScheduleForm') {
    
    $id = model::secure($_POST['id']);
    $subj_id = model::secure($_POST['subj_id']);
    $lecturer_id = model::secure($_POST['lecturer_id']);
    $class_id =  model::secure($_POST['class_id']);
    $group_id =  model::secure($_POST['group_id']);
    $year =  model::secure($_POST['year']);
    $term_id =  model::secure($_POST['term_id']);
    $day_id =  model::secure($_POST['day_id']);
    $lecture_time =  model::secure($_POST['lecture_time']);
    saClass::addSchedule($id,$lecturer_id,$subj_id,$class_id,$group_id,$year,$term_id,$day_id,$lecture_time);
}
if ($action == 'changeSchedule') {
    
    $id = model::secure($_POST['id']);
    saClass::studentschedulesForm($id);
}



if ($action == 'schedulesTable') {

    $data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);


    $lectures = lecture::all_sql("  limit $start, $length");

    $recordsTotal = $recordsFiltered = lecture::count_sql("");
    
    $days = array('الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة', 'السبت', 'الاحد');
 

    if($lectures){
        foreach ($lectures as $key => $value) {

            $id = $value['id'];
            $value['id'] = "#".$value['id'];
        
            $value['subject_id'] = subjects::find($value['subject_id'])['name'];
            $value['group_id'] = groups::find($value['group_id'])['name'];
            $value['class_id'] = classes::find($value['class_id'])['name'];
            $value['day_id'] = $days[$value['day_id']];

            if($value['term_id'] == 1){

                $value['term_id'] = "الأول";

            }else if($value['term_id'] == 2){

                $value['term_id'] = "الثاني";
            }

            $value['edit'] = "<a class='btn btn-info' onclick = \"modalShow('sa.php',{action:'changeSchedule',id:'$id'})\" href='#'>تعديل</a>";
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