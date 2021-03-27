<?php

class student extends model
{
    protected $table = '`student`';

    public static function addForm($id = 0) {

        // calculate age using js 
        ?>
        <script>
            $(document).on('change ','#dob',function(){
                var dob = $(this).val();
                dob = new Date(dob);
                var today = new Date();
                var years = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                var monthes = today.getMonth()- dob.getMonth();
                if(monthes < 0 ){
                    monthes +=12;
                }
                $('#age').html(' سنين '+ years+' شهور '+ monthes  ); 
            });
        </script>
    
        <?php
        //end calculate age


        $student = Null;$studentDetails = Null; $studentDetails = Null; 
        $refOne = Null; $refTwo = Null; $problem = Null;$medical = Null;

        if($id > 0){
            $student = student::find($id);
            $studentDetails = student_details::all_sql("WHERE `student_id` =  $id ");
            $studentDetails = $studentDetails[0];
            
            $refOne = json_decode($studentDetails['ref_one'], true);
            $refTwo = json_decode($studentDetails['ref_one'], true);
            $problem = json_decode($studentDetails['problem'], true);
            $medical = json_decode($studentDetails['medical'], true);

        }
        ?>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> طالب جديد</h3>
            </div>
            <div class="card-body">
                <form method="post" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="addStudent">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <small>ENG</small> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="name" placeholder="Student Name"
                                   value="<?=$student['name']?>"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الاسم <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control form-control-sm" name="name_ar"
                                    value="<?=$student['name_ar']?>"  placeholder="Student Name in Arabic" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> المؤهل <span class="text-danger">*</span></label>
                                <select value="<?=$studentDetails['qual_id']?>" class="form-control form-control-sm 2select" id="qual" name="qual_id" required>
                                    <?= qualifications::option($studentDetails['qual_id']); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> التخصصات <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="spec" name="spec_id" required>
                                    <?= specializations::option($studentDetails['spec_id']); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> سنة التخرج <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1970" step="1" id="qrad-year"
                                    value="<?=$studentDetails['graduation_year']?>"  name="graduation_year" placeholder="Graduation Year" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> العنوان <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control form-control-sm" id="address" cols="30"
                                 rows="1"><?=$studentDetails['address']?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم الهاتف <sup>الأول <span class="text-danger">*</span> </sup></label>
                                <input type="text" name="ph_num_one" class="form-control form-control-sm" id="ph-num-one"
                                 value="<?=$studentDetails['ph_num_one']?>"  placeholder="Mobile Number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم الهاتف<sup>الثاني</sup></label>
                                <input type="text" name="ph_num_two" class="form-control form-control-sm" id="ph-num-two"
                                 value="<?=$studentDetails['ph_num_two']?>"  placeholder="Mobile Number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم الهاتف الأرضي</label>
                                <input type="text" name="home_num" class="form-control form-control-sm" id="home-num"
                                value="<?=$studentDetails['home_num']?>"  placeholder="Home Number">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الحالة العسكرية <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="military" name="military_status_id"
                                    required>
                                    <?= military_status::option($studentDetails['military_status_id']); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الحالة الاجتماعية <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="social" name="social_status_id"
                                    required>
                                    <?= social_status::option($studentDetails['social_status_id']); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>الرقم القومي<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="national_id"
                                value="<?=$student['national_id']?>"  placeholder="National ID" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>رقم الباركود </label>
                                <input type="text" class="form-control form-control-sm" name="barcode_id"
                                value="<?=$student['barcode_id']?>" placeholder="Barcode ID" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>تاريخ الميلاد <span class="text-danger">*</span></label>
                                <input type="date" value="<?=$studentDetails['dob']?>"  class="form-control form-control-sm" id="dob" name="dob" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>العمر <span class="text-danger">*</span></label>
                                <div id="age" name="age"></div>
                                <!-- <input type="number" class="form-control form-control-sm" min="5" max="100" id="age" name="age"
                                value="" placeholder="Age" required> -->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>إسم ولي الأمر <sup>الأول <span class="text-danger">*</span></sup></label>
                                <input type="text" class="form-control form-control-sm" name="ref_name_one"
                                 value="<?=$refOne['name']?>"  placeholder="Reference Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم هاتف ولى الأمر <sup>الأول <span class="text-danger">*</span></sup></label>
                                <input type="text" class="form-control form-control-sm" name="ref_ph_one"
                                    value="<?=$refOne['mobile']?>"   placeholder="Reference Mobile" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>علاقة ولي الأمر <sup>الأول <span class="text-danger">*</span></sup></label>
                                <select class="form-control form-control-sm 2select" id="ref-rel-one" name="ref_rel_one"
                                    required>
                                    <?= relation_status::optionOrg($refOne['relation']) ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>إسم ولي <sup>الثاني</sup></label>
                                <input type="text" class="form-control form-control-sm" name="ref_name_two"
                                value="<?=$refTwo['name']?>"  placeholder="Reference Name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>رقم هاتف ولي الأمر <sup>الثاني</sup></label>
                                <input type="text" class="form-control form-control-sm" name="ref_ph_two"
                                 value="<?=$refTwo['mobile']?>" placeholder="Reference Mobile">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>علاقة ولي الأمر <sup>الثاني</sup></label>
                                <select class="form-control form-control-sm 2select" id="ref-rel-two" name="ref_rel_two">
                                <?= relation_status::optionOrg($refTwo['relation']) ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>القسم <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="dep-id" name="dep_name" value="<?= departments::where('id',$studentDetails['dep_id'])['name']?>" readonly>
                                <input type="hidden"  name="dep_id" value="<?= $studentDetails['dep_id']?>" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>غرض الإنضمام <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="join-purpose-id" name="join_purpose_id"
                                    required>
                                    <?= joining_purposes::option($studentDetails['join_purpose_id']); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label> هل تم فصلك من مؤسسة أو كلية أخرى لأسباب تأديبية أو لأسباب أخرى؟ </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm 2select" id="problem-ans" name="problem_ans" >
                                    <option>إختر إجابة</option>
                                    <option value="yes" <?= ($problem['answer'] == 'yes') ?  'selected' :''?>>نعم</option>
                                    <option value="no"  <?= ($problem['answer'] == 'no')  ?  'selected' :''?>>لا</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> سبب الإقالة؟</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control form-control-sm" name="problem_reason" id="problem-reason"
                                    cols="30" rows="1" value="Nothing"><?=$problem['reason']?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label> هل تعاني من مشاكل طبية أو صحية أو نفسية؟ </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm 2select" id="medical-ans" name="medical_ans" >
                                    <option>إختر إجابة</option>
                                    <option value="yes" <?= ($medical['answer'] == 'yes') ?  'selected' :''?>>نعم</option>
                                    <option value="no"  <?= ($medical['answer'] == 'no')  ?  'selected' :''?>>لا</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> المرض أو اسم العملية؟</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control form-control-sm" name="medical_disease" id="medical-disease"
                                    cols="30" rows="1" value="Nothing"><?=$medical['disease']?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label> هل لديك دورات كمبيوتر؟ </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm 2select" id="com-skills" name="computer_skills" >
                                    <option>إختر إجابة</option>
                                    <option value="yes" <?= ($studentDetails['computer_skills'] == 'yes') ?  'selected' :''?> >نعم</option>
                                    <option value="no"  <?= ($studentDetails['computer_skills'] == 'no') ?  'selected' :''?> >لا</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> مهارات عامة ؟</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control form-control-sm" name="general_skills" id="gen-skills" cols="30"
                                    rows="1" value="Nothing"><?=$studentDetails['general_skills']?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label> كيف سمعت عنا ؟ <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm 2select" id="source" name="source_id" required>
                                    <?= resources::option($studentDetails['source_id']) ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> اسم الشخص</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control form-control-sm" name="resource_name" id="resource_name"
                                    cols="30" rows="1" value="Nothing"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label> أي فرع من الأركان تريد الانضمام إليه؟ <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm 2select" id="branch_id" name="branch_id" required>
                                    <?= branches::optionOrg($student['branch_id']) ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer text-center" style="background-color:#FFF;">
                        
                        <button type="submit" class="btn btn-dark"><?= ($id > 0) ?  'تعديل الطالب' :'إضافة الطالب'?></button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    public static function addStudent($data) {
        $student = [];
        $studentDetails = [];
        $student['date'] = date("Y-m-d H:i:s");

        foreach($data as $k => $val) {
           
            if ($k == 'name' || $k == 'name_ar' || $k == 'national_id' || $k == 'barcode_id' || $k == 'branch_id') {
                $student[$k] = $val;
            } else {
                $ignore = ['ref_name_one', 'ref_ph_one', 'ref_rel_one', 'ref_name_two', 'ref_ph_two', 
                           'ref_rel_two', 'medical_ans', 'medical_disease', 'problem_ans', 'problem_reason', 'id'];
                !in_array($k, $ignore) ? $studentDetails[$k] = $val : '';
            }
        }

        $student['status'] = 1; // 1 for [ student has a form ]

        $studentDetails['ref_one'] = json_encode([
            "name"     => $data['ref_name_one'],
            "mobile"   => $data['ref_ph_one'],
            "relation" => relation_status::find($data['ref_rel_one'])['name']
        ], JSON_UNESCAPED_UNICODE);

        $studentDetails['ref_two'] = json_encode([
            "name"     => !empty($data['ref_name_two']) ? $data['ref_name_two'] : '',
            "mobile"   => !empty($data['ref_ph_two'])   ? $data['ref_ph_two']   : '',
            "relation" => !empty($data['ref_rel_two'])  ? relation_status::find($data['ref_rel_two'])['name']  : ''
        ], JSON_UNESCAPED_UNICODE);

        $studentDetails['medical'] = json_encode([
            "answer"  => $data['medical_ans'],
            "disease" => !empty($data['medical_disease']) ? $data['medical_disease'] : ''
        ], JSON_UNESCAPED_UNICODE);

        $studentDetails['problem'] = json_encode([
            "answer"  => $data['problem_ans'],
            "reason" => !empty($data['problem_reason']) ? $data['problem_reason'] : ''
        ], JSON_UNESCAPED_UNICODE);

        $uId = $_SESSION['userid'];



        switch($data['id']) {
            case 0:
                $s = new student;
                foreach($student as $k => $val) {
                    $s->$k = $val;
                }

                $sId = $s->save($uId);
                
                if ($sId) {
                    $studentDetails['student_id'] = $sId;
                    $detailsAdded = self::addStudentDetails($studentDetails);
                    if ($_SESSION['user_type'] == 4) {
                        $json['notifyDo'] = $detailsAdded ? ['type' => 'success', 'msg' => 'Student is added successfully!', 'redirectTo' => 'photo_add.php?id=$sId'] : ['type' => 'danger', 'msg' => 'Something Wrong!'];
                    }else{
                        $json['notifyDo'] = $detailsAdded ? ['type' => 'success', 'msg' => 'Student is added successfully!', 'redirectTo' => 'index.php'] : ['type' => 'danger', 'msg' => 'Something Wrong!'];
                    }

                } else {
                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in add Student Section'];
                }


                // add payment two records  
                $regForm = pay_for::where('name','registration form');
                $firstFund =pay_for::where('name','1st fund');
                    //reg form record
                    $x = [];
                    $x['student_id'] = $sId;
                    $x['pay_for_id'] = $regForm['id'];
                    $x['value'] =  $regForm['price'];
                    $x['date'] = date("Y-m-d H:i:s");
                    $x['status'] = 0;
                    $saveReg = payment::saveArrayOrg($x);
                    if($saveReg){
                    //1st fund  record
                    $y = [];
                    $y['student_id'] = $sId;
                    $y['pay_for_id'] = $firstFund['id'];
                    $y['value'] =  $firstFund['price'];
                    $y['date'] = date("Y-m-d H:i:s");
                    $y['status'] = 0;
                    $saveReg = payment::saveArrayOrg($y);
                    }
                //add resource name
                if($data['source_id']){
                    $z=[];
                    $z['resource_id'] = $data['source_id'];
                    $z['name'] = $data['resource_name'];
                    about_us::saveArrayOrg($z);
                }


                // For Print
                    if ($detailsAdded) {
                        $output = registrationForm($data);
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
                    }
                // ---

                exit(json_encode($json));
                break;
            default:
                // for update student data
                $student['id'] = $data['id'];
                $s = new student;
                foreach($student as $k => $val) {
                    $s->$k = $val;
                }
                // echo strlen($s->national_id);
                // var_dump($s);exit();
                if(strlen($s->national_id) != 14){

                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'National ID Should Be 14 Digits!!'];
                    exit(json_encode($json));
                }
                // echo strlen($studentDetails['ph_num_one']);
                // echo "<br>";
                // echo strlen($studentDetails['ph_num_two']);
                // exit();
                if($studentDetails['ph_num_one'] && strlen($studentDetails['ph_num_one']) != 11 || $studentDetails['ph_num_two'] && strlen($studentDetails['ph_num_two']) != 11){

                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Phone Number Should Be 11 number Length!!'];
                    exit(json_encode($json));
                }
                //exit();

                $sId = $s->update($uId);
                
                if ($sId) {

                        $studentDetails['student_id'] =$data['id'];
                        $detailsAdded = self::updateStudentDetails($studentDetails,$data['id'],$uId);

                        // --   
                        if ($_SESSION['user_type'] == 4) {

                            $data['dep_id'] = departments::where('name',$data['dep_id'])['id'];
            
                            $output = registrationForm($data);
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

                            $json['notifyDo'] = $detailsAdded ? ['type' => 'success', 'msg' => 'Student is added successfully!', 'script' => '<script>printIt("'.$output.'");</script>', 'redirectTo' => 'photo_add.php?id='.$data["id"].''] : ['type' => 'danger', 'msg' => 'Something Wrong!'];
                        
                        }else{
                            $json['notifyDo'] = $detailsAdded ? ['type' => 'success', 'msg' => 'Student is added successfully!', 'redirectTo' => 'index.php'] : ['type' => 'danger', 'msg' => 'Something Wrong!'];
                        }
                }else{
                    $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong! May be in update Student Section'];
                }
                // ---

                exit(json_encode($json));
                break;
        }

    }

    public static function pay($student_id, $value, $pay_for) {
        $payment = new payment;
        $payment->student_id = $student_id;
        $payment->pay_for_id = $pay_for;
        $payment->value      = $value;
        $payment->date       = date("Y-m-d H:i:s");
        return $payment->save($_SESSION['userid']);
    }

    public static function expense($student_id, $value, $expense_for) {
        $expense = new expenses;
        $expense->student_id     = $student_id;
        $expense->expense_for_id = $expense_for;
        $expense->value          = $value;
        $expense->date           = date("Y-m-d H:i:s");
        return $expense->save($_SESSION['userid']);
    }

    public static function addStudentDetails($data) {
        $sDetails = new student_details;
        foreach($data as $k => $val) {
            $sDetails->$k = $val;
        }
       
        return $sDetails->save($_SESSION['userid']);
    }

    public static function updateStudentDetails($data,$sId,$uId) {
        
        $sdId = student_details::where("student_id",$sId)['id'];
        $sDetails = new student_details;
        foreach($data as $k => $val) {
            $sDetails->$k = $val;
        }
        $sDetails->id = $sdId;
        // echo "<pre>";print_r($sDetails);echo "</pre>";
        return $sDetails->update($uId);
    }

    public static function getStudents($draw, $start, $length,$condation = " where 1 = 1 ") {

        $data         = [];
        $students     = student::all_sql(" $condation  limit $start, $length ");
        $recordsTotal = $recordsFiltered = student::count_sql($condation);
        foreach($students as $student) {
            $id = $student['id'];
            $row['id']     = $student['id'];
            $row['name']   = ucwords($student['name']);
            $row['name_ar']   = ucwords($student['name_ar']);
            $row['action'] = '';
            if($student['status'] == 1){
                $row['action'] = "<a href='edit_student.php?id=$id' class='btn btn-primary'>تسجيل البيانات</a>";
            }
            $data[]        = $row;
        }
        $response = array(
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        );
        echo json_encode($response);
        
    }

    public static function findForm() {
        ?>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> بحث عن طالب
                    <div class="form-inline float-right">
                        <a href="index.php" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> &nbsp; Students</a>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                <form method="GET" onsubmit="submitForm(this, 'student.php')">
                    <div class="form-group">
                        <label>إختر طالب:</label>
                        <select class="2select form-control pb-2 pb-2" id="student" name="id" required></select>
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-dark" value="بحث">
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    public static function findStudent($search) {
        $query = '';
        $flag = '';
        $res = [];
        $row = [];

        if($_SESSION['user_type'] == 3){
                $q = model::custom_sql("SELECT  `s`.`name` , `p`.`student_id` 
                                        FROM `student` AS `s` LEFT JOIN `payment` AS `p`
                                        ON `s`.`id` = `p`.`student_id`
                                        WHERE `p`.`status` = 0 AND `s`.`name` LIKE '%$search%' LIMIT 1")[0];
                // echo "<pre>";print_r($q);echo "</pre>";
                if($q){

                    $row['id'] = $q['student_id']; 
                    $row['text'] = $q['name'];
                    $res[] = $row;
                }
                
        }else{
            if (preg_match("/^[a-zA-Z]+/", $search)) {
                $query = "WHERE name LIKE '$search%'";
                $flag = 'name';
            } else if (preg_match("/^(010|011|012|015)[0-9]+/", $search)) {
                $query = "WHERE ph_num_one LIKE '$search%' OR ph_num_two LIKE '$search%'";
                $flag = 'phone';
            } else if (preg_match("/^(2|3)[0-9]+/", $search)) {
                $query = "WHERE national_id LIKE '$search%'";
                $flag = 'national';
            } else {
            // $query = "";  // Not Working, Waiting for barcode details.
            }

            switch ($flag) {
                case 'name' :
                case 'national' :
                    $students = student::all_sql($query);
                    if (!empty($students)) {
                        foreach($students as $val) {
                            $row['id'] = $val['id']; 
                            $row['text'] = $val['name'];
                            $res[] = $row;
                        }
                    }
                break;
                case 'phone' :
                    $studentDetails = student_details::all_sql($query);
                    if (!empty($studentDetails)) {
                        foreach($studentDetails as $val) {
                            $row['id'] = $val['student_id']; 
                            $row['text'] = student::find($val['student_id'])['name'];
                            $res[] = $row;
                        }
                    }
                break;
                default:
                    $res[] = ['text' => 'Not Found'];
                break;
            }
        }

        empty($res) ? $res[] = ['text' => 'Not Found'] : '';
        echo json_encode($res);
    }

    public static function getStudent($id) {
        $student        = student::find($id);
        $studentDetails = student_details::where('student_id', $id);
        $status         = student_status::find($student['status'])['name'];
        $department     = departments::find($studentDetails['dep_id'])['name'];
        
        ?>
        <div class="card card-dark student">
            <div class="card-header" style="height:3em;">
                <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> <?=ucwords(strtolower($student['name']))?>
                    &nbsp; | &nbsp;<?= $student['name_ar'] ?>

                    <?php if($_SESSION['user_type'] == 1){  ?>
                    <div class="form-inline float-right">
                    <a href="edit_student.php?id=<?=$id?>" class="btn btn-info mr-2 btn-sm"> <i class="fa fa-pencil-square-o"></i> &nbsp;
                            تعديل الطالب</a>
                        <a href="find_student.php" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left fa-sm"></i> &nbsp;
                            رجوع</a>
                    </div>

                    <?php }?>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>الرقم القومي</th>
                            <th>رقم الباركود</th>
                            <th>القسم</th>
                            <th>أرقام الهاتف</th>
                            <th>ملحوظات</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $student['id'] ?></td>
                            <td><?= $student['national_id'] ?></td>
                            <td><?= $student['barcode_id'] ?></td>
                            <td><?= $department ?></td>
                            <td><?= $studentDetails['ph_num_one'] ?> <br> <?= $studentDetails['ph_num_two'] ?> </td>
                            <td><?= $studentDetails['note'] ?></td>
                            <td><span class="status"><?= ucwords($status) ?></span></td>
                        </tr>
                    </tbody>
                </table>

                    <?= self::optionBtns($id) ?>


                </div>
        </div>
        <!-- For retrieving data coming form ajx request for any button  -->
        <div class="more-details mt-3"></div>
        <?php
    }

    public static function studentDetails($id) {
        $studentDetails = student_details::where('student_id', $id);
        $qual    = qualifications::find($studentDetails['qual_id'])['name'];
        $spec    = specializations::find($studentDetails['spec_id'])['name'];
        $mili    = military_status::find($studentDetails['military_status_id'])['name'];
        $soci    = social_status::find($studentDetails['social_status_id'])['name'];
        $join    = joining_purposes::find($studentDetails['join_purpose_id'])['name'];
        $reso    = resources::find($studentDetails['source_id'])['name'];
        $ref_one = json_decode($studentDetails['ref_one']);
        $ref_two = json_decode($studentDetails['ref_two']);
        $problem = json_decode($studentDetails['problem']);
        $medical = json_decode($studentDetails['medical']);

        ?>
        <div class="card card-info stud-details">
            <div class="card-header" onclick="slideToggleDiv('.stud-details')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table text-center mb-4">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>رقم المنزل</th>
                            <th>تاريخ الميلاد</th>
                            <th>العمر</th>
                            <th>المؤهلات</th>
                            <th>التخصص</th>
                            <th>سنة التخرج</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $studentDetails['address'] ?></td>
                            <td><?= $studentDetails['home_num'] ?></td>
                            <td><?= $studentDetails['dob'] ?></td>
                            <td><?= $studentDetails['age'] ?></td>
                            <td><?= $qual ?></td>
                            <td><?= $spec ?></td>
                            <td><?= $studentDetails['graduation_year'] ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table text-center mb-4">
                    <thead>
                        <tr>
                            <th>الحالة العسكرية</th>
                            <th>الحالة الإجتمعاية</th>
                            <th>سبب الإنضمام</th>
                            <th>مصادر</th>
                            <th>مهارات الحاسوب</th>
                            <th>مهارات عامة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $mili ?></td>
                            <td><?= $soci ?></td>
                            <td><?= $join ?></td>
                            <td><?= $reso ?></td>
                            <td><?= $studentDetails['computer_skills'] ?></td>
                            <td><?= $studentDetails['general_skills'] ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table text-center mb-4">
                    <thead>
                        <tr>
                            <th>العلاقة</th>
                            <th>الإسم</th>
                            <th>رقم الهاتف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $ref_one->relation ?></td>
                            <td><?= $ref_one->name ?></td>
                            <td><?= $ref_one->mobile ?></td>
                        </tr>
                        <tr>
                            <td><?= $ref_two->relation ?></td>
                            <td><?= $ref_two->name ?></td>
                            <td><?= $ref_two->mobile ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table text-center mb-4">
                    <thead>
                        <tr>
                            <th>لدية مشكلة</th>
                            <th>السبب</th>
                            <th>المشاكل الطبية</th>
                            <th>المرض</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $problem->answer ?></td>
                            <td><?= $problem->reason != '' ? $problem->reason : 'Not Found'; ?></td>
                            <td><?= $medical->answer ?></td>
                            <td><?= $medical->disease != '' ? $medical->disease: 'Not Found';?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public static function addInterviewResForm($id) {
        $statusId = student::find($id)['status'];
        ?>
        <div class="card card-warning stud-inter-res">
            <div class="card-header" onclick="slideToggleDiv('.stud-inter-res')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="addInterForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="addInterRes">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Status <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="stu_sta_id" required>
                                    <?= student_status::option("", "`id` > $statusId AND `id` <= 5"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning"
                            onclick="hideElem('.stud-inter-res', '.addInterForm')">تحديث الحالة</button>
                    </div>
                </form>

            </div>
        </div>
        <?php
    }

    public static function addInterRes($id, $status_id) {
        $student = new student;
        $student->id = $id;
        $student->status = $status_id;
        if ($student->update($_SESSION['userid'])) {
            $status = student_status::find($status_id)['name'];
            $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status').fadeIn();</script>";
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Interview Result Is added Successfully', 'script' => $script];
            exit(json_encode($json));
        }
    }

    public static function interviewInfo($id) {
        $statusId = student::find($id)['status'];
        ?>
        <div class="card card-success stud-inter-info">
            <div class="card-header" onclick="slideToggleDiv('.stud-inter-info')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <?php
                                switch($statusId) {
                                    // delayed
                                    case 4:
                                        ?> <h3 class="text-center text-warning">The student is Delayed for next year.</h3> <?php
                                    break;
                                    // unaccepted
                                    case 5:
                                        ?> <h3 class="text-center text-danger">The student is Unaccepted.</h3> <?php
                                    break;
                                    // delayed
                                    case 7:
                                    ?> <h3 class="text-center text-muted">The student retrieves his money</h3> <?php
                                    break;
                                    // accepted
                                    default:
                                        ?> <h3 class="text-center text-success">The student is Accepted.</h3> <?php
                                    break;
                                }
                            ?>
            </div>
        </div>
        <?php
            }

   
    
    public static function payFormFundForm($id) {
        $pay   = payFor::where('name', 'registration form');
        $payId = $pay['id'];
        $fund  = $pay['price'];
        ?>
        <div class="card card-dark stud-form-fund">
            <div class="card-header" onclick="slideToggleDiv('.stud-form-fund')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="formFundForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="payFormFund">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?=$fund?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("$payId", "`id` = $payId"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark"
                            onclick="hideElem('.stud-form-fund', '.formFundForm')">Pay</button>
                    </div>
                </form>

                </div>
            </div>
        <?php

    }

    public static function payFormFund($id, $fund, $pay_for ,$status) {

        //update old payment
        if($pay_for == 1){

                    $update = model::custom_sql("UPDATE `payment` SET `status` = 1 WHERE `student_id` = '$id' AND `pay_for_id` = '$pay_for' AND `status` = 0 ");
     
                    $student = new student;
                    $student->id = $id;
                    $student->status = 1;
                    if ($student->update($_SESSION['userid'])) {                
                        $status = student_status::find(1)['name'];
                        $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status').fadeIn();</script>";
                        $json['notifyDo'] = ['type' => 'success', 'msg' => 'The First fund is paid successfully', "redirectTo" => "requests.php"];
                        //$json['redirect'] = "../safe/requests.php";
                        exit(json_encode($json));

            }
        }

        else{
                if (self::pay($id, $fund, $pay_for ,$status)){
                    $student = new student;
                    $student->id = $id;
                    $student->status = 1;

                    if ($student->update($_SESSION['userid'])) {                
                        $status = ucwords(student_status::find(1)['name']);
                        $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status and Piad for It').fadeIn();</script>";
                        $json['notifyDo'] = ['type' => 'success', 'msg' => 'The Form fund is paid successfully', 'script' => $script];
                        $json['redirect'] = "../safe/requests.php";
                        exit(json_encode($json));
                    }
                }
        }

    }

    public static function payFirstFundForm($id,$payId) {
        $fund = payFor::where('name', '1st fund')['price'];
        ?>
        <div class="card card-danger stud-first-fund">
            <div class="card-header" onclick="slideToggleDiv('.stud-first-fund')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="firstFundForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="payFirstFund">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="payId" value="<?= $payId; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?=$fund?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("2", "`id` = 2"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger"
                            onclick="hideElem('.stud-first-fund', '.firstFundForm')">Pay</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function payFirstFund($id,$payId, $fund, $payForId,$status) {

                
        $x = [];
        $x['status'] = $status;
        $update = payment::updateArrayOrg($x,'id',$payId);


        if($update ){

            //make secound form request to safe
            $secoundFund = pay_for::where('name','2nd fund');
            $h['student_id'] =  $id;
            $h['pay_for_id'] =  $secoundFund['id'];
            $h['value'] =  $secoundFund['price'];
            $h['date'] =   date("Y-m-d H:i:s");
            $h['status'] =   0;
            $secoundFundPayment  = payment::saveArrayOrg($h);


            $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status').fadeIn();</script>";
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'The First fund is paid successfully', "redirectTo" => "requests.php"];

        }else{
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while paying First fund!', "redirectTo" => "requests.php"];
        }
        // For Print      
        $output = receiptForm($payId);
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



    public static function paySecondFundForm($id,$payId) {
        $fund = payFor::where('name', '2nd fund')['price'];
        ?>
        <div class="card card-danger stud-second-fund">
            <div class="card-header" onclick="slideToggleDiv('.stud-second-fund')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="secondFundForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="paySecondFund">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="payId" value="<?= $payId; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?= $fund ?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("3", "`id` = 3"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger"
                            onclick="hideElem('.stud-second-fund', '.secondFundForm')">Pay</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function paySecondFund($id,$payId, $fund, $payForId,$status) {

        $x = [];
        $x['status'] = $status;
        $update = payment::updateArrayOrg($x,'id',$payId);
        if($update){
            $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status').fadeIn();</script>";
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'The second fund is paid successfully', "redirectTo" => "requests.php"];

        }else{
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while paying second fund!', "redirectTo" => "requests.php"];
        }
        // For Print      
        $output = receiptForm($payId);
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


    public static function payLostCardForm($id,$payId) {
        $fund = payFor::where('name', 'Lost Card')['price'];
        ?>
        <div class="card card-danger stud-lost-card">
            <div class="card-header" onclick="slideToggleDiv('.stud-lost-card')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="lostCardForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="payLostCard">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="payId" value="<?= $payId; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?= $fund ?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("6", "`id` = 6"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger"
                            onclick="hideElem('.stud-lost-card', '.lostCardForm')">Pay</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }



    public static function payLostCard($id,$payId, $fund, $payForId,$status) {

        $x = [];
        $x['status'] = $status;
        $update = payment::updateArrayOrg($x,'id',$payId);
        if($update){

            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Lost Card Paid Successfully.', "redirectTo" => "requests.php"];
           
        }else{
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while paying Lost Card!', "redirectTo" => "requests.php"];
        }
        // For Print      
        $output = receiptForm($payId);
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

    public static function payReEnrollmentForm($id,$payId) {
        $fund = payFor::where('name', 'Re-enrollment')['price'];
        ?>
        <div class="card card-danger stud-re-enroll">
            <div class="card-header" onclick="slideToggleDiv('.stud-re-enroll')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="reEnroll" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="payReEnrollment">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="payId" value="<?= $payId; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?= $fund ?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("9", "`id` = 9"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger"
                            onclick="hideElem('.stud-re-enroll', '.reEnroll')">Pay</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }


    public static function payReEnrollment($id,$payId, $fund, $payForId,$status){

        $x = [];
        $x['status'] = 1;
        $update = payment::updateArrayOrg($x,'id',$payId);
        if($update){
            $json["notifyDo"] = ["type" => "success", "msg" => "Re-enrollment Paid Successfully.", "redirectTo" => "requests.php"];

        }else{
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while paying for Re-enrollment!', "redirectTo" => "requests.php"];
        }
        // For Print      
        $output = receiptForm($payId);
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

    public static function payCollectionForm($id,$payId) {
        $fund = payFor::where('name', 'collection')['price'];
        ?>
        <div class="card card-danger stud-collection">
            <div class="card-header" onclick="slideToggleDiv('.stud-collection')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="collection" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="payCollection">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="payId" value="<?= $payId; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fund Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?= $fund ?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pay For <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="stu-sta" name="pay_for_id" required>
                                    <?= payFor::option("7", "`id` = 7"); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger"
                            onclick="hideElem('.stud-collection', '.collection')">Pay</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }


    public static function payCollection($id,$payId, $fund, $payForId,$status){

        $x = [];
        $x['status'] = 1;
        $update = payment::updateArrayOrg($x,'id',$payId);
        if($update){
            $json["notifyDo"] = ["type" => "success", "msg" => "Collection Paid Successfully.", "redirectTo" => "requests.php"];

        }else{
        $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Error while paying for Collection!', "redirectTo" => "requests.php"];
        }
        
        // For Print      
        $output = receiptForm($payId);
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



    public static function returnFirstFundForm($id) {
        $exp = expenseFor::where('name', 'ex 1st fund');
        $fund = $exp['price'];
        $expId = $exp['id'];
        ?>
        <div class="card card-danger stud-first-fund">
            <div class="card-header" onclick="slideToggleDiv('.stud-first-fund')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" class="firstFundForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                <input type="hidden" name="action" value="returnFirstFund">
                <input type="hidden" name="id" value="<?= $id; ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fund Value <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                value="<?=$fund?>" readOnly required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expense For <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm 2select" id="stu-sta" name="expense_for_id"
                                required>
                                <?= expenseFor::option("$expId", "`id` = $expId"); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-danger"
                        onclick="hideElem('.stud-first-fund', '.firstFundForm')">Return</button>
                </div>
            </form>

        </div>
        </div>
        <?php
    }

    public static function returnFirstFund($id, $fund, $expense_for) {
        if (self::expense($id, $fund, $expense_for)) {
            $student = new student;
            $student->id = $id;
            $student->status = 7;
            if ($student->update($_SESSION['userid'])) {                
                $status = student_status::find(7)['name'];
                $script = "<script>ajxReq('student.php', {action:'optionBtns', id:$id}, '.option-btns', true); $('table span.status').fadeOut(50).empty().append('$status').fadeIn();</script>";
                $json['notifyDo'] = ['type' => 'success', 'msg' => 'The First fund is paid successfully', 'script' => $script];
                exit(json_encode($json));
            }
        }

    }

    public static function studentResult($id) {
       
        $student  = student::find($id);
        if (!$student) {
            $r = '{"notifyDo": {"type": "danger","msg": "Not A Student!", "redirectTo": "student_result.php"}}';
            $r = json_encode($r);
            $script = "<script>mainResult($r);</script>";
            exit($script);
        }
        
        $bcId     = $student['barcode_id'];
        $dep_id   = student_details::where('student_id', $id)['dep_id'];
        $dep_info = department_subjects::where('department_id', $dep_id);
        $hasRes  = results::all_sql("WHERE student_barcode_id = $bcId");
        
        ?>
        <div class="card card-danger stud-res">
     
            <div class="card-body toPrint">
                <?php
                if (!empty($hasRes)) {
                    $dep_subj = get_object_vars(json_decode($dep_info['subjects']));
                    $allYears =  model::custom_sql("SELECT `year` FROM `results` GROUP BY `year`");
                    //echo "<pre>";print_r($allYears);echo "</pre>";
                       
                    foreach ($allYears as $key => $value) { 
                            $year = $value["year"];
                            $select = results::all_sql("WHERE student_barcode_id = $bcId AND year = $year");
                            //echo "<pre>";print_r($select);echo "</pre>";
                            if(!empty($select)){?>
                            <div class="card-header">
                                <h3 class="card-title " style="text-transform: capitalize;"> <?= ucwords(strtolower($student['name']))." - ".$year; ?>
                                    <div class="form-inline" style="position: absolute; right: 2%; bottom: 7px;">
                                        <button type="button" onclick="printIt();" class="btn btn-default text-dark btn-sm"> <i
                                        class="fa fa-pencil-square-o"></i> &nbsp; Print Result </button>
                                    </div>
                                </h3>
                            </div>
                            <?php } ?>
                            <?php
                            // $i = 0;
                            // echo "<pre>";print_r($dep_subj);echo "</pre>";
                            foreach($dep_subj as $subId => $name) {
                                $editSection = true;
                                result::createSubjectResTable($subId,$bcId,'table',$year,$editSection); 
                            }
                    }
                }else {
                    echo "<h3 class='text-center text-muted'>There is no result till now.</h3>";
                }
                ?>
            </div>   
        </div>
        <?php

    }


    public static function studentAttendance($id){
        $student  = student::find($id);
        if (!$student) {
            $r = '{"notifyDo": {"type": "danger","msg": "Not A Student!", "redirectTo": "student_result.php"}}';
            $r = json_encode($r);
            $script = "<script>mainResult($r);</script>";
            exit($script);
        }
        
        $bcId     = $student['barcode_id'];
        $dep_id   = student_details::where('student_id', $id)['dep_id'];
        $dep_info = department_subjects::where('department_id', $dep_id);
        $hasAtt  = attendance::all_sql("WHERE student_barcode = $bcId");
        
        ?>
        <div class="card card-dark stud-attendance">
     
            <div class="card-body toPrint">
                <?php
                if (!empty($hasAtt)) {
                    $dep_subj = get_object_vars(json_decode($dep_info['subjects']));
                    $allYears =  model::custom_sql("SELECT `register_date` FROM `attendance` WHERE `student_barcode` = $bcId GROUP BY YEAR(`register_date`)");
                    //echo "<pre>";print_r($allYears);echo "</pre>";
                    foreach ($allYears as $key => $value) {
                        // var_dump($value);
                        // exit(); 
                            $year = $value["register_date"][0].$value["register_date"][1].$value["register_date"][2].$value["register_date"][3];
                            //echo $year;
                            $allAttendances = attendance::all_sql("WHERE student_barcode = $bcId AND YEAR(`register_date`) = $year ");
                            //echo "<pre>";print_r($allAttendances);echo "</pre>";exit(); 
                            
                            if(!empty($allAttendances)){?>
                            <div class="card-header">
                                <h3 class="card-title " style="text-transform: capitalize;"> <?= ucwords(strtolower($student['name']))." - ".$year; ?> </h3>
                            </div>
                            <?php } ?>

                            <table class="table table-bordered table-responsive w-100 d-block d-md-table text-center mt-4 mb-2">
                                    <thead>
                                        <tr>
                                            <th>المادة</th>
                                            <th>الفصل</th>
                                            <th>التاريخ</th>
                                     <!--   <th>عدد ساعات الحضور</th> -->
                                        </tr> 
                                    </thead>

                    <?php   foreach($allAttendances as $key => $value) {

                                $subject = subjects::where('id',$value['subject_id'])['name'];
                                $class = classes::where('id',$value['class_id'])['name'];
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $subject ?> </td>
                                            <td><?= $class ?></td>
                                            <td><?= $value['register_date'] ?></td>
                                        </tr>
                                    </tbody>
                               
                             <?php
                            }
                            ?> </table> <?php
                    }
                }else {
                    echo "<h3 class='text-center text-muted'>There is no Attendance till now.</h3>";
                }
                ?>
            </div>   
        </div>
        <?php


    }


    public static function studentTrainingForm() {
        ?>
        <div class="card card-dark stud-training">
            <div class="card-header" onclick="slideToggleDiv('.stud-training')" style="height:40px; cursor:pointer;">
                <h3 class="card-title slideBtn" style="text-transform: capitalize; line-height:0.7em;">Reserve Training</h3>
            </div>
            <div class="card-body">
                <form method="POST" class="studTraining" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="addStudentTraining">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Student</label>
                                <select class="2select form-control pb-2 pb-2" id="student" name="student" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Training <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="training" name="training_id"
                                    onchange="getOldVal($(this).children('option:selected'), {price:'training_price'}, {link:'student.php', action:'getOldVal', tblName:'training'});"
                                    required>
                                    <?= training::option(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>You Should Pay</label>
                                <input type="number" class="form-control form-control-sm" min="0" name="training_price"
                                    readOnly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark"
                            onclick="hideElem('.stud-training', '.studTraining')">Register</button>
                    </div>
                </form>

            </div>
        </div>
        <?php
    }

    public static function addStudentTraining($stuId, $traId) {

        $alreadyExist = student_training::all_sql("WHERE student_id = $stuId AND training_id = $traId");
        $studStatus = student::find($stuId)['status'];
        if (empty($alreadyExist)) {
            //check for student status to see if he pay his funds or not
            if ($studStatus == 3 || $studStatus >= 6) {

                $stuTra = new student_training;
                $stuTra->student_id = $stuId;
                $stuTra->training_id = $traId;
                $stuTra->date = date("Y-m-d");
                $stuTra->is_paid = 0;
                if ($stuTra->save($_SESSION['userid'])) {
                    $json['notifyDo'] = [
                        'type'   => 'success',
                        'msg'    => 'Now you can go to pay the cost.',
                        'redirectTo' => 'student_training.php'
                    ];
                    exit(json_encode($json));
                }
            } else {
                $json['notifyDo'] = [
                    'type'   => 'danger',
                    'msg'    => 'Student Should Pay The First Fund.',
                    'redirectTo' => 'student_training.php'
                ];
                exit(json_encode($json));
            }
        } else {
             $json['notifyDo'] = [
                'type'   => 'warning',
                'msg'    => 'Already Reserved',
                'redirectTo' => 'student_training.php'
            ];
            exit(json_encode($json));
        }
    }

    public static function getStudentTraining($id) {
        $stuTra = student_training::all_sql("WHERE student_id = $id AND is_paid = 0");
        ?>
        <div class="card card-dark stud-details">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> Student Training
                    <div class="form-inline float-right">
                        <a href="training.php" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> &nbsp; Back </a>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table text-center mb-4">
                    <thead>
                        <tr>
                            <th>Training Name</th>
                            <th>Price</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($stuTra)) {
                            foreach($stuTra as $tra) {
                                $training = training::find($tra['training_id']); ?>
                        <tr>
                            <td><?= ucwords($training['name']) ?></td>
                            <td><?= $training['price'] ?></td>
                            <td><?= $training['start_at'] ?></td>
                            <td><?= $training['end_at'] ?></td>
                            <td><button type="button"
                                    onclick="pay('student.php', {action:'payTraining', id:<?=$id?>, price:<?= $training['price']?>, trainingId:<?= $training['id'] ?>})"
                                    class="btn btn-default btn-sm"><i class="fa fa-money fa-lg"></i></button></td>
                        </tr>
                        <?php } 
                                            } else { ?>
                        <tr>
                            <td colspan="5">There are no training till now.</td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public static function payTraining($trainingId, $sId, $price) { 
        if (self::pay($sId, $price, 8)) {
            $stud_tra = new student_training;
            $stud_tra->id = $trainingId;
            $stud_tra->is_paid = 1;
            if ($stud_tra->update($_SESSION['userid'])) {
                $json["notifyDo"] = ["type" => "success", "msg" => "Paid Successfully.", "redirectTo" => "training.php?student=$sId"];
            } else {
                $json["notifyDo"] = ["type" => "danger", "msg" => "Something Wrong!", "redirectTo" => "training.php?student=$sId"];
            }
        } else {
            $json["notifyDo"] = ["type" => "danger", "msg" => "Something Wrong!", "redirectTo" => "training.php?student=$sId"];
        }
        exit(json_encode($json));
    }














    public static function optionBtns($id) {
        
        $statusId   = student::find($id)['status'];
        $isFormPaid = payment::all_sql("WHERE `student_id` = $id AND `pay_for_id` = 1");
        $userType   = $_SESSION['user_type'];
        $suspendedId = student_status::where('name','suspended')['id'];

        ?>
    <div class="row mt-3 text-center option-btns">



    <!-- Attendance -->
    <?php if (($userType == 1 || $userType == 2) && $statusId != 7) { ?>
        <!-- More Details -->
        <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'studentDetails', id:<?= $id ?>}, '.more-details', true, '.stud-details')"
            class="btn btn-info btn-sm w-100">تفاصيل أكثر</button>
    </div>
    <!------------------>
    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'studentAttendance', id:<?= $id ?>}, '.more-details', true, '.stud-attendance')"
            class="btn btn-dark btn-sm w-100"
            <?= $statusId == 3 || $statusId >= 6 ? '' : 'disabled'; ?>>الحضور</button>
    </div>
    <?php } ?>
    <!---------------->

    <!-- Interview Button -->
    <?php if ($userType == 1) { ?>
    <?php if ($statusId != 1 && $statusId != 2) { ?>
    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'interviewInfo', id:<?= $id ?>}, '.more-details', true, '.stud-inter-info')"
            class="btn btn-success btn-sm w-100">المقابلة الشخصية</button>
    </div>
    <?php } else { ?>
    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'addInterviewResForm', id:<?= $id ?>}, '.more-details', true, '.stud-inter-res')"
            class="btn btn-warning btn-sm w-100" <?= $statusId == 2 ? '' : 'disabled'; ?>>إضافة نتيجة المقابلة الشخصية</button>
    </div>
    <?php } ?>
    <?php } ?>
    <!---------------------->

    <!-- Payment && Results -->
    <?php if ($statusId == 1 ) { ?>


    <!-- <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'payFirstFundForm', id:}, '.more-details', true, '.stud-first-fund')"
            class="btn btn-danger btn-sm w-100">دفع القسط الأول</button>
    </div> -->

    <?php } else if ($statusId == 3 && $userType == 3) { ?>

    <!-- <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'paySecondFundForm', id:}, '.more-details', true, '.stud-second-fund')"
            class="btn btn-danger btn-sm w-100" دفع القسط الثاني</button>
    </div> -->

    <?php } else if ($statusId == 5 && $userType == 3) { ?>

    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'returnFirstFundForm', id:<?= $id ?>}, '.more-details', true, '.stud-return-fund')"
            class="btn btn-danger btn-sm w-100">إسترجاع القسط الأول</button>
    </div>

    <?php } else if ($statusId == 6 && ($userType == 1 ||  $userType == 2)) { ?>

    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'studentResult', id:<?= $id ?>}, '.more-details', true, '.stud-res')"
            class="btn btn-danger btn-sm w-100">النتائج</button>
    </div>

    <?php   }elseif($userType == 1){  ?>
    <!------------------------>
    
    <!-- Change Branch -->
    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formChangeBranch', id:<?= $id ?>}, '.more-details', true, '.ch-res')"
            class="btn btn-danger btn-sm w-100">تغيير الفرع</button>
    </div>
    <!------------------------>
    <!-- Add Photo -->
    <div class="col-md">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formAddImage', id:<?= $id ?>}, '.more-details', true, '.ch-img')"
            class="btn btn-info btn-sm w-100">إضافة صورة</button>
    </div>
    <!------------------>

</div>
<div class="row">
    <!-- Extract Lost Allowance Card -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formExtractLostCard', id:<?= $id ?>}, '.more-details', true, '.ch-card')"
            class="btn btn-danger btn-sm w-100">استخراج بطاقة بدل المفقودة</button>
    </div>
    <!------------------>
    <!-- Print Card -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formPrintCard', id:<?= $id ?>}, '.more-details', true, '.stud-details')"
            class="btn btn-info btn-sm w-100">طباعة الكارنية</button>
    </div>
    <!------------------>
    <!-- Graduation Certificate -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'', id:<?= $id ?>}, '.more-details', true, '.stud-details')"
            class="btn btn-success btn-sm w-100" disabled>شهادة التخرج</button>
    </div>
    <!------------------>
    <!-- Cash Back -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formCashBack', id:<?= $id ?>}, '.more-details', true, '.ch-back')"
            class="btn btn-success btn-sm w-100">إسترجاع النقود</button>
    </div>
    <!------------------>
    <!-- Change status -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formChangeStatus', id:<?= $id ?>}, '.more-details', true, '.ch-status')"
            class="btn btn-danger btn-sm w-100">تغيير حالة الطالب</button>
    </div>
    <!------------------------>
    <!-- Reenrollment  -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formReEnrollment', id:<?= $id ?>}, '.more-details', true, '.ReEnroll')"
            class="btn btn-danger btn-sm w-100"
            <?= (student::find($id)['status'] != $suspendedId) ?  'disabled' :''?>>إعادة القيد</button>
    </div>
    <!------------------------>
    <!-- select Group  -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formSelectGroup', id:<?= $id ?>}, '.more-details', true, '.sel-group')"
            class="btn btn-danger btn-sm w-100">تحديد مجموعة الطالب</button>
    </div>
    <!------------------------>
    <!-- select Group  -->
    <div class="col-md-2 mt-2">
        <button type="button"
            onclick="ajxReq('student.php', {action:'formAddNote', id:<?= $id ?>}, '.more-details', true, '.add-note')"
            class="btn btn-danger btn-sm w-100">إضافة ملاحظات</button>
    </div>
    <!------------------------>
    <?php } ?>
    </div>

    <?php
    }


    public static function getOldVal($id, $tblName = '') {
        $res = $tblName::find($id);
        echo json_encode($res);
    }








    //start admin functions 
    
    public static function formAddNote($id) {

        $oldNote = student_details::where('student_id',$id)['note'];
        ?>
        <div class="card card-danger add-note">
            <div class="card-header" onclick="slideToggleDiv('.add-note')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="chstat" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="addNote">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>إضافة ملاحظات على الطالب <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm" name="student_note" id="student_note" cols="30" rows="10"><?=$oldNote?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" onclick="hideElem('.add-note', '.chstat')">تغيير</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }
    public static function AddNote($id,$studentNote){

            $x = [];
            $x['note'] = $studentNote;
            $update = student_details::updateArrayOrg($x , 'student_id' , $id);

            if($update){
                $json["notifyDo"] = ["type" => "success", "msg" => "Student Note Added Successfully.", "redirectTo" => "find_student.php?id=$id"];
                exit(json_encode($json));
            }
            $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Adding Student Note!", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
    }



    public static function formChangeStatus($id) {
        $suspendedId = student_status::where('name','suspended')['id'];
        $reEnrollmentId = pay_for::where('name','Re-enrollment')['id'];
        $paymentCheck = model::custom_sql("SELECT * FROM `payment` WHERE `student_id` = $id AND `pay_for_id` = $reEnrollmentId AND `status` = 0  ORDER BY `date` DESC LIMIT 1")[0];
        //var_dump($paymentCheck);
        ?>
        <div class="card card-danger ch-status">
            <div class="card-header" onclick="slideToggleDiv('.ch-status')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="chstat" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="changeStatus">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>حالة الطالب الجديدة <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="newStatus" name="newStatus" required>
                                    <option value="0" >إختر الحالة</option>
                                    <?php if(!$paymentCheck){ ?>
                                    <option value="active" <?= (student::find($id)['status'] != $suspendedId) ?  'selected' :''?>>مفعل</option>
                                    <?php } ?>
                                    <option value="suspended" <?= (student::find($id)['status'] == $suspendedId) ?  'selected' :''?>>مفصول</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" onclick="hideElem('.ch-status', '.chstat')">تغيير</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

  
    public static function changeStatus($id,$newStatus) {

        //$activeId = student_status::where('name','has form')['id'];
        $suspendedId = student_status::where('name','suspended')['id'];
        $studentStatus = student::find($id)['status'];

        if($newStatus == 'suspended' && $studentStatus != $suspendedId){
            //saving old status
            $oldStatus = student::find($id)['status'];
            $z = [];
            $z['student_id'] = $id;
            $z['old_status_id'] = $oldStatus;
            $z['date'] = date("Y-m-d H:i:s");
            old_status::saveArrayorg($z);
            
            $x = [];
            $x['status'] = $suspendedId;
            $update = student::updateArrayOrg($x , 'id' , $id);

            if($update){
                $json["notifyDo"] = ["type" => "success", "msg" => "Student Suspended Successfully.", "redirectTo" => "find_student.php?id=$id"];
                exit(json_encode($json));
            }
        }else if($newStatus == 'active' && $studentStatus == $suspendedId){

            $oldStatus = model::custom_sql(" SELECT * FROM `old_status` ORDER BY `id` DESC  limit 1 ")[0];
           
            $x = [];
            $x['status'] = $oldStatus['old_status_id'];
            $update = student::updateArrayOrg($x , 'id' , $id);
            if($update){
                $json["notifyDo"] = ["type" => "success", "msg" => "Re-enrollment made Successfully.", "redirectTo" => "find_student.php?id=$id"];
                exit(json_encode($json));
            }

        }else{
            $json["notifyDo"] = ["type" => "danger", "msg" => "Student already $newStatus !", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
   
    }



    public static function formReEnrollment($id) {

        ?>
        <div class="card card-danger ReEnroll">
            <div class="card-header" onclick="slideToggleDiv('.ReEnroll')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="reenroll" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="reEnrollment">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">    
                                    <h3 class='mb-4'>إرسال طلب للخزنة لإعادة قيد الطالب</h3>
                                    <button type='submit' class='btn btn-danger' onclick='hideElem(".ReEnroll", ".reenroll")'>إرسال</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function  ReEnrollment($id){
            $reEnrollmentId = pay_for::where('name','Re-enrollment');

            $y = [];
            $y['student_id'] = $id;
            $y['pay_for_id'] = $reEnrollmentId['id'];
            $y['value'] = $reEnrollmentId['price'];
            $y['date'] = date("Y-m-d H:i:s");
            $y['status'] = 0;
            $payRequest = payment::saveArrayorg($y);

            if($payRequest){
                $json["notifyDo"] = ["type" => "success", "msg" => "Change Student Request sent Successfully.", "redirectTo" => "find_student.php?id=$id"];
                exit(json_encode($json));
            }
        
        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Re-enrollment Student!" , "redirectTo" => "find_student.php?id=$id"];
        exit(json_encode($json));
        
    }

    public static function formSelectGroup($id) {

        $oldGroupId = student::find($id)['group_id'];
        $oldGroupName = groups::find($oldGroupId)['name'];

        ?>
        <div class="card card-danger sel-group">
            <div class="card-header" onclick="slideToggleDiv('.sel-group')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="SelectGroup">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                <?php if($oldGroupId > 0){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>المجموعة الحالية</label>
                                <input class="form-control form-control-sm" type="text" value="<?=$oldGroupName?>" readonly>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>تغيير المجموعة <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="newGroup" name="newGroup" required>
                                    <?= groups::optionOrg() ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" onclick="hideElem('.sel-group', '.chBranch')">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

   
    public static function SelectGroup($id,$newGroup) {

        $oldGrouphId = student::find($id)['branch_id'];
        $oldGroupName = groups::find($oldGrouphId)['name'];

        if($newGroup == $oldGroupName){
            $json["notifyDo"] = ["type" => "danger", "msg" => "Student already in $newGroup Group!", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }

        $x = [];
        $x['group_id'] = $newGroup;
        $save = student::updateArrayOr($x,'id',$id);

        if($save){
            $json["notifyDo"] = ["type" => "success", "msg" => "Student Group Changed  Successfully.", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
    }



    public static function formChangeBranch($id) {
        $oldBranchId = student::find($id)['branch_id'];
        $oldBranchName = branches::find($oldBranchId)['name'];

        ?>
        <div class="card card-danger ch-res">
            <div class="card-header" onclick="slideToggleDiv('.ch-res')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="changeBranch">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الفرع الحالى</label>
                                <input class="form-control form-control-sm" type="text" value="<?=$oldBranchName?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الفرع الجديد <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm 2select" id="newBranch" name="newBranch" required>
                                    <?= branches::optionOrg() ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" onclick="hideElem('.ch-res', '.chBranch')">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

   
    public static function changeBranch($id,$newBranch) {

        $oldBranchId = student::find($id)['branch_id'];
        $oldBranchName = branches::find($oldBranchId)['name'];
        if($newBranch == $oldBranchName){
            $json["notifyDo"] = ["type" => "danger", "msg" => "Student already in $newBranch Branch!", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
        //update student branch
        $x = [];
        $x['branch_id'] = branches::find($newBranch)['id'];
        $update = student::updateArrayOr($x,'id',$id);

        // add collection request
        $collection = pay_for::where('name','collection');
        $exBranch = expense_for::where('name','ex branch');

        $y = [];
        $y['student_id'] = $id;
        $y['pay_for_id'] = $collection['id']; //collection id on pay_for table
        $y['value'] = $collection['price'];
        $y['date'] = date("Y-m-d H:i:s");
        $y['status'] = 0; // to send request to safe person
        $exSave = payment::saveArrayorg($y);

        // add expense request 
        $z = [];
        $z['student_id'] = $id;
        $z['expense_for_id'] = $exBranch['id'];; //ex branch id on expense_for table
        $z['value'] = $exBranch['price'];
        $z['date'] = date("Y-m-d H:i:s");
        $z['status'] = 0; // to send request to safe person
        $exSave = expenses::saveArrayorg($z);

        if($update && $exSave){
            $json["notifyDo"] = ["type" => "success", "msg" => "Student Branch Change Request Sent Successfully.", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
    }


    public static function formAddImage($id) {
        ?>
        <div class="card card-info ch-img">
            <div class="card-header" onclick="slideToggleDiv('.ch-img')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body ">
                <h3>إضافة صورة للطالب</h3>
                <form method="POST" class="addimg" onsubmit="submitForm(this, 'student.php')"  enctype="multipart/form-data" prevent-default>
                    <input type="hidden" name="action" value="addImage">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row justify-content-center m-4">
                        <div class="form-group">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info" onclick="hideElem('.ch-img', '.addimg')">إضافة</button>
                    </div>
                </form>
                <div class="row ">
                        <div class="form-group">
                            <label>الصوره</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                        <label>الاوراق المرفقه</label><br>
                    <div class="row">
                        <?= student_paper::checkbok()?>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info" onclick="hideElem('.ch-img', '.addimg')">إضافة</button>
                    </div>
                </form>

            </div>
        </div>
        <?php

    }

    public static function addImage($id,$image) {

        $x = [];
        $x['image'] = $image;
        $update = student::updateArrayOr($x,'id',$id);
        if($update){
            $json["notifyDo"] = ["type" => "success", "msg" => "Image Updated Successfully.", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Updating Image!", "redirectTo" => "find_student.php?id=$id"];
        exit(json_encode($json));
    }


    public static function formExtractLostCard($id) {         
        ?>
        <div class="card card-danger ch-card">
            <div class="card-header" onclick="slideToggleDiv('.ch-card')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body text-center">
                <h3>الرجاء إدخال نسخة إلكترونية من سجل فقدان البطاقة في قسم الشرطة</h3>
                <form method="POST" class="excard" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="extractLostCard">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="row justify-content-center m-4">
                        <div class="form-group">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="form-group text-center ml-2">
                            <button type="submit" class="btn btn-danger">
                                رفع الصورة وتقديم طلب للخزنة</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php

    }

    public static function extractLostCard($id,$image) {
      
        if(empty($image)){
            $json["notifyDo"] = ["type" => "danger", "msg" => "Please Select An Image!", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }
       //insert image
       $x = [];
       $x['student_id'] = $id;
       $x['image'] = $image;
       $cardSave = lost_cards::saveArrayorg($x);

       //insert payment record
        $lostCardId = pay_for::where('name','Lost Card');

       $y = [];
       $y['student_id'] = $id;
       $y['pay_for_id'] = $lostCardId['id'];
       $y['value'] = $lostCardId['price'];
       $y['date'] = date("Y-m-d H:i:s");
       $y['status'] = 0;
        $requestSave = payment::saveArrayorg($y);

       if($cardSave && $requestSave){

                $json["notifyDo"] = ["type" => "success", "msg" => "Image Updated Successfully.", "redirectTo" => "find_student.php?id=$id"];
                exit(json_encode($json));
        }

        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Updating Image!", "redirectTo" => "find_student.php?id=$id"];
        exit(json_encode($json));
    }

    //uncompleted
    public static function formPrintCard($id) { 
        // $payment = payment::all_sql("WHERE `student_id` = '$id' AND `pay_for_id` = 6 AND `status` = 0");
        
        ?>
        <div class="card card-info ch-print">
            <div class="card-header" onclick="slideToggleDiv('.ch-print')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body text-center">
                <form method="POST" class="cprint" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="printCard">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info" onclick="hideElem('.ch-print', '.cprint')">طباعة الكارنية</button>
                    </div>

                </form>
            </div>
        </div>
        <?php

    }



    public static function formCashBack($id) { 
        // $payment = payment::all_sql("WHERE `student_id` = '$id' AND `pay_for_id` = 6 AND `status` = 0");
        
        ?>
        <div class="card card-success ch-back">
            <div class="card-header" onclick="slideToggleDiv('.ch-back')" style="height:40px; cursor:pointer;">
                <div class="form-inline" style="position: absolute; right: 50%; bottom: 6px;">
                    <button type="button" class="slideBtn" style="background:none;border:0;color:#FFF;cursor:pointer;"> <i
                            class="fa fa-angle-up" style="font-size: 1.6em;"></i></button>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" class="firstFundForm" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="cashBack">
                    <input type="hidden" name="id" value="<?= $id; ?>">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>نوع الإسترجاع <span class="text-danger">*</span></label>
                               
                                <select class="form-control form-control-sm 2select" name="expense_for_id"  onchange="getOldVal($(this).children('option:selected'), {name:'expense_for_name', price:'fund_value'}, {link:'expense_for.php', action:'getOldVal'});" required>
                                        <?= expenseFor::option(); ?>	                   
                                </select> 
                            </div>
                        </div>
             
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>قيمة اللإسترجاع<span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-sm" min="1" name="fund_value"
                                    value="<?=$fund?>" readOnly required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success"
                                    onclick="hideElem('.stud-first-fund', '.firstFundForm')">Confirm</button>
                            </div>
                        </div>
                </form>

            </div>
        </div>
        <?php

    }
    public static function cashBack($id,$expenseForId,$fundValue){

        $x = [];
        $x['student_id'] = $id;
        $x['expense_for_id'] = $expenseForId;
        $x['value'] = $fundValue;
        $x['date'] = date("Y-m-d H:i:s");
        $x['status'] = 0;
        $save = expenses::saveArrayorg($x);

        if($save){
            $json["notifyDo"] = ["type" => "success", "msg" => "Cash Back Requested Successfully.", "redirectTo" => "find_student.php?id=$id"];
            exit(json_encode($json));
        }

        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Requesting Cash Back!", "redirectTo" => "find_student.php?id=$id"];
        exit(json_encode($json));

    }
    
    //end admin functions

    public static function addStudentGroup($id = 0){
        // $group = '';
        if($id >0){
            $studentDep = student_details::where('student_id',$id)['dep_id'];
        }
        ?>
        <div class="card card-danger ch-res">
            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="submitStudentGroup">
                    <input type="hidden" name="id" value="<?=$id?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>إسم المجموعة</label>
                                <select class="form-control form-control-sm 2select" name="group_id"   required>
                                        <?= groups::optionOrg(''," `dep_id` = '$studentDep' AND `status` = 1  "); ?>	                   
                                </select> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" >إضافة</button>
                    </div>
                </form>

            </div>
        </div>
        <?php
    }

    public static function submitStudentGroup($id,$group_id){

        $x = [];
        $x['group_id'] = $group_id;
        $save = student::updateArrayOr($x,'id',$id);

        if($save){
            $json["notifyDo"] = ["type" => "success", "msg" => "Student Group Changed  Successfully.", "redirectTo" => "add_student_group.php"];
            exit(json_encode($json));
        }
        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Add Student Group!", "redirectTo" => "add_student_group.php"];
        exit(json_encode($json));
        
    }


    public static function addGroupForm($id = 0){
        $group = array();
        $group = NULL;
        if($id >0){
            $group = groups::find($id);
        }
        ?>
        <div class="card card-danger ch-res">
            <div class="card-body">
                <form method="POST" class="chBranch" onsubmit="submitForm(this, 'student.php')" prevent-default>
                    <input type="hidden" name="action" value="addGroup">
                    <input type="hidden" name="id" value="<?=$id?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>إسم المجموعة</label>
                                <input class="form-control form-control-sm" value="<?= $group['name'] ?>" name="name" type="text"  >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>القسم</label>
                                <select class="form-control form-control-sm 2select" name="dep_id"   required>
                                        <?= departments::optionOrg($group['dep_id']); ?>	                   
                                </select> 
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الحالة</label>
                                <select class="form-control form-control-sm 2select" id="status" name="status">
                                    <option value="0"  >إختر العلاقة</option>
                                    <option value="1" <?=($group['status'] == 1) ? 'selected' : '' ; ?> >مفتوحة</option>
                                    <option value="0" <?=($group['status'] == 0) ? 'selected' : '' ; ?>>مغلقة</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger" >Submit</button>
                    </div>
                </form>

            </div>
        </div>
        <?php
    }

    public static function addGroup($id,$name,$dep_id,$status){

        if($id > 0){
            $x=[];
            $x['name'] = $name;
            $x['dep_id'] = $dep_id;
            $x['status'] = $status;
            $update = groups::updateArrayOrg($x,'id',$id);
    
            if($update){
                $json["notifyDo"] = ["type" => "success", "msg" => "Group is Updated Successfully.", "redirectTo" => "student_groups.php"];
                exit(json_encode($json));
            }
    
            $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Up   dating Group!", "redirectTo" => "student_groups.php"];
            exit(json_encode($json));
        }
        $x=[];
        $x['name'] = $name;
        $x['status'] = $status;
        $save = groups::saveArrayorg($x);

        if($save){
            $json["notifyDo"] = ["type" => "success", "msg" => "Group is Added Successfully.", "redirectTo" => "student_groups.php"];
            exit(json_encode($json));
        }

        $json["notifyDo"] = ["type" => "danger", "msg" => "Error While Adding Group!", "redirectTo" => "student_groups.php"];
        exit(json_encode($json));

    }

    //groups tables



    public static function addGroupTable(){
        ?>

            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">الطلبة الغير مسجلين لمجموعات</h3>
                </div>

                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>إسم الطالب</th>
                            <th>القسم</th>
                            <th>تحديد المجموعة</th>
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
                            {"data": "dep_id"},
                            {"data": "group_id"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "searching":false,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/student.php',
                            data: {action:'addGroupTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }
    public static function groupsTable(){
        ?>

            <div class="row ml-2 mb-4" >
                <a href="#" onclick="modalShow('student.php',{action:'addGroupForm'})" class="btn btn-dark"
                style="color: white;" name="submit">إضافة مجموعة</a>
            </div>

            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">مجموعات الطلبة</h3>
                </div>

                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>إسم المجموعة</th>
                            <th>القسم</th>
                            <th>عدد الطلبة</th>
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
                            {"data": "name"},
                            {"data": "dep_id"},
                            {"data": "student_count"},
                            {"data": "status"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "searching":false,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/student.php',
                            data: {action:'groupsTable'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }
}       