<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addDepartmentForm') {
    departments::addDepartmentForm();
}

if ($action == 'addDepartment') {
    $data['depName'] = model::secure($_POST['dep_name']);
    $subjIds =  [];
    
    if (isset($_POST['subjIds'])) {
        foreach($_POST['subjIds'] as $id) {
            array_push($subjIds, $id);
        }
        $data['subjIds'] = $subjIds; 
    }
    
    departments::addDepartment($data);
}

if ($action == 'editDepartmentSubjectsForm') {
    departments::editDepartmentSubjectsForm();
}

if ($action == 'editDepartmentSubjects') {
    $data['depId'] = model::secure($_POST['dep_id']);
    // isset($_POST['dep_name']) ? $data['depName'] = model::secure($_POST['dep_name']) : '';
    // isset($_POST['dep_status']) ? $data['depStatus'] = model::secure($_POST['dep_status']) : '';
    $subjIds =  [];
    
    if (isset($_POST['subjIds'])) {
        foreach($_POST['subjIds'] as $id) {
            array_push($subjIds, $id);
        }
        $data['subjIds'] = $subjIds; 
    }
    // echo '<pre>';
    //     print_r($data);
    // echo '</pre>';
    // die;
    
    departments::editDepartmentSubjects($data);
}

if ($action == 'depSubjects') {
    $id = model::secure($_POST['id']);
    departments::depSubjects($id);
}

if ($action == 'editDepartmentForm') {
    departments::editDepartmentForm();
}

if ($action == 'editDepartment') {

    $data['depId'] = model::secure($_POST['dep_id']);
    $data['depName'] = model::secure($_POST['dep_name']);
    $data['depStatus'] = model::secure($_POST['dep_status']);
    
    departments::editDepartment($data);
}

if ($action == 'optionBtns') {
    departments::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    departments::getOldVal($id);
}