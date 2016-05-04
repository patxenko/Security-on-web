<?php
session_start();
//generate the secret code
require 'APIs/GoogleAuth/GoogleAuthenticator.php';
$authenticator = new PHPGangsta_GoogleAuthenticator();
$secret = $authenticator->createSecret();
//echo "Secret: ".$secret;
$_SESSION['googleSecret']=$secret;

$website = 'http://localhost/GoogleAuth'; //Your Website
$title= 'Codigo';
$qrCodeUrl = $authenticator->getQRCodeGoogleUrl('TFG Fran Lopez', $secret);
echo $qrCodeUrl;
//echo "webon";
//show qr code to scan
//echo "Scan the QR Code for google Authenticator with the google App";
//print "<br><br><br>";
//print '<img src="'.$qrCodeUrl.'" alt="QrCode" height="100" width="100"><br><br>';


//box to insert received code
//print '  <form action="verifica.php" method="post">';
//print '  Code: <input type="text" name="code"><br>';
//print '  <input type="hidden" name="secret" value="'.$secret.'" />';
//print '  <input type="submit" value="Send code">';
//print '  </form>';
//return ($qrCodeUrl);
?>

