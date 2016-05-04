<?php
require_once('latchHelpers.php');
$mail="admin@admin.com";
$user = isGoogleEnabledForAdmin($mail);
echo $user;
?>
