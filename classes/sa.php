<?php

class saClass{

    public static function studentschedulesForm($id = 0){
        // echo date('w',strtotime('2019-09-04'));
        $lec = Null;
        if($id > 0 ){
            $lec = lecture::find($id);
        }
        ?>
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title" style="text-transform: capitalize;">إضافة جدول المحاضرات</h3>
                </div>
                <div class="card-body">  
                    <form method="POST" onsubmit="submitForm(this, 'sa.php')"  prevent-default>
                        <input type="hidden" name="action" value="addScheduleForm">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>المحاضر</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="lecturer_id" required>
                                        <?= employees::optionOrg( employees::find($lec['lecturer_id'])['id'] ," `type` = 'Lecturer' "); ?>	                   
                                    </select>                             
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>المادة</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="subj_id" required>
                                        <?= subjects::option($lec['subject_id']); ?>	                   
                                    </select>                             
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>الفصل</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="class_id" required>
                                        <?= classes::optionOrg($lec['class_id']); ?>	                   
                                    </select>                             
                                </div>                            
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>مجموعة الطلاب</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="group_id" required>
                                        <?= groups::optionOrg($lec['group_id']); ?>	                   
                                    </select>                             
                                </div>                            
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>العام الدراسى</label>
                                    <input class="form-control form-control-sm" value="<?=$lec['year']?>" type="number" min="1990" max="3000" step="1" name="year" >                           
                                </div>                            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>الفصل الدراسى</label>
                                    <select class="form-control form-control-sm 2select" id="term_id" name="term_id" required>                     
                                        <option value="0">إختر إجابة</option>               
                                        <option value="1" <?= ($lec['term_id'] && $lec['term_id'] == '1') ? 'selected' :''?>>الاول</option>  
                                        <option value="2" <?= ($lec['term_id'] && $lec['term_id'] == '2') ? 'selected' :''?>>الثاني</option>            	                   
                                    </select>                                
                                </div>                            
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>يوم المحاضرة</label>
                                    <select class="form-control form-control-sm 2select" id="subject" name="day_id" required>
                                        <option value="-1">إختر اجابة</option>               
                                        <option value="5" <?= ($lec['term_id'] == '5') ? 'selected' :''?>>الجمعة</option>               
                                        <option value="6" <?= ($lec['term_id'] == '6') ? 'selected' :''?>>السبت</option>  
                                        <option value="0" <?= ($lec['term_id'] == '0') ? 'selected' :''?>>الاحد</option>           
                                        <option value="1" <?= ($lec['term_id'] == '1') ? 'selected' :''?>>الاثنين</option>  	                   
                                        <option value="2" <?= ($lec['term_id'] == '2') ? 'selected' :''?>>الثلاثاء</option>  	                   
                                        <option value="3" <?= ($lec['term_id'] == '3') ? 'selected' :''?>>الاربعاء</option>  	                   
                                        <option value="4" <?= ($lec['term_id'] == '4') ? 'selected' :''?>>الخميس</option>  	                   
                                    </select>                             
                                </div>                            
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>وقت المحاضرة</label>
                                    <input type="time" value="<?=$lec['lecture_time']?>" class="form-control form-control-sm" name="lecture_time"></div>                            
                            </div>
                        </div>



                        <div class="form-group text-center mt-3">
                            <input type="submit" class="btn btn-dark" value="إضافة الجدول" >
                        </div>
                    </form>
                </div>
            </div>        
        <?php
    }

    public static function addSchedule($id,$lecturer_id,$subj_id,$class_id,$group_id,$year,$term_id,$day_id,$lecture_time){

        if($id == 0 ){
            $x = [];
            $x['subject_id'] = $subj_id;
            $x['lecturer_id'] = $lecturer_id;
            $x['class_id'] = $class_id;
            $x['group_id'] = $group_id;
            $x['year'] = $year;
            $x['term_id'] = $term_id;
            $x['day_id'] = $day_id;
            $x['lecture_time'] = $lecture_time;
            $save = lecture::saveArrayOrg($x);

            if($save){
                $json['notifyDo'] = ['type' => 'success', 'msg' => 'Schedule Is Added Successfully', 'redirectTo' => 'students_schedules.php'];

            }else{
                $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong Check Add Schedule Section!'];
            }
        }else{
            $x = [];
            $x['subject_id'] = $subj_id;
            $x['lecturer_id'] = $lecturer_id;
            $x['class_id'] = $class_id;
            $x['group_id'] = $group_id;
            $x['year'] = $year;
            $x['term_id'] = $term_id;
            $x['day_id'] = $day_id;
            $x['lecture_time'] = $lecture_time;
            $update = lecture::updateArrayOrg($x,'id',$id);
            if($update){
                $json['notifyDo'] = ['type' => 'success', 'msg' => 'Schedule Is Updated Successfully', 'redirectTo' => 'students_schedules.php'];

            }else{
                $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong Check Update Schedule Section!'];
            }
        }

        exit(json_encode($json));

    }


    public static function schedulesTable(){
        ?>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">جداول المحاضرات</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>المادة</th>
                            <th>المجموعة</th>
                            <th>الفصل</th>
                            <th>الساعة</th>
                            <th>اليوم</th>
                            <th>الفصل الدراسى</th>
                            <th>السنة</th>
                            <th>تعديل</th>

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
                        "data": "subject_id"
                    },
                    {
                        "data": "group_id"
                    },
                    {
                        "data": "class_id"
                    },
                    {
                        "data": "lecture_time"
                    },
                    {
                        "data": "day_id"
                    },
                    {
                        "data": "term_id"
                    },
                    {
                        "data": "year"
                    },
                    {
                        "data": "edit"
                    }
                ],
                "ordering": false,
                "lengthMenu": [10, 25, 50, 100],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: '../ajx/sa.php',
                    data: {
                        action: 'schedulesTable'
                    },
                    type: 'POST'
                }
            });
        });
        </script>
        <?php
    }

}