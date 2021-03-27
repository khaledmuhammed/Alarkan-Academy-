<?php

class expenseFor extends model
{
    protected $table = '`expense_for`';

    public static function expenseForOption() {
        ?>      
            <div class="card card-dark">
                <div class="card-header" style="height:3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> Expense Options</h3>
                </div>
                <div class="card-body"> 
                    <div class="row option-btns">
                        <?php self::optionBtns(); ?>
                    </div>
                </div>
            </div>
            <!-- For retrieving data coming form ajx request for any button  -->
            <div class="expenseFor-details mt-3"></div>
        <?php
    }

    public static function optionBtns() {
        ?>
            <!-- Add Expense For -->
                <div class="col-md-6">
                    <button type="button" onclick="ajxReq('expense_for.php', {action:'addExpenseForForm'}, '.expenseFor-details', true, '.add-expenseFor')"
                        class="btn btn-info btn-sm w-100">Add Expense</button>
                </div>
            <!-------------------->

            <!-- Edit Expense For -->
                <div class="col-md-6">
                        <button type="button" onclick="ajxReq('expense_for.php', {action:'editExpenseForForm'}, '.expenseFor-details', true, '.edit-expenseFor')"
                            class="btn btn-dark btn-sm w-100">Edit Expense</button>
                    </div>
            <!-------------------->
        <?php
    }

    public static function addExpenseForForm() {
        ?>
            <div class="card card-info add-expenseFor">
                <div class="card-header"  onclick="slideToggleDiv('.add-expenseFor')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Add Expense </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="addExpenseForm" onsubmit="submitForm(this, 'expense_for.php')" prevent-default>
                        <input type="hidden" name="action" value="addExpenseFor">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense For Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="expense_for_name" placeholder="Expense For Name" required> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense For Price</label>
                                    <input type="number" min="0" class="form-control form-control-sm" name="expense_for_price">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-info" onclick="removeElem('.add-expenseFor', '.addExpenseForm')">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function addExpenseFor($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('expenseFor.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $expenseFor = new expenseFor;
        $expenseFor->name = $data['expenseForName'];
        $expenseFor->price = $data['expenseForPrice'];
        $expenseFor->status = 1;
        $expenseForId = $expenseFor->save($uId);

        if ($expenseForId) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Expense For is added successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something wrong!', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function editExpenseForForm() {
        ?>
            <div class="card card-dark edit-expenseFor">
                <div class="card-header"  onclick="slideToggleDiv('.edit-expenseFor')" style="height:2.3em;">
                    <h3 class="card-title" style="font-size:1em; line-height:.7em;"> Edit Expense For </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="editExpenseForm" onsubmit="submitForm(this, 'expense_for.php')" prevent-default>
                        <input type="hidden" name="action" value="editExpenseFor">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expense For <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm 2select" name="expense_for_id"  onchange="getOldVal($(this).children('option:selected'), {name:'expense_for_name', price:'expense_for_price', status:'expense_for_status'}, {link:'expense_for.php', action:'getOldVal'});" required>
                                        <?= expenseFor::option('', ' 1=1 "'); ?>	                   
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expense For Name</label>
                                    <input type="text" class="form-control form-control-sm" name="expense_for_name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expense For Price</label>
                                    <input type="number" min="0" class="form-control form-control-sm" name="expense_for_price">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Expense For Status</label>
                                    <select class="form-control form-control-sm 2select" name="expense_for_status">
                                        <option value="">Select Status</option>                
                                        <option value="0">OFF</option>                
                                        <option value="1" selected>ON</option>                
                                    </select> 
                                </div>
                            </div>

                        </div>
                        <div class="row selected-expenseFor mt-2 mb-4"></div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-dark" onclick="removeElem('.edit-expenseFor', '.editExpenseForm')">Edit Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function editExpenseFor($data) {
        
        // ------
            $uId = $_SESSION['userid'];
            $script = "<script>ajxReq('expense_for.php', {action:'optionBtns'}, '.option-btns', true);</script>";
        // ------

        $expenseFor = new expenseFor;
        $expenseFor->id = $data['expenseForId'];
        $data['expenseForName']   != '' ? $expenseFor->name = $data['expenseForName'] : '';
        $data['expenseForPrice']  != '' ? $expenseFor->price = $data['expenseForPrice'] : '';
        $data['expenseForStatus'] != '' ? $expenseFor->status = $data['expenseForStatus'] : '';
        if ($expenseFor->update($uId)) {
            $json['notifyDo'] = ['type' => 'success', 'msg' => 'Expense For is edited successfully!', 'script' => $script];
        } else {
            $json['notifyDo'] = ['type' => 'danger', 'msg' => 'Something Wrong', 'script' => $script];
        }

        exit(json_encode($json));
    }

    public static function getOldVal($id) {
        $res = expenseFor::find($id);
        echo json_encode($res);
    }
}