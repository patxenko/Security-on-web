<?php
session_start();  
session_unset();
session_destroy();  
unset($_COOKIE['Admin']); 
?>
