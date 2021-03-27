<?php

class subjects extends model
{
    protected $table = '`subjects`';

    public static function subjectsOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Subjects Options</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="subject-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Subject -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('subjects.php', {action:'addSubjectForm'}, '.subject-details', true, '.add-subject')"
                        class="btn btn-info btn-sm w-100">Add Subject</button>
                </div>
            <!-------------------->

            <!-- Edit Subject -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('subjects.php', {action:'editSubjectForm'}, '.subject-details', true, '.edit-subject')"
                            class="btn btn-dark btn-sm w-100">Edit Subject</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addSubjectForm() {
        ?>
            <div class="card card-info add-subject">
                <div class="card-header"  onclick="slideToggleDiv('.add-subject')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Subject </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addSubjForm" onsubmit="submitForm(this, 'subjects.php')" prevent-default>
                        <input type="hidden" name="action" value="addSubject">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subject Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="subj_name" placeholder="Subject Name" required> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Final <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_final" required> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Midterm <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_midterm" required> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Activity <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_activity" required> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Attendace <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_attendace" required> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-subject', '.addSubjForm')">Add Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addSubject($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('subjects.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $subj = new subjects;
        $subj->name      = $data['subjName'];
        $subj->final     = $data['subjFinal'];
        $subj->midterm   = $data['subjMidterm'];
        $subj->activity  = $data['subjActivity'];
        $subj->attendace = $data['subjAttendace'];
        $subj->total     = $data['subjFinal'] + $data['subjMidterm'] + $data['subjActivity'] + $data['subjAttendace'];
        $subj->status    = 1;

        $subjId = $subj->save($uId);

        if ($subjId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Subject is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editSubjectForm() {
        ?>
            <div class="card card-dark edit-subject">
                <div class="card-header"  onclick="slideToggleDiv('.edit-subject')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Subject </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editSubjForm" onsubmit="submitForm(this, 'subjects.php')" prevent-default>
                        <input type="hidden" name="action" value="editSubject">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="subj_id" onchange="getOldVal($(this).children('option:selected'), {name:'subj_name', final:'subj_final', midterm:'subj_midterm', activity:'subj_activity', attendace:'subj_attendace', status:'subj_status'}, {link:'subjects.php', action:'getOldVal', tblName:'subjects'});" required>
                                        <?= subjects::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subject Name</label>
                                    <input type="text" class="form-control form-control-sm" name="subj_name">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Final <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_final" required> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Midterm <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_midterm" required> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Activity <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_activity" required> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Attendace <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="1" name="subj_attendace" required> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subject Status</label>
                                    <select class="form-control form-control-sm 2select" name="subj_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-subjects mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-subject', '.editSubjForm')">Edit Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editSubject($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('subjects.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $subj = new subjects;
        $subj->id        = $data['subjId'];
        $subj->name      = $data['subjName'];
        $subj->final     = $data['subjFinal'];
        $subj->midterm   = $data['subjMidterm'];
        $subj->activity  = $data['subjActivity'];
        $subj->attendace = $data['subjAttendace'];
        $subj->total     = $data['subjFinal'] + $data['subjMidterm'] + $data['subjActivity'] + $data['subjAttendace'];
        $subj->status    = $data['subjStatus'];

        if ($subj->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Subject is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id, $tblName = '') {
        $res = $tblName::find($id);
        echo json_encode($res);
    }

}
