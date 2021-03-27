<?php

require_once "../core.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == "login") {
    $data = [];
    foreach ($_POST as $k => $val) {
        if ($k != "action") {
            $data[$k] = model::secure($val);
        }
    }
    user::login($data);
}


