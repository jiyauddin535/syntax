<?php
require('http.php');
require('oauth_client.php');
require('config.php');


$client = new oauth_client_class;

// set the offline access only if you need to call an API
// when the user is not present and the token may expire
$client->offline = FALSE;

$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = CLIENT_SECRET;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
  die('Please go to Google APIs console page ' .
          'http://code.google.com/apis/console in the API access tab, ' .
          'create a new client ID, and in the line ' . $application_line .
          ' set the client_id to Client ID and client_secret with Client Secret. ' .
          'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
          'the domain is valid and can be resolved by a public DNS.');

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
  if (($success = $client->Process())) {
    if (strlen($client->authorization_error)) {
      $client->error = $client->authorization_error;
      $success = false;
    } elseif (strlen($client->access_token)) {
      $success = $client->CallAPI(
              'https://www.googleapis.com/oauth2/v1/userinfo', 'GET', array(), array('FailOnAccessError' => true), $user);
    }
  }
  $success = $client->Finalize($success);
}

//print_r($user) ;
//echo "string";
//die() ;
if ($client->exit)
  exit;
if ($success) {
  // Now check if user exist with same email ID
  $sql = "SELECT id, name  from user_data where email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $user->email);
    $stmt->execute();
    $result = $stmt->fetchAll();
      $uCount = count($result) ;
    if ($uCount > 0) {
      // User Exist 
       $_SESSION['userId'] = $result[0]['id']  ;
        $_SESSION['userName'] = $result[0]['name']  ;
    } else {
      $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $pstr = substr(str_shuffle($str),0, 5); 
      $password = base64_encode($pstr);
      // New user, Insert in database
      $sql = "INSERT INTO `user_data` (`name`,  `email`, `password`, `status`, `createdDate`) VALUES " . "( :name, :email, :password, :status, :created_date)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $user->given_name);
      $stmt->bindValue(":email", $user->email);
      $stmt->bindValue(":password", $password);
      $stmt->bindValue(":status", '1');
      $stmt->bindValue(":created_date", date('Y-m-d'));

      $stmt->execute();
      $result = $stmt->rowCount();
    //  echo $DB->lastInsertId().'hhhhh' ;
      if ($result > 0) {

                /*  ******Mail **** */
                $url = $GLOBALS['base_url'];
                $sender = 'info@syntaxnote.com';
                $msg = '<p>Login Email : "'.$user->email.'" </p>
                <p>Login Password : "'.$pstr.'" </p>
                <p><a href="'.$url.'">Login </a></p>
       
                <p>Thank you.</p>' ;
                $headers = "From: " . strip_tags($sender) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mail= @mail( $email, 'Login Details | Syntaxnote', $msg, $headers);  
                /*  ******Mail **** */

         $_SESSION['userId']= $DB->lastInsertId() ;
         $_SESSION['userName'] = $user->given_name  ;
      }
    }
  } catch (Exception $ex) {
   // $_SESSION["e_msg"] = $ex->getMessage();
  }

  //$_SESSION["user_id"] = $user->id;
} else {
  //$_SESSION["e_msg"] = $client->error;
}
header("location:https://www.syntaxnote.com/profile.php");
exit;
?>