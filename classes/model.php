<?php

class model extends db
{
    protected $table = '';

    protected $fillable = [];

    public function received_data()
    {
        $fields = $this->fetch('SHOW COLUMNS FROM '.$this->table);
        foreach ($fields as $filed) {
            // code...
            $this->fillable[] = $filed['Field'];
        }
        $data = [];
        foreach ($this->fillable as $k => $v) {
            if (property_exists($this, $v)) {
                $data[$v] = $this->$v;
            }
        }

        return $data;
    }

    // 	public function log($fun ,$tbname){
//
    // 	}
    public function save($id = null)
    {
        //get the prepared sql for insert.
        $data = $this->received_data();
        $sql = 'INSERT INTO '.$this->table;
        $sql .= ' (`';
        $sql .= implode('`,`', array_keys($data));
        $sql .= "`) VALUES('";
        $sql .= implode("','", array_values($data));
        $sql .= "');";

        // echo '<pre>';
        // print_r($sql);
        // echo '</pre>';
        // die;

        $res = $this->query($sql);

        if ($res) {
            /*
            * This function is predefined in the DB class.
            * It returns the last inserted id in the database.
            */
            $date = date('Y-m-d H:i:s');
            $id = $this->last_inserted_id();
            $sql2 = "INSERT INTO log(`create_date`, `table_name`, `fun`, `user_id`, `note`) VALUES ('$date', '$this->table', 'Add New Patient', '$id', 'del this col.') ";
            $res2 = $this->query($sql2);

            return $id;
        } else {
            // throw new Exception( 'Query error:'.mysqli_error($con) );
            return false;
        }
    }

    public function saveArray($data, $uid)
    {
        //get the prepared sql for insert.
        if (!is_array($data) || count($data) < 1) {
            return false;
        }
        $a = new static();
        $sql = 'INSERT INTO '.$a->table;
        $sql .= ' (`';
        $sql .= implode('`,`', array_keys($data));
        $sql .= "`) VALUES('";
        $sql .= implode("','", array_values($data));
        $sql .= "');";
        $res = $a->query($sql);
        $id = $a->last_inserted_id();

        if ($res) {
            /*
            * This function is predefined in the DB class.
            * It returns the last inserted id in the database.
            */
            $date = date("Y-m-d H:i:s");
            $fun  = "Insert Into";
            $note = "$fun this table $a->table";

            $sql2 = "INSERT INTO log(`create_date`,`table_name`,`fun`,`user_id` ,`note`) VALUES ('$date' ,'$this->table' ,'$fun' ,'$uid' , '$note') ";
            $res2 = $this->query($sql2);

            return $id;
        } else {
            // throw new Exception( 'Query error:'.mysqli_error($con) );
            return false;
        }
    }


    public static function saveArrayOrg($data){
		//get the prepared sql for insert.
		if (!is_array($data) || count($data)<1) return false;
		$a = new static;
		$sql  = 'INSERT INTO '.$a->table;
		$sql .= ' (`';
		$sql .= implode('`,`',array_keys($data));
		$sql .= "`) VALUES('";
		$sql .= implode("','", array_values($data));
		$sql .= "');";
		$res = $a->query($sql);
		
		if ($res) {
			/*
			* This function is predefined in the DB class.
			* It returns the last inserted id in the database.
			*/
			return $a->last_inserted_id();
		}else{
			// throw new Exception( 'Query error:'.mysqli_error($con) );
			return false;
		}
	}

    // UPDATE users SET col1='value',col2='value' WHERE id=3

    public function update($uid)
    {
        $data = $this->received_data();
        $i = 0;

        $sql = "UPDATE {$this->table} SET ";
        foreach ($data as $k => $v) {
            $sql .= '`'.$k."`='{$v}' ";
            if ($i < count($data) - 1) {
                $sql .= ',';
            }
            ++$i;
        }
        $sql .= ' WHERE id='.$this->id;
        //perfom this SQL with query function which is predefined in the DB class.

        $res = $this->query($sql);

        if ($res) {
            $date = date('Y-m-d H:i:s');

            $sql2 = "INSERT INTO log(`create_date`,`table_name`,`fun`,`user_id`) VALUES ('$date', '$this->table', 'Edit User Details', '$uid') ";
            //$sql2 = 'INSERT INTO log create_date=date("Y-m-d H:i:s"),table_name=$this->table,function = $fun' ;
            $res2 = $this->query($sql2);

            return true;
        } else {
            throw new Exception('Query error:'.mysqli_error($con));
        }
    }

    // updateArray Method usage
    // $x = array();
    // $x['status'] = 2;
    // table::updateArray($x,'id',$uid);
    public function updateArray($data, $field, $value, $uid)
    {
        $a = new static();
        $i = 0;
        $sql = "UPDATE {$a->table} SET ";
        
        foreach ($data as $k => $v) {
            $sql .= '`'.$k."`='{$v}' ";
            if ($i < count($data) - 1) {
                $sql .= ',';
            }
            ++$i;
        }
        
        $sql .= ' WHERE `'.$field."`='".$value."'";
        $res = $a->query($sql);
        
        //perfom this SQL with query function which is predefined in the DB class.
        if ($res) {
            $date = date("Y-m-d H:i:s");
            $fun  = "Update";
            $note = "$fun this table $a->table";

            $sql2 = "INSERT INTO log (`create_date`,`table_name`,`fun`,`user_id` ,`note`) VALUES ('$date', '$this->table', '$fun', '$uid', '$note')";
            $res2 = $this->query($sql2);

            return true;
        } else {
            throw new Exception('Query error:'.mysqli_error($con));
        }
    }



    public static function updateArrayOrg($data, $field, $value){
		$a = new static;
		$i=0;
		$sql="UPDATE {$a->table} SET ";
		foreach ($data as $k => $v) {
			$sql .= '`'.$k."`='{$v}' ";
			if ($i < count($data)-1) {
				$sql .=',';
			}
			$i++;
		}
		$sql .= " WHERE `".$field."`='".$value."'";
		//perfom this SQL with query function which is predefined in the DB class.
		$res = $a->query($sql);
		
		if ($res) {
			return true;
		}else{
			throw new Exception( 'Query error:'.mysqli_error($con) );
		}
    }
    
    public static function updateArrayOr($data, $field, $value){
		$a = new static;
		$i=0;
		$sql="UPDATE {$a->table} SET ";
		foreach ($data as $k => $v) {
			$sql .= '`'.$k."`='{$v}' ";
			if ($i < count($data)-1) {
				$sql .=',';
			}
			$i++;
		}
		$sql .= " WHERE `".$field."`='".$value."'";
		//perfom this SQL with query function which is predefined in the DB class.
		$res = $a->query($sql);
		
		if ($res) {
			return true;
		}else{
			throw new Exception( 'Query error:'.mysqli_error($con) );
		}
	}


    public static function all()
    {
        $a = new static();

        return $a->fetch("SELECT * FROM {$a->table}");
    }

    public static function where($col, $val)
    {
        $a = new static();
        $data = $a->fetch("SELECT * FROM {$a->table} WHERE `$col` = '$val' LIMIT 1");
        if ($data) {
            return $data[0];
        } else {
            return false;
        }
    }

    public static function all_sql($val = 'where 1=1')
    {
        $a = new static();
        $data = $a->fetch("SELECT *,{$a->table}.id as mid FROM {$a->table}  $val");

        return $data;
    }

    public static function custom_sql($sql)
    {
        $a = new static();
        $data = $a->fetch($sql);
        if ($data) {
            return $data;
        } else {
            return false;
        }
        
    }
  

    public static function find($id)
    {
        if (!is_numeric($id)) {
            return false;
        }
        $a = new static();
        $data = $a->one("SELECT * FROM {$a->table} WHERE id='$id' LIMIT 1");
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $a = new static();
        $id = $this->id;
        $sql = "DELETE FROM {$a->table} WHERE id={$id}";
        $this->query($sql);
    }

    public static function count_all()
    {
        $a = new static();

        return $a->count("SELECT * FROM {$a->table}");
    }

    public static function count_sql($val)
    {
        $a = new static();

        return $a->count("SELECT * FROM {$a->table} $val");
    }

    public static function sum_sql($col, $val)
    {
        $a = new static();
        $data = $a->one("SELECT sum($col) as amount FROM {$a->table} $val limit 1");

        return $data['amount'];
    }

    public static function secure($el)
    {
        $a = new static();
        $se = $a->con()->real_escape_string(htmlspecialchars($el));

        return $se;
    }

    public static function get_row()
    {
        $row = array();
        $a = new static();
        $rows = $a->all();
        foreach ($rows as $key => $value) {
            $row[$value['id']] = $value;
        }

        return $row;
    }

    public static function get_ids()
    {
        $row = array();
        $a = new static();
        $ids = $a->fetch("SELECT `id` FROM {$a->table}");
        foreach ($ids as $id) {
            $row[] = $id['id'];
        }

        return $row;
    }

    public static function get_list()
    {
        $row = array();
        $a = new static();
        $rows = $a->all();
        foreach ($rows as $key => $value) {
            $row[$value['id']] = $value['name'];
        }

        return $row;
    }

    public static function get_list_ne($listKey='id',$listVal='name'){
        $row = array();
        $a = new static;
        $rows = $a->all();
        foreach ($rows as $key => $value) {
            $row[$value[$listKey]] = $value[$listVal];
        }
        return $row;
    }



    public static function option($y = '', $x = '1=1')
    {
        $a = new static();
        $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
        $res = '<option value="" >إختر إجابة</option>';        
        $q = "SELECT id, name FROM {$a->table} WHERE $x and status = 1";

        if ($x[-1] == '"') {
            $q = explode('"', $q)[0];
        } else if ($x[-1] == "'") {
            $q = explode("'", $q)[0];
        };

        $q = explode("'", $q)[0];

        $data = $a->fetch($q);
        foreach ($data as $key => $value) {
            $id = $value['id'];
            $name = $value['name'];
            if ($id == $y) {
                $res .= "<option value='$id' selected> $name </option>";
            } else {
                $res .= "<option value='$id'> $name </option>";
            }
        }
        print_r($res);
    }

	public static function optionOrg($y ="", $x ='1=1'){
        $a = new static;
     $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
     $res = '<option value="" >إختر إجابة</option>';
     $data = $a->fetch("SELECT id,name FROM {$a->table} WHERE $x ");
     foreach ($data as $key => $value) {
         $id = $value['id'];
         $name = $value['name'];
         if ($id == $y) {
             $res.= "<option value='$id' selected> $name </option>";
         }else {
             $res.= "<option value='$id'> $name </option>";
         }
     }
     print_r ($res);
 }
 
 public static function checkbok($y =[], $x ='1=1'){
    $a = new static;
    $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
    $res = '<div class="form-group">';
    $data = $a->fetch("SELECT id,name FROM {$a->table} WHERE $x ");
    foreach ($data as $key => $value) {
        $id = $value['id'];
        $name = $value['name'];
        if (in_array($id,$y)) {
            $res.= "<div class='form-check'>
            <input class='form-check-input' type='checkbox' id='$id' name='{$a->table}[]' value='$id' checked=''>
            <label class='form-check-label' for='$id'>$name</label>
          </div>";
        }else {
            $res.= "<div class='form-check'>
            <input class='form-check-input' type='checkbox' id='$id' name='{$a->table}[]' value='$id'>
            <label class='form-check-label' for='$id'>$name</label>
          </div>";
        }
    }
    $res .='</div>';
    print_r ($res);
}

public static function optionsFall($y ="", $x ='1=1',$barCode){
        $a = new static;
    //  $tbName = ucwords(str_replace('_', ' ', trim($a->table, '`')));
     $res = '<option value="" >إختر إجابة</option>';
     $results = model::custom_sql(" SELECT * FROM `results` WHERE 'SUM( `midterm`,`activity`,`attendace`,`final` )' < 50 AND `student_barcode_id` = $barCode ");
     var_dump($results);
     if($results){
        foreach ($results as $key => $value) {
            
            $id = subjects::find($value['subject_id'])['id'];
            $name = subjects::find($value['subject_id'])['name'];
            if ($id == $y) {
                $res.= "<option value='$id' selected> $name </option>";
            }else {
                $res.= "<option value='$id'> $name </option>";
            }
        }
     }
     print_r ($res);
 }




    public static function enum($y, $x = '0', $col = 'status')
    {
        $matches = [];
        $a = new static();
        $res = '<option value="" >Select '.$y.' ...</option>';
        $type = $a->fetch("SHOW COLUMNS FROM  {$a->table} WHERE Field =\"$col\"");
        $type = $type[0]['Type'];
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enums = explode("','", $matches[1]);
        foreach ($enums as $name) {
            if ($name == $x) {
                $res .= "<option value='$name' selected> $name </option>";
            } else {
                $res .= "<option value='$name'> $name </option>";
            }
        }
        print_r($res);
    }

    public static function update_status($id, $val, $uid)
    {
        $a = new static();
        $a->id = $id;
        $a->status = $val;

        return $a->update($uid);
    }

   /* 
    public static function form($id = '0')
    {
        if ($id > 0) {
            $var = $filename::where('id', $id);
            $id = $var['id'];
            $name = $var['name'];
            $color = $var['color'];
            $title = 'Edit ';
        } else {
            $id = 0;
            $name = '';
            $color = '';
            $title = 'Add ';
        } 
        ?>
            <!-- <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $title.' '.$filename; ?></h3>
                </div>
                <div class="card-body">
                <form id="<?php echo $filename; ?>form">
                    <input name="action" type="hidden" class="form-control" value="add"/>
                    <input name="id" type="hidden" class="form-control" value="<?php echo $id; ?>" readonly>
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="<?php echo $filename; ?> name" required>
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" name="color" class="btn-block" value="<?php echo $color; ?>" placeholder="<?php echo $filename; ?> color" >
                    </div>
                    
                    
                    <div class="text-center">
                        <input type="button" class="btn btn-info" value="Submit"  onclick="submitForm('<?php echo $filename; ?>.php','#<?php echo $filename; ?>form')" >
                    </div>
                </form>
                </div>
            </div> -->
        <?php
    }

    // public function all_where_sql($val1,$val2){
    // 	$a = new static;
    // 	$val1 = $this->all_sql();
    // 	$val2 = $this->all_where(w1,w2);
    // 	return $this->a($val1,$val2);
    // }
    */
}
