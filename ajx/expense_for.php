<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'addExpenseForForm') {
    expenseFor::addExpenseForForm();
}

if ($action == 'addExpenseFor') {
    $data['expenseForName']  = model::secure($_POST['expense_for_name']);    
    $data['expenseForPrice'] = model::secure($_POST['expense_for_price']);    
    expenseFor::addExpenseFor($data);
}

if ($action == 'editExpenseForForm') {
    expenseFor::editExpenseForForm();
}

if ($action == 'editExpenseFor') {

    $data['expenseForId']     = model::secure($_POST['expense_for_id']);
    $data['expenseForName']   = model::secure($_POST['expense_for_name']);
    $data['expenseForPrice']  = model::secure($_POST['expense_for_price']);
    $data['expenseForStatus'] = model::secure($_POST['expense_for_status']);
    
    expenseFor::editExpenseFor($data);
}

if ($action == 'optionBtns') {
    expenseFor::optionBtns();
}

if ($action == 'getOldVal') {
    $id = model::secure($_POST['id']);
    expenseFor::getOldVal($id);
}