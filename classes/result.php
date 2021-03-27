<?php

class result {
    
    public static function findForm() {
        ?>
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: capitalize;"> Find Student
                    <div class="form-inline float-right">
                        <a href="index.php" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> &nbsp; Students</a>
                    </div>
                    </h3>
                </div>
                <div class="card-body">  
                    <form method="GET" onsubmit="submitForm(this, 'student.php')">
                        <div class="form-group">
                            <label>Select Student</label>
                            <select class="2select form-control pb-2 pb-2" id="student" name="id" required></select>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit"  class="btn btn-dark" value="Edit Result" >
                        </div>
                    </form>
                </div>
            </div> 

        <?php
    }

    public static function updateResForm($resId) {
        $barCode = results::find($resId)['student_barcode_id'];
        //echo $barCode;
        $student  = student::where('barcode_id',$barCode);
        $id = $student['id'];
        
        //var_dump($student);
        if (!$student) {
            $r = '{"notifyDo": {"type": "danger","msg": "Not A Student!", "redirectTo": "student_result.php"}}';
            $r = json_encode($r);
            $script = "<script>mainResult($r);</script>";
            exit($script);
        }

        $bcId     = $student['barcode_id'];
        $dep_id   = student_details::where('student_id', $id)['dep_id'];
        $dep_info = department_subjects::where('department_id', $dep_id);
        $hasRes   = results::all_sql("WHERE student_barcode_id = $bcId");
        ?>
            <div class="card card-dark">

                <div class="card-body">
                    <?php
                        if (!empty($hasRes)) {
                            $dep_subj = get_object_vars(json_decode($dep_info['subjects']));
                    ?>
                            <form method="post" onsubmit="submitForm(this, 'result.php')" prevent-default>
                                <input type="hidden" name="action" value="updateStuRes">
                                <input type="hidden" name="stu_barcode" value="<?=$bcId?>">
                    <?php
                                $editRes = results::find($resId);
                                $subId = $editRes['subject_id'];
                                $bcId = $editRes['student_barcode_id'];

                                //foreach($dep_subj as $subId => $name) {
                                    $res  = results::all_sql("WHERE student_barcode_id = $bcId AND subject_id = $subId")[0];
                                    $year = $res['year'];
                                    ?>
                                    <div class="card-header">
                                        <h3 class="card-title" style="text-transform: capitalize;"> <?= ucwords(strtolower($student['name']))." - ".$year;  ?>
                                            <div class="form-inline" style="position: absolute; right: 2%; bottom: 7px;">
                                                <a href="find_student.php?student=<?=$id?>" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> &nbsp; Profile </a>
                                            </div>
                                        </h3>
                                    </div>
                                    <?php
                                    self::createSubjectResTable($subId, $bcId ,'editable',$year,'false');
                               // }
                    ?>
                                <div class="card-footer text-center"  style="background-color:#FFF;">
                                    <button type="submit" class="btn btn-dark">Edit Result</button>
                                </div>
                            </form>

                    <?php
                        } else {
                            echo "<h3 class='text-center text-muted'>There is no result till now.</h3>";
                        }
                    ?>
                </div>
            </div>
        <?php

    }
    
    public static function createSubjectResTable($subId, $bcId, $type = 'editable',$year,$editSection) {
        //$editSection = false;
        //echo $editSection;
        $subject = subjects::find($subId);
        $res  = results::all_sql("WHERE student_barcode_id = $bcId AND subject_id = $subId AND `year` = '$year'");
        $path_parts = pathinfo('find_student.php');

        if (!empty($res)) {
            $res = $res[0];
            ?>
                <?php if ($type == 'editable') { ?>
                    <input type="hidden" name="subj_ids[]" value="<?=$subId?>">
                    <input type="hidden" name="res_ids[]" value="<?=$res['id']?>">
                <?php } ?>

                <table class="table table-bordered table-responsive w-100 d-block d-md-table text-center mt-4 mb-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Attendace</th>
                            <th>Midterm</th>
                            <th>Activity</th>
                            <th>Final</th>
                            <th>Total</th>
                            <?php
                            //echo $path_parts['filename'];
                            if($editSection == 1){
                                echo '<th>Edit</th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th><?= ucwords($subject['name']) ?></th>
                            <td><?= $subject['attendace'] ?></td>
                            <td><?= $subject['midterm'] ?></td>
                            <td><?= $subject['activity'] ?></td>
                            <td><?= $subject['final'] ?></td>
                            <td><?= $subject['total'] ?></td>
 

                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= ucwords($subject['name']) ?></td>
                            <?php if ($type == 'editable') { ?>
                                <td><input class="form-control form-control-sm" type="number" name="attendace[]" value="<?= !empty($res['attendace']) ? (int)$res['attendace'] : 0; ?>" ></td>
                                <td><input class="form-control form-control-sm" type="number" name="midterm[]" value="<?= !empty($res['midterm']) ? (int)$res['midterm'] : 0; ?>" ></td>
                                <td><input class="form-control form-control-sm" type="number" name="activity[]" value="<?= !empty($res['activity']) ? (int)$res['activity'] : 0; ?>" ></td>
                                <td><input class="form-control form-control-sm" type="number" name="final[]" value="<?= !empty($res['final']) ? (int)$res['final'] : 0; ?>" ></td>
                                <td><input class="form-control form-control-sm" type="number"  value="<?= empty($res['final']) || empty($res['midterm']) || empty($res['activity']) || empty($res['attendace'])  ? 0 : (int)$res['final'] + (int)$res['midterm'] + (int)$res['activity'] + (int)$res['attendace']; ?>" readonly ></td>
                                <?php if($editSection == 1){  ?>
                                    <td><a href="student_result.php?id=<?=$res['id']?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                <?php }?>

                            <?php } else { ?>
                                <td><?= !empty($res['attendace']) ? $res['attendace'] : 'empty'; ?> </td>
                                <td><?= !empty($res['midterm']) ? $res['midterm'] : 'empty'; ?> </td>
                                <td><?= !empty($res['activity']) ? $res['activity'] : 'empty'; ?> </td>
                                <td><?= !empty($res['final']) ? $res['final'] : 'empty'; ?> </td>
                                <td><?= empty($res['final']) || empty($res['midterm']) || empty($res['activity']) || empty($res['attendace']) ? 0 : (int)$res['final'] + (int)$res['midterm'] + (int)$res['activity'] + (int)$res['attendace']; ?></td>
                                <?php if($editSection == 1){  ?>
                                     <td><a href="student_result.php?id=<?=$res['id']?>"><i class="fa fa-pencil-square-o"></i></a></td>
                                <?php }?>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            <?php
        } 
    }

    public static function addResultsForm() {
        ?>
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: capitalize;"> إضافة نتيجة</h3>
                </div>
                <div class="card-body">  
                    <form method="POST" onsubmit="submitForm(this, 'result.php')" enctype="multipart/form-data" prevent-default>
                        <input type="hidden" name="action" value="addResults">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>المادة</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="subj_id" required>
                                        <?= subjects::option(); ?>	                   
                                    </select>                             
                                </div>                            
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نوع النتيجة</label>
                                    <select class="form-control form-control-sm " id="res-for" name="res_for" required>
                                        <option value="midterm">Midterm</option>               
                                        <option value="activity">Activity</option>  
                                        <option value="attendace">Attendace</option>           
                                        <option value="final">Final</option>               
                                    </select>                             
                                </div>                            
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>السنة</label>
                                    <input class="form-control form-control-sm" type="number" min="2000" step="1" name="year" >                           
                                </div>                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" class="form-control form-control-sm" name="subj_file">
                            </div>
                        </div>

                        <div class="form-group text-center mt-3">
                            <input type="submit" class="btn btn-dark" value="إضافة النتيجة" >
                        </div>
                    </form>
                </div>
            </div>        
        <?php
    }

    public static function addResults($res, $subj_id, $year, $res_for) {

         $flag = false;
         $oldRes = model::custom_sql("SELECT `subject_id`,`student_barcode_id` , `year` FROM `results` 
                                    WHERE `subject_id` = $subj_id AND `year` = $year ");

        $i = 0;
        foreach ($res as $key => $value){
            //$key is the student barcodeId 
            if($oldRes[$i]['subject_id'] == $subj_id && $oldRes[$i]['student_barcode_id'] == $key && $oldRes[$i]['year'] == $year){
                $x = [];
                $x['student_barcode_id'] = $key;
                $x['year'] = $year;
                $x[$res_for] = $value;
                $update = model::custom_sql(" UPDATE `results` SET `student_barcode_id`='$key',
                `$res_for`='$value' WHERE `student_barcode_id`='$key' AND `year`='$year' AND `subject_id` = $subj_id");
  
                $flag = true;
            }else{
                $r = new results;
                $r->student_barcode_id = $key;
                $r->year = $year;
                $r->subject_id = $subj_id;
                $r->$res_for = $value;
                $flag = $r->save($_SESSION['userid']) ? true : false;
            }
            $i = $i + 1;
        }

        if ($flag) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Results Is added Successfully', 'redirectTo' => 'add_results.php'];
            exit(json_encode($json));
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while Submitting students results!'];
            exit(json_encode($json));
        }
    }

    public static function updateStuRes($res, $bcId) {
        $flag = true;
        foreach ($res as $k => $v) {
            if ($flag) {
                $r = new results;
                $r->id = $k;
                $r->midterm = $v['midterm'];
                $r->activity = $v['activity'];
                $r->attendace = $v['attendace'];
                $r->final = $v['final'];
                $flag = $r->update($_SESSION['userid']) ? true : false;
            } else {
                break;
            }
        }

        if ($flag) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Results Is Updated Successfully', 'redirectTo' => 'student_result.php'];
            exit(json_encode($json));
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong!'];
            exit(json_encode($json));
        }
    }
}