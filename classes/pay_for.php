<?php

class payFor extends model
{
    protected $table = '`pay_for`';

    public static function payForOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> خيارات الدفع</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="payFor-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Pay For -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('pay_for.php', {action:'addPayForForm'}, '.payFor-details', true, '.add-payFor')"
                        class="btn btn-info btn-sm w-100">إضافة الدفع</button>
                </div>
            <!-------------------->

            <!-- Edit Pay For -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('pay_for.php', {action:'editPayForForm'}, '.payFor-details', true, '.edit-payFor')"
                            class="btn btn-dark btn-sm w-100">تعديل الدفع</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addPayForForm($barCode) {
        ?>
            <div class="card card-info add-payFor">
                <div class="card-header"  onclick="slideToggleDiv('.add-payFor')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Pay</h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addPayForm" onsubmit="submitForm(this, 'pay_for.php')" prevent-default>
                        <input type="hidden" name="action" value="addPayFor">

                        <div class="row">
                        
                            <div class="col-md-4">
                                <label>إسم الفئة <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" name="cat_name">
                                    <option value="">إختر الفئة</option>
                                    <?php  
                                        $cat_pay = pay_cat::get_list_ne();
                                        foreach ($cat_pay as $key => $value) {
                                    ?>
                                    <option value="<?= $key ?>"><?= $value ?></option> 
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>إسم العنصر <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="pay_for_name" placeholder="Pay For Name" required> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>سعر العنصر</label>
                                    <input type="number" min="0" class="form-control form-control-sm" name="pay_for_price">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-payFor', '.addPayForm')">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addPayFor($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('payFor.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $payFor = new payFor;
        $payFor->cat_id = $data['payForcat'];
        $payFor->name = $data['payForName'];
        $payFor->price = $data['payForPrice'];
        $payFor->status = 1;
        $payForId = $payFor->save($uId);

        if ($payForId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Pay For is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editPayForForm() {
        ?>
            <div class="card card-dark edit-payFor">
                <div class="card-header"  onclick="slideToggleDiv('.edit-payFor')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> تعديل الدفع</h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editPayForm" onsubmit="submitForm(this, 'pay_for.php')" prevent-default>
                        <input type="hidden" name="action" value="editPayFor">

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>خيارات الدفع <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="pay_for_id"  onchange="getOldVal($(this).children('option:selected'), {name:'pay_for_name', price:'pay_for_price', status:'pay_for_status'}, {link:'pay_for.php', action:'getOldVal'});" required>
                                        <?= payFor::option('','1=1'); ?>                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label>إسم الفئة <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" name="edit_cat_name">
                                    <option value="">إختر فئة</option>
                                    <?php  
                                        $cat_pay = pay_cat::get_list_ne();
                                        foreach ($cat_pay as $key => $value) {
                                    ?>
                                    <option value="<?= $key ?>"><?= $value ?></option> 
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>إسم الدفع</label>
                                    <input type="text" class="form-control form-control-sm" name="pay_for_name">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>سعر الدفع</label>
                                    <input type="number" min="0" class="form-control form-control-sm" name="pay_for_price">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>حالة الدفع</label>
                                    <select class="form-control form-control-sm 2select" name="pay_for_status">
                                        <option value="">إختر حالة</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-payFor mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-payFor', '.editPayForm')">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editPayFor($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('pay_for.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $payFor = new payFor;
        $payFor->id = $data['payForId'];
        $data['editcatname']   != '' ? $payFor->cat_id = $data['editcatname'] : '';
        $data['payForName']   != '' ? $payFor->name = $data['payForName'] : '';
        $data['payForPrice']  != '' ? $payFor->price = $data['payForPrice'] : '';
        $data['payForStatus'] != '' ? $payFor->status = $data['payForStatus'] : '';
        if ($payFor->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Pay For is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id) {
        $res = payFor::find($id);
        echo json_encode($res);
    }
    public static function optionOrg($y ="", $x ='1=1'){
        $a = new static;
     $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
     $res = '<option value="" >إختر إجابة</option>';
     $data = $a->fetch("SELECT id,name_ar FROM {$a->table} WHERE $x ");
     foreach ($data as $key => $value) {
         $id = $value['id'];
         $name = $value['name_ar'];
         if ($id == $y) {
             $res.= "<option value='$id' selected> $name </option>";
         }else {
             $res.= "<option value='$id'> $name </option>";
         }
     }
     print_r ($res);
    }
}
