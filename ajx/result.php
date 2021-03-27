<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'updateResForm') {
    $id = model::secure($_POST['student']);
    result::updateResForm($id);
}

if ($action == 'updateStuRes') {
    $bcId = model::secure($_POST['stu_barcode']);
    $res  = [];

    foreach ($_POST['res_ids'] as $k => $resId) {
        $res[$resId] = [
            'final'     => model::secure($_POST['final'][$k]),
            'midterm'   => model::secure($_POST['midterm'][$k]),
            'activity'  => model::secure($_POST['activity'][$k]),
            'attendace' => model::secure($_POST['attendace'][$k])
        ];   
    }
    result::updateStuRes($res, $bcId);
}

if ($action == 'addResults') {
    
    $subj_id = model::secure($_POST['subj_id']);
    $year    = model::secure($_POST['year']);
    $res_for = model::secure($_POST['res_for']);

    $file = file_get_contents($_FILES['subj_file']['tmp_name']);
    $file = explode('|', rtrim(str_replace("\n", '|', $file), '|'));
    $results = [];

    foreach ($file as $res) {
        $stuRes = explode(',', $res);
        $results[$stuRes[0]] = $stuRes[1];
    }

    result::addResults($results, $subj_id, $year, $res_for);
}