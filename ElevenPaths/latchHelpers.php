<?php

function authenticateUser($email, $password) {
     //DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT mail FROM usuarios WHERE mail = ? AND password = ?');
     $sth->execute(array($email,$password));
     $user=$sth->fetch();
     return $user;

}

function getLatchId($email) {
     //DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT latchId FROM usuarios WHERE mail=?');
     $sth->execute(array($email));
     $user = $sth->fetch();
     if ($user!=null){
          $doesTheLatchIdExistAndNotNull = array_key_exists('latchId',$user) && $user['latchId'] != null;
          return($doesTheLatchIdExistAndNotNull) ? $user['latchId'] : -1;
     }
     else{
          return -1;
     }
}

function getAdminLacthId() {
     //DB login
     $admin="admin@admin.com";
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT latchId FROM usuarios WHERE mail=?');
     $sth->execute(array($admin));
     $user = $sth->fetch();
     if ($user!=null){
          $doesTheLatchIdExistAndNotNull = array_key_exists('latchId',$user) && $user['latchId'] != null;
          return($doesTheLatchIdExistAndNotNull) ? $user['latchId'] : -1;
     }
     else{
          return -1;
     }
}


function authenticateAdmin($email, $password) {
     //DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT mail FROM admin WHERE mail = ? AND password = ?');
     $sth->execute(array($email,$password));
     $user=$sth->fetch();
     return $user;

}


function getLatchIdAdmin($email) {
     //DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT latchId FROM admin WHERE mail=?');
     $sth->execute(array($email));
     $user = $sth->fetch();
     if ($user!=null){
          $doesTheLatchIdExistAndNotNull = array_key_exists('latchId',$user) && $user['latchId'] != null;
          return($doesTheLatchIdExistAndNotNull) ? $user['latchId'] : -1;
     }
     else{
          return -1;
     }
}


function isGoogleEnabledForAdmin($email) {
     //DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT isGoogleEnabled FROM admin WHERE mail=?');
     $sth->execute(array($email));
     $user = $sth->fetch();
     if ($user['isGoogleEnabled']!=null && $user['isGoogleEnabled']==1){
          return $user['isGoogleEnabled'];
     }
     else{
          return -1;
     }
}

function comprobarCambiarGoogle($email) {
//DB login
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT isGoogleEnabled FROM admin WHERE mail=?');
     $sth->execute(array($email));
     $user = $sth->fetch();
     $aaa=$dbh->prepare('SELECT googleSecret FROM admin WHERE mail=?');
     $aaa->execute(array($email));
     $user2 = $aaa->fetch();
     if ($user2['googleSecret']!=null && $user['isGoogleEnabled']!=null && $user['isGoogleEnabled']==1){
          //cambiamos de 1 a 0
          $value=0;
          $mail="admin@admin.com";
          //RUN CHANGES INTO isGoogleEnabled column of DATABASE
          $sth2 = $dbh->prepare('UPDATE `admin` SET `isGoogleEnabled` = ? WHERE mail = ?;');
          $sth2->execute(array($value,$mail)); //en cookie user tenemos el email del usuario recien logueado
          $user = $sth2->fetch();
          return 1;
     }
     if ($user2['googleSecret']==null){
          return 2;
     }
     else{
          //cambiamos de 0 a 1 habilitar
          $value=1;
          $mail="admin@admin.com";
          //RUN CHANGES INTO isGoogleEnabled column of DATABASE
          $sth2 = $dbh->prepare('UPDATE `admin` SET `isGoogleEnabled` = ? WHERE mail = ?;');
          $sth2->execute(array($value,$mail)); //en cookie user tenemos el email del usuario recien logueado
          $user = $sth2->fetch();
          return 0;
     }
}

function takeGoogleAdminSecret($email) {
     $dsn='mysql:dbname=db;host=127.0.0.1';
     $DBuser='';
     $DBpassword='';
     try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
     } catch (PDOException $e) {
     }
     $sth=$dbh->prepare('SELECT isGoogleEnabled FROM admin WHERE mail=?');
     $sth->execute(array($email));
     $user = $sth->fetch();
     $aaa=$dbh->prepare('SELECT googleSecret FROM admin WHERE mail=?');
     $aaa->execute(array($email));
     $user2 = $aaa->fetch();
     if ($user2['googleSecret']!=null && $user['isGoogleEnabled']!=null && $user['isGoogleEnabled']==1){
          return ($user2['googleSecret']);
     }
     else{
          return 2;
     }
}
