<?php

class departments extends model
{
    protected $table = '`departments`';

    public static function departmentsOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Departments Options
                    <!-- <div class="form-inline float-right">
                        <a href="index.php" class="btn btn-success btn-sm"> <i class="fa fa-eye fa-sm"></i> &nbsp; Students</a>
                    </div> -->
                    </h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="department-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Department -->
                <div class="col-md-4">
                    <button type="button" onclick="ajxReq('departments.php', {action:'addDepartmentForm'}, '.department-details', true, '.add-department')"
                        class="btn btn-info btn-sm w-100">Add Department</button>
                </div>
            <!-------------------->

            <!-- Edit Department Subjects-->
                <div class="col-md-4">
                    <button type="button" onclick="ajxReq('departments.php', {action:'editDepartmentSubjectsForm'}, '.department-details', true, '.edit-department-subjects')"
                        class="btn btn-default btn-sm w-100">Edit Department Subjects</button>
                </div>
            <!-------------------->

            <!-- Edit Department -->
                <div class="col-md-4">
                        <button type="button" onclick="ajxReq('departments.php', {action:'editDepartmentForm'}, '.department-details', true, '.edit-department')"
                            class="btn btn-dark btn-sm w-100">Edit Department</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addDepartmentForm() {
        ?>
            <div class="card card-info add-department">
                <div class="card-header"  onclick="slideToggleDiv('.add-department')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Department </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addDepForm" onsubmit="submitForm(this, 'departments.php')" prevent-default>
                        <input type="hidden" name="action" value="addDepartment">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="dep_name" placeholder="Department Name" required> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subjects</label>
                                    <select class="form-control form-control-sm 2select" onchange="selectOption($(this).children('option:selected'), '.selected-subjects', 'subjIds', 'info');">
                                        <?= subjects::option(); ?>	                   
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row selected-subjects mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-department', '.addDepForm')">Add Department</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addDepartment($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('departments.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $dep = new departments;
        $dep->name = $data['depName'];
        $dep->status = 1;
        $depId = $dep->save($uId);

        if ($depId) {
            if (isset($data['subjIds'])) {
                $subjs = [];
                foreach ($data['subjIds'] as $id) {
                    $subjName = subjects::find($id)['name'];
                    $subjs[$id] = $subjName;
                }
                $depSubj = new department_subjects;
                $depSubj->department_id = $depId;
                $depSubj->subjects = json_encode($subjs, JSON_UNESCAPED_UNICODE);
                if ($depSubj->save($uId)) {
                    $json['notifyDo'] = ['type' => 'success', 'msg' => 'Department and Subjects are added successfully!', 'script' => $script];
                }
            } else {
                $json['notifyDo'] = ['type' => 'success', 'msg' => 'Department is added successfully!', 'script' => $script];
            }
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editDepartmentSubjectsForm() {
        ?>
            <div class="card card-default edit-department-subjects">
                <div class="card-header"  onclick="slideToggleDiv('.edit-department-subjects')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Department Subjects </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editDepForm" onsubmit="submitForm(this, 'departments.php')" prevent-default>
                        <input type="hidden" name="action" value="editDepartmentSubjects">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="dep_id" onchange="selectOption($(this).children('option:selected'), '.selected-subjects', 'subjIds', 'default', true, 'departments.php', 'depSubjects');" required>
                                        <?= departments::option(); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subjects</label>
                                    <select class="form-control form-control-sm 2select" onchange="selectOption($(this).children('option:selected'), '.selected-subjects', 'subjIds', 'default');">
                                        <?= subjects::option(); ?>	                   
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row selected-subjects mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default" onclick="removeElem('.edit-department-subjects', '.editDepForm')">Edit Department Subjects</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editDepartmentSubjects($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('departments.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        // $dep = new departments;
        // $dep->id = $data['depId'];
        // $data['depName']   != '' ? $dep->name = $data['depName'] : '';
        // $data['depStatus'] != '' ? $dep->status = $data['depStatus'] : '';

        if (isset($data['subjIds'])) {
            $subjs = [];
            foreach ($data['subjIds'] as $id) {
                $subjName = subjects::find($id)['name'];
                $subjs[$id] = $subjName;
            }
            $depSubjId = department_subjects::where('department_id', $data['depId'])['id'];
            // echo $depSubjId;die;

            $depSubj = new department_subjects;
            $depSubj->id = $depSubjId;
            $depSubj->subjects = json_encode($subjs, JSON_UNESCAPED_UNICODE);

            if ($depSubj->update($uId)) {
                $json['notifyDo'] = ['type' => 'success', 'msg' => 'Department Subjects are edited successfully!', 'script' => $script];
            }

        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function depSubjects($id) {
        $depSubjs = department_subjects::where('department_id', $id)['subjects'];
        echo $depSubjs;

    }

    public static function editDepartmentForm() {
        ?>
            <div class="card card-dark edit-department">
                <div class="card-header"  onclick="slideToggleDiv('.edit-department')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Department </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editDepForm" onsubmit="submitForm(this, 'departments.php')" prevent-default>
                        <input type="hidden" name="action" value="editDepartment">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="dep_id" onchange="getOldVal($(this).children('option:selected'), {name:'dep_name', status:'dep_status'}, {link:'departments.php', action:'getOldVal'});" required>
                                        <?= departments::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" class="form-control form-control-sm" name="dep_name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department Status</label>
                                    <select class="form-control form-control-sm 2select" name="dep_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-subjects mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-department', '.editDepForm')">Edit Department</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editDepartment($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('departments.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $dep = new departments;
        $dep->id = $data['depId'];
        $data['depName']   != '' ? $dep->name = $data['depName'] : '';
        $data['depStatus'] != '' ? $dep->status = $data['depStatus'] : '';
        if ($dep->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Department is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id) {
        $res = departments::find($id);
        echo json_encode($res);
    }

}
