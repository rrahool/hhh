<?php
require_once('src/PHPMailer.php');

$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->addReplyTo("noreply@nohassleresults.com","No Hassle Results");

$mail->setFrom('noreply@nohassleresults.com', 'No Hassle Results');

$full_name = $user["fullname"];
$address = $user['email'];
$mail->addAddress($address, $full_name);

$mail->Subject = "No hassle results genie reset password link";

$mail->altBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//$message = '
//<html>
//<body>
//Hey '.$full_name.'!<br>
//Thanks for subscription with COL!<br>
//<br>
//Please click this link to activate your account:<br>
//<a href="http://registration.colbd.com/verify.php?email='.$address.'&hash='.$hash.'" style="padding:5px; background-color:#3276B1; color:#ffffff;">Verify Now</a>
//<br>
//<h4>Team COL</h4>
//<img src="http://registration.colbd.com/images/logo.png">
//</body>
//</html>
//';
define('PROJECT_HOME','https://genie.nohassleresults.com/');
$message = "<div>Hi " . $user["fullname"] . ",<br><br><p>Click this link to recover your password<br><a href='" . PROJECT_HOME . "reset-password.php?salt=" . $user["password"] . "&email=" . $user["email"] . "'>" . PROJECT_HOME . "reset-password.php?salt=" . $user["password"] . "&email=" . $user["email"] . "</a><br><br></p>Regards,<br> Admin.</div>";
//echo $message;die;
$mail->msgHTML($message);

// $mail->addAttachment("pdf/subscriber_".$last_id.".pdf");      // attachment
// $mail->addAttachment("pdf/col-tnc.pdf");      // attachment
// $mail->addAttachment("pdf/col-privacy.pdf");      // attachment

$mailSend = $mail->send();
if(!$mailSend) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "A Message sent to your email with password reset link. Have a look!";
}

?>
