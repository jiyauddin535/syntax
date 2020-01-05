<?php
include('../admin/include/User.php');
error_reporting(1);
$GLOBALS['user'] = new User();
$GLOBALS['base_url'] = $base_url;

 include('api_function.php'); 

header("Content-type: application/json; charset=iso-8859-1");
$inputdata = file_get_contents('php://input');
$data = json_decode($inputdata, TRUE);
//print_r($data);
$action = $data['action'];
$data = $data['data'];
/********User Login******/
if($action=='login'){
	$email=$data['email'];	
	$password = base64_encode($data['password']);
	$query="select * from user_data where email='$email' and password='$password' ";
	$result = $GLOBALS['user']->getResult($query);
	$results = $result[0] ;
	$check= count($result);
	
	if ($check > 0)
	{

		if($results['status'] == 1 ){
			$details= array(
	   	   'message' => "Welcome ".$results['name'],
			'status' => "1",	
	        'data' => table_data($results['id'],'user_data'),
	    );

		}else{
		
	   $details= array(
	   	   'message' => "Your account is not active",
			'status' => "0",	
	        'data' => (object)array(),
	    );
	
	  }
	}else{

		$details= array(
			'status' => "0",	       
	        'message' => "Invalid login details",
	        'data' => (object)array(),
	    );

	}
}

/********Social Login******/
if($action=='social_login'){
	$email = $data['email'];
	$pid = $data['pid'];
	

	$query="select * from user_data where email='$email' ";
	$results = $GLOBALS['user']->getResult($query);
	$check= count($results);
	if ($check >0)
	{ 
		$userId = $results[0]['id'];
		$update = array(
	      'pid' => $pid,
	      'status' => '1',
	      );
  		$where = 'id = '.$userId ;
  		$updateRes = $GLOBALS['user']->updateStatementwithAnd($update,'user_data',$where);
	   $details= array(
	   		'status' => '1',	       
	        'message' => "Success",
	        'data' => table_data($userId,'user_data'),
	    );
	 
	}else{	 
		$password = rand(10000,100000);
		$refid = rand(1000,10000);
		$insert = array(
	      'email' => $email,
	      'password' => base64_encode($password),
	      'pid' => $pid,
	      'status' => '1',
	      );
  		$insertRes = $GLOBALS['user']->insertQuery($insert,'user_data');
 
		$details= array(
			'status' => '1',	       
	        'message' => "Success",
	        'data' => table_data($insertRes,'user_data'),
	    );
	    
	    
	}
	
} 



/* *******Reset Password***** */
if($action=='reset_password'){
	$userId = $data['userId'];
	$password = base64_encode($data['password']) ;	

	 $query="select id from user_data where id ='$userId' ";
	$results = $GLOBALS['user']->getResult($query);
	$check= count($results);
	if ($check >0)
	{
		$userId = $results[0]['id'];
		$update = array(
	      'password' => $password,	      
	      );
  		$where = 'id = '.$userId ;
  		$updateRes = $GLOBALS['user']->updateStatementwithAnd($update,'user_data',$where);
	   $details= array(
	   		'message' => "Password Update Successfully",
			'status' => "1",	       
	        'data' => table_data($userId,'user_data'),
	    );
	 
	}else{
		
		$details= array(
			'status' => '0',	       
	        'message' => "Invalid User",
	        'data' => (object)array(),
	    );
	}
	
} 


/* *******Check User***** */
if($action=='check_email_user'){
	$email = $data['email'];
	$ehash = $data['ehash'];

    $query="select id from user_data where email ='$email' and ehash = '$ehash' ";
	$results = $GLOBALS['user']->getResult($query);
	$check= count($results);
	if ($check >0)
	{	
	$userId = $results[0]['id'];	
	   $details= array(
			'status' => '1',	       
	        'userId' => $userId	        
	    );
	 
	}else{
		 $details= array(
			'status' => '0'	       
	    );
	}
	
} 


/* *******Update Profile***** */
if($action=='update_profile'){
	$userId = $data['userId'];
	$name = $data['name'];
	$mobile = $data['mobile'];
	
	$query="select id from user_data where id ='$userId' ";
	$results = $GLOBALS['user']->getResult($query);
	$check= count($results);
	if ($check >0)
	{
		$userId = $results[0]['id'];
		$update = array(
	      'name' => $name,	      
	      'mobile' => $mobile     	      
	      );
  		$where = 'id = '.$userId ;
  		$updateRes = $GLOBALS['user']->updateStatementwithAnd($update,'user_data',$where);
	   $details= array(
	   		'message' => "User record update successfully",
			'status' => "1",	       
	        'data' => table_data($userId,'user_data'),
	    );
	 
	}else{
		
		$details= array(
			'status' => '0',	       
	        'message' => "Invalid User",
	        'data' => (object)array(),
	    );
	}
	
} 



/********User Registration******/
if($action=='register'){
	$phone=$data['phone'];
	$name = $data['name'];
//	$dob = $data['dob'];
	$email = $data['email'];
	$password = base64_encode($data['password']);

	$firbaseId = $data['firbaseId'];

	 $query="select * from user_data where mobile='$phone' or email='$email' ";
	$results = $GLOBALS['user']->getResult($query);
	      $check= count($results);
	if ($check > 0)
	{
	   $details= array(
	   		'message' => "User Already Exist",
			'status' => "0",	       
	        'data' => (object)array(),
	    );
	 
	}else{

		//$date = date('Y-m-d');
		//$otp = rand(10000,100000);
		//$refId = rand(1000,10000);
		$insert = array(
	      'name' => $name,
	      'email' => $email,
	      'mobile' => $phone,
	      'password' => $password,
	      'status' => '1',
	      );
  		 $insertRes = $GLOBALS['user']->insertQuery($insert,'user_data');


		$details= array(
			'status' => '1',	       
	        'message' => "Registered successfully",
	        'data' => table_data($insertRes,'user_data'),
	    );
	    
	    
	}
	
} 



/**Send OTP ***/
if($action=='otp'){
	$phone=$data['phone'];
	$otp = rand(10000,999999);
	$query="select * from user_data where mobile='".$phone."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $update = array(
	      'otp' => $otp,
	      );
	  	  $where = "mobile=".$phone;
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'user_data',$where); 
	 	  $details= array(
	   		'message' => "OTP sent successfully",
			'status' => "1",	       
	       'data' => table_data($userId,'user_data'),
	      );
	}else{
		$details= array(
	   		'message' => "Error : Record not found.",
			'status' => "0",	       
	        'data' => (object)array(),
	    );
	    
	    
	}
	
} 



/* ********Verify OTP********** */
if($action=='verify_otp'){
	$userId=$data['userId'];
	$otp=$data['otp'];
	
$query="select * from user_data where id='".$userId."' and otp = '".$otp."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $update = array(
	      'status' => '1',
	      );
	  	  $where = "id=".$userId;
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'user_data',$where); 
	 	  $details= array(
	   		'message' => "OTP verify successfully",
			'status' => "1",	       
	       'data' => table_data($userId,'user_data'),
	      );
	}else{
		$details= array(
	   		'message' => "Error : Record not found.",
			'status' => "0",	       
	        'data' => (object)array(),
	    );
	    
	    
	}
	
} 


/* ********Delete Notes********** */
if($action=='delete_note'){
	$userId=$data['userId'];
	$noteId=$data['noteId'];
	
$query="select id from note_data where id='".$noteId."' and userId = '".$userId."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $update = array(
	      'status' => '2',
	      );
	  	  $where = "id=".$noteId;
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'note_data',$where); 
	 	  $details= array(
	   		'message' => "Note Deleted successfully",
			'status' => "1",	       
	      );
	}else{
		$details= array(
	   		'message' => "Error : Record not found.",
			'status' => "0",	       
	    );	    
	    
	}	
}

/* ********Delete Multiple Notes********** */
if($action=='delete_multiple_note'){
	$userId=$data['userId'];
	$noteId=$data['noteId'];
	

	   $update = array(
	      'status' => '2',
	      );
	  	  $where = "id in ($noteId)";
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'note_data',$where); 
	 	  $details= array(
	   		'message' => "Note Deleted successfully",
			'status' => "1",	       
	      );
	
}


/* ********Recover from Trash********** */
if($action=='recover_note'){
	$userId=$data['userId'];
	$noteId=$data['noteId'];
	
$query="select id from note_data where id='".$noteId."' and userId = '".$userId."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $update = array(
	      'status' => '1',
	      );
	  	  $where = "id=".$noteId;
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'note_data',$where); 
	 	  $details= array(
	   		'message' => "Note Recovered  successfully",
			'status' => "1",	       
	      );
	}else{
		$details= array(
	   		'message' => "Error : Record not found.",
			'status' => "0",	       
	    );	    
	    
	}	
}


/* ********Recover Multiple notes from Trash********** */
if($action=='recover_multiple_note'){
	$userId=$data['userId'];
	$noteId=$data['noteId'];
	
	   $update = array(
	      'status' => '1',
	      );
	  	  $where = "id in ($noteId)";
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'note_data',$where); 
	 	  $details= array(
	   		'message' => "Note Recovered successfully",
			'status' => "1",	       
	      );
		
}


/* ********remove Notes from trash********** */
if($action=='delete_trash_note'){
	$userId=$data['userId'];
	
$query="select id from user_data where id = '".$userId."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $sql = "Delete from note_data where userId = '".$userId."' and status = '2' " ;
	 	  $update_query = $GLOBALS['user']->runQuery($sql); 
	 	  $details= array(
	   		'message' => "Note Remove from Trash",
			'status' => "1",	       
	      );
	}else{
		$details= array(
	   		'message' => "Invalid User",
			'status' => "0",	       
	    );	    
	    
	}	
} 

/* ********remove Multiple Notes from trash********** */
if($action=='delete_trash_multiple_note'){
	$userId=$data['userId'];
	 $noteId=$data['noteId'];
	

	  $sql = "Delete from note_data where id in ($noteId) and status = '2' " ;
	 	  $update_query = $GLOBALS['user']->runQuery($sql); 
	 	  $details= array(
	   		'message' => "Note Remove from Trash",
			'status' => "1",	       
	      );
		
} 


/* ***Forgot Password*** */
if($action=='forgot_password'){	
	$email = $data['email'];
	$query = "select * from user_data where email='$email'";
	$results = $GLOBALS['user']->getResult($query);
	$total = count($results);
	if($total==1){
		$userId = $results[0]['id'] ;
		$password = base64_decode($results[0]['password']) ;
		$sender = 'info@syntaxnote.com';
		/*  ********** */
		$ehash = uniqid() ;
		$where = 'id = '.$userId ;
  		$updateRes = $GLOBALS['user']->updateStatementwithAnd(array('ehash' =>$ehash),'user_data',$where);

		$url = $GLOBALS['base_url'].'reset-password.php?email='.$email.'&ehash='.$ehash;
                $msg = '<p>To Reset your account please click on below link</p>
    		<p><a href="'.$url.'">Reset Password </a></p>
       
    <p>Thank you.</p>' ;
                $headers = "From: " . strip_tags($sender) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            $mail= @mail( $email, 'Syntax Note Reset Password', $msg, $headers);  
                /*  ********** */

		$details= array(
			'message' => "Please check your Email id",
			'status' => "1",
			'data' => table_data($userId,'user_data'),

		);
	}else{
		$details= array(
		   		'message' => "Invalid User Id",
				'status' => "0",	       
		        'data' => (object)array(),
		    );
	}
}



/* ***user profile*** */
if($action=='get_profile'){	
	$userId = $data['userId'];
	$query = "select id from user_data where id='$userId'";
	$results = $GLOBALS['user']->getResult($query);
	$total = count($results);
	if($total==1){

		$details= array(
			'message' => "Profile Details",
			'status' => "1",
			'data' => table_data($userId,'user_data'),

		);
	}else{
		$details= array(
		   		'message' => "Invalid User Id",
				'status' => "0",	       
		        'data' => (object)array(),
		    );
	}
}




/* *********App Rating********** */
if($action=='app_rating'){	
	 $userId = $data['userId'];	
	 $rating = $data['rating'];	 

  $sql = $GLOBALS['user']->getResult("Select id from app_rating where userId = '$userId' ");
	$count = count($sql) ;

	if($count > 0) {	

	$update = array(
	      'userId' => $userId,
	      'rating' => $rating,	      
	      );
  		$where = 'userId = '.$userId ;
  		$updateRes = $GLOBALS['user']->updateStatementwithAnd($update,'app_rating',$where);		
		$details= array(
			'message' => "Success",
			'status' => "1",
			'data' => app_rating($userId),
		);	
}else{
	 $insert = array(
	      'userId' => $userId,
	      'rating' => $rating,	      
	      );
  		 $insertRes = $GLOBALS['user']->insertQuery($insert,'app_rating');
  		
		$details= array(
			'message' => "Success",
			'status' => "1",
			'data' => app_rating($userId),
		);	

}

}

/* *********Note List********** */
if($action=='category_list'){	
$userId = $data['userId'];	  	
		$details= array(
			'message' => "Category List",
			'status' => "1",
			'data' => category_list($userId),
		);	
}


/* *********Create Note********** */
if($action=='create_note'){	
	 $userId = $data['userId'];	
	 $title = $data['title'];
	 $desc = $data['desc'];
	 $catId = $data['catId'];

 
	 $insert = array(
	      'userId' => $userId,
	      'title' => addslashes($title),	      
	      'description' => addslashes($desc),	      
	      'catId' => $catId,	      
	      'createDate' => date("Y-m-d H:i:s"),	      
	      );
  		 $insertRes = $GLOBALS['user']->insertQuery($insert,'note_data');
  		
		$details= array(
			'message' => "Note Added Successfully",
			'status' => "1",
			
		);	
}


/* ***********Edit Note***************/
if($action=='edit_note'){
	$noteId=$data['noteId'];
	$userId=$data['userId'];
	$title=$data['title'];
	$description=$data['description'];
	$catId=$data['catId'];
	
    $query="select id from note_data where id='".$noteId."' and userId = '".$userId."'";
	$results = $GLOBALS['user']->getResult($query);
	$userId = $results[0]['id'] ;
	$check= count($results);
	if ($check==1)
	{
	   $update = array(
	      'title' => addslashes($title),
	      'description' => addslashes($description),
	      'catId' => $catId,
	      'createDate' => date("Y-m-d H:i:s"),
	      );
	  	  $where = "id=".$noteId;
	 	  $update_query = $GLOBALS['user']->updateStatementwithAnd($update,'note_data',$where); 
	 	  $details= array(
	   		'message' => "Note Updated  successfully",
			'status' => "1",	       
	      );
	}else{
		$details= array(
	   		'message' => "Error : Record not found.",
			'status' => "0",	       
	    );	    
	    
	}	
}


/* *********search Note********** */
if($action=='search_note'){	
	 $userId = $data['userId'];		
	 $key = $data['key'];		
  	
		$details= array(
			'message' => "Success",
			'status' => "1",
			'data' => search_list($userId,$key),
		);	
}

/* *********All Note List ********** */
if($action=='all_notes'){	
	 $userId = $data['userId'];		
  	
		$details= array(
			'message' => "All Notes",
			'status' => "1",
			'data' => note_list_cat($userId),
		);	
}

/* *********Note List By Category ********** */
if($action=='notes_by_category'){	
	 $userId = $data['userId'];		
	 $catId = $data['catId'];		
  	
		$details= array(
			'message' => "Notes By Category",
			'status' => "1",
			'data' => note_list($userId,$catId,'1'),
		);	
}



/* *********Trash list ********** */
if($action=='trash_list'){	
	 $userId = $data['userId'];		
	 $status = 2;		
  	
		$details= array(
			'message' => "Trash List",
			'status' => "1",
			'data' => note_list($userId,'',$status),
		);	
}


/* *****Note Details***** */
if($action=='note_details'){
	
	//$userId = $data['userId'];
	$noteId = $data['noteId'];
	$query = "select id from note_data where id='$noteId'";
	$results = $GLOBALS['user']->getResult($query);
	$total = count($results);
	if($total==1){

		$details= array(
			'message' => "Note Details",
			'status' => "1",
			'data' => note_data($noteId,'note_data'),
		);
	}else{
		$details= array(
		   		'message' => "Invalid Id",
				'status' => "0",	       
		        'data' => (object)array(),
		    );
	}
}


header('content-type: application/json');
echo json_encode($details,true); 



?>

