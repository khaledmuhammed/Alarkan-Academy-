<?php

class site_setting extends model
{
    protected $table = '`site_setting`';
}

class attendance extends model
{
    protected $table = '`attendance`';
}
class attendance_exams extends model
{
    protected $table = '`attendance_exams`';
}

class student_training extends model
{
    protected $table = '`student_training`';
}

class joining_purposes extends model
{
    protected $table = '`joining_purposes`';
}

class military_status extends model
{
    protected $table = '`military_status`';
}

class payment extends model
{
    protected $table = '`payment`';
}
class pay_for extends model
{
    protected $table = '`pay_for`';
}

class expenses extends model
{
    protected $table = '`expenses`';
}

class resources extends model
{
    protected $table = '`resources`';
}

class results extends model
{
    protected $table = '`results`';
}

class social_status extends model
{
    protected $table = '`social_status`';
}

class student_details extends model
{
    protected $table = '`student_details`';
}

class department_subjects extends model
{
    protected $table = '`department_subjects`';
}

class relation_status extends model
{
    protected $table = '`relation_status`';
    public static function optionOrg($y ="", $x ='1=1'){
        $a = new static;
     $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
     $res = '<option value="" >إختر العلاقة</option>';
     $data = $a->fetch("SELECT id,name FROM {$a->table} WHERE $x ");
     foreach ($data as $key => $value) {
         $id = $value['id'];
         $name = $value['name'];
         if ($name == $y) {
             $res.= "<option value='$id' selected> $name </option>";
         }else {
             $res.= "<option value='$id'> $name </option>";
         }
     }
     print_r ($res);
    }
}

class student_status extends model
{
    protected $table = '`student_status`';
}

class employees extends model
{
    protected $table = '`employees`';
}
class lost_cards extends model
{
    protected $table = '`lost_cards`';
}
class branches extends model
{
    protected $table = '`branches`';
}
class expense_for extends model
{
    protected $table = '`expense_for`';
}
class salaries extends model
{
    protected $table = '`salaries`';
}
class pay_cat extends model
{
    protected $table = '`pay_cat`';
}
class old_status extends model
{
    protected $table = '`old_status`';
}
class old_salaries extends model
{
    protected $table = '`old_salaries`';
}
class classes extends model
{
    protected $table = '`classes`';
}
class groups extends model
{
    protected $table = '`groups`';
}
class about_us extends model
{
    protected $table = '`about_us`';
}
class lecture extends model
{
    protected $table = '`lecture`';
}
class secound_round extends model
{
    protected $table = '`secound_round`';
}
class trainee extends model
{
    protected $table = '`trainee`';
}
class course extends model
{
    protected $table = '`course`';
    public static function optionOrg($y ="", $x ='1=1'){
        $a = new static;
     $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
     $res = '<option value="" >إختر إجابة</option>';
     $data = $a->fetch("SELECT id,name,price, date FROM {$a->table} WHERE $x ");
     foreach ($data as $key => $value) {
         $id = $value['id'];
         $name = $value['name']." ".$value['price']." ".$value['date'];
         if ($id == $y) {
             $res.= "<option value='$id' selected> $name </option>";
         }else {
             $res.= "<option value='$id'> $name </option>";
         }
     }
     print_r ($res);
    }
}
class student_paper extends model
{
    protected $table = '`student_paper`';
}
