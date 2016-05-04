<?php
require_once('latchHelpers.php');
$mail="admin@admin.com";
$user = comprobarCambiarGoogle($mail);
echo $user;
//user sera 1 si esta habilitado google y existe secreto
//por tanto lo cambiamos a 0 y deshabilitamos
?>
