<?php
require_once('latchHelpers.php');
require_once("latchConfigAdmin.php");
session_start();
$email = "admin@admin.com";
$statusMessage = '';
$password="72815514K";
$user = authenticateAdmin($email, $password);
$correctLogin = "nada";


$api = new ElevenPaths\Latch\LatchApp($appId, $secret); //llamada a la clase latchApp
$accountId=getLatchIdAdmin($email); //de latchHelpers comprueba que hay latchId en la base de datos

while ($correctLogin!=1){
       $latchStatusResponse = $api->operationStatus($accountId,$operationBlock); //the latchApp verifica el estado del candado de login.
       $statusData = $latchStatusResponse->getData();   //the latchResponse
       if ($statusData!=null && property_exists($statusData,"operations")){ //si existe una propiedad operaciones en la respuesta
           $operations=(Array)$statusData->operations;
           $isTheAccountLatched = $operations[$operationBlock]->status == 'off';
           $correctLogin = 1 && !$isTheAccountLatched;
           
       } else {
           $correctLogin = "nada";
       }
       sleep(2);
}

echo $correctLogin;
echo "ataca bro";

function isLoginCorrect($user){
      //return isset($user['mail']);
      return $correctLogin;
}

?>



