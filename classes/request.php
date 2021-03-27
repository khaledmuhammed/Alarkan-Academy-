<?php

class requestClass {


    public static function getRequest($id,$action) {
        $student        = student::find($id);
        $studentDetails = student_details::where('student_id', $id);
        $status         = student_status::find($student['status'])['name'];
        $department     = departments::find($studentDetails['dep_id'])['name'];
        
        ?>
        <div class="card card-dark student">
            <div class="card-header" style="height:3em;">
                <h3 class="card-title" style="font-size:1em; line-height:1.6em;"> <?=ucwords(strtolower($student['name']))?>
                    &nbsp; | &nbsp;<?= $student['name_ar'] ?>
                    <div class="form-inline float-right">
                        <a href="requests.php" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left fa-sm"></i> &nbsp;
                            Back</a>
                    </div>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barcode ID</th>
                            <th>Department</th>
                            <th>Mobile Numbers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $student['id'] ?></td>
                            <td><?= $student['barcode_id'] ?></td>
                            <td><?= $department ?></td>
                            <td><?= $studentDetails['ph_num_one'] ?> <br> <?= $studentDetails['ph_num_two'] ?> </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 text-center option-btns">
                    <div class="col-2 float-right">
                        <?= self::requestConfirm($id,$action) ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- For retrieving data coming form ajx request for any button  -->
        <div class="more-details mt-3">
        </div>
        <?php
    }


    public static function requestConfirm($sId ,$payId) {

        $statusId   = student::find($sId)['status'];
        $action = payment::find($payId)['pay_for_id'];

        $registrationForm = pay_for::where('name', 'registration form')['id'];
        $firstFund = pay_for::where('name', '1st fund')['id'];
        $secoundFund = pay_for::where('name', '2nd fund')['id'];
        $collection = pay_for::where('name', 'collection')['id'];
        $uniform = pay_for::where('name', 'uniform')['id'];
        $lostCard = pay_for::where('name', 'Lost Card')['id'];
        $ReEnrollment = pay_for::where('name', 'Re-enrollment')['id'];



        if($action == $registrationForm){
            ?>
            <div class="col-md">
                <button type="button"
                    onclick="ajxReq('student.php', {action:'payFormFundForm', id:<?= $sId ?>}, '.more-details', true, '.stud-form-fund')"
                    class="btn btn-dark btn-sm w-100">Pay Form Fund</button>
            </div>
            <?php
        }
        if($action == $firstFund){
            ?>
            <div class="col-md">
                <button type="button" onclick="ajxReq('student.php', {action:'payFirstFundForm', id:<?= $sId ?>, payId:<?= $payId ?>}, '.more-details', true, '.stud-first-fund')"
                    class="btn btn-danger btn-sm w-100">Pay 1st Fund</button>
            </div>
            <?php
        }
        if($action == $secoundFund){
           
            ?>
            <div class="col-md">
                <button type="button" onclick="ajxReq('student.php', {action:'paySecondFundForm', id:<?= $sId ?>, payId:<?= $payId ?>}, '.more-details', true, '.stud-second-fund')"
                    class="btn btn-danger btn-sm w-100">Pay 2nd Fund</button>
            </div>
            <?php
        }
        if($action ==$collection){
            ?>
            <div class="col-md">
                <button type="button" onclick="ajxReq('student.php', {action:'payCollectionForm', id:<?= $sId ?>, payId:<?= $payId ?>  }, '.more-details', true, '.stud-second-fund')"
                    class="btn btn-danger btn-sm w-100">Pay Collection</button>
            </div>
            <?php
        }
        if($action == 5){
            //for uniform
        }
        if($action == $lostCard){
            ?>
            <div class="col-md">
                <button type="button" onclick="ajxReq('student.php', {action:'payLostCardForm', id:<?= $sId ?>, payId:<?= $payId ?>  }, '.more-details', true, '.stud-second-fund')"
                    class="btn btn-danger btn-sm w-100">Pay Lost Card</button>
            </div>
            <?php
        }
        if($action == $ReEnrollment){
            ?>
            <div class="col-md">
                <button type="button" onclick="ajxReq('student.php', {action:'payReEnrollmentForm',id:<?= $sId ?>, payId:<?= $payId ?> }, '.more-details', true, '.stud-second-fund')"
                    class="btn btn-danger btn-sm w-100">Pay Re-enrollment</button>
            </div>
            <?php
        }

    }
    
    public static function table() {
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
                            {"data": "student_name"},
                            {"data": "request"}
                        ],
                        "ordering": false,
                        "lengthMenu": [10, 25, 50, 100],
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: '../ajx/request.php',
                            data: {action:'table'},
                            type: 'POST'
                        }
                    });
                });
            </script>
        <?php
    }


}