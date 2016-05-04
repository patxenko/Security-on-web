<script type="text/javascript">
llamadaRetorno(){
alert("hola");
}
</script>
<?php
require 'APIs/lightOpenId/openid.php';
$algo=1;
$pagina=$_GET['pagina'];
//echo ($pagina);
try
{
    $openid = new LightOpenID($_SERVER['HTTP_HOST']);
     
    //Not already logged in
    if(!$openid->mode)
    {
         
        //do the login
        if(isset($algo)) 
        {
            //The google openid url
            $openid->identity = 'https://me.yahoo.com';
             
            //Get additional google account information about the user , name , email , country
            $openid->required = array('namePerson/friendly' , 'contact/email' , 'namePerson/first' , 'namePerson/last' , 'pref/language' , 'contact/country/home' , 'namePerson');
             
            //start discovery
            header('Location: ' . $openid->authUrl());
            //echo ($openid->authUrl());
       
        }
        else
        {
            //print the login form
            echo "error";
        }
         
    }
     
    else if($openid->mode == 'cancel')
    {
        echo 'User has canceled authentication!';
        //redirect back to login page ??
    }
     
    //Echo login information by default
    else
    {
        if($openid->validate())
        {
            //User logged in
            $d = $openid->getAttributes();
             
            //$first_name = $d['namePerson/first'];
            //$last_name = $d['namePerson/last'];
            $email = $d['contact/email'];
            $language_code = $d['pref/language'];
            //$country_code = $d['contact/country/home'];
            $name = $d['namePerson'];
            $data = array(
                //'first_name' => $first_name ,
                //'last_name' => $last_name ,
                'email' => $email ,
            );
            if ($pagina=="signUp"){
                //$miName=string($name);
                //$miMail=string($email);?>
                <script type="text/javascript">
                window.close();
                var nombre = "<?php echo $name; ?>" ;
                var mail= "<?php echo $email; ?>" ;
                window.opener.getYahooValues(nombre,mail);
                </script>
               <?php
 
            }
            if ($pagina=="signIn"){
                //echo "sign in eleccion";?>
                <script type="text/javascript">
                window.close();
                window.opener.yahooRedirect();
                </script>
<?php
            }
            //echo ($email." ".$name);
            //header("Location: index.php?mail=$email&name=$name");
            //REDIRECCIONAMOS A USUARIO SIN REGISTRAR.
            //session_start();
            //$_SESSION['newMail']=$email;
            //header('Location:profile.php');
            //$conexion =  mysql_connect('127.0.0.1', 'root', 'root');
            //if (!$conexion) {
            //      die('No pudo conectarse: ' . mysql_error());
            //}
            //else{
            //      $resultado='Conectado satisfactoriamente';
            //}
            //mysql_select_db('TFG') or die('No se pudo seleccionar la base de datos');
            //mysql_query ("SET NAMES 'utf8'");
            //$query_check_email = 'SELECT * FROM usuarios WHERE mail="'.$email.'"';
            //$result_check_email = mysql_query($query_check_email) or die (mysql_error());
            //if(mysql_num_rows($result_check_email)==0){ //no existe
            //     header('Location:unregisteredProfile.php');
            //}
            //else{
		// $resultado="Existe un usuario con ese mismo email en la base de datos";
	    //}









         
        }
        else
        {
            //user is not logged in
        }
    }
}
 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}
?>


<script>
function nuevo(){
var nombre = "<?php echo $name; ?>" ;
alert(nombre);
}
</script>
