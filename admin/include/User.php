<?php session_start() ;
require 'DBclass.php';
error_reporting(0); 
date_default_timezone_set('Asia/Kolkata');

class User
{
    protected $db;
    public function __construct()
		{
			$this->db = new DB_con();
			$this->db = $this->db->ret_obj();
		}
	public function escapeString($var) {
		$result = $this->db->real_escape_string($var);
		return $result;
	}
	 /* Get result from sql query */
    public function getResult($sql) {
		
		global $rowCount;
		$resultArray = array();
		//echo $sql ;
		$result = $this->db->query($sql);
		$rowCount = $result->num_rows;
		while($arrayResult = $result->fetch_assoc()) {
			$resultArray[] = $arrayResult;	
		}
		return $resultArray;
	}
		/*****Get Single data by id****/
		 public function getResultById($table, $id) {
		
		global $rowCount;
		$resultArray = array();
		$result = $this->db->query("Select  * from ".$table." where id = '".$id."'");
		$resultArray = $result->fetch_assoc();
		return $resultArray;
	}	
	
	/* Run Query */	
	public function runQuery($sql) {		
	$result = $this->db->query($sql);	
	return $result ; }

	/* Get Website Logo */	
	public function getLogo() {		
	$result = $this->db->query("select logo from admin where admin_id='1'");	
	$logo =  $result->fetch_assoc();	
	return $logo['logo'];	}
	
	/** Insert data in to database***/
	public function insertQuery($colArray,$tablename) {
		global $dbError;
		$dbError = true;
		$query = "";
	 $query = 'INSERT INTO '.$tablename.' ('.implode(',',array_keys($colArray)).') values(\''.implode('\',\'',$colArray).'\')';
		$result = $this->db->query($query);// or die($this->db->error);
		$last_id = $this->db->insert_id;
		return $last_id;
	}
	/** Insert data in to database***/
	public function QueryInsert($query) {
		
		$result = $this->db->query($query);// or die($this->db->error);
		$last_id = $this->db->insert_id;
		return $last_id;
	}
	
	

	
	/** Status Update in to database***/
	public function updateStatus($table,$col,$val,$id) {		
	global $dbError;				$dbError = true;
	$query = "UPDATE $table SET $col='$val' WHERE id = ".$id;			
	$this->db->query($query) or die($this->db->error);		
	if($table=="main_video_promo"){		
	$query = "UPDATE $table SET $col=2 WHERE id != ".$id;	
	$this->db->query($query) or die($this->db->error);		}	}
	
	
	public function updateStatementwithAnd($colArray,$tablename,$whereValue){
		global $dbError;
		$dbError = true;
		$query = "";
		$update = array();
		
		foreach($colArray as $col => $value) {
			$update[] = $col."='".$value."'";
		}
		
		 $query = "UPDATE $tablename SET ".implode(",",$update)." WHERE ".$whereValue;
		$this->db->query($query) or die($this->db->error);
		
	}
	/*** Update data in database ***/
	public function updateQuery($colArray,$tablename,$id) {
		global $dbError;
		$dbError = true;
		$query = "";
		$update = array();
		foreach($colArray as $col => $value) {
			$update[] = $col."='".$value."'";
		}
		 $query = "UPDATE $tablename SET ".implode(",",$update)." WHERE id = ".$id;
		$this->db->query($query) or die($this->db->error);
	}
	
	/** Delete recored from table as per table **/
	public function QueryDelete($table,$tab_id) {
		$query = "DELETE FROM $table WHERE id = ".$tab_id;
		$this->db->query($query) or  die($this->db->error);
	}

	/* ****** Curl Post*******/
	public function curlPost($url, $data){

		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($data );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);
		# Print response.
		$result = json_decode($result);
		return $result ;
	}
	
	/** Get Column of a array***/
	public function getColumns($tablename) {
		$columnList = array();
		$columnTable = "SHOW COLUMNS FROM $tablename";
		$columnResult = $this->db->query($columnTable) or die($this->db->error);	
		while($columnRow  = $columnResult->fetch_row()){
			$columnList[] = $columnRow[0];
		}
		return $columnList;
	}
	
	/** Get Column value of a array***/
	public function getColumnValues($tableColumns) {
			global $_DATA;	
			$columnValues = array();
			foreach($tableColumns as $k => $v) {
				if(array_key_exists($v, $_POST)) {
					$_DATA[$v] = $_POST[$v];
					 $columnValues[$v]  = addslashes($_POST[$v]);
				}	
			}
			return $columnValues;
		}
	/** Get File Extanion name in small letters */
	public function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	/** Get City  as per City Id**/
	public function getCity($CITY_ID) {
		$query = "SELECT CITY FROM city WHERE CITY_ID = $CITY_ID";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
       return $CITY = $user_data['CITY'];
	}
	/** Get State as per State Id**/
	public function getState($STATE_ID) {
		$query = "SELECT STATE FROM state WHERE STATE_ID = $STATE_ID";
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
       return $STATE = $user_data['STATE'];
	}
	/** Get Status as per Status Id**/	public function getStatus($status_id) {	
	$query = "SELECT status FROM status WHERE status_id = $status_id";   
	$result = $this->db->query($query) or die($this->db->error);        $data = $result->fetch_array(MYSQLI_ASSOC);       return $status = $data['status'];	}		/** Get Name as per Id**/	public function getName($id,$table) {		$query = "SELECT name FROM $table WHERE ".$table."_id = $id";        $result = $this->db->query($query) or die($this->db->error);        $data = $result->fetch_array(MYSQLI_ASSOC);       return $name = $data['name'];	}
	/*Custom Echo how much word we want to echo*/
	public function custom_echo($x,$c){
			if(strlen($x)<=$c)
			{
				echo $x;
			}else{
				$y=substr($x,0,$c) . '..';
				echo $y;
			}
	}
	/* //Show Active Menu */
	public function activeClass($urlLink){
		$page = explode(",",$urlLink);
		$i = 0;
		$page_count=count($page);
		while($i<$page_count){
			if(basename($_SERVER['PHP_SELF']) == $page[$i]){
				echo 'class="active"';
			}
			$i++;
		}
	}
	
	public function hashSSHA($password){
		$salt = sha1(rand());
		$salt = substr($salt, 0, 10);
		$encrypted = base64_encode(sha1($password . $salt, true) . $salt);
		$hash = array("salt" => $salt, "encrypted" => $encrypted);
		return $hash;
	}
	
	
	public function checkhashSSHA($salt, $password){
		$hash = base64_encode(sha1($password . $salt, true) . $salt);
		return $hash;
	}

			
    /*** starting the session ***/
    public function get_session()
    {
        return $_SESSION['login'];
    }
	/* Logging out a user */
    public function user_logout()
    {
        $_SESSION['login'] = false;
        unset($_SESSION);
		session_destroy();
    }
    
}

/* //Get city state using ajax */
class area
{
	public $dbfunc;
	public function __construct()
		{
			$this->dbfunc = new User();
		}
	/* Get State in Any form field in option drop down*/
	public function getState($state_id){
		$state_query = "select state,state_id from state";
		$state_result= $this->dbfunc->getResult($state_query);
		$COUNT_STATE = count($state_result);
		$i=0;
		while($i<$COUNT_STATE) {?>
			<option value="<?php echo @$state_result[$i]['state_id'];?>" <?php if(@$state_result[$i]['state_id']==$state_id){ echo "selected";}?>><?php echo @$state_result[$i]['state'];?></option>
		<?php $i++;
		}
	}
	/* Get city in Any form field in after select state */
	public function getCity($city_id){
		$city_query = "select city,city_id from city where STATE_ID=$city_id";
		$city_result= $this->dbfunc->getResult($city_query);
		$COUNT_CITY = count($city_result);
		$i=0;
		echo '<option value="">Select City</option>';
		while($i<$COUNT_CITY) {?>
			<option value="<?php echo @$city_result[$i]['city_id'];?>"><?php echo @$city_result[$i]['city'];?></option>
		<?php $i++;
		}
	}
	
	
}
/* //check new user exits or not */
class exits_user{
	public $dbfunc;
	public function __construct()
		{
			$this->dbfunc = new User();
		}
	/* check if a user email is already exits or not with getting table and email id */
	public function check_user_exits($table,$email,$mobile){
		$email = $this->dbfunc->escapeString($email);
		$mobile = $this->dbfunc->escapeString($mobile);
		$query = "select ".strtolower($table)."_id from $table where email='$email' or mobile='$mobile' ";
		$result= $this->dbfunc->getResult($query);
		$count_row = count($result);
        if ($count_row == 1) {
			return true;/* echo "<img src='dist/img/error.png'> <span style='color:red;'>User Already Exits</span><input type='hidden' name='CHECK_EMAIL'>"; */
        }else{
			return false;/* echo "<img src='dist/img/success.png'> <span style='color:green;'> Bingo Available</span><input type='hidden' name='CHECK_EMAIL' value='$email'>"; */
        }
	}
	public function check_edit_user_exits($table,$email,$id){
		$query = "select ".strtolower($table)."_id from $table where EMAIL='$email' and ".strtolower($table)."_id!=$id";
		$result= $this->dbfunc->getResult($query);
		$count_row = count($result);
        if ($count_row == 1) {
			echo "<img src='dist/img/error.png'> <span style='color:red;'>User Already Exits</span><input type='hidden' name='CHECK_EMAIL'>";
        }else{
			echo "<img src='dist/img/success.png'> <span style='color:green;'> Bingo Available</span><input type='hidden' name='CHECK_EMAIL' value='$email'>";
        }
	}
	
}
/* //Misc Function */
class miscfunc
{
	public $dbfunc;
	public function __construct()
		{
			$this->dbfunc = new User();
		}
	/* //forget Password for user */
	public function resetPassword($email,$table)
    {
		$email = $this->dbfunc->escapeString($email);
		$table = $this->dbfunc->escapeString($table);
		$query = "SELECT ".strtolower($table)."_id,name FROM $table where email='".$email."' LIMIT 1";
        $result = $this->dbfunc->getResult($query); 		
        if(count($result)==1)
        {			if($table=="admin"){
				global $adminlink;				$url=$adminlink;			}else{				global $link;				$url=$link;			}
			$field = strtolower($table)."_id";
			$user_id = $result[0][$field];
			$id = base64_encode($user_id);
			$colArray['token_code'] = md5(uniqid(rand()));
            $this->dbfunc->updateQuery($colArray,$table,$user_id);
            $to=$email;
			$subject="Forget Password for Tune It Live";
            $from = 'info@tuneitlive.com';
			$code = $colArray['token_code'];
		/* //	$check = base64_encode($table); */
			$body="
					Hello , ".$result[0]['name']."
				   <br /><br />
				   We got request for reset your password, if you do this then just click the following link to reset your password, if not just ignore  this email,
				   <br /><br />
				   Click Following Link To Reset Your Password 
				   <br /><br />
				   <a href='$url/reset.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you :)
				";
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to,$subject,$body,$headers);
			return true;
        }
        else
        {
          return false;
        }
    }
	/* //reset password authenticate if key and id match or not */
	public function auth_key($id,$table,$code)
    {
		$id = $this->dbfunc->escapeString($id);
		$table= $this->dbfunc->escapeString($table);
		$code= $this->dbfunc->escapeString($code);
        $query = "SELECT ".strtolower($table)."_id from $table WHERE ".strtolower($table)."_id='$id' and token_code='$code'";
        $result = $this->dbfunc->getResult($query);
        $count_row = count($result);
        if ($count_row == 1) {
            return true;
        }else{
            return false;
        }
    }			/* //Verify User email Account from verification link */	public function verifyEmail($email,$table,$code)    {		$email = $this->dbfunc->escapeString($email);		$table= $this->dbfunc->escapeString($table);		$code= $this->dbfunc->escapeString($code);        $query = "SELECT ".strtolower($table)."_id from $table WHERE email='$email' and verify_code='$code'";        $result = $this->dbfunc->getResult($query);  
	$count_row = count($result);        if ($count_row == 1) {						$colArray['verify_code']="";			$colArray['status']=1;			$this->dbfunc->updateQuery($colArray,$table,$result[0][strtolower($table)."_id"]);            return true;        }else{            return false;        }    }		
	/*** Check if User exits or not with id pass***/
		 public function checkExits($uid, $pass, $tablename)    {    
		     $query = "SELECT ".strtolower($tablename)."_id,password,salt from $tablename WHERE ".strtolower($tablename)."_id=$uid ";   
		          $result = $this->dbfunc->getResult($query);   
		               $count_row = count($result);    
		                   if ($count_row == 1) {		
		                   	$salt = $result[0]['salt'];	
		                   			$encrypted_password = $result[0]['password'];	
		                   					$hash = $this->dbfunc->checkhashSSHA($salt, $pass); 	
		                   							if($hash==$encrypted_password){			
		                   								return true;		
		                   									}else{			
		                   										return false;	
		                   												}		
		                   													        }else{     
		                   													               return false;        }    } 
}

/* //Admin login Register */
class AdminUser
{
	protected $dbfunc;
	public function __construct()
		{
			$this->dbfunc = new User();
		}
	/* //Admin Login Check */
	public function check_login($email, $password)
    {
		$email = $this->dbfunc->escapeString($email);
		$password =$this->dbfunc->escapeString($password);
        $query = "SELECT admin_id,name,password,salt from admin WHERE email='$email' ";
        $result = $this->dbfunc->getResult($query);
        $count_row = count($result);
        if ($count_row == 1) {
			$salt = $result[0]['salt'];
			$encrypted_password = $result[0]['password'];
			$hash = $this->dbfunc->checkhashSSHA($salt, $password);			
			if($encrypted_password == $hash){
				$_SESSION['login'] = true; /* // this login var will use for the session thing */
				$_SESSION['admin_id'] = $result[0]['admin_id'];
				$_SESSION['name'] = $result[0]['name'];
				/* if($CHECK=='Y'){
					global $cookie_name,$cookie_time;
					setcookie($cookie_name, 'usr='.$EMAIL.'&hash='.$hash, time() + $cookie_time);
				} */
				return true;
			}
			else{
				return false;
			}
        }else{
            return false;
        }
    }
	/* ////Admin Auto Login Check via Cookie */
	public function check_auto_login($email, $hash)
    {
		$email = $this->dbfunc->escapeString($email);
		$hash =$this->dbfunc->escapeString($hash);
        $query = "SELECT admin_id,name,password,salt from admin WHERE email='$email' and password='$hash'";
        $result = $this->dbfunc->getResult($query);
        $count_row = count($result);
        if ($count_row == 1) {
            $_SESSION['login'] = true; /* // this login var will use for the session thing */
            $_SESSION['admin_id'] = $result[0]['admin_id'];
			$_SESSION['name'] = $result[0]['name'];
            return true;
        }else{
            return false;
        }
    }
	/* //Get Admin info using Admin Id */
	public function getAdminInfo($adminid)
    {
		$query = "SELECT * FROM admin where admin_id=$adminid LIMIT 1";
        $result = $this->dbfunc->getResult($query);
		return $result[0];
    }}class frontUser{	protected $dbfunc;	public function __construct()		{			$this->dbfunc = new User();		}			/* user Register */		public function regUser($name, $lname, $email, $mobile, $password){		$name = $this->dbfunc->escapeString($name);		$lname = $this->dbfunc->escapeString($lname);		$email = $this->dbfunc->escapeString($email);		$mobile = $this->dbfunc->escapeString($mobile);		$password = $this->dbfunc->escapeString($password);				$hash = $this->dbfunc->hashSSHA($password);		$encrypted_password = $hash["encrypted"];		$salt = $hash["salt"];		$join_date= date('Y-m-d h:i:s');		$verify_code = rand().md5(rand().uniqid('', true));		$result = $this->dbfunc->QueryInsert("INSERT INTO user(name, lname, email, mobile, password, salt, verify_code, join_date)VALUES('$name', '$lname', '$email', '$mobile', '$encrypted_password', '$salt', '$verify_code', '$join_date')");		if($result){			global $link;            $to=$email;			$subject="Verify Email Account for Tune It Live";            $from = 'info@tuneitlive.com';			$body="					Hello , ".$name."				   <br /><br />					You have created account on tuneitlive.com.Please confirm your account to activate your Profile. If you created this account then just click the following link to Activate your Account, if not just ignore  this email,				   <br /><br />				   Click Following Link To Activate Your Account 				   <br /><br />				   <a href='$link/verify.php?email=$email&code=$verify_code'>Click Here to Activate your Account</a>				   <br /><br />				   Thank You :)				";            $headers = "From: " . strip_tags($from) . "\r\n";            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";            $headers .= "MIME-Version: 1.0\r\n";            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";            mail($to,$subject,$body,$headers);						return true;		}else{			return false;		}	}	/* //User Login Check */	public function check_login($email, $password, $check)    {		$email = $this->dbfunc->escapeString($email);		$password =$this->dbfunc->escapeString($password);        $query = "SELECT user_id,name,password,salt from user WHERE email='$email'  and status='1'";        $result = $this->dbfunc->getResult($query);        $count_row = count($result);        if ($count_row == 1) {			$salt = $result[0]['salt'];			$encrypted_password = $result[0]['password'];			$hash = $this->dbfunc->checkhashSSHA($salt, $password);						if($encrypted_password == $hash){				$_SESSION['login'] = true; 				$_SESSION['user_id'] = $result[0]['user_id'];				$_SESSION['name'] = $result[0]['name'];				 if($check=='Y'){					global $cookie_name,$cookie_time;					setcookie($cookie_name, 'usr='.$email.'&hash='.$hash, time() + $cookie_time);				}				return true;			}else{				return false;			}        }else{            return false;        }    }		/* Check User is active or not */	public function checkUserStatus($email)    {		$email = $this->dbfunc->escapeString($email);        $query = "SELECT status from user WHERE email='$email'";        $result = $this->dbfunc->getResult($query);        $count_row = count($result);        if ($count_row == 1) {				return $result[0]['status'];        }else{            return false;        }    }	/* ////user Auto Login Check via Cookie */	public function check_auto_login($email, $hash)    {		$email = $this->dbfunc->escapeString($email);		$hash =$this->dbfunc->escapeString($hash);        $query = "SELECT user_id,name,password,salt from user WHERE email='$email' and password='$hash' and status='1'";        $result = $this->dbfunc->getResult($query);        $count_row = count($result);        if ($count_row == 1) {            $_SESSION['login'] = true; /* // this login var will use for the session thing */            $_SESSION['user_id'] = $result[0]['user_id'];			$_SESSION['name'] = $result[0]['name'];            return true;        }else{            return false;        }    }	/* //Get User info using User Id */	public function getUserInfo($userid)    {		$query = "SELECT * FROM user where user_id=$userid LIMIT 1";        $result = $this->dbfunc->getResult($query);		return $result[0];    }		}/*	public function getSize($PRODUCT_ID) {		$query = "SELECT PRODUCT_name FROM product WHERE PRODUCT_ID = $PRODUCT_ID";        $result = $this->dbfunc->getResult($query);		return $result[0]['PRODUCT_name'];	}	public function getUserInfo($Uniqueid)    {		$query = "SELECT * FROM users where UNIQUE_ID='$Uniqueid' LIMIT 1";        $result = $this->dbfunc->getResult($query);		return $result[0];    }		  public function getProduct()    {		$query = "SELECT PRODUCT_ID,PRODUCT_name FROM product where ACTIVE='Y'";        $result = $this->dbfunc->getResult($query);		return $result;    }		public function getProductInfo($Pid)    {		$query = "SELECT PRODUCT_name FROM product where PRODUCT_ID='$Pid'";        $result = $this->dbfunc->getResult($query);		return $result[0]['PRODUCT_name'];    }
	
	//Get Department using Department_ID
	 public function getDepartment($DEPARTMENT_ID){
		$query = "select DEPARTMENT_name from department where DEPARTMENT_ID=$DEPARTMENT_ID";
		$result= $this->dbfunc->getResult($query);
		return $result[0]['DEPARTMENT_name'];
	}
	// Get Department list in dropdown with sub category
	public function DepartmentList($DEPARTMENT_ID){
		$query = "select DEPARTMENT_ID,DEPARTMENT_name from department where ACTIVE='Y' and PARENT_ID=0";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		$i=0;
		while($i<$count_result) {?>
				<option style="font-weight:bold!important;" value="<?php echo @$result[$i]['DEPARTMENT_ID'];?>" <?php if(@$result[$i]['DEPARTMENT_ID']==$DEPARTMENT_ID){ echo "selected";}?>><?php echo @$result[$i]['DEPARTMENT_name'];?></option>
				<?php 
					$dquery = "select DEPARTMENT_ID,DEPARTMENT_name from department where ACTIVE='Y' and PARENT_ID='".$result[$i]['DEPARTMENT_ID']."' ";
					$dresult= $this->dbfunc->getResult($dquery);
					$count_dresult = count($dresult);
					$n=0;
					while($n<$count_dresult) {?>
						<option id="mytes" value="<?php echo @$dresult[$n]['DEPARTMENT_ID'];?>" <?php if(@$dresult[$n]['DEPARTMENT_ID']==$DEPARTMENT_ID){ echo "selected";}?>><?php echo @$dresult[$n]['DEPARTMENT_name'];?></option>
			<?php $n++;	}
			$i++;
		}
	}
	// Get Department list in dropdown
	public function DepartmentListNo($DEPARTMENT_ID){
		$query = "select DEPARTMENT_ID,DEPARTMENT_name from department where ACTIVE='Y' and PARENT_ID=0";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		$i=0;
		while($i<$count_result) {?>
				<option value="<?php echo @$result[$i]['DEPARTMENT_ID'];?>" <?php if(@$result[$i]['DEPARTMENT_ID']==$DEPARTMENT_ID){ echo "selected";}?>><?php echo @$result[$i]['DEPARTMENT_name'];?></option>
		<?php 
			$i++;
		}
	}
	//Get position using POSITION_ID
	 public function getPosition($POSITION_ID){
		$query = "select POSITION_name from position where POSITION_ID=$POSITION_ID";
		$result= $this->dbfunc->getResult($query);
		return $result[0]['POSITION_name'];
	}
	// Get Position list in dropdown
	public function PositionList($POSITION_ID){
		$query = "select POSITION_ID,POSITION_name from position where ACTIVE='Y'";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		$i=0;
		while($i<$count_result) {?>
			<option value="<?php echo @$result[$i]['POSITION_ID'];?>" <?php if(@$result[$i]['POSITION_ID']==$POSITION_ID){ echo "selected";}?>><?php echo @$result[$i]['POSITION_name'];?></option>
		<?php $i++;
		}
	}
	
	//get employee count
	public function countEmployee($d_id){
		$query = "SELECT SUPER_USER_ID FROM super_user where ACTIVE = 'Y' and DEPARTMENT_ID=$d_id";
		$result= $this->dbfunc->getResult($query);
		return count($result);
	}
	
	//get employee image
	public function imageEmployee($d_id){
		$query = "SELECT SUPER_USER_ID FROM super_user where ACTIVE = 'Y' and DEPARTMENT_ID=$d_id";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		while($i<$count_result) {?>
			<img src="dist/img/cstuser.png">
		<?php $i++;}
	}
	
	
	// Get Team list in dropdown
	public function TeamList($teamid){
		$query = "select SUPER_USER_ID,F_name,LAST_name from super_user where ACTIVE='Y'";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		$i=0;
		while($i<$count_result) {?>
			<option value="<?php echo @$result[$i]['SUPER_USER_ID'];?>" <?php if(@$result[$i]['SUPER_USER_ID']==$teamid){ echo "selected";}?>><?php echo @$result[$i]['F_name']." ".@$result[$i]['LAST_name'];?></option>
		<?php $i++;
		}
	}
	
	// Get client list in dropdown
	public function ClientList($client_id){
		$query = "select CLIENT_ID,C_name from client where ACTIVE='Y'";
		$result= $this->dbfunc->getResult($query);
		$count_result = count($result);
		$i=0;
		while($i<$count_result) {?>
			<option value="<?php echo @$result[$i]['CLIENT_ID'];?>" <?php if(@$result[$i]['CLIENT_ID']==$client_id){ echo "selected";}?>><?php echo @$result[$i]['C_name'];?></option>
		<?php $i++;
		}
	}
	//Get team member detail using USers detail id
	 public function getMemberDetail($uid){
		$query = "select * from super_user where SUPER_USER_ID=$uid";
		$result= $this->dbfunc->getResult($query);
		return $result[0];
	}
	
	//Get client detail using USers client id
	 public function getClientDetail($cid){
		$query = "select * from client where CLIENT_ID=$cid";
		$result= $this->dbfunc->getResult($query);
		return $result[0];
	} 
	
	public function get_session()
    {
        return $_SESSION['login'];
    }*/
	

