<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addQualificationsForm') {
    qualifications::addQualificationsForm();
}

if ($action == 'addQualifications') {
    $data['qualName'] = model::secure($_POST['qual_name']);
    $qualIds =  [];
    
    if (isset($_POST['qualIds'])) {
        foreach($_POST['qualIds'] as $id) {
            array_push($qualIds, $id);
        }
        $data['qualIds'] = $qualIds; 
    }
    
    qualifications::addQualifications($data);
}

if ($action == 'editQualificationsForm') {
    qualifications::editQualificationsForm();
}

if ($action == 'editQualifications') {

    $data['qualId'] = model::secure($_POST['qual_id']);
    $data['qualName'] = model::secure($_POST['qual_name']);
    $data['qualStatus'] = model::secure($_POST['qual_status']);
    
    qualifications::editQualifications($data);
}

if ($action == 'optionBtns') {
    qualifications::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    qualifications::getOldVal($id);
}