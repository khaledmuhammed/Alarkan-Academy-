<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addPayForForm') {
    payFor::addPayForForm();
}

if ($action == 'addPayFor') {
    $data['payForcat']  = model::secure($_POST['cat_name']);    
    $data['payForName']  = model::secure($_POST['pay_for_name']);    
    $data['payForPrice'] = model::secure($_POST['pay_for_price']);    
    payFor::addPayFor($data);
}

if ($action == 'editPayForForm') {
    payFor::editPayForForm();
}

if ($action == 'editPayFor') {

    $data['payForId']     = model::secure($_POST['pay_for_id']);
    $data['editcatname']   = model::secure($_POST['edit_cat_name']);
    $data['payForName']   = model::secure($_POST['pay_for_name']);
    $data['payForPrice']  = model::secure($_POST['pay_for_price']);
    $data['payForStatus'] = model::secure($_POST['pay_for_status']);
    
    payFor::editPayFor($data);
}

if ($action == 'optionBtns') {
    payFor::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    payFor::getOldVal($id);
}