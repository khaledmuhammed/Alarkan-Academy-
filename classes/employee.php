<?php
class employeeClass{

    public static function table() {
        ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">معلومات الموظفين</h3>
                    <a class="btn btn-success float-right" data='action' onclick="modalShow('../ajx/employee.php',{action:'addEmployee'})" href='#'>+ Add new employee</a>
                </div>
                <div class="card-body text-center">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>النوع</th>
                                <th>الحالة</th>
                                <th>الفعل</th>
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
                            {"data": "type"},
                            {"data": "status"},
                            {"data": "details"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/employee.php',
                            data: {action:'table'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
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
        $emSalary = employees::where('id',$eId)['salary'];
        if ($emSalary != $data['eSalary']) {
            $x = array();
            $x['employee_id'] = $eId;
            $x['salary'] = $emSalary;
            $x['date'] = date("Y-m-d");
            $update = old_salaries::saveArrayOrg($x);
        }

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

    public static function employeeOldDetails($data) {
        $employeeID = $data['id'];
        $employeesOldData = old_salaries::all_sql("where `employee_id` = $employeeID");
        if (!$employeesOldData) {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'No old data for this employee!'];
            exit(json_encode($json));
        }
        $json['result'] = '';
        foreach ($employeesOldData as $key => $employeeOldData) {
            $json['result'] .= '
            <div>
                <p><b>Old Salary:</b> '.$employeeOldData['salary'].'<b> - Date:</b> '.$employeeOldData['date'].'</p>
            </div>
            ';
        }
        exit(json_encode($json));
    }
    
}