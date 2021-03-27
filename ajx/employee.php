<?php

require_once "../core.php";
require_once "../classes/employee.php";

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if($_POST['action'] == 'table'){
	$data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);

    $recordsFiltered = $recordsTotal = employees::count_all();
    $sqlParam = "";

	if(!empty($_POST['search']['value'])){
		$search = trim(model::secure($_POST['search']['value']));
		$sqlParam = "where (`id` LIKE '%$search%' OR `name` LIKE '%$search%' OR `type` LIKE '%$search%')";
		$recordsFiltered = employees::count_sql($sqlParam);
    }
    
	$sqlParam .= " ORDER BY `id` DESC limit $start, $length";
    $employees = employees::all_sql($sqlParam);
    
	if($employees){
		foreach ($employees as $key => $employee) {
            if ($employee['status'] == '0') {
                $employee['status'] = 'Working';
            }
            if ($employee['status'] == '1') {
                $employee['status'] = 'Not Working';
            }
            $employeeID = $employee['id'];
            $employee['details'] = "<a url='../../ajx/employee.php' class='action' data='{\"action\":\"employeeDetails\",\"id\":\"$employeeID\"}' href='#'>Details</a>
                                    - <a data='action' onclick='modalShow(\"employee.php\",{action:\"employeeEdit\",id:\"$employeeID\"})' href='#'>Edit</a>
                                    - <a url='../../ajx/employee.php' class='action' data='{\"action\":\"employeeOldData\",\"id\":\"$employeeID\"}' href='#'>Old data</a>";
			$data[] = $employee; 
		}
	}else{
    	$draw="0";
    	$recordsTotal = $recordsFiltered = "0";
    	$data = [] ;
    }
    
	$response = array(
		"draw" => intval($draw),
		"recordsTotal" => $recordsTotal,
		"recordsFiltered" => $recordsFiltered,
		"data" => $data
	);
	echo json_encode($response);  
}

if ($action == 'employeeDetails') {
    $data['id'] = model::secure($_POST['id']);
    employeeClass::employeeDetails($data);
}

if ($action == 'addEmployee') {
    employeeClass::addEmployeeForm();
}

if ($action == 'addEmployeeform') {
    $data['eName'] = model::secure($_POST['eName']);
    $data['eType'] = model::secure($_POST['eType']);
    $data['ePhone'] = model::secure($_POST['ePhone']);
    $data['eSalary'] = model::secure($_POST['eSalary']);
    $data['eAddress'] = model::secure($_POST['eAddress']);
    employeeClass::addEmployeeSubmit($data);
}

if ($action == 'employeeEdit') {
    $data['id'] = model::secure($_POST['id']);
    employeeClass::employeeEdit($data);
}

if ($action == 'editEmployeeSubmit') {
    $data['eId'] = model::secure($_POST['eId']);
    $data['eName'] = model::secure($_POST['eName']);
    $data['eType'] = model::secure($_POST['eType']);
    $data['ePhone'] = model::secure($_POST['ePhone']);
    $data['eSalary'] = model::secure($_POST['eSalary']);
    $data['eStatus'] = model::secure($_POST['eStatus']);
    $data['eAddress'] = model::secure($_POST['eAddress']);
    employeeClass::editEmployeeSubmit($data);
}

if ($action == 'employeeOldData') {
    $data['id'] = model::secure($_POST['id']);
    employeeClass::employeeOldDetails($data);
}