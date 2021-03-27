<?php

class officerClass { 

    public static function attendanceForm($classId=NULL ,$subjects=null ) {
        ?>
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title float-right" style="text-transform: capitalize;"> تسجيل حضور الطلاب <i
                class="fas fa-barcode"></i> </h3>
    </div>
    <div class="card-body ">
        <?php if($classId == NULL && $subjects == NULL ){ ?>
        <form method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="float-right"> رقم الفصل <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm 2select" id="class_id" name="class_id" required>
                            <?= classes::optionOrg(); ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="float-right"> إختر المواد <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm select2 dark" id="subjects" name="subjects[]"
                            multiple="multiple">
                            <option>إختر المواد</option>
                            <?php
                                        $subjects = subjects::get_list('id','name');
                                        foreach ($subjects as $key => $subject) {
                                        echo '<option value="'.$key.'">'.$subject.'</option>';
                                        }
                                        ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <input type="submit" name="submitAttendance" class="btn btn-dark" value="تسجيل الطلاب">
            </div>
        </form>
        <?php  }else{ ?>
        <div class="card-body d-flex justify-content-sm-center">
            <form class="form-inline" method="POST" onsubmit="submitForm(this, 'officer.php')" prevent-default>
                <input type="hidden" name="action" value="addBarcodes">
                <input type="hidden" class="form-control form-control-sm" name="class_id"
                    value="<?=$_POST['class_id']?>">
                <?php foreach ($_POST['subjects'] as $value) {?>

                <input type="hidden" class="form-control form-control-sm" name="subjects[]" value="<?=$value?>">
                <?php } ?>


                <div class="row  ">
                    <div class="form-group ">
                        <input type="text" class=" form-control form-control" name="barCode" required autofocus
                            onfocus="this.value=''">
                        <label class="float-right ml-2"> :إدخل رقم الباركود <span class="text-danger">*</span> </label>
                    </div>


                </div>

            </form>

        </div>
        <div class="row d-flex justify-content-sm-center">
            <a class="btn btn-danger" href="index.php">إنتهاء</a>
        </div>
    </div>
</div>
<?php
                }
    } 
    

    public static function addAttendance($classId,$subjects,$barCode){

        $nowDate = date("Y-m-d H:i:s");
        if(isset($_SESSION['userid'])){

            $student = student::where('barcode_id',$barCode);
            $studentGroup = $student['group_id'];
            $studentStatus = $student['status'];

            $studentAttendance = attendance::all_sql(" WHERE `student_barcode` = $barCode AND `subject_id` IN (".implode(',',$subjects).") AND `group_id` = $studentGroup AND `class_id` = $classId AND `register_date` <= '$nowDate' ");
            $allAttendance = attendance::all_sql(" WHERE `subject_id` IN (".implode(',',$subjects).") AND `group_id` = $studentGroup AND `class_id` = $classId AND `register_date` <= '$nowDate' ");
            $attendanceCalc = count($allAttendance) - count($studentAttendance); 

            // echo count($allAttendance);
            // echo count($studentAttendance);
            // // var_dump($studentAttendance);
            // echo "<pre>";print_r($allAttendance);echo "</pre>";
            // exit();
            // $attendanceCount = attendance::count_sql("WHERE `student_barcode` = $barCode AND `subject_id` IN (".implode(',',$subjects).") ");


            //we should check for(استدعاء ولى الامر) also here!!
            if($attendanceCalc < 2 && $studentStatus != 8&& $studentStatus != 9 ){

                foreach ($subjects as $key => $value) {
                    $x = [];
                    $x['class_id'] = $classId;
                    $x['subject_id'] = $value;
                    $x['group_id'] = $studentGroup;
                    $x['register_date'] = date("Y-m-d H:i:s");
                    $x['student_barcode'] = $barCode;
                    $save = attendance::saveArrayOrg($x);
                }
                
                if($save){
                    $json['notifyDo'] =  ['type' => 'success', 'msg' => $barCode.' is verified successfully!'];
                    $json['reload'] = true;
                }else {
                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in Add Attendance Section'];
                }
            }else if($attendanceCalc == 2 && $studentStatus != 8 && $studentStatus != 9){

             $json['notifyDo'] = ['type' => 'warning', 'msg' => 'Student Absence is Two Lectures!'];
            }else{

             $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Student Cant Enter this Lecture!'];
            }
            exit(json_encode($json));
        }


        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Session Timeout Please login again'];
        $json['reload'] = true;
        exit(json_encode($json));

    }
    

    public static function examForm($subject=null , $exam_type = null ) {
        ?>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title float-right" style="text-transform: capitalize;"> تسجيل حضور إمتحان <i
                        class="fas fa-barcode"></i> </h3>
            </div>
            <div class="card-body ">
                <?php if($subject == NULL ){ ?>
                <form method="POST">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="float-right"> إختر نوع الإمتحان <span class="text-danger">*</span></label>
                                <select style="cursor: pointer;" class="form-control form-control-sm 2select" id="exam_type"
                                    name="exam_type" required>
                                    <option value="0" >إختر إجابة</option>               
                                    <option value="midterm" >نصف الفصل</option>               
                                    <option value="final" >إمتحان نهائي</option>               
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="float-right"> إختر المادة <span class="text-danger">*</span></label>
                                <select style="cursor: pointer;" class="form-control form-control-sm 2select" id="subject"
                                    name="subject" required>
                                    <?= subjects::optionOrg(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-3">
                        <input type="submit" name="submitAttendance" class="btn btn-dark" value="تسجيل الطلاب">
                    </div>
                </form>
                <?php  }else{ ?>
                            <div class="card-body d-flex justify-content-sm-center">
                                <form class="form-inline" method="POST" onsubmit="submitForm(this, 'officer.php')" prevent-default>
                                    <input type="hidden" name="action" value="addExamBarcodes">
                                    <input type="hidden" class="form-control form-control-sm" name="subject" value="<?=$_POST['subject']?>">
                                    <input type="hidden" class="form-control form-control-sm" name="exam_type" value="<?=$_POST['exam_type']?>">

                                    <div class="row  ">
                                        <div class="form-group ">
                                            <input type="text" class=" form-control form-control" name="barCode" required autofocus
                                                onfocus="this.value=''">
                                            <label class="float-right ml-2"> :إدخل رقم الباركود <span class="text-danger">*</span> </label>
                                        </div>

                                    </div>

                                </form>
                                </div>
                                <div class="row d-flex justify-content-sm-center">
                                            <a class="btn btn-danger" href="index.php">إنتهاء</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
    } 

    public static function addExamAttendance($subject,$barCode,$type){
       
        //check for student status 
        // $studentAttendance = attendance::all_sql("WHERE `student_barcode` = $barCode AND `subject_id` = $subject");
        // $studentStatus = student::all_sql("WHERE `barcode_id` = $barCode")[0]['status'];
        // $statusName = student_status::where('id',$studentStatus)['name'];
        $nowDate = date("Y-m-d H:i:s");

        $student = student::where('barcode_id',$barCode);
        $studentGroup = $student['group_id'];
        $studentStatus = $student['status'];

        $studentAttendance = attendance::all_sql(" WHERE `student_barcode` = $barCode AND `subject_id` = $subject AND `group_id` = $studentGroup AND `group_id` = $studentGroup AND `register_date` <= '$nowDate' ");
        $allAttendance = attendance::all_sql(" WHERE `subject_id` = $subject  AND `group_id` = $studentGroup AND `register_date` <= '$nowDate' ");
        $attendanceCalc = count($allAttendance) - count($studentAttendance);
        if($type == 'final'){

            if( $attendanceCalc < 3   &&  $studentStatus == 6 &&  $studentStatus != 8 &&  $studentStatus != 9 ){
        
                $x = [];
                $x['subject_id'] = $subject;
                $x['student_barcode'] = $barCode;
                $x['date'] = date("Y-m-d H:i:s");

                // $oldBarcodes = attendace::all_Sql("WHERE `student_barcode` = $barCode AND ");
                $save = attendance_exams::saveArrayOrg($x);
                if($save){
                    $json['notifyDo'] =  ['type' => 'success', 'msg' => $barCode.' is verified successfully!'];
                    $json['reload'] = true;

                } else {
                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in Add Attendance Section'];
                }
                
            }else{
                $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Problem with Student Status'];
            }

        }else if($type == 'midterm'){

            if( $attendanceCalc < 2   &&  $studentStatus == 2 || $studentStatus == 6 &&  $studentStatus != 8 &&  $studentStatus != 9 ){
        
                $x = [];
                $x['subject_id'] = $subject;
                $x['student_barcode'] = $barCode;
                $x['date'] = date("Y-m-d H:i:s");

                // $oldBarcodes = attendace::all_Sql("WHERE `student_barcode` = $barCode AND ");
                $save = attendance_exams::saveArrayOrg($x);
                if($save){
                    $json['notifyDo'] =  ['type' => 'success', 'msg' => $barCode.' is verified successfully!'];
                    $json['reload'] = true;

                } else {
                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in Add Attendance Section'];
                }
                
            }else{
                $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Problem with Student Status'];
            }

        }
        exit(json_encode($json));
    }
   
}