<?php

class expenseClass {

    public static function getExpenses($id,$exId) {

        $student        = student::find($id);
        $studentDetails = student_details::where('student_id', $id);
        $status         = student_status::find($student['status'])['name'];
        $department     = departments::find($studentDetails['dep_id'])['name'];
        
        ?>
        <div class="card card-dark student">
            <div class="card-header" style="height:3em;">
                <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> <?=ucwords(strtolower($student['name']))?>
                    &nbsp; | &nbsp;<?= $student['name_ar'] ?>
                    <div class="form-inline float-right">
                        <a href="requests.php" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left fa-sm"></i> &nbsp;
                            Back</a>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barcode ID</th>
                            <th>Department</th>
                            <th>Mobile Numbers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $student['id'] ?></td>
                            <td><?= $student['barcode_id'] ?></td>
                            <td><?= $department ?></td>
                            <td><?= $studentDetails['ph_num_one'] ?> <br> <?= $studentDetails['ph_num_two'] ?> </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 text-center option-btns">
                    <div class="col-2 float-right">
                        <?= self::btnExpenseConfirm($id,$exId) ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- For retrieving data coming form ajx request for any button  -->
        <div class="more-details mt-3">
        </div>
        <?php
    }


    public static function btnExpenseConfirm($sId,$exId) {

        $statusId   = student::find($sId)['status'];

        ?>
        <div class="col-md">
            <button type="button"
                onclick="ajxReq('expenses.php', {action:'confirmExpense', exId:<?= $exId ?>}, '.more-details', true, '.stud-form-fund')"
                class="btn btn-dark btn-sm w-100">Confirm</button>
        </div>
        <?php
    }

    public static function confirmExpense($exId) {

        $x = [];
        $x['status'] = 1;
        $update = expenses::updateArrayOrg($x,'id',$exId);

       if($update){
        $json['notification'] = array('type'=>'success', 'msg'=>'Expense Confirmed Successfully.');
        $json['reload'] = true;

        // For Print
        $output = expenseForm($exId);
        $search = [
            '/\>[^\S ]+/',      // strip whitespaces after tags, except space
            '/[^\S ]+\</',      // strip whitespaces before tags, except space
            '/(\s)+/',          // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        ];
    
        $replace = ['>', '<', '\\1', ''];
        
        $output = preg_replace($search, $replace, $output);
        // $output = json_encode($output, JSON_UNESCAPED_UNICODE);
        $json['notifyDo']['script'] = '<script>printIt("'.$output.'");</script>';
        // ---

        exit(json_encode($json));
        }

        $json['notification'] = array('type'=>'danger', 'msg'=>'Error While Confirming Expense!!');
        exit(json_encode($json));

    }

    public static function BorrowForm($id) {
            $name = employees::find($id)['name']; ?>

            <div class=" card-dark">
                <div class="card-body">  
                    <form method="POST" onsubmit="submitForm(this, 'expenses.php')"  prevent-default>
                        <input type="hidden" name="action" value="addBorrow">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input class="form-control form-control-sm" type="text" value="<?=$name?>"  name="emp_name" disabled>                            
                                </div>                            
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control form-control-sm" type="number" min="1"  name="price" >                            
                                </div>                            
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                               
                                    <label>Description</label>
                                    <textarea class="form-control form-control-sm" cols="2" rows="2"  name="description" ></textarea>                           
                                </div>                            
                            </div>
                        </div>


                        <div class="form-group text-center mt-3">
                            <input type="submit" class="btn btn-dark" value="Make Request" >
                        </div>
                    </form>
                </div>
            </div>        
        <?php
    }


    public static function submitBorrow($empId, $studentId,$price,$description,$status,$date){
       $x = [];
       $x['student_id'] = $studentId;
       $x['expense_for_id'] = '7';
       $x['value'] =       $price;
       $x['employee_id'] = $empId;
       $x['description'] = $description;
       $x['date']        = $date;
       $x['status'] =  $status;
       $save = expenses::saveArrayorg($x);
       if($save){
            $json["notifyDo"] = ["type" => "success", "msg" => "Borrow Request Sent Successfully.", "redirectTo" => "make_borrow.php"];
            exit(json_encode($json));
       }
       $json["notifyDo"] = ["type" => "danger", "msg" => "Error while sending Borrow Request!", "redirectTo" => "borrowForm.php?id = $empId "];
       exit(json_encode($json));
    } 
    



    public static function table() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">طلبات السلف</h3>
                </div>
                <div class="card-body ">
                    <table id="table " class="table text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>تأكيد</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "id"},
                            {"data": "name"},
                            {"data": "submit"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'makeBorrowTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }




    public static function salariesTable() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">مرتبات الموظفين</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>التاريخ</th>
                                <th>مجموع المرتبات</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "id"},
                            {"data": "date"},
                            {"data": "total_sal"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "searching":false,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'totalSalTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }


    public static function borrowingsTable() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">سلف الموظفين</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>إسم الموظف</th>
                                <th>قيمة الإستلاف</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "id"},
                            {"data": "emp_name"},
                            {"data": "val"},
                            {"data": "date"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'borrowingsTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }


    public static function employeesExpensesTable() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">نفقات الموظفين</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>إسم الموظف</th>
                                <th>نوع النفقة</th>
                                <th>الوصف</th>
                                <th>تأكيد</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "id"},
                            {"data": "emp_name"},
                            {"data": "expense_for"},
                            {"data": "description"},
                            {"data": "confirm"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'empTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }

    public static function salariesExpensesTable() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">نفقات المرتبات</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>المجموع</th>
                                <th>تأكيد</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "date"},
                            {"data": "total"},
                            {"data": "action"}
                        ],
                        "ordering": false,
                        "searching": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'salTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }


    public static function otherExpensesTable() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">النفقات الأخرى</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>القيمة</th>
                                <th>الوصف</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "value"},
                            {"data": "description"},
                            {"data": "date"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'otherTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }



    public static function submitSalExpense($date,$total){

        $year = $date[0].$date[1].$date[2].$date[3];
        $month = $date[5].$date[6];
        $day = $date[8].$date[9];
        
        $upadateSalaries = model::custom_sql(" UPDATE `salaries` set `status` = 1 WHERE YEAR(`date`) = $year AND  MONTH(`date`) = $month AND  DAYOFMONTH(`date`) = $day ");

        //var_dump($upadateSalaries);
           
        $json["notifyDo"] = ["type" => "success", "msg" => "Salaries were paid successfully.", "redirectTo" => "salaries_expenses.php"];
        exit(json_encode($json));
    
    }




    
    public static function reportTable($date) {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Safe Report at <?=$date?>
                        <div class="float-right form-inline">
                            <input type="date" class="form-control element" name="date" value="<?=$date?>" required="">&nbsp;
                        </div>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>اليوم</th>
                                <th>الإيرادات</th>
                                <th>المصروفات</th>
                                <th>المجموع</th>
                                <th>مجموع الإيرادات</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                $(function() {
                    $('.table').DataTable({
                        "columns": [
                            {"data": "date"},
                            {"data": "revenue"},
                            {"data": "expenses"},
                            {"data": "total"},
                            {"data": "totRevenue"}
                        ],
                        "ordering":  false,
                        "searching": false,
                        "bLengthChange": false,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/expenses.php',
                            data: {action:'reportTable',date:'<?=$date?>'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }

    public static function reportDetails($exIds = NULL, $revIds = NULL){
        //echo "hello";
        // echo "<pre>";print_r($revIds);echo "</pre>"; 
        // echo "<pre>";print_r($exIds);echo "</pre>"; 
        if($exIds != NULL){?>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>نوع العملية </th>
                            <th>القيمة</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($exIds[0] as $key => $value) {  ?>
                            <tr>
                                <th><?=expense_for::find($value['expense_for_id'])['name'];?></th>
                                <th>$<?=$value['value'];?></th>
                             </tr>
                    <?php } ?> 

                    </tbody>
                </table>
            </div>
    <?php
        }else if($revIds != NULL){ ?>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>نوع العملية </th>
                            <th>القيمة</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($revIds[0] as $key => $value) {  ?>
                            <tr>
                                <th><?=pay_for::find($value['pay_for_id'])['name'];?></th>
                                <th>$<?=$value['value'];?></th>
                             </tr>
                    <?php } ?> 

                    </tbody>
                </table>
            </div>

    <?php
        }
    }



}