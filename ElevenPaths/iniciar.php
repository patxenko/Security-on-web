<?php
        //recogemos variables
        $mail=$_POST['mail'];
        $pass=$_POST['pass'];
	$conexion =  mysql_connect('127.0.0.1', '', '');
        if (!$conexion) {
              die('No pudo conectarse: ' . mysql_error());
        }
        else{
              $resultado='Conectado satisfactoriamente';
        }

        mysql_select_db('db') or die('No se pudo seleccionar la base de datos');
        mysql_query ("SET NAMES 'utf8'");
        session_start();
        
        if($mail!="" && $pass!=""){

			$query_login = "SELECT * FROM `usuarios` WHERE mail='".$mail."' AND password='".$pass."'";
			$result_login_id = mysql_query($query_login) or die (mysql_error());
			$result_login_id_array= mysql_fetch_array($result_login_id);

			if(mysql_num_rows($result_login_id)!=0){

				//$_SESSION['user_id'] = $result_login_id_array['id'];
   				//$_SESSION['session_exist'] = true;
                                $resultado="conectado satisfactoriamente";
                                header('Location: profile.php');
			}
                        else{

				$resultado="El email o la contraseña son incorrectos";
			}

	}
        else{
			$resultado="Faltan campos por rellenar";
	}
	
echo $resultado;

?>
