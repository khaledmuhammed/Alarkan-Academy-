<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addSpecializationsForm') {
    specializations::addSpecializationsForm();
}

if ($action == 'addSpecializations') {
    $data['specName'] = model::secure($_POST['spec_name']);
    specializations::addSpecializations($data);
}

if ($action == 'editSpecializationsForm') {
    specializations::editSpecializationsForm();
}

if ($action == 'editSpecializations') {

    $data['specId'] = model::secure($_POST['spec_id']);
    $data['specName'] = model::secure($_POST['spec_name']);
    $data['specStatus'] = model::secure($_POST['spec_status']);
    
    specializations::editSpecializations($data);
}

if ($action == 'optionBtns') {
    specializations::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    specializations::getOldVal($id);
}