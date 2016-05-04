<?php 
//recogemos el $accountId
 require_once("latchConfigAdmin.php"); //contiene appId y secret y acceso a funciones de la API

 //recogemos el latchId del usuario si tiene;
 $dsn='mysql:dbname=TFG;host=127.0.0.1';
 $DBuser='root';
 $DBpassword='root';
 try {
       $dbh=new PDO($dsn,$DBuser,$DBpassword);
 } 
 catch (PDOException $e) {
 }
   
 //RUN THEM AGAINST THE DATABASE
 $sth=$dbh->prepare('SELECT latchId FROM admin WHERE mail = ?');
 $sth->execute(array($_COOKIE['Admin'])); //en cookie user tenemos el email del usuario recien logueado
 $user = $sth->fetch();
 
 $accountId = $user['latchId'];
 //echo($accountId+" 3"); 
 $latchapi = new ElevenPaths\Latch\LatchApp($appId, $secret); //llamada a la clase latchApp

 if (($accountId != -1) && ($accountId != '')){
      $unpairResponse = $latchapi->unpair($accountId);
      $unpairResponseData = $unpairResponse->getData(); //getData de getResponse
      echo($unpairResponseData);
 }
 

//ACTUALIZAMOS LA BASE DE DATOS TRAS DESPAREADO
      $sth = $dbh->prepare('UPDATE `admin` SET `latchId` = ? WHERE mail = ?;');
      $sth->execute(array("",$_COOKIE['Admin'])); //en cookie admin tenemos el email del usuario recien logueado
      $user = $sth->fetch();
      echo("despareado correctamente");
?>
