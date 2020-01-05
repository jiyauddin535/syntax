<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
$action = $_POST['action'] ;
$url = $base_url."api/api.php";

/* ********Delete Note*********** */
if($action == 'delete'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'delete_note');
$data['data'] = array('userId' => $userId,'noteId' => $noteId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 
}

/* ********Delete Multiple Note*********** */
if($action == 'delAll'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'delete_multiple_note');
$data['data'] = array('userId' => $userId,'noteId' => $noteId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 
}


/* ********Undo Note*********** */
if($action == 'undo'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'recover_note');
$data['data'] = array('userId' => $userId,'noteId' => $noteId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 
}

/* ********Undo Multiple Note*********** */
if($action == 'undoAll'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'recover_multiple_note');
$data['data'] = array('userId' => $userId,'noteId' => $noteId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 
}

/* ********Remove Note*********** */
if($action == 'trash'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'delete_trash_note');
$data['data'] = array('userId' => $userId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 

}

/* ********Remove Multiple Note*********** */
if($action == 'multipleTrash'){
$noteId = $_POST['noteId'] ;
$data = array('action' => 'delete_trash_multiple_note');
$data['data'] = array('userId' => $userId, 'noteId' => $noteId);
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$status = $noteResult->status ; 

}
