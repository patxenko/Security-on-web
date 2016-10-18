<?php
        //recogemos variables
        $nombre=$_POST['nombre'];
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
        
        if($nombre!="" && $mail!="" && $pass!="" ){
		 if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                            //verifica que el email ingresado es nuevo
                            $query_check_email = 'SELECT * FROM usuarios WHERE mail="'.$mail.'"';
		            $result_check_email = mysql_query($query_check_email) or die (mysql_error());

		            if(mysql_num_rows($result_check_email)==0){

		            	$query_adduser = "INSERT INTO `usuarios` (`nombre`, `mail`, `password`) VALUES ('".$nombre."','".$mail."','".$pass."')";
				$result_adduser = mysql_query($query_adduser) or die (mysql_error());
                                $resultado="Registrado correctamente";

		            }
                            else{
		                $resultado="Existe un usuario con ese mismo email en la base de datos";
		            }
		  }
                  else{
		       $resultado="El email introducido: ".$mail." no es correcto";
		  }
		    
	}
        else{
	        $resultado="Faltan campos por rellenar";
	}
	
echo $resultado;

?>
