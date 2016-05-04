<?php
session_start();
        //recogemos variables
        $secret=$_SESSION['googleSecret'];
        $mail="admin@admin.com";
        $value=1;

if ($secret !=''){
      $dsn='mysql:dbname=TFG;host=127.0.0.1';
      $DBuser='root';
      $DBpassword='root';
      try {
           $dbh=new PDO($dsn,$DBuser,$DBpassword);
      } catch (PDOException $e) {
      }
   
      //RUN CHANGES INTO googleSecret column of DATABASE
      $sth = $dbh->prepare('UPDATE `admin` SET `googleSecret` = ? WHERE mail = ?;');
      $sth->execute(array($secret,$mail)); //en cookie user tenemos el email del usuario recien logueado
      $user = $sth->fetch();
      //RUN CHANGES INTO isGoogleEnabled column of DATABASE
      $sth2 = $dbh->prepare('UPDATE `admin` SET `isGoogleEnabled` = ? WHERE mail = ?;');
      $sth2->execute(array($value,$mail)); //en cookie user tenemos el email del usuario recien logueado
      $user2 = $sth2->fetch();
}
?>
