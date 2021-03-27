<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addTrainingForm') {
    training::addTrainingForm();
}

if ($action == 'addTraining') {
    $data['trainingName']  = model::secure($_POST['training_name']);
    $data['trainingPrice'] = model::secure($_POST['training_price']);
    $data['startAt']      = model::secure($_POST['start_at']);
    $data['endAt']        = model::secure($_POST['end_at']);
    if ($data['endAt'] <= $data['startAt']) {
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Try Again, But The end date must be come after start date!'];
        exit(json_encode($json));
    } else {
        training::addTraining($data);
    }
}

if ($action == 'editTrainingForm') {
    training::editTrainingForm();
}

if ($action == 'editTraining') {

    $data['trainingId']     = model::secure($_POST['training_id']);
    $data['trainingName']   = model::secure($_POST['training_name']);
    $data['trainingPrice']  = model::secure($_POST['training_price']);
    $data['trainingStatus'] = model::secure($_POST['training_status']);
    $data['startAt']       = model::secure($_POST['start_at']);
    $data['endAt']         = model::secure($_POST['end_at']);

    if ($data['endAt'] <= $data['startAt']) {
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Try Again, But The end date must be come after start date!'];
        exit(json_encode($json));
    } else {
        training::editTraining($data);
    }
    
}

if ($action == 'optionBtns') {
    training::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    $tblName = model::secure($_POST['tblName']);
    training::getOldVal($id, $tblName);
}