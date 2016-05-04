<?php
require_once('latchHelpers.php');
require_once("latchConfigAdmin.php");
session_start();

$email = "admin@admin.com";
$password = isset($_POST['pass']) ? $_POST['pass'] : '';
#guarda los valores en el fichero de logs.data-------
//$ip = $_SERVER['REMOTE_ADDR'];
//$data=array(
//"email" => $email,
//"password" => $password,
//"ip" => $ip,
//);
//$nuevoUsuario=json_encode($data);
//file_put_contents("logs.data",$nuevoUsuario."\n",FILE_APPEND);
#--------------------------
$statusMessage = '';
//1.COMPRUEBA QUE MAIL Y PASSWORD SEAN CORRECTOS
$user = authenticateAdmin($email, $password);
$correctLogin = isset($user['mail']);

//******LATCH******COMPRUEBA SI TIENE LATCH O NO Y CUAL ES EL ESTADO DEL PESTILLO EN CASO DE TENER
$api = new ElevenPaths\Latch\LatchApp($appId, $secret); //llamada a la clase latchApp
$accountId=getLatchIdAdmin($email); //de latchHelpers comprueba que hay latchId en la base de datos
//echo ($accountId);
if (($accountId != -1) && ($accountId!='' && ($correctLogin!=''))) { //si es usuario de latch comprueba pestillo
       $latchStatusResponse = $api->operationStatus($accountId,$operationLogin); //the latchApp verifica el estado del candado de login.
       $statusData = $latchStatusResponse->getData();   //the latchResponse
       if ($statusData!=null && property_exists($statusData,"operations")){ //si existe una propiedad operaciones en la respuesta
           $operations=(Array)$statusData->operations;
           $isTheAccountLatched = $operations[$operationLogin]->status == 'off';
           $correctLogin = isLoginCorrect($user) && !$isTheAccountLatched;
           //echo $isTheAccountLatched;
       } else {
           $correctLogin = isLoginCorrect($user);
       }
}
else {
     $correctLogin = isLoginCorrect($user); //no es usuario de latch
}
//*********FIN DE LATCH*******


$statusMessage = ($correctLogin) ? '' : 'email or password incorrect';
if ($correctLogin) {
     setCookie('Admin',$user['mail'],time()+(24*60*60),'/');
     //header("Location: profile.php");
     $statusMessage='login correcto';
     
}
$_SESSION['status']=$statusMessage;
//echo ($statusMessage);
  //devuelve 1 para los que no tienes latch o lo tienen sin pestillo, y no devuelve nada en caso de tener latch con pestillo
//echo ($isTheAccountLatched);


//SI HASTA ESTE PUNTO CORRECTO, LOGIN EN ORDEN, VERIFICAMOS EL ESTADO DE GOOGLE
if ($correctLogin==1){
     $mail="admin@admin.com";
     $userGoogle = isGoogleEnabledForAdmin($mail);
     if ($userGoogle==1){
         echo 2;
     }
     else{
         echo ($correctLogin);
     }
}
else{
     echo ($correctLogin);
}
function isLoginCorrect($user){
      return isset($user['mail']);
}

?>



