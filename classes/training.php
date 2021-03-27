<?php

class training extends model
{
    protected $table = '`training`';

    public static function trainingOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Training Options</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="training-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Training -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('training.php', {action:'addTrainingForm'}, '.training-details', true, '.add-training')"
                        class="btn btn-info btn-sm w-100">Add Training</button>
                </div>
            <!-------------------->

            <!-- Edit Training -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('training.php', {action:'editTrainingForm'}, '.training-details', true, '.edit-training')"
                            class="btn btn-dark btn-sm w-100">Edit Training</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addTrainingForm() {
        ?>
            <div class="card card-info add-training">
                <div class="card-header"  onclick="slideToggleDiv('.add-training')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Training </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addTrainingForm" onsubmit="submitForm(this, 'training.php')" prevent-default>
                        <input type="hidden" name="action" value="addTraining">

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Training Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="training_name" placeholder="Training Name" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Training Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="0" name="training_price" placeholder="Training Price" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start At <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-sm" name="start_at" placeholder="Start At" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End At <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-sm" name="end_at" placeholder="End At" required> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-training', '.addTrainingForm')">Add Training</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addTraining($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('training.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $training = new training;
        $training->name = $data['trainingName'];
        $training->price = $data['trainingPrice'];
        $training->start_at = $data['startAt'];
        $training->end_at = $data['endAt'];
        $training->status = 1;
        $trainingId = $training->save($uId);

        if ($trainingId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Training is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editTrainingForm() {
        ?>
            <div class="card card-dark edit-training">
                <div class="card-header"  onclick="slideToggleDiv('.edit-training')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Training </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editTrainingForm" onsubmit="submitForm(this, 'training.php')" prevent-default>
                        <input type="hidden" name="action" value="editTraining">

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Training <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="training_id"
                                     onchange="getOldVal($(this).children('option:selected'), {name:'training_name', price:'training_price', start:'start_at', end:'end_at', status:'training_status'}, {link:'training.php', action:'getOldVal', tblName:'training'});"
                                     required>
                                        <?= training::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Training Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="training_name" placeholder="Training Name" required> 
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Training Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-sm" min="0" name="training_price" placeholder="Training Price" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start At <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-sm" name="start_at" placeholder="Start At" required> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End At <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-sm" name="end_at" placeholder="End At" required> 
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Training Status</label>
                                    <select class="form-control form-control-sm 2select" name="training_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1">ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-training', '.editTrainingForm')">Edit Training</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editTraining($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('training.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $training = new training;
        $training->id       = $data['trainingId'];
        $training->name     = $data['trainingName'];
        $training->price    = $data['trainingPrice'];
        $training->start_at = $data['startAt'];
        $training->end_at   = $data['endAt'];
        $training->status   = $data['trainingStatus'];
        if ($training->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Training is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function payTrainingForm() {
        ?>
            <div class="card card-dark pay-training">
                <div class="card-header"  onclick="slideToggleDiv('.pay-training')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Pay for Training </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="payTrainingForm" onsubmit="submitForm(this, 'training.php')" prevent-default>
                        <input type="hidden" name="action" value="payTraining">

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Student</label>
                                    <select class="2select form-control pb-2 pb-2" id="student" name="student" onchange="getOldVal($(this).children('option:selected'), {price:'training_price'}, {link:'student.php', action:'getOldVal', tblName:'student'});" required></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Training <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" id="training" name="training_id" onchange="getOldVal($(this).children('option:selected'), {price:'training_price'}, {link:'student.php', action:'getOldVal', tblName:'training'});" required>
                                        <?= training::option(); ?>	                   
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>You Should Pay</label>
                                    <input type="number" class="form-control form-control-sm" min="0" name="training_price" readOnly>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.pay-training', '.payTrainingForm')">Pay for Training</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php

    }

    public static function getOldVal($id, $tblName = '') {
        $res = $tblName::find($id);
        echo json_encode($res);
    }

}