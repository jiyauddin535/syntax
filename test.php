<?php 

session_start() ;
echo $_SESSION['UserId'] = 1 ; 



$sender = "no-reply@evenzt.com";
                $to = $_POST['to'];
                $msg = $_POST['msg'];
                $subject = $_POST['subject'];
                /*  ********** */
                /*$msg = '<p>Thank you for joining us!</p>
    <p><p><a href="http://evenzt.com">Click Here to Login</a></p></p>
    <p>Thank you.</p>' ; */
                $headers = "From: " . strip_tags($sender) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                            $mail= mail( $to, $subject, $msg, $headers); 

                            if($mail){
                                echo 'sent ev' ;
                            }else {
                              echo 'not Sent ev' ;
                            }


                            ?>