<?php
require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

// if ($action == 'addAttendance') {
//     $classId = model::secure($_POST['class_id']);
//     $subjects = $_POST['subjects'];

//     officerClass::attendanceForm($classId,$subjects);
//    // officerClass::addAttendance($classId,$subjects);
// }
if ($action == 'addBarcodes') {
    
    $classId = model::secure($_POST['class_id']);
    $subjects = $_POST['subjects'];
    $barCode =  model::secure($_POST['barCode']);
    officerClass::addAttendance($classId,$subjects,$barCode);
}
if ($action == 'addExamBarcodes') {
    
    $subject =  model::secure($_POST['subject']);
    $barCode =  model::secure($_POST['barCode']);
    $type =  model::secure($_POST['exam_type']);

    officerClass::addExamAttendance($subject,$barCode,$type);
}