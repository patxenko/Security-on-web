<?php
require_once('latchHelpers.php');
require_once("latchConfig.php");
session_start();
$user = authenticateUser("admin@admin.com", "admin");
//$correctLogin = isset($user['mail']);

//verfificamos el estado del pestillo de administrador
//******LATCH******
$api = new ElevenPaths\Latch\LatchApp($appId, $secret); //llamada a la clase latchApp

//RECOGEMOS EL LATCHID DE ADMINISTRADOR
$accountId=getAdminLacthId(); //de latchHelpers comprueba que hay latchId en la base de datos

if (($accountId != -1) && ($accountId!='')) { //si es usuario de latch comprueba pestillo
       $latchStatusResponse = $api->operationStatus($accountId,$operationPracticas); //the latchApp verifica el estado del candado de login.
       $statusData = $latchStatusResponse->getData();   //the latchResponse
       if ($statusData!=null && property_exists($statusData,"operations")){ //si existe una propiedad operaciones en la respuesta
           $operations=(Array)$statusData->operations;
           $isTheAccountLatched = $operations[$operationPracticas]->status == 'off';
           $correctPracticas = isPracticasCorrect($user) && !$isTheAccountLatched;
       } else {
           $correctPracticas = isPracticasCorrect($user);
       }
}
else {
     $correctPracticas = isPracticasCorrect($user); //no es usuario de latch
}
//*********FIN DE LATCH*******
if ($correctPracticas) {
     //setCookie('User',$user['mail'],time()+(24*60*60),'/');
     //header("Location: profile.php");
     $statusMessage='login correcto';
}
echo ($correctPracticas); //devuelve 1 para los que no tienes latch o lo tienen sin pestillo, y no devuelve nada en caso de tener latch con pestillo
function isPracticasCorrect($user){
      return isset($user['mail']);
}
?>
