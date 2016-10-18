<?php

require_once("latchConfig.php");

//GET PAIRING CODE FROM USER (?operador ternario condicion ? si true : si false)
$latchPairingCode = isset($_POST['latchPairingCode']) ? $_POST['latchPairingCode'] : '';
echo ($latchPairingCode."7 ");
//NEW API INSTANCE AND PAIRING
$api = new ElevenPaths\Latch\LatchApp($appId, $secret); //llamada a la clase latchApp
$latchPairResponse= $api->pair($latchPairingCode);  //pair de la clase latchApp.php
$latchResponseData= $latchPairResponse->getData();  //getData de getResponse
$accountId = isset($latchResponseData->accountId) ? $latchResponseData->accountId : '';
//echo $accountId;
echo ($_COOKIE['User']);

if ($accountId != '') {
      //ADD PAIRING CODE TO DB
      $dsn='mysql:dbname=db;host=127.0.0.1';
      $DBuser='';
      $DBpassword='';
      try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
      } catch (PDOException $e) {
      }  
      //RUN THEM AGAINST THE DATABASE
      $sth = $dbh->prepare('UPDATE `usuarios` SET `latchId` = ? WHERE mail = ?;');
      $sth->execute(array($accountId,$_COOKIE['User'])); //en cookie user tenemos el email del usuario recien logueado
      $user = $sth->fetch();
      echo ("Successfully paired");
}
//header("Location: ");
?>
