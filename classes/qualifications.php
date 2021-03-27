<?php

class qualifications extends model
{
    protected $table = '`qualifications`';

    public static function qualificationsOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Qualifications Options</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="qualifications-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Qualifications -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('qualifications.php', {action:'addQualificationsForm'}, '.qualifications-details', true, '.add-qualifications')"
                        class="btn btn-info btn-sm w-100">Add Qualifications</button>
                </div>
            <!-------------------->

            <!-- Edit Qualifications -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('qualifications.php', {action:'editQualificationsForm'}, '.qualifications-details', true, '.edit-qualifications')"
                            class="btn btn-dark btn-sm w-100">Edit Qualifications</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addQualificationsForm() {
        ?>
            <div class="card card-info add-qualifications">
                <div class="card-header"  onclick="slideToggleDiv('.add-qualifications')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Qualifications </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addQualForm" onsubmit="submitForm(this, 'qualifications.php')" prevent-default>
                        <input type="hidden" name="action" value="addQualifications">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Qualifications Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="qual_name" placeholder="Qualifications Name" required> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-qualifications', '.addQualForm')">Add Qualifications</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addQualifications($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('qualifications.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $qual = new qualifications;
        $qual->name = $data['qualName'];
        $qual->status = 1;
        $qualId = $qual->save($uId);

        if ($qualId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Qualifications is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editQualificationsForm() {
        ?>
            <div class="card card-dark edit-qualifications">
                <div class="card-header"  onclick="slideToggleDiv('.edit-qualifications')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Qualifications </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editQualForm" onsubmit="submitForm(this, 'qualifications.php')" prevent-default>
                        <input type="hidden" name="action" value="editQualifications">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Qualifications <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="qual_id" onchange="getOldVal($(this).children('option:selected'), {name:'qual_name', status:'qual_status'}, {link:'qualifications.php', action:'getOldVal'});" required>
                                        <?= qualifications::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Qualifications Name</label>
                                    <input type="text" class="form-control form-control-sm" name="qual_name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Qualifications Status</label>
                                    <select class="form-control form-control-sm 2select" name="qual_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-qualifications mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-qualifications', '.editQualForm')">Edit Qualifications</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editQualifications($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('qualifications.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $qual = new qualifications;
        $qual->id = $data['qualId'];
        $data['qualName']   != '' ? $qual->name = $data['qualName'] : '';
        $data['qualStatus'] != '' ? $qual->status = $data['qualStatus'] : '';
        if ($qual->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Qualifications is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id) {
        $res = qualifications::find($id);
        echo json_encode($res);
    }

}
