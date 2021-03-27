<?php
class salaryClass{

    public static function tableHistory() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Salary History</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>وقت العمل</th>
                                <th>الخصم</th>
                                <th>المجموع</th>
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
                            {"data": "employee_id"},
                            {"data": "working_time"},
                            {"data": "discount"},
                            {"data": "total"},
                            {"data": "date"}
                        ],
                        "ordering": false,
                        "searching": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/salary.php',
                            data: {action:'tablehistory'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }

    public static function calculate() {
    ?>
        <form method="POST" onsubmit="submitForm(this,'salary.php')" prevent-default>
            <input type="hidden" name="action" value="calculatesalary">
            <div class="row mb-4">
                
                <div class="col-md-3">
                    <label>نوع الموظف</label>
                    <select class="form-control form-control-sm" name="eType" required>
                        <option value="">إختر النوع</option>
                        <option value="officer">Officer</option>
                        <option value="lecturer">Lecturer</option>
                    </select> 
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>التاريخ</label>
                        <input type="date" class="form-control form-control-sm" name="date" placeholder="Employee Salary" required> 
                    </div>
                </div>

                <div class="col-md-3">
                    <label>الملف</label>
                    <input type="file" class="form-control form-control-sm" name="subj_file">
                </div>

            </div>
            <div class="form-group float-right">
                <button type="submit" class="btn btn-info">إضافة المرتبات</button>
            </div>
        </form>
    <?php
    }

    public static function calculateSalary($eType,$date,$results) {
        //$flag = true;
        $dateYear = $date[0].$date[1].$date[2].$date[3];
        $dateMonth = $date[5].$date[6];
        $i =  count($results);
        //exit();
                
        foreach ($results as $k => $v) {
            
            if ($i != 0) {
                $i = $i-1;
                $v = (float)$v; //setting the abcense days as as float value

                $eSalary = employees::where('id',$k)['salary'];
                if ($eSalary) {
                    if ($eType == 'officer') {
                        // how many days working?
                        $eDaySalary = $eSalary / 30 ;
                        $hoursSalary = $eDaySalary / 24;
                        $eDepreciation = 0;
                        $eDepreciation = expenses::all_sql("Where `student_id` = 0 AND `employee_id` = '$k'
                                                            AND  `date` LIKE '%$dateMonth%' AND  `date` LIKE '%$dateYear%'
                                                            AND `expense_for_id` = 7 AND `status` = 0");
                        
                        if($eDepreciation){
                            $eDepreciation = $eDepreciation[0]['value'];
                        }else{
                            $eDepreciation = 0;
                        }
                        // echo $k;
                        // echo "<pre>";print_r($eDepreciation);echo "</pre>";


                        $hoursAbcense = $v * 8;
                        $absenceValue =   $hoursAbcense * $hoursSalary ;

                        $workingTime = (30 - $v);

                        $totalSalary = $eSalary - ($absenceValue + $eDepreciation);

                        //$totalHoursSalary = 30 * 8 * $hoursSalary;
                        //echo $eDepreciation;
                        // $eDepreciation = $eDepreciation / 60;
                        //$exploitation = ($v / 60);
                        //$absenceValue = (float)0.00;
                        //$absenceValue = floatval($absenceValue); 
                        //echo $v;
                        //$totalSalary = $workingTime * $eDaySalary;
                        //echo $totalHoursSalary -($absenceValue + $eDepreciation);
                        //echo "totalHoursWork: ".$totalHoursSalary."<br>";
                        // echo "eDaySalary: ".$eDaySalary."<br>";
                        // echo "hoursSalary: ".$hoursSalary."<br>";
                        // echo "#days: ".$v."<br>";
                        // echo "workingTime: ".$workingTime."<br>";
                        // echo "eDepreciation: ".$eDepreciation."<br>";
                        // echo "absenceValue: ".$absenceValue."<br>";
                        // echo "orgSlaray: ".$eSalary."<br>";
                        // echo "totalSalary: ".$totalSalary."<br>";
                        //exit();

                        $x = array();
                        $x['employee_id'] = $k;
                        $x['working_time'] = $workingTime;
                        $x['discount'] = $eDepreciation;
                        $x['total'] = $totalSalary;
                        $x['salary_date'] = $date;
                        $x['date'] = date("Y-m-d");
                        $x['status'] = 0;
                        $save = salaries::saveArrayOrg($x);
                    }

                    if ($eType == 'lecturer') {
                        //echo 'dsads';
                        $totalSalary = $eSalary / $v;
                        $x = array();
                        $x['employee_id'] = $k;
                        $x['working_time'] = $v;
                        $x['discount'] = 0;
                        $x['total'] = $totalSalary;
                        $x['salary_date'] = $date;
                        $x['date'] = date("Y-m-d");
                        $x['status'] = 0;
                        $save = salaries::saveArrayOrg($x);
                    }

                    if ($save) {
                        $json['notifyDo'] = ['type' => 'success', 'msg' => 'Employees is updated successfully!'];
                        
                    } else {
                        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!'];
                        
                    }
                }

            } else {

                break;
            }
        }
        exit(json_encode($json));
    }


    public static function tableRequest() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">تقديم طلب المرتبات</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>المجموع</th>
                                <th>التأكيد</th>
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
                            url: '../ajx/salary.php',
                            data: {action:'tablerequest'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }


    public static function submitSalaries($total){
        
        $expenseId = expense_for::where('name','paying salaries')['id'];

        $x = [];
        $x['student_id'] = 0;
        $x['expense_for_id'] = $expenseId;
        $x['value'] = $total;
        $x['employee_id'] = 0;
        $x['description'] = '';
        $x['date'] = date("Y-m-d H:i:s");
        $x['status'] = 0;
        $saveSal = expenses::saveArrayOrg($x);

        if($saveSal){
            $json['notifyDo'] = [
                'type'   => 'success',
                'msg'    => 'Salary Request Confirmed Successfully.',
                'redirectTo' => 'salary-request.php'
            ];
            exit(json_encode($json));
        }
        $json['notifyDo'] = [
            'type'   => 'danger',
            'msg'    => 'Error while Conferming Salary Request! ',
            'redirectTo' => 'salary-request.php'
        ];
        exit(json_encode($json));

    }



    public static function employeeDetails($data) {
        $employeeID = $data['id'];
        $employeeData = employees::where('id',$employeeID);
        if ($employeeData['status'] == '0') {
            $employeeData['status'] = 'Working';
        }
        if ($employeeData['status'] == '1') {
            $employeeData['status'] = 'Not Working';
        }
        $json['result'] = '
        <div>
            <p><b>Name:</b> '.$employeeData['name'].'</p>
            <p><b>Type:</b> '.$employeeData['type'].'</p>
            <p><b>Phone:</b> '.$employeeData['phone'].'</p>
            <p><b>Address:</b> '.$employeeData['address'].'</p>
            <p><b>Salary:</b> '.$employeeData['salary'].'</p>
            <p><b>Start_date:</b> '.$employeeData['start_date'].'</p>
            <p><b>End_date:</b> '.$employeeData['end_date'].'</p>
            <p><b>Status:</b> '.$employeeData['status'].'</p>
        </div>
        ';
        exit(json_encode($json));
    }

    public static function addEmployeeForm() {
    ?>
        <form method="POST" onsubmit="submitForm(this, 'employee.php')" prevent-default>
            <input type="hidden" name="action" value="addEmployeeform">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-sm" name="eName" placeholder="Employee Name" required> 
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Type</label>
                    <select class="form-control form-control-sm" name="eType" required>
                        <option value="">Select Type</option>
                        <option value="Officer">Officer</option>
                        <option value="Lecturer">Lecturer</option>
                    </select> 
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control form-control-sm" name="ePhone" placeholder="Employee Phone" required> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control form-control-sm" name="eSalary" placeholder="Employee Salary" required> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="eAddress" cols="30" rows="4" class="form-control form-control-sm" placeholder="Employee Address" required></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group float-right">
                <button type="submit" class="btn btn-info">Add new employee</button>
            </div>
        </form>
    <?php
    }

    public static function addEmployeeSubmit($data) {
        if (empty($data['eName'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee name required!'];
            exit(json_encode($json));
        }
        if (empty($data['eType'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Type required!'];
            exit(json_encode($json));
        }
        if ($data['eType'] == '' || is_numeric($data['eType'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Type wrong!'];
            exit(json_encode($json));
        }
        if (empty($data['ePhone'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Phone required!'];
            exit(json_encode($json));
        }
        if (empty($data['eSalary'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Salary required!'];
            exit(json_encode($json));
        }
        if (empty($data['eAddress'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Address required!'];
            exit(json_encode($json));
        }
        $x = array();
        $x['name'] = $data['eName'];
        $x['type'] = $data['eType'];
        $x['phone'] = $data['ePhone'];
        $x['address'] = $data['eAddress'];
        $x['salary'] = $data['eSalary'];
        $x['start_date'] = date("Y-m-d H:i:s");
        $save = employees::saveArrayOrg($x);
        if ($save) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Employee is added successfully!'];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!'];
        }
        $json['reload'] = true;
        exit(json_encode($json));
    }

    public static function employeeEdit($data) {
        $employeeID = $data['id'];
        $employeeData = employees::where('id',$employeeID);
        ?>
            <form method="POST" onsubmit="submitForm(this, 'employee.php')" prevent-default>
                <input type="hidden" name="action" value="editEmployeeSubmit">
                <input type="hidden" name="eId" value="<?= $employeeID ?>">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control form-control-sm" name="eName" placeholder="Employee Name" value="<?= $employeeData['name'] ?>" required> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Type</label>
                        <select class="form-control form-control-sm" name="eType" required>
                            <option value="">Select Type</option>
                            <option value="Officer" <?php if ($employeeData['type'] == 'Officer') echo 'selected'; ?>>Officer</option>
                            <option value="Lecturer" <?php if ($employeeData['type'] == 'Lecturer') echo 'selected'; ?>>Lecturer</option>
                        </select> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control form-control-sm" name="ePhone" placeholder="Employee Phone" value="<?= $employeeData['phone'] ?>" required> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" class="form-control form-control-sm" name="eSalary" placeholder="Employee Salary" value="<?= $employeeData['salary'] ?>" required> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Type</label>
                        <select class="form-control form-control-sm" name="eStatus" required>
                            <option value="">Status</option>
                            <option value="0" <?php if ($employeeData['status'] == '0') echo 'selected'; ?>>working</option>
                            <option value="1" <?php if ($employeeData['status'] == '1') echo 'selected'; ?>>Not Working</option>
                        </select> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="eAddress" cols="30" rows="4" class="form-control form-control-sm" placeholder="Employee Address" required><?= $employeeData['address'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-info">Update employee</button>
                </div>
            </form>
        <?php
    }

    public static function editEmployeeSubmit($data) {
        if (empty($data['eName'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee name required!'];
            exit(json_encode($json));
        }
        if (empty($data['eType'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Type required!'];
            exit(json_encode($json));
        }
        if ($data['eType'] == '' || is_numeric($data['eType'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Type wrong!'];
            exit(json_encode($json));
        }
        if (empty($data['ePhone'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Phone required!'];
            exit(json_encode($json));
        }
        if (empty($data['eSalary'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Salary required!'];
            exit(json_encode($json));
        }
        if (!is_numeric($data['eStatus'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Status wrong!'];
            exit(json_encode($json));
        }
        if (empty($data['eAddress'])) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Employee Address required!'];
            exit(json_encode($json));
        }
        $eId = $data['eId'];
        $x = array();
        $x['name'] = $data['eName'];
        $x['type'] = $data['eType'];
        $x['phone'] = $data['ePhone'];
        $x['address'] = $data['eAddress'];
        $x['salary'] = $data['eSalary'];
        $x['start_date'] = date("Y-m-d H:i:s");
        $x['status'] = $data['eStatus'];
        $update = employees::updateArrayOr($x,'id',$eId);
        if ($update) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Employee is updated successfully!'];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!'];
        }
        $json['reload'] = true;
        exit(json_encode($json));
    }

}