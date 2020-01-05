<?php include('admin/include/User.php'); ?>
<?php $user = new User();
session_destroy() ;
 header('Location: '.$base_url);
?>
