<?php

class safeClass {
    
    public static function addStudentForm() {

        ?>
<div class="card card-danger ch-res">
    <div class="card-body">
        <form method="POST" class="chBranch" onsubmit="submitForm(this, 'safe.php')" prevent-default>
            <input type="hidden" name="action" value="addStudent">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>إسم الطالب</label>
                        <input class="form-control form-control-sm" name="name_ar" type="text" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الرقم القومى</label>
                        <input class="form-control form-control-sm" name="national_id" type="number" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>رقم التليفون</label>
                        <input class="form-control form-control-sm" name="phone_num" type="number" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>القسم</label>
                        <select class="form-control form-control-sm" name="department" required>
                            <?=departments::optionOrg()?>
                        </select>
                    </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="first_fund">
                                <label class="form-check-label" for="exampleCheck1">القسط الاول</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2" name="secound_fund">
                                <label class="form-check-label" for="exampleCheck2">القسط الثاني</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck3" name="third_fund">
                                <label class="form-check-label" for="exampleCheck3">القسط الثالث</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function addStudent($name_ar,$national_id,$phone_num,$department,$first,$secound,$third){
        

        //check if this student exists before
        $oldStudent = student::where('national_id',$national_id);
        if(!$oldStudent ){
            if(is_numeric($national_id) && strlen($national_id)  == 14 && is_numeric($phone_num) && strlen($phone_num) == 11 ){
                $x = [];
                $y = [];
                $h = [];
                $t = [];
                $payment =[];
                $regId = pay_for::where('name','registration form');
                $departmentinfo = departments::find($department);

                //saving student
                $x['name_ar'] = $name_ar;
                $x['national_id'] = $national_id;
                $x['date'] =   date("Y-m-d H:i:s");
                $x['status'] = 1;
                if($first != ''){
                    $x['status'] = 2;
                }
                     
                // $x['ph_num_one'] = $phone_num;
                // $saveStudent = student::saveArrayOrg($x);
                
                $y['student_id'] = student::saveArrayOrg($x);
                $y['ph_num_one'] = $phone_num;
                $y['dep_id'] = $department;
                $saveStudentDetails = student_details::saveArrayOrg($y);

            
                //regetration form payment
                $h['student_id'] =  $y['student_id'];
                $h['pay_for_id'] =  $regId['id'];
                $h['value'] =  $regId['price'];
                $h['date'] =   date("Y-m-d H:i:s");
                $h['status'] =   1;
                $payment[]  = payment::saveArrayOrg($h);
                if($first != ''){
                    //first fund form payment
                    $h['pay_for_id'] =  2;
                    $h['value'] =  $departmentinfo['frist_fund'];
                    $payment[]  = payment::saveArrayOrg($h);
                }
                if($secound != ''){
                    //secound fund form payment
                    $h['pay_for_id'] =  3;
                    $h['value'] =  $departmentinfo['secound_fund'];
                    $payment[]  = payment::saveArrayOrg($h);
                }
                if($third != ''){
                    //third fund form payment
                    $h['pay_for_id'] =  4;
                    $h['value'] =  $departmentinfo['third_fund'];
                    $payment[]  = payment::saveArrayOrg($h);
                }



                //first free trainning
                $t['student_id'] =  $y['student_id'];
                $t['training_id'] =  0; //not assigned yet
                $t['date'] =   date("Y-m-d");
                $t['is_paid'] =   0;
                $training  = student_training::saveArrayOrg($t);

                if($saveStudentDetails && $payment  && $training){
                    $json['notification'] =  ['type' => 'success', 'msg' => 'Student is Added successfully!'];
                    $json['reload'] =  true;
                } else {
                    $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Student Section'];
                }
                    // For Print
                    $output = receiptForm($payment);
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
            }else{
                $json['notification'] = ['type' => 'danger', 'msg' => 'National ID Must be 14 digit and phone number Must be 11 digit!'];
                exit(json_encode($json));
            }
        }else{
            $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Student Section'];
            $id = $oldStudent['id'];
            $json['redirect'] = "find_student.php?id=$id";
        }
         exit(json_encode($json));

    }
    public static function addTraineeForm() {

        ?>
        <div class="card card-danger ch-res">
            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'safe.php')" prevent-default>
                    <input type="hidden" name="action" value="addTrainee">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>إسم المتدرب</label>
                                <input class="form-control form-control-sm" name="name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الرقم القومى</label>
                                <input class="form-control form-control-sm" name="national_id" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رقم التليفون</label>
                                <input class="form-control form-control-sm" name="phone" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الدوره</label>
                                <select class="form-control form-control-sm" name="course">
                                    <?=course::optionOrg()?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function addTrainee($name,$national_id,$phone,$course){
        
            $price = course::find($course)['price'];
            $x = [];
            $h = [];
            //saving student
            $x['name'] = $name;
            $x['national_id'] = $national_id;
            $x['course_id'] = $course;
            // $x['user_id'] = $national_id;
            $x['date'] =   date("Y-m-d H:i:s");
            $x['phone'] = $phone;
            $saveTrainee = trainee::saveArrayOrg($x);


        
            //regetration form payment
            $h['trainee_id'] =  $saveTrainee;
            $h['pay_for_id'] =  11;
            $h['value'] =  $price;
            $h['date'] =   date("Y-m-d H:i:s");
            $h['status'] =   1;
            $payment  = payment::saveArrayOrg($h);





            if($saveTrainee && $payment ){
                $json['notification'] =  ['type' => 'success', 'msg' => 'Trainee is Added successfully!'];
                $json['reload'] =  true;
            } else {
                $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Trainee Section'];
            }
                // For Print
                $output = traineeForm($payment);
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
             
        
    public static function addExpenseForm(){

        ?>
        <div class="card card-danger ch-res">

            <div class="card-header ">إضافة نفقة</div>

            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'safe.php')" prevent-default>
                    <input type="hidden" name="action" value="addExpense">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>قيمة النفقة</label>
                                <input type="number" class="form-control form-control-sm" name="value">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>وصف النفقة</label>
                                <textarea class="form-control form-control-sm" name="description" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger">تقديم</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function changeStatusForm($id){

        ?>
        <div class="card card-danger ch-res">

            <div class="card-header ">غلق الملف</div>

            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'safe.php')" prevent-default>
                    <input type="hidden" name="action" value="changeStatus">
                    <input type="hidden" name="id" value="<?=$id?>">

                    <div class="form-group">
                        <label>السبب بالتفصيل</label>
                        <textarea class="form-control form-control-sm" name="note" rows="6" cols="50"></textarea>
                    </div>


                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger">غلق الملف</button>
                    </div>
                </form>

            </div>
        </div>
        <?php
    }

    public static function changeStatus($id,$note){

        $x = [];
        $y = [];
        $x['status'] = 9;
        $y['note'] = $note;
        $update = student::updateArrayOrg($x,'id',$id);
        $update = student_details::updateArrayOrg($y,'student_id',$id);

        if($update){
            $json['notification'] =  ['type' => 'success', 'msg' => 'Student is Closed successfully!'];
            $json['reload'] =  true;
        }else{
            $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in Close Student Section'];
        }
        exit(json_encode($json));
    }


    public static function addExpense($value,$description){

        $otherExpense = expense_for::where('name','other');

        $x = [];
        $x['expense_for_id'] = $otherExpense['id'];
        $x['value'] = $value;
        $x['student_id'] = 0;
        $x['employee_id'] = 0;
        $x['description'] = $description;
        $x['date'] = date("Y-m-d H:i:s");
        $x['status'] = 1;
        $save = expenses::saveArrayOrg($x);

        if($save){
            $json['notification'] =  ['type' => 'success', 'msg' => 'Expense is Added successfully!'];
            $json['reload'] =  true;
        }else{
            $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Expense Section'];
        }
        exit(json_encode($json));

    }

    public static function noInterviewtable(){
        ?>
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">الطلاب الغير مسجلين</h3>
    </div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>إسم الطالب</th>
                    <th>تغيير الحالة</th>

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
        "columns": [{
                "data": "id"
            },
            {
                "data": "student_name"
            },
            {
                "data": "change_status"
            }
        ],
        "ordering": false,
        "lengthMenu": [10, 25, 50, 100],
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: '../ajx/safe.php',
            data: {
                action: 'noInterviewtable'
            },
            type: 'POST'
        }
    });
});
</script>
<?php
    }

   


    public static function paymentForm($barCode = NULL){
        ?>
    <div class="card card-dark">
        <!-- <div class="card-header">
            <h3 class="card-title float-right" style="text-transform: capitalize;"> تسجيل مدفوعات الطلاب <i
                    class="fas fa-barcode"></i> </h3>
        </div> -->
        <div class="card-body ">
            <?php if($barCode == NULL ){ ?>
            <div class="card-body d-flex justify-content-sm-center">
                <form class="form-inline" method="POST">

                    <div class="row  ">
                        <div class="form-group ">
                            <input type="text" class=" form-control form-control" name="barCode" required autofocus
                                onfocus="this.value=''">
                            <label class="float-right ml-2"> :إدخل رقم الباركود <span class="text-danger">*</span> </label>
                        </div>

                    </div>

                </form>
            </div>
            <?php } else{ 
                $studentId = student::where('barcode_id',$barCode)['id'];

                student::getStudent($studentId);

                ?>
            <form method="POST" onsubmit="submitForm(this, 'safe.php')" prevent-default>
                <input type="hidden" name="action" value="addPaymentBarCode">
                <!-- <input type="hidden" name="barCode" value=""> -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>خيارات الدفع <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" name="pay_for_id"
                                    onchange="getOldVal($(this).children('option:selected'), {name:'pay_for_name', price:'pay_for_price', status:'pay_for_status'}, {link:'pay_for.php', action:'getOldVal'});"
                                    required>
                                    <?= payFor::optionOrg(""," `id` IN(5,10) "); ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>سعر الدفع</label>
                                <input type="number" min="0" class="form-control form-control-sm" name="pay_for_price">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ملحوظات</label>
                                <textarea class="form-control form-control-sm" name="description"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row selected-payFor mt-2 mb-4"></div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark">تسجيل</button>
                    </div>
                </div>
            </form>

            </form>
        </div>
    </div>
    <?php
            }
    }



   public function  addPayment($student_id,$pay_for_id,$pay_for_price,$description){
    
    $studentCheck = student::where('id',$student_id);

    if($studentCheck){
       $x = [];
       $x['student_id'] = $student_id;
       $x['pay_for_id'] = $pay_for_id;
       $x['value'] = $pay_for_price;
       $x['description'] = $description;
       $x['date'] =   date("Y-m-d H:i:s");
       $x['status'] = 1;
       $save = payment::saveArrayOrg($x);
       if($save){
        $json['notification'] =  ['type' => 'success', 'msg' => 'Payment is Added successfully!'];
        $json['reload'] =  true;
        }else{
            $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Payment Section'];
        }
    }else{
        $json['notification'] = ['type' => 'danger', 'msg' => 'No Student With This ID!'];

    }
    exit(json_encode($json));

   }


   public static function secoundRoundForm($barCode = NULL){
    ?>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-right" style="text-transform: capitalize;"> تسجيل مدفوعات الطلاب <i
                    class="fas fa-barcode"></i> </h3>
        </div>
        <div class="card-body ">
            <?php if($barCode == NULL ){ ?>
            <div class="card-body d-flex justify-content-sm-center">
                <form class="form-inline" method="POST">

                    <div class="row  ">
                        <div class="form-group ">
                            <input type="text" class=" form-control form-control" name="barCode" required autofocus
                                onfocus="this.value=''">
                            <label class="float-right ml-2"> :إدخل رقم الباركود <span class="text-danger">*</span> </label>
                        </div>

                    </div>

                </form>
            </div>
            <?php } else{ 
            $student = student::where('barcode_id',$barCode);
            $studentname = $student['name_ar'];
            $studentFall = results::custom_sql(" SELECT * FROM `results` WHERE 'SUM( `midterm`+`activity`+`attendace`+`final` )' < 50 AND `student_barcode_id` = $barCode  ");
            //$keys=array_values($studentFall); 
            //echo "<pre>";print_r($studentFall);echo "</pre>";
            // exit();
            if($studentFall){
                ?>
                <form method="POST" onsubmit="submitForm(this, 'safe.php')" prevent-default>
                    <input type="hidden" name="action" value="secoundRound">
                    <!-- <input type="hidden" name="barCode" value=""> -->

                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="float-right"> رقم الطالب <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="number" name="student_id"
                                    value="<?=$student['id']?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="float-right"> إسم الطالب <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm " type="text" name="student_name"
                                    value="<?=$studentname?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>إختر المادة <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="subject_id" 
                                     required>
                                        <?= subjects::optionsFall("","",$barCode); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع العملية <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="pay_for_id" 
                                    onchange="getOldVal($(this).children('option:selected'), {name:'pay_for_name', price:'pay_for_price', status:'pay_for_status'}, {link:'pay_for.php', action:'getOldVal'});" 
                                     required>
                                        <?= pay_for::optionOrg(""," `id` IN(15,16) "); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>سعر الدفع</label>
                                    <input type="number" min="0" class="form-control form-control-sm" name="pay_for_price" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ملحوظات</label>
                                    <textarea class="form-control form-control-sm" name="description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row selected-payFor mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark">تسجيل</button>
                        </div>
                    </div>
                </form>
            <?php }else { ?>

                <h3 class="text-center mt-4"> لا يوجد مواد رسب فيها الطالب</h3>
            <?php } ?>
        </div>
    </div>
    <?php
        }
 }

 public static function secoundRound($student_id,$subject_id,$pay_for_id,$pay_for_price,$description){

    $studentCheck = secound_round::where('student_id',$student_id);
    $studentCheck = secound_round::all_sql("WHERE `subject_id` = $subject_id   AND `student_id` =  $student_id ");
    // echo pay_for::where('id',$pay_for_id)['name_ar'];
    // exit();
    if( !$studentCheck ){
       $y = [];
       $x = [];
       $x['student_id'] = $student_id;
       $x['pay_for_id'] = $pay_for_id;
       $x['value'] = $pay_for_price;
       $x['description'] = $description;
       $x['date'] =   date("Y-m-d H:i:s");
       $x['status'] = 1;
       $save = payment::saveArrayOrg($x);

        //make secound_round record
       $y = [];
       $y['payment_id'] = $save;
       $y['subject_id'] = $subject_id;
       $y['status'] = pay_for::where('id',$pay_for_id)['name_ar'];
       $y['student_id'] = $student_id;
       $y['action'] = 2;
       $save2 = secound_round::saveArrayOrg($y);

       if($save2){

        $json['notification'] =  ['type' => 'success', 'msg' => 'Payment is Added successfully!'];
        $json['reload'] =  true;
        }else{
            $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Payment Section'];
        }
    }else{
        $json['notification'] = ['type' => 'danger', 'msg' => 'This Payment Made Before!'];

    }
    exit(json_encode($json));
 }
 public static function secoundRoundTable(){

    ?>      
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">طلبات الخزنة</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>إسم الطالب</th>
                            <th>نوع الطلب</th>
                            <th>الحالة</th>
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
                            {"data": "student_id"},
                            {"data": "status"},
                            {"data": "action"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/safe.php',
                            data: {action:'secoundRoundTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
 }
 public static function secoundRoundAction($id,$action){
     $x = [];
     $x['action'] = $action;
     $update = secound_round::updateArrayOrg($x,'id',$id);
     if($update){
        $json['notification'] =  ['type' => 'success', 'msg' => 'Payment is Updated successfully!'];
        $json['reload'] =  true;
    }else{
        $json['notification'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in Update Payment Section!'];
    }
    exit(json_encode($json));
 }



}