<?php
require('http.php');
require('oauth_client.php');
require('config.php');

if ($_GET["oauth_problem"] <> "") {
  // in case if user cancel the login. redirect back to home page.
  $_SESSION["e_msg"] = $_GET["oauth_problem"];
  header("location:index.php");
  exit;
}

$client = new oauth_client_class;


$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = API_KEY;
$application_line = __LINE__;
$client->client_secret = SECRET_KEY;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.';

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->authorization_error)) {
      $client->error = $client->authorization_error;
      $success = false;
    } elseif (strlen($client->access_token)) {
      /*$success = $client->CallAPI(
					'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,picture-url,public-profile-url,formatted-name)', 
					'GET', array(
						'format'=>'json'
					), array('FailOnAccessError'=>true), $user);*/

          $success = $client->CallAPI('https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))') ;
    }
  }
  $success = $client->Finalize($success);
}
print_r($user) ;
echo $user->emailAddress ;
echo "string";
die() ;
if ($client->exit) exit;
if ($success) {
  // Now check if user exist with same email ID
  $sql = "SELECT id, account_type from shr_user_data where email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $user->emailAddress);
    $stmt->execute();
    $result = $stmt->fetchAll();

     $uCount = count($result) ;

    if ($uCount > 0) {
      // User Exist 
       $_SESSION['USER_ID'] = $result[0]['id']  ;
       $_SESSION['TYPE'] = $result[0]['account_type']  ;
    } else {
      // New user, Insert in database
       $sql = "INSERT INTO `shr_user_data` (`f_name`, `l_name`, `email`, `account_type`, `status`, `acoountActivation`, `created_date`,`updated_date`) VALUES " . "( :f_name, :l_name, :email, :account_type, :status, :acoountActivation, :created_date, :updated_date)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":f_name", $user->firstName);
      $stmt->bindValue(":l_name", $user->lastName);
      $stmt->bindValue(":email", $user->emailAddress);
      $stmt->bindValue(":account_type", '1');
      $stmt->bindValue(":status", '1');
      $stmt->bindValue(":acoountActivation", '1');      
      $stmt->bindValue(":created_date", date('Y-m-d'));
      $stmt->bindValue(":updated_date", date('Y-m-d'));
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {

          $_SESSION['USER_ID']= $DB->lastInsertId() ;
         $_SESSION['TYPE']='1';
      }
    }
  } catch (Exception $ex) {
   // $_SESSION["e_msg"] = $ex->getMessage();
  }

 // $_SESSION["user_id"] = $user->id;
} else {
  //$_SESSION["e_msg"] = $client->error;
}
header("location:https://www.mysuperhumanrace.com/profile");
exit;
?>