<?php
error_reporting(1);
$siteTitle='Adminspress';
@session_start();
define('SITE_URL','http://localhost/polygon/');
function getPDOObject() {
$dsn = 'mysql:host=localhost;dbname=xcode;charset=utf8';
$user = 'root';
$pass = '';
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_PERSISTENT, true);

   return $pdo;
}
function sqlfetch($query)
{
	$row=array();
	$pdo=getPDOObject();
	$sql=$pdo->query($query);
	
	$datas = $sql->fetchAll(PDO::FETCH_ASSOC);
	foreach($datas as $data)
	$row[]=$data;
	return $row;
}


/*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
function getRows($table,$conditions = array()){
	$pdo=getPDOObject();
	$sql = 'SELECT ';
	$sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
	$sql .= ' FROM '.$table;
	if(array_key_exists("where",$conditions)){
		$sql .= ' WHERE ';
		$i = 0;
		foreach($conditions['where'] as $key => $value){
			$pre = ($i > 0)?' AND ':'';
			$sql .= $pre.$key." = '".$value."'";
			$i++;
		}
	}
	
	if(array_key_exists("order_by",$conditions)){
		$sql .= ' ORDER BY '.$conditions['order_by']; 
	}
	
	if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
		$sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
	}elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
		$sql .= ' LIMIT '.$conditions['limit']; 
	}
	
	$query = $pdo->prepare($sql);
	$query->execute();
	
	if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
		switch($conditions['return_type']){
			case 'count':
				$data = $query->rowCount();
				break;
			case 'single':
				$data = $query->fetch(PDO::FETCH_ASSOC);
				break;
			default:
				$data = '';
		}
	}else{
		if($query->rowCount() > 0){
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	return !empty($data)?$data:false;
}

/*
 * Insert data into the database
 * @param string name of the table
 * @param array the data for inserting into the table
 */
function insert($table,$data){
	$pdo=getPDOObject();
	
	// $fld_str='';$val_str='';
	// if($table_name && is_array($data_array))
		// {
	  $sql="SHOW COLUMNS FROM `".$table."`";
		$columns_query= sqlfetch($sql);
		
				foreach($columns_query as $coloumn_data)  
			  $column_name[]=$coloumn_data['Field'];
				// print_r($column_name);  
	
	if(!empty($data) && is_array($data)){
		$columns = '';
		$values  = '';
		$i = 0;
		if(!array_key_exists('created',$data)){
			$data['created'] = date("Y-m-d H:i:s");
		}
		if(!array_key_exists('modified',$data)){
			$data['modified'] = date("Y-m-d H:i:s");
		}

		$actual_data=array();
		
		foreach($data as $key=>$val)
			{
			 if(in_array($key,$column_name))
				{
					// echo $key;
					$actual_data[$key]=$val;
				}
			}
		// print_r($actual_data);
		$columnString = implode(',', array_keys($actual_data));
		$valueString = ":".implode(',:', array_keys($actual_data));
		$sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
		$query = $pdo->prepare($sql);
		foreach($actual_data as $key=>$val){
			$val = htmlspecialchars(strip_tags($val));
			$query->bindValue(":".$key, $val);
		}
		$insert = $query->execute();
		if($insert){
			$data['id'] = $pdo->lastInsertId();
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/*
 * Update data into the database
 * @param string name of the table
 * @param array the data for updating into the table
 * @param array where condition on updating data
 */
function update($table,$data,$conditions){
	
	$sql="SHOW COLUMNS FROM `".$table."`";
		$columns_query= sqlfetch($sql);
		
				foreach($columns_query as $coloumn_data)  
			  $column_name[]=$coloumn_data['Field'];
	$actual_data=array();
		
		foreach($data as $key=>$val)
			{
			 if((in_array($key,$column_name)) )
				{
					// echo $key;
					$actual_data[$key]=addslashes($val);
				}
			}
	$pdo=getPDOObject();
	
	
	if(!empty($actual_data) && is_array($actual_data)){
		$colvalSet = '';
		$whereSql = '';
		$i = 0;
		// if(!array_key_exists('modified',$data)){
			// $actual_data['modified'] = date("Y-m-d H:i:s");
		// }
		foreach($actual_data as $key=>$val){
			$pre = ($i > 0)?', ':'';
			$val = ($val);
			$colvalSet .= $pre.$key."='".$val."'";
			$i++;
		}
		if(!empty($conditions)&& is_array($conditions)){
			$whereSql .= ' WHERE ';
			$i = 0;
			foreach($conditions as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$whereSql .= $pre.$key." = '".$value."'";
				$i++;
			}
		}
		$sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
		$query = $pdo->prepare($sql);
		$update = $query->execute();
		return $update?$query->rowCount():false;
	}else{
		return false;
	}
}

/*
 * Delete data from the database
 * @param string name of the table
 * @param array where condition on deleting data
 */
function del($table,$conditions){
	$pdo=getPDOObject();
	$whereSql = '';
	if(!empty($conditions)&& is_array($conditions)){
		$whereSql .= ' WHERE ';
		$i = 0;
		foreach($conditions as $key => $value){
			$pre = ($i > 0)?' AND ':'';
			$whereSql .= $pre.$key." = '".$value."'";
			$i++;
		}
	}
	$sql = "DELETE FROM ".$table.$whereSql;
	$delete = $pdo->exec($sql);
	return $delete?$delete:false;
}


function get_active_status_text($num)
{
	$status='';
	if($num==0)
		$status='<span class="label label-default">Deactive</span>';
	if($num==1)
		$status='<span class="label label-success">Active</span>';
	return $status;
}

function check_session()
{
	if(!isset($_SESSION['admin_sithub_id']))
	{
		header('location:alogin.php'); 
                exit();
	}
}

function check_login()
{
	if(isset($_SESSION['admin_sithub_id']))
	{
		header('location:./index.php');
	}
}

function login_me()
{	

	$pdo=getPDOObject();
	if(($_POST['email']=='') || ($_POST['pass']==''))
		$message='
	<div class="alert alert-danger">
		Please enter Username and Password
	</div>';
	else
	{
		


		$user=md5($_POST['email']);
		$pass=md5($_POST['pass']);
		
		
			
		
$stmt = $pdo->prepare("SELECT id FROM admin where md5(username)=? and md5(password)=? order by id limit 1");
$stmt->execute(array($user,$pass));
$num=$stmt->rowCount();
	
		if($num>0)
		{
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($row as $admin)
			{
			
			session_start();
			$_SESSION['admin_sithub_id']=$admin['id'];
			$message='<div class="alert alert-success">Login Successful ,Please Refresh page if not redirected.</div>';
			header('location:./index.php');
			}
			
		}
		else
		{
			$message='
			<div class="alert alert-danger">
			Invalid Credentials, Please check Your Username and Password
			</div>';
			
		}
	}
	return $message;
}

function get_topics_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT id from topics");
	$num=$sql->rowCount();
	return $num;
}
function get_total_student_active_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT id from student where actstat='1'");
	$num=$sql->rowCount();
	return $num;
}
function get_tags_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT id from tags");
	$num=$sql->rowCount();
	return $num;
}
function get_total_public_active_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT id from public_register where actstat='1'");
	$num=$sql->rowCount();
	return $num;
}

function get_category_name($code)
{
	$categoryname='';
	$newcode=explode(',',$code);
	foreach($newcode as $res)
	{
	    
	$data=sqlfetch("SELECT name FROM category where id='$res'");
	foreach($data as $category)
	{
		$categoryname=$category['name'].'&nbsp;';
	}
	}
	return $categoryname;
}

function get_category_mod_name($code)
{
	$categoryname='';
	$data=sqlfetch("SELECT name FROM course_mod where id='$code'");
	foreach($data as $category)
	{
		$categoryname=$category['name'];
	}
	return $categoryname;
}
function get_modules_of_courses($course_str)
{
	$modules_arr=array();
	$course_arr=explode(',',$course_str);
    $data=sqlfetch("select id,mainid from `course_mod`");
		foreach($data as $course_mod)
		{
			$course_mod_arr=explode(',',$course_mod['mainid']);
			if(count($course_mod_arr))
			foreach($course_mod_arr as $course_mod_num )
			{
				if(in_array($course_mod_num,$course_arr))
				{
					$modules_arr[]=$course_mod['id'];
				}
				else{}	
			}
		}
	return $modules_arr=array_unique($modules_arr);
}
function get_new_member_count()
{
	$pdo=getPDOObject();
	$sql=$pdo->query("SELECT id from seller where actstat='0'");
	$num=$sql->rowCount();
	return $num;
}

function get_studname($id,$type)
{
	
	$name='';
	$query='';
	if($type=='Public')
		$query="SELECT name from public_register where id='$id'";
		else
		
	$query="SELECT name from student where id='$id'";
	$sql=sqlfetch($query);
	foreach($sql as $data)
	$name=$data['name'];
	return $name;
}

function get_test_name($id)
{
	
	$name='';
	
		$query="SELECT name from test where id='$id'";
	$sql=sqlfetch($query);
	foreach($sql as $data)
	$name=$data['name'];
	return $name;
}

function get_admin_id()
{
	$mid=$_SESSION['admin_sithub_id'];
	return $mid;
}

function get_blog_name($id)
{
	$name='';
	$data=sqlfetch("SELECT name FROM blog where id='$id'");
	if(count($data))
		foreach($data as $blog)
		{
			$name=$blog['name'];
		}
	return $name;
}

function get_student_by_bill_id($bid){
	$stud_id=0;
	// echo $bid;
			$temp_bid_arr=array();
			$temp_bid_str='';
	//echo $bid;
	$students=sqlfetch("Select id,bid FROM student where bid like '%$bid%'");
	if(count($students))
	{
		foreach($students as $student)
		{
			$temp_bid_str=$student['bid'];
			$temp_bid_arr=explode(',',$temp_bid_str);
			if(in_array($bid,$temp_bid_arr))
			$stud_id=$student['id'];
		}
	}
		// echo $stud_id;
	return $stud_id;
}

function is_student_profile_active($id)
{
	$name='';
	
	if(get_student_by_bill_id($id))
		return 1;
	else
		return 0;
}

function add_quote_to_stud($id,$prev_id)
{
	$student_sql=sqlfetch("SELECT bid FROM student where id='$prev_id'");
	if(count($student_sql))
	$temp_bid_arr=array();
		foreach($student_sql as $student)
		{   
			$temp_bid_str=$student['bid'];
			$temp_bid_arr=explode(',',$temp_bid_str);
			$temp_bid_arr[]=$id;
			$bid=implode(',',$temp_bid_arr);
			
			update('student',array('bid'=>$bid),array('id'=>$prev_id));
		}
}

function get_bill_total($id)
{
	$total='';
	$data=sqlfetch("SELECT price FROM bill where id='$id'");
	if(count($data))
		foreach($data as $blog)
		{
			$total=$blog['price'];
		}
	return $total;
}

function get_rest_amt_by_bill_id($id)
{
	$bill_total=get_bill_total($id);
	$leftamount=$bill_total;
	$invoice_sql=sqlfetch("SELECT amt FROM `invoice` where bid='$id'");
	if(count($invoice_sql))
	{
		foreach($invoice_sql as $invoice)
		{
			// echo $invoice['amt'].',';
			$leftamount=$leftamount-$invoice['amt'];
		}
	}
	return $leftamount;
}
function get_tag_name($name)
{
	$tag_id='';
	$data=sqlfetch("SELECT tag_id FROM topics where name='$name'");
	if(count($data))
		foreach($data as $tag)
		{
			$tag_id=$tag['tag_id'];
		}
	return $tag_id;
}


?>