<?php

class specializations extends model
{
    protected $table = '`specializations`';

    public static function specializationsOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Specializations Options</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="specializations-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Specializations -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('specializations.php', {action:'addSpecializationsForm'}, '.specializations-details', true, '.add-specializations')"
                        class="btn btn-info btn-sm w-100">Add Specializations</button>
                </div>
            <!-------------------->

            <!-- Edit Specializations -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('specializations.php', {action:'editSpecializationsForm'}, '.specializations-details', true, '.edit-specializations')"
                            class="btn btn-dark btn-sm w-100">Edit Specializations</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addSpecializationsForm() {
        ?>
            <div class="card card-info add-specializations">
                <div class="card-header"  onclick="slideToggleDiv('.add-specializations')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Specializations </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addSpecForm" onsubmit="submitForm(this, 'specializations.php')" prevent-default>
                        <input type="hidden" name="action" value="addSpecializations">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Specializations Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="spec_name" placeholder="Specializations Name" required> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-specializations', '.addSpecForm')">Add Specializations</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addSpecializations($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('specializations.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $spec = new specializations;
        $spec->name = $data['specName'];
        $spec->status = 1;
        $specId = $spec->save($uId);

        if ($specId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Specializations is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editSpecializationsForm() {
        ?>
            <div class="card card-dark edit-specializations">
                <div class="card-header"  onclick="slideToggleDiv('.edit-specializations')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Specializations </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editSpecForm" onsubmit="submitForm(this, 'specializations.php')" prevent-default>
                        <input type="hidden" name="action" value="editSpecializations">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Specializations <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="spec_id" onchange="getOldVal($(this).children('option:selected'), {name:'spec_name', status:'spec_status'}, {link:'specializations.php', action:'getOldVal'});" required>
                                        <?= specializations::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Specializations Name</label>
                                    <input type="text" class="form-control form-control-sm" name="spec_name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Specializations Status</label>
                                    <select class="form-control form-control-sm 2select" name="spec_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-specializations mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-specializations', '.editSpecForm')">Edit Specializations</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editSpecializations($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('specializations.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $spec = new specializations;
        $spec->id = $data['specId'];
        $spec->name = $data['specName'];
        $spec->status = $data['specStatus'];
        if ($spec->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Specializations is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id) {
        $res = specializations::find($id);
        echo json_encode($res);
    }

}
