<?php
session_start();
require 'APIs/GoogleAuth/GoogleAuthenticator.php';
require_once('latchHelpers.php');
$authenticator = new PHPGangsta_GoogleAuthenticator();
//take secret from post
$email="admin@admin.com";
$secret = takeGoogleAdminSecret($email);
$otp = $_POST['pass'];
$tolerance = 0;
//$oneCode = $ga->getCode($secret);
//echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $authenticator->verifyCode($secret, $otp, $tolerance);    
 
if ($checkResult) 
{
    echo 1; //es el correcto
     
} else {
    echo 0; //error
}
?>


 
 

