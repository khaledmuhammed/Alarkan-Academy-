<?php

require_once "../core.php";
require '../classes/expenses.php';

$action = isset($_POST['action']) ? $_POST['action'] : exit("ERR : You can not be here!");

if ($action == 'confirmExpense'){
    
    $exId = model::secure($_POST['exId']);
    expenseClass::confirmExpense($exId);
}


if ($action == 'borrowModal'){

    $id = model::secure($_POST['id']);
    expenseClass::BorrowForm($id);
}

if ($action == 'addBorrow'){
    
    $empId = model::secure($_POST['id']);
    $price = model::secure($_POST['price']);
    $description = model::secure($_POST['description']);
    $status = 0;
    $studentId = 0;
    $date = date("Y-m-d H:i:s");
    expenseClass::submitBorrow($empId, $studentId,$price,$description,$status,$date);
}


if ($action == 'confirmStudentExpense'){
    $exId =  model::secure($_POST['exId']);
    expenseClass::confirmExpense($exId);

}


if ($action == 'Table'){

    $data = array();
    $draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);//Paging first record indicator.
    $length = model::secure($_POST['length']);//Number of records that the ta
    $recordsTotal = $recordsFiltered = 0 ;

    $borrowId = expense_for::where('name','borrowing')['id'];
    $payingSalariesId = expense_for::where('name','paying salaries')['id'];
    $expenses = expenses::all_sql("WHERE `status` = 0 AND expense_for_id != $borrowId AND expense_for_id != $payingSalariesId");

    
    if(!empty($_POST['search']['value'])){

        $search = trim(model::secure($_POST['search']['value']));
        $expenses = model::custom_sql("SELECT `e`.* ,`s`.`name` 
                                        FROM `student` AS `s`
                                        LEFT JOIN `expenses` AS `e`
                                        ON `s`.`id` = `e`.`student_id`
                                        WHERE `s`.`name` LIKE '%$search%'
                                        AND `e`.`status` = 0");
        $recordsTotal = $recordsFiltered= count($expenses); 
    } 

    if($expenses){

        $recordsTotal = $recordsFiltered = count(expenses::all_sql("WHERE `status` = 0 AND expense_for_id != $borrowId AND expense_for_id != $payingSalariesId
        limit $start,$length"));
        foreach ($expenses as $key => $value) {

            $id = $value['id'];
            $sId = $value['student_id'];
            $payForId = $value['expense_for_id'];

            $value['student_name'] = student::find($sId)['name_ar'];

            $value['expense_for'] = expense_for::find($payForId)['name_ar'];
            $expense_for = $value['expense_for'];

            // $value['expense_for'] =  '<a href="../safe/confirmExpense.php?ex_id='.$id.'&id='.$sId.'">'.$expense_for.'</a>';
            $value['id'] = "#".$value['id'];
            $value['confirm'] = "<a class='btn btn-sm btn-success action' url='../../ajx/expenses.php' data ='{\"action\":\"confirmStudentExpense\",\"exId\":\"$id\"}' href='#'>تأكيد</a>";

            $data[] = $value ; 

        }
    }

    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);  
}



if($_POST['action'] == 'makeBorrowTable'){
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

            $id = $employee['id'];
            $employee['submit'] = "<a data='action' onclick='modalShow(\"expenses.php\",{action:\"borrowModal\",id:\"$id\"})' href='#'>تقديم الطلب</a>";
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



if ($action == 'totalSalTable'){

    $data = array();
    $draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);//Paging first record indicator.
    $length = model::secure($_POST['length']);//Number of records that the ta
    $recordsTotal = $recordsFiltered = 0 ;

    $salaries = model::custom_sql("SELECT `id`,SUM(`total`) AS `total_sal`,`salary_date` AS `date` FROM `salaries`
                                   GROUP BY MONTH(`salary_date`) , YEAR(`salary_date`)");
 
    // if(!empty($_POST['search']['value'])){
        // $search = trim(model::secure($_POST['search']['value']));
        // $expenses = model::custom_sql("SELECT `e`.* ,`s`.`name` FROM `student` AS `s`
        //                                 LEFT JOIN `expenses` AS `e`
        //                                 ON `s`.`id` = `e`.`student_id`
        //                                 WHERE `s`.`name` LIKE '%$search%'
        //                                 AND `e`.`status` = 0");
    
        // $recordsTotal = $recordsFiltered= count($expenses); 
    // } 

    if($salaries){
        $recordsTotal = $recordsFiltered = count($salaries);

        foreach ($salaries as $key => $value) {

            $value['id'] = "#".$value['id'];

             $data[] = $value ; 

        }
    }

    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);  
}

if ($action == 'borrowingsTable'){

    $data = array();
    $draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);//Paging first record indicator.
    $length = model::secure($_POST['length']);//Number of records that the ta
    $recordsTotal = $recordsFiltered = 0 ;

    $borrowId = expense_for::where('name','borrowing')['id'];
    $Borrowings = expenses::all_sql("WHERE `expense_for_id` = $borrowId ");
    //echo "<pre>";print_r($Borrowings);echo "</pre>";
 
    if(!empty($_POST['search']['value'])){
        $search = trim(model::secure($_POST['search']['value']));
        $Borrowings = model::custom_sql("SELECT `e`.`name` ,`x`.* FROM
                                        `employees` AS `e`
                                        LEFT JOIN `expenses` AS `x`
                                        ON `e`.`id` = `x`.`employee_id`
                                        WHERE `e`.`name` LIKE '%$search%'
                                        AND `x`.`expense_for_id` = $borrowId");
    
        $recordsTotal = $recordsFiltered= count($Borrowings); 
    } 

    if($Borrowings){
        $recordsTotal = $recordsFiltered = count($Borrowings);
        
        foreach ($Borrowings as $key => $value) {

            $value['id'] = "#".$value['id'];

            $empId = $value['employee_id'];
            $empName = employees::find($empId)['name'];
            $value['emp_name'] = $empName;

            $value['val'] = $value['value'];


            $date = date('Y-m-d', strtotime( $value['date']));
            $value['date'] = $date;

            $data[] = $value ; 

        }
    }

    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);  
}



if ($action == 'empTable'){

    $data = array();
    $draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);//Paging first record indicator.
    $length = model::secure($_POST['length']);//Number of records that the ta
    $recordsTotal = $recordsFiltered = 0 ;

    $payingSalaryId = expense_for::where('name','paying salaries')['id'];
    $expenses = expenses::all_sql(" WHERE `student_id` = 0 
                                    AND `status` = 0 
                                    AND `expense_for_id` !=  $payingSalaryId
                                    limit $start,$length");
    
    $recordsTotal = $recordsFiltered = expenses::count_sql("WHERE `status` = 0 AND student_id = 0 AND `expense_for_id` !=  $payingSalaryId ");
    if(!empty($_POST['search']['value'])){

        $search = trim(model::secure($_POST['search']['value']));
        $expenses = model::custom_sql("SELECT `e`.* ,`emp`.`name` 
                                        FROM `employees` AS `emp`
                                        LEFT JOIN `expenses` AS `e`
                                        ON `emp`.`id` = `e`.`employee_id`
                                        WHERE `emp`.`name` LIKE '%$search%'
                                        AND `e`.`status` = 0
                                        AND `expense_for_id` !=  $payingSalaryId
                                        AND `student_id` = 0");
    
        $recordsTotal = $recordsFiltered= count($expenses); 
    } 

    if($expenses){

        foreach ($expenses as $key => $value) {

            $id = $value['id'];
            $eId = $value['employee_id'];
            $payForId = $value['expense_for_id'];

            $value['emp_name'] = employees::find($eId)['name'];

            $value['expense_for'] = expense_for::find($payForId)['name'];
            $expense_for = $value['expense_for'];
            
            $value['confirm'] = "<a class='btn btn-sm btn-success action' url='../../ajx/expenses.php' data ='{\"action\":\"confirmExpense\",\"exId\":\"$id\",\"emp_id\":\"$eId\"}' href='#'>Confirm</a>";

            $value['id'] = "#".$value['id'];
            $data[] = $value ; 

        }
    }

    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);  
}


if ($action == 'otherTable'){

    $data = array();
    $draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);//Paging first record indicator.
    $length = model::secure($_POST['length']);//Number of records that the ta
    $recordsTotal = $recordsFiltered = 0 ;

    $otherExpenseId =expense_for::where('name','other')['id'];
    $expenses = expenses::all_sql(" WHERE `student_id` = 0 
                                    AND `employee_id` = 0 
                                    AND `status` = 0 
                                    AND `expense_for_id` =  $otherExpenseId
                                    limit $start,$length ");
    
    $recordsTotal = $recordsFiltered = expenses::count_sql("WHERE `student_id` = 0 
                                                            AND `employee_id` = 0 
                                                            AND `status` = 0 
                                                            AND `expense_for_id` =  $otherExpenseId ");
    if(!empty($_POST['search']['value'])){

        $search = trim(model::secure($_POST['search']['value']));

        $expenses =  expenses::all_sql(" WHERE `student_id` = 0 
                                        AND `employee_id` = 0 
                                        AND `status` = 0 
                                        AND `expense_for_id` =  $otherExpenseId
                                        AND `date` LIKE '%$search%'
                                        OR `value` LIKE '%$search%'");
    
        $recordsTotal = $recordsFiltered= count($expenses); 
    } 

    if($expenses){

        foreach ($expenses as $key => $value) {

            $id = $value['id'];
    
            $data[] = $value ; 

        }
    }

    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);  
}





if ($action == 'submitSalExpense'){
    
    $date = model::secure($_POST['date']);
    $total = model::secure($_POST['total']);

    expenseClass::submitSalExpense($date,$total);
}



if ($action == 'salTable'){

    $data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);

    //$salaryExpenseId = expense_for::where('name','paying salaries')['id'];
    $salariesData = salaries::custom_sql("SELECT SUM(`total`) AS total,`date` FROM `salaries` WHERE `status` = 0 GROUP BY DATE(`date`)");
    //echo "<pre>";print_r($salariesData);echo "</pre>";
    $recordsFiltered = $recordsTotal = count($salariesData);

	if($salariesData){

		foreach ($salariesData as $key => $salarieData) {

            //$id = $salarieData['id'];

            $salarieData['total'] = round($salarieData['total'] , 2);
            $date =  $salarieData['date'];
			$total = $salarieData['total'];

			$salarieData['action'] ="<a class='btn btn-sm btn-success action' url='../../ajx/expenses.php' data ='{\"action\":\"submitSalExpense\",\"total\":\"$total\",\"date\":\"$date\"}' href='#'>Pay</a>";

			$data[] = $salarieData;
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


if ($action == 'showReportDetails'){

    $date = $_POST['date'];

    if($_POST['value'] == 'expenses'){
        $exIds[] = expenses::all_sql(" WHERE DATE(`date`) = DATE('$date') and status = 1  ");
        $exIds = array_filter($exIds);

        expenseClass::reportDetails($exIds,NULL);

    }else if($_POST['value'] == 'revenue'){
        $revIds[] = payment::all_sql(" WHERE DATE(`date`) =  DATE('$date') and status = 1  ");
        $revIds = array_filter($revIds);

        expenseClass::reportDetails(NULL,$revIds);
    }
}



if ($action == 'reportTable'){

    $data = array();
	$draw = model::secure($_POST["draw"]);
    $start  = model::secure($_POST["start"]);
    $length = model::secure($_POST['length']);
    $date = model::secure($_POST['date']);

    
    // $Expenses = salaries::custom_sql("SELECT `e`.`id`,DATE(`e`.`date`) AS `date`,SUM(`e`.`value`) AS `expenses` FROM `expenses` AS `e` WHERE `status` = 1 GROUP BY DAY(`date`)  ");
    // $Revenus = salaries::custom_sql("SELECT `p`.`id`,DATE(`p`.`date`) AS `date`,SUM(`p`.`value`) AS `revenue` FROM `payment` AS `p` WHERE `status` = 1   GROUP BY DAY(`date`)  ");
    
    $ExpensesCount = salaries::custom_sql("SELECT DATE(`e`.`date`) AS `date`,SUM(`e`.`value`) AS `expenses` FROM `expenses` AS `e` WHERE `status` = 1  and MONTH(`date`) = MONTH('$date')and YEAR(`date`) = YEAR('$date')  GROUP BY DAY(`date`)  ");
    $RevenusCount =  salaries::custom_sql("SELECT DATE(`p`.`date`) AS `date`,SUM(`p`.`value`) AS `revenue` FROM `payment` AS `p` WHERE `status` = 1  and MONTH(`date`) = MONTH('$date')and YEAR(`date`) = YEAR('$date')  GROUP BY DAY(`date`)    ");
    $recordsFiltered = $recordsTotal = count($ExpensesCount) + count($RevenusCount);
    if(!$ExpensesCount && !$RevenusCount){
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => $data
        );
        exit(json_encode($response)); 
    }
    $allExDates  = array();
    $allRevDates  = array();
    if(!$ExpensesCount){
        $filteredFoo = $RevenusCount;
        $allRevDates  = array_column($RevenusCount , 'date');
    }elseif(!$RevenusCount){
        $filteredFoo = $ExpensesCount;
        $allExDates  = array_column($ExpensesCount , 'date');
    }else{
        $filteredFoo = array_merge($ExpensesCount, $RevenusCount);
        $allExDates  = array_column($ExpensesCount , 'date');
        $allRevDates  = array_column($RevenusCount , 'date');
    }
    
    $results = [];
    //  echo "<pre>";print_r($filteredFoo);echo "</pre>";

    foreach ($filteredFoo as $key => $value) {

        if(in_array($value['date'], $allExDates) && in_array($value['date'], $allRevDates)){
            if(!isset($value['expenses']) ||  $value['expenses'] == '' ){
            $value['expenses'] = 0;
            }
            if(!isset($value['revenue']) ||  $value['revenue']== '' ){
                $value['revenue'] = 0;
            }

            $results[$value['date']][]     =   $value['expenses'];
            $results[$value['date']][]     =  $value['revenue'];   
        }
        else if(in_array($value['date'], $allExDates)){
            $results[$value['date']][0]    =   $value['expenses'];
         
        }else if(in_array($value['date'], $allRevDates)){
            $results[$value['date']][3]     =   $value['revenue'];
         
        }
        
    }
    //sorting $results by date
    ksort($results);

    if($results){
        $recordsFiltered = $recordsTotal = count($results) ;

        $sum = 0;
        foreach ($results as $key => $value) {
                $value= array_filter($value);
                //$value[0] => expense value
                //$value[3] => revenue value

                $value['date'] = $key;
                if(isset($value[0])){
                    $value['expenses'] = $value[0];
                    $expenses = $value['expenses'];
                    $value['expenses'] = "<a onclick = \"modalShow('expenses.php',{action:'showReportDetails',date:'$key',value:'expenses'})\" href='#'>$expenses</a>";

                  
                }else{
                    $value['expenses'] = 0;
                    $expenses = 0;
                }
                if(isset($value[3])){
                    $value['revenue'] = $value[3];
                    $revenue = $value['revenue'];
                    $value['revenue'] = "<a onclick = \"modalShow('expenses.php',{action:'showReportDetails',date:'$key',value:'revenue'})\" href='#'>$revenue</a>";
                    
                }else{
                    $value['revenue'] = 0;
                    $revenue = 0;
                }
                
                $value['total'] = $revenue - $expenses;
                $sum += $value['total'];
                $value['totRevenue'] = $sum;


                $data[] = $value;
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
