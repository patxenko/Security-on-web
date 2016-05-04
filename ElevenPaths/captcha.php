<?php 
//error_reportin(0);
$consulta = $_POST['consulta'] ; 
echo '<form action="" method="post"><div>		
Introduce tu nombre:<br>
<input class="entr" type="text" name="consulta" id="consulta" value=""><br>
Introduce los caracteres que ves en la imagen<br>
<img alt="Numeros aleatorios" src="captchaImag.php">  
<input class="campos" type="text" name="num"><br>
<input class="campos" type="submit" value="GENERAR"></div>
</form><br>';
 session_start(); 
if($_SESSION['img_number'] != $_POST['num']){ 
   echo'<div style="color:red;">Los caracteres no se corresponden.<br> 
 Trate de nuevo por favor</div>'; 
}else{ 	
echo '<div class="result">Tu nombre es: '.$consulta.'</div>'; 
}      
?> 

