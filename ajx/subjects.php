<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addSubjectForm') {
    subjects::addSubjectForm();
}

if ($action == 'addSubject') {
    $data['subjName'] = model::secure($_POST['subj_name']);
    $data['subjFinal'] = model::secure($_POST['subj_final']);
    $data['subjMidterm'] = model::secure($_POST['subj_midterm']);
    $data['subjActivity'] = model::secure($_POST['subj_activity']);
    $data['subjAttendace'] = model::secure($_POST['subj_attendace']);
    
    subjects::addSubject($data);
}

if ($action == 'editSubjectForm') {
    subjects::editSubjectForm();
}

if ($action == 'editSubject') {

    $data['subjId'] = model::secure($_POST['subj_id']);
    $data['subjName'] = model::secure($_POST['subj_name']);
    $data['subjStatus'] = model::secure($_POST['subj_status']);
    $data['subjFinal'] = model::secure($_POST['subj_final']);
    $data['subjMidterm'] = model::secure($_POST['subj_midterm']);
    $data['subjActivity'] = model::secure($_POST['subj_activity']);
    $data['subjAttendace'] = model::secure($_POST['subj_attendace']);
    
    subjects::editSubject($data);
}

if ($action == 'optionBtns') {
    subjects::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    $tblName = model::secure($_POST['tblName']);
    subjects::getOldVal($id, $tblName);
}