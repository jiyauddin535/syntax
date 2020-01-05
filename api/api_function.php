<?php

function checkData($rtdata){
	
	if($rtdata == ''){
	$data = "" ;	
	}else{
		$data = htmlspecialchars($rtdata) ;
	}
	
	return $data ;
}

function checkImg($rtdata){
	
	if($rtdata == ''){
	$data = "" ;	
	}else{
		$data = $GLOBALS['base_url'].$rtdata ;
	}
	
	return $data ;
}

function checkInt($rtdata){
	
	if($rtdata == ''){
	$data = "0" ;	
	}else{
		$data = $GLOBALS['base_url'].$rtdata ;
	}
	
	return $data ;
}


/* ***************User data*************** */
function table_data($last_id,$table){
	$query = "select * from ".$table." where id='".$last_id."'";
	$report_data = $GLOBALS['user']->getResult($query);
	$i=0;	

	$tresult = array(
	"userId" => checkData($report_data[$i]['id']),
	"name" => checkData($report_data[$i]['name']),
	"email" => checkData($report_data[$i]['email']),
	"mobile" => checkData($report_data[$i]['mobile']),
	//"userPic" => checkImg($report_data[$i]['userPic']),
	//"deviceId" => checkData($report_data[$i]['deviceId']),
	//"firbaseId" => checkData($report_data[$i]['firbaseId']),
	"status" => checkData($report_data[$i]['status']),
	);

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 


/* *********Notification List********* */
function user_notification($user_id,$table){
	$query = "select * from ".$table." where receiverId = '".$user_id."'";
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 	
	$count = count($report_data) ;
	while ($count > $i) {
		$senderId = $report_data[$i]['senderId'] ;
	$user_data = $GLOBALS['user']->getResult("select *  from user_data where id = '$senderId' ");	
	$tresult[] = array(
	 "id" => checkData($report_data[$i]['id']),
	 "senderId" => checkData($senderId),
	 "senderName" => checkData($user_data[0]['name']),
	 "message" => checkData($report_data[$i]['message']),
	 "date" => checkData($report_data[$i]['createDate']),
	);	

	$i++ ;
	}	

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 


/* *********User KYC********* */
function note_data($noteId,$table){
	 $query = "select * from ".$table." where id='".$noteId."'";
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 

	$tresult = array(
	 "id" => checkData($report_data[$i]['id']),
	 "userId" => checkData($report_data[$i]['userId']),
	 "catId" => checkData($report_data[$i]['catId']),
	 "title" => checkData($report_data[$i]['title']),
	 "description" => checkData($report_data[$i]['description']),	 
	 "createDate" => date('d M Y h:i A', strtotime($report_data[$i]['createDate'])),	 
	);		

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 


/* *********App Rating********* */
function app_rating($userId){
	
	$app_rating = $GLOBALS['user']->getResult("select AVG(rating) as appRating from app_rating where status = 1");
	$user_rating = $GLOBALS['user']->getResult("select rating from app_rating where userId = '$userId' and status = 1");
	
	$tresult = array(
	 "userRating" => checkData($app_rating[0]['appRating']),
	 "appRating" => checkData($user_rating[0]['rating']),
	 
	);		
	
	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 

/* *********Note List By Cat********* */
function note_list_cat($userId){
	
	$query = "select * from note_data where status = '1' and userId = '$userId' group by catId order by id desc";
	
	//echo "select * from note_data where status = '1' and userId = '$userId' group by catId order by id desc";
	
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 
	$count = count($report_data) ;
	while ($i < $count) {
		$catId = $report_data[$i]['catId'] ; 
		$tresult[] = array(
	 "catId" => checkData($report_data[$i]['catId']),
	 "catName" => checkData(catName($catId)),
	 "noteList" => note_list($userId,$catId),
	);
	$i++; 
}			

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 



/* *********Note List********* */
function note_list($userId,$catId='',$status=''){
	$cat = '' ;
	$sta = '' ;
	if(!empty($catId)){
	$cat = 'and catId = '.$catId ;
	}
	if(!empty($status)){
	$sta = 'and status = '.$status ;
	}
	
	 $query = "select * from note_data where userId = '$userId' $sta $cat  order by createDate desc ";
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 
	$count = count($report_data) ;
	while ($i < $count) {
		$tresult[] = array(
	 "id" => checkData($report_data[$i]['id']),
	 "title" => checkData($report_data[$i]['title']),
	 "desc" => checkData($report_data[$i]['description']),
	 "catId" => checkData($report_data[$i]['catId']),
	 "catName" => checkData(catName($report_data[$i]['catId'])),
	 "createDate" => date('d M Y h:i A', strtotime($report_data[$i]['createDate'])),	 
	);
	$i++; 
}			

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 

/* *********category List********* */
function category_list($userId){
	
	 $query = "select * from category_list where  status = '1'  order by catName ";
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 
	$count = count($report_data) ;
	while ($i < $count) {
		$catId = $report_data[$i]['catId'] ;
		$tresult[] = array(
	 "id" => checkData($report_data[$i]['id']),
	 "catName" => checkData($report_data[$i]['catName']),
	  
	);
	$i++; 
}			

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 


/* *********search List********* */
function search_list($userId,$key){
	
	 $query = "select * from note_data where title like '%$key%' and status = '1' and userId = '$userId' order by id desc";
	$report_data = $GLOBALS['user']->getResult($query);
	$i = 0 ; 
	$count = count($report_data) ;
	while ($i < $count) {
		$catId = $report_data[$i]['catId'] ;
		$tresult[] = array(
	 "id" => checkData($report_data[$i]['id']),
	 "title" => checkData($report_data[$i]['title']),
	 "description" => checkData($report_data[$i]['description']),
	 "catId" => checkData($catId),
	 "catName" => checkData(catName($catId)),
	 "createDate" => date('d M Y h:i A', strtotime($report_data[$i]['createDate'])),	 
	);
	$i++; 
}			

	if(empty($tresult)){
	$tresult=array();
				}
	return $tresult;
} 


function catName($catId){
$query = "select * from category_list where id = '$catId'";
	$report_data = $GLOBALS['user']->getResult($query);

	$catName = $report_data[0]['catName'] ;
	return $catName ;
}

 ?>

 