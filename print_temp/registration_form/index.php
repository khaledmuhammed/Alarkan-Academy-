<?php
    
    function registrationForm($data ='') { ob_start();?>
        <!DOCTYPE html>
            <html lang='ar'>

            <head>

                <meta charset='UTF-8'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>Registration Form</title>

                <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
                    integrity='sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN' crossorigin='anonymous'>
                <link rel='stylesheet' href='https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css'
                    integrity='sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If' crossorigin='anonymous'>
                <link rel='stylesheet' type='text/css' media='print' href='css/style.css' />
                <style>
                html {
                    overflow-x: hidden;
                }

                body {
                    direction: rtl;
                    margin: -2.2mm -11.2mm;
                }

                .title {
                    width: 30%;
                }

                .container-fluid {
                    margin: 0;
                    padding: 0;
                }
                </style>

            </head>

            <body class=''>
                <div class='container-fluid'>
                    <!-- Header -->
                    <div class='row' style='margin:auto;'>
                        <div class='col-md-12 mt-4 text-center'>
                            <img src='../print_temp/registration_form/images/header.png' alt='logo' />
                        </div>
                    </div>

                    <!-- Details Table -->
                    <div class='row mt-5 mb-2' style='width:85%; margin:auto; border:1px solid #c1c1c1;'>
                        <div class='col-md-12 mt-3'>
                            <table class='table table-bordered'>

                                <tr>
                                    <th class='title' scope='row'>الاسم باللغة العربية</th>
                                    <td colspan='6'><?= $data['name_ar'] ?></td>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>الاسم باللغة الانجليزية</th>
                                    <td colspan='6'><?= $data['name'] ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>المؤهل</th>
                                    <td><?= qualifications::find($data['qual_id'])['name'] ?></td>
                                    <th scope='row'>التخصص</th>
                                    <td><?= specializations::find($data['spec_id'])['name'] ?></td>
                                    <th scope='row'>سنة التخرج</th>
                                    <td><?= $data['graduation_year'] ?></td>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>محل الإقامة</th>
                                    <td colspan='6'><?= $data['address'] ?></td>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>رقم الموبايل الخاص</th>
                                    <td colspan='2'><?= $data['ph_num_one'] ?></td>
                                    <?= isset($data['ph_num_two']) ? '<td colspan=\'6\'>'.$data['ph_num_two'].'</td>': 'لا يوجد'?>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>رقم هاتف المنزل</th>
                                    <?= isset($data['home_num']) ? '<td colspan=\'6\'>'.$data['home_num'].'</td>': 'لا يوجد'?>
                                </tr>

                                
                                <tr>
                                    <th scope='row'>الموقف من التجنيد</th>
                                    <td colspan='2'><?= military_status::find($data['military_status_id'])['name'] ?></td>
                                    <th scope='row'>الحالة الاجتماعية</th>
                                    <td colspan='2'><?= social_status::find($data['social_status_id'])['name'] ?></td>
                                </tr>


                                <tr>
                                    <th class='title' scope='row'>رقم البطاقة القومية</th>
                                    <td colspan='6'><?= $data['national_id'] ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>تاريخ الميلاد</th>
                                    <td colspan='2'><?= $data['dob'] ?></td>
                                    <th scope='row'>العمر</th>
                                    <td colspan='2'><?= date('Y') - date('Y', strtotime($data['dob'])) ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>اسم المعرف</th>
                                    <td colspan='2'><?= $data['ref_name_one'] ?></td>
                                    <th scope='row'>رقم الهاتف</th>
                                    <td colspan='2'><?= $data['ref_ph_one'] ?></td>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>صلة القرابة</th>
                                    <td colspan='6'><?= relation_status::find($data['ref_rel_one'])['name'] ?></td>
                                </tr>

                                <?php if ($data['ref_name_two']) { ?>
                                <tr>
                                    <th scope='row'>اسم المعرف الثاني</th>
                                    <td colspan='2'><?= $data['ref_name_two'] ?></td>
                                    <th scope='row'>رقم الهاتف</th>
                                    <td colspan='2'><?= $data['ref_ph_two'] ?></td>
                                </tr>
                                <tr>
                                    <th class='title' scope='row'>صلة القرابة</th>
                                    <td colspan='6'><?= relation_status::find($data['ref_rel_two'])['name'] ?></td>
                                </tr>
                                <?php } ?>


                                <tr>
                                    <th class='title' scope='row'>القسم المراد الإلتحاق به</th>
                                    <td colspan='6'><?= $data['dep_name']?></td>
                                </tr>

                                <tr>
                                    <th class='title' scope='row'>الغرض من الإلتحاق</th>
                                    <td colspan='6'><?= joining_purposes::find($data['join_purpose_id'])['name'] ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>هل تم فصلك من معهد أخر أو كلية لأسباب تأديبية أو أسباب أخرى ؟ </th>
                                    <td colspan='6'><?= $data['problem_ans'] == 'no' ? 'لا' : 'نعم'; ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>السبب</th>
                                    <td colspan='6'><?= $data['problem_reason'] == '' ? 'لا يوجد' : $data['problem_reason']; ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>هل تعاني من مشاكل طبيه او صحية او نفسية؟</th>
                                    <td colspan='2'><?= $data['medical_ans'] == 'no' ? 'لا' : 'نعم'; ?></td>
                                    <th scope='row'>اسم المرض او العملية</th>
                                    <td colspan='2'><?= $data['medical_disease'] == '' ? 'لا يوجد' : $data['medical_disease']; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope='row'>هل لديك دورات بالحاسب الآلي ؟</th>
                                    <td colspan='2'><?= $data['computer_skills'] == 'no' ? 'لا' : 'نعم'; ?></td>
                                    <th scope='row'>هل لديك مهارات خاصة</th>
                                    <td colspan='2'><?= $data['general_skills'] == '' ? 'لا يوجد' : $data['general_skills']; ?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>هل اطلعت على الشروط والاحكام الخاصه بالتقديم والتسجيل كاملة وتوافق عليها ؟</th>
                                    <td colspan='6'>......................................................................................................................................</td>
                                </tr>

                            </table>
                        </div>

                        <div class='col-md-12 mt-3 mb-2' style='border-bottom: 1px solid rgba(0, 0, 0, 0.73);'>
                            <p class='font-weight-bold text-center' style='font-weight: 800;'>اقرار الطالب</p>
                            <hr style='width:90px;border-top: 2px solid rgba(0, 0, 0, 0.73);'>
                            <p>
                                أقر أنا: .......................................... , المتقدم الى الاركان لتطوير وتدريب وتنمية الموارد
                                البشرية والعلوم الطبية والصحية بأن جميع المستندات المرفقة والمقدمة الخاصه بي سليمة وصحيحة , وانه في
                                حال تغيير اي بيانات سأقوم بتزويدها لإدارة الاكاديمية , وأقر بالالتزام والحضور ومراعاة شرف المهنة ,
                                وأوافق على التزامي بشروط واحكام ولوائح وقواعد الاكاديمية , وأنني على علم كامل بالرسوم السنوية لكل
                                سنة , كما انني اوافق على كل بنودها كاملة وذلك تجنباً للعقوبات المنصوص عليها بالشروط الحالية
                                والمستجدة , وسيتم اخطار ولي الأمر بكل تلك الشروط وحضوره معي المقابله الشخصية , كما لا يحق لي بأي حال
                                من الأحوال مخالفة الشروط والأحكام واللوائح والانظمة والتعليمات الحالية أو المستقبلية أو المستجدة أو
                                أن أطعن فيها أو أعترض عليها أو أحتج بأميتي , وهذا اقرار مني بذلك .
                            </p>
                        </div>

                        <div class='col-md-6 mt-2 mb-2' style='border-bottom: 1px solid rgba(0, 0, 0, 0.73);'>
                            <p>
                                <span style='font-weight: 800;'>المقر بما فيه :</span>
                                <span>..............................................................................................</span>

                            </p>
                        </div>

                        <div class='col-md-6 mt-2 mb-2' style='border-bottom: 1px solid rgba(0, 0, 0, 0.73);'>
                            <p>
                                <span style='font-weight: 800;'>التاريخ : </span>
                                <span><?=date('Y-m-d')?></span>
                                <p>
                        </div>

                        <div class='col-md-12 mt-2' style='border-bottom: 1px solid rgba(0, 0, 0, 0.73);'>
                            <p>
                                <span style='font-weight:800; font-size: 14.8px;'>توقيع المسؤول الاداري بمطابقة المستندات وتوقيع ولي
                                    الأمر والطالب واطلاعهم على الشروط والاحكام والرسوم والاقرارات </span>
                                <span>‏<?= $_SESSION['username']?>:.........................................</span>
                                <p>
                        </div>
                    </div>

                </div>
            </body>

            </html>

            <?php 
                $output = ob_get_contents();
                ob_end_clean();
                return $output;
    } 


    

    function receiptForm($id) {
        ob_start();
        if(is_array($id)){
            $ids ="";$receiptType="";$payval =0;
            foreach ($id as  $value) {
                $payment = payment::where('id',$value);
                $ids .= $payment['id'].",";
                $payval += $payment['value'];
                $receiptType .= pay_for::where('id',$payment['pay_for_id'])['name_ar'] .",";
            }
            $payment['id']= $ids;
            $payment['value'] = $payval;
        }else{
            $payment = payment::where('id',$id);
            $receiptType = pay_for::where('id',$payment['pay_for_id'])['name_ar'];
        }
        $studentId =  $payment['student_id'];
        $student = student::where('id',$studentId);
        $studentDetail = student_details::where('student_id',$studentId);
        $sDepartment = $studentDetail['dep_id'];
        $department = departments::where('id',$sDepartment)['name'];
        ?>
        <!DOCTYPE html>
            <html lang='ar'>

            <head>

            <meta charset='UTF-8'>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>إيصال مدفوعات</title>

            <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
                integrity='sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN' crossorigin='anonymous'>
            <link rel='stylesheet' href='https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css'
                integrity='sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If' crossorigin='anonymous'>
            <link rel='stylesheet' type='text/css' media='print' href='css/style.css' />
            <style>
            html {
                overflow-x: hidden;
            }

            body {
                direction: rtl;
                margin: -2.2mm -11.2mm;
            }

            .title {
                width: 30%;
            }

            .container-fluid {
                margin: 0;
                padding: 0;
            }
            </style>

        </head>
        <?php 
            //$payment =  payment::find($id);
        ?>

        <body class=''>
            <div class='container-fluid mb-4'>
                <!-- Header -->
                <div class='row' style='margin:auto;'>
                    <div class='col-md-12 mt-4 text-center'>
                        <img src='../print_temp/registration_form/images/alarkanLogo.jpg' alt='logo' class='mb-2' style='width:100px;height:100px;' />
                    </div>
                    <div class='mt-2 row text-center' style='margin:auto;'>
                        <span class='font-weight-bold p-2 border border-dark'> أكاديمية الأركان - Alarkan Academy </span>
                    </div>
                </div>
                <!-- content -->
                <div class='row ml-auto mt-2'>
                    <div class='col-md-3 m-auto text-center'>
                        <table class='text-center table table-borderless ml-5'>
                            <tbody>
                                <tr>
                                    <th scope='row'>رقم السند</th>
                                    <td ><?=$payment['id']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>التاريخ</th>
                                    <td><?=$payment['date']?></td>
                                </tr>
                                <tr>
                                    <th scope='row' >الاسم</th>
                                    <td ><?=$student['name_ar']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الرقم القومى</th>
                                    <td colspan='2'><?=$student['national_id']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>كارنية</th>
                                    <td colspan='2'>مستجد</td>
                                </tr>
                                <tr>
                                    <th scope='row'>الشعبة</th>
                                    <td colspan='2'><?=$department?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>المبلغ</th>
                                    <td colspan='2'><?= number_format($payment['value'],2);?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الغرض</th>
                                    <td colspan='2'><?=$receiptType?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الفرع</th>
                                    <td colspan='2'><?=branches::find($_SESSION['branch_id'])['name']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>


            </div>
        </body>

        </html>

        <?php 
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
    } 


    function expenseForm($id) {
        ob_start();
    
        $expense = expenses::where('id',$id);
        $receiptType = expense_for::where('id',$expense['expense_for_id'])['name_ar'];
        
        $studentId =  $expense['student_id'];
        $student = student::where('id',$studentId);
        $studentDetail = student_details::where('student_id',$studentId);
        $sDepartment = $studentDetail['dep_id'];
        $department = departments::where('id',$sDepartment)['name'];
        ?>
        <!DOCTYPE html>
            <html lang='ar'>

            <head>

            <meta charset='UTF-8'>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>إيصال مصروفات</title>

            <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
                integrity='sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN' crossorigin='anonymous'>
            <link rel='stylesheet' href='https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css'
                integrity='sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If' crossorigin='anonymous'>
            <link rel='stylesheet' type='text/css' media='print' href='css/style.css' />
            <style>
            html {
                overflow-x: hidden;
            }

            body {
                direction: rtl;
                margin: -2.2mm -11.2mm;
            }

            .title {
                width: 30%;
            }

            .container-fluid {
                margin: 0;
                padding: 0;
            }
            </style>

        </head>
        <?php 
            //$payment =  payment::find($id);
        ?>

        <body class=''>
            <div class='container-fluid mb-4'>
                <!-- Header -->
                <div class='row' style='margin:auto;'>
                    <div class='col-md-12 mt-4 text-center'>
                        <img src='../print_temp/registration_form/images/alarkanLogo.jpg' alt='logo' class='mb-2' style='width:100px;height:100px;' />
                    </div>
                    <div class='mt-2 row text-center' style='margin:auto;'>
                        <span class='font-weight-bold p-2 border border-dark'> أكاديمية الأركان - Alarkan Academy </span>
                    </div>
                </div>
                <!-- content -->
                <div class='row ml-auto mt-2'>
                    <div class='col-md-3 m-auto text-center'>
                        <table class='text-center table table-borderless ml-5'>
                            <tbody>
                                <tr>
                                    <th scope='row'>رقم السند</th>
                                    <td ><?=$expense['id']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>التاريخ</th>
                                    <td><?=$expense['date']?></td>
                                </tr>
                                <tr>
                                    <th scope='row' >الاسم</th>
                                    <td ><?=$student['name_ar']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الرقم القومى</th>
                                    <td colspan='2'><?=$student['national_id']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>كارنية</th>
                                    <td colspan='2'>مستجد</td>
                                </tr>
                                <tr>
                                    <th scope='row'>الشعبة</th>
                                    <td colspan='2'><?=$department?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>المبلغ</th>
                                    <td colspan='2'><?= number_format($expense['value'],2);?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الغرض</th>
                                    <td colspan='2'><?=$receiptType?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الفرع</th>
                                    <td colspan='2'><?=branches::find($_SESSION['branch_id'])['name']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>


            </div>
        </body>

        </html>

        <?php 
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
    } 

    function traineeForm($id) {
        ob_start();
        if(is_array($id)){
            $ids ="";$receiptType="";$payval =0;
            foreach ($id as  $value) {
                $payment = payment::where('id',$value);
                $ids .= $payment['id'].",";
                $payval += $payment['value'];
                $receiptType .= pay_for::where('id',$payment['pay_for_id'])['name_ar'] .",";
            }
            $payment['id']= $ids;
            $payment['value'] = $payval;
        }else{
            $payment = payment::where('id',$id);
            $receiptType = pay_for::where('id',$payment['pay_for_id'])['name_ar'];
        }
        $studentId =  $payment['trainee_id'];
        $student = trainee::find($studentId);
        $sDepartment = $student['course_id'];
        $department = course::find($sDepartment)['name'];
        ?>
        <!DOCTYPE html>
            <html lang='ar'>

            <head>

            <meta charset='UTF-8'>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <title>Registration Form</title>

            <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
                integrity='sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN' crossorigin='anonymous'>
            <link rel='stylesheet' href='https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css'
                integrity='sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If' crossorigin='anonymous'>
            <link rel='stylesheet' type='text/css' media='print' href='css/style.css' />
            <style>
            html {
                overflow-x: hidden;
            }

            body {
                direction: rtl;
                margin: -2.2mm -11.2mm;
            }

            .title {
                width: 30%;
            }

            .container-fluid {
                margin: 0;
                padding: 0;
            }
            </style>

        </head>
        <?php 
            //$payment =  payment::find($id);
        ?>

        <body class=''>
            <div class='container-fluid mb-4'>
                <!-- Header -->
                <div class='row' style='margin:auto;'>
                    <div class='col-md-12 mt-4 text-center'>
                        <img src='../print_temp/registration_form/images/alarkanLogo.jpg' alt='logo' class='mb-2' style='width:50px;height:50px;' />
                    </div>
                    <div class='mt-2 row text-center' style='margin:auto;'>
                        <span class='p-2 border border-dark'> أكاديمية الأركان - Alarkan Academy </span>
                    </div>
                </div>
                <!-- content -->
                <div class='row mt-2'>
                    <div class='col-md-3 m-auto text-center'>
                        <table class='text-center table table-borderless ml-5'>
                            <tbody>
                                <tr>
                                    <th scope='row'>رقم السند</th>
                                    <td ><?=$payment['id']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>التاريخ</th>
                                    <td><?=$payment['date']?></td>
                                </tr>
                                <tr>
                                    <th scope='row' >الاسم</th>
                                    <td  class='border border-dark '><?=$student['name']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الرقم القومى</th>
                                    <td colspan='2'><?=$student['national_id']?></td>
                                </tr>

                                <tr>
                                    <th scope='row'>المبلغ</th>
                                    <td colspan='2'><?=$payment['value']?></td>
                                </tr>
                                <tr>
                                    <th scope='row'>الغرض</th>
                                    <td colspan='2'><?=$receiptType ." (". $department.")"?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>



            </div>
        </body>

        </html>

        <?php 
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
    } 
?>