<html>
<head>
<title> 4RL3K1N </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnh60nG_kVse3G3z1xoaC2Nvmg4s5dsjs&libraries=places"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="mijs.js"></script>
<link rel="stylesheet" href="micss.css" type="text/css"/>
<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<script src="js/jQuery.BlackAndWhite.js"></script>


<script>
//FUNCION DE LOGIN CON YAHOO
function yahooRedirect(){
window.location.href = 'profile.php';
}
//FUNCION DE RECOGIDA DE VALORES CON YAHOO
function getYahooValues(nombre,mail){
document.formulario.name.value=nombre;
document.formulario.mail.value=mail;
}
//FUNCION DE LOGIN CON TWITTER
function twitterLoginCorrect(){
window.location.href = 'profile.php';
}
//FUNCION DE RECOGIDA DE VALORES CON TIWTTER
function getTwitterValues(nombre,mail){
document.formulario.name.value=nombre;
document.formulario.mail.value=mail;
}
//FUNCION DE LLAMADA AL PULSAR EL BOTON TWITTER
function twitterLog(){
var URLactual = window.location.href;
    if (URLactual=="http://localhost/ElevenPaths/index.php#signIn"){
               //window.location.href = 'twitterIN.php?pagina=signIn';
               var miPopup
               miPopup =window.open("twitterIN.php?pagina=signIn","Twitter signIn","width=500", "height=200","menubar=no") 
    }
    if (URLactual=="http://localhost/ElevenPaths/index.php#signUp"){
               //window.location.href = 'twitterIN.php?pagina=signUp';   
               var miPopup
               miPopup =window.open("twitterIN.php?pagina=signUp","Twitter signUp","width=500", "height=200","menubar=no")            
    }
}

//FUNCION DE LLAMADA AL PULSAR BOTON DE YAHOO
function yahooLog(){
    var URLactual = window.location.href;
    if (URLactual=="http://localhost/ElevenPaths/index.php#signIn"){
               var miPopup
               miPopup =window.open("login-yahoo.php?pagina=signIn","Yahoo signIn","width=500", "height=200","menubar=no") 
    }
    if (URLactual=="http://localhost/ElevenPaths/index.php#signUp"){
               var miPopup
               miPopup =window.open("login-yahoo.php?pagina=signUp","Yahoo signUp","width=500", "height=200","menubar=no")
    }
}
//COMPROBACION DE GOOGLE AUTH TOKEN PARA ADMINISTRADOR
function comprobarGoogleAuth(pass){
	        var parametros = {
				"pass" : pass,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'verifyGoogleCodeLogin.php',
	                type:  'post',
	                
	                success: function (response) {
                              var sA=response;
                               if (sA == 1){
                                      window.location.href='profileAdmin.php';
                                }
                                else{
                                      alert("incorrect code");
                                }
                        } 
	        });
}
//REDIRECCION A PAGINA DE REGISTRO
function signUpPage(){
    window.location.href = 'index.php#signUp';
}
//REDIRECCION A PAGINA DE LOG IN
function signInPage(){
    window.location.href = 'index.php#signIn';
}
//REDIRECCION A PAGINA DE INICIO
function inicio(){
    window.location.href = 'index.php#Inicio';
}
//REDIRECCION A PAGINA DE LOGIN ADMINISTRADOR
function AdminLog(){
     window.location.href = 'index.php#AdminLog';
}
//LLAMADA A LA FUNCION REGISTRAR
function registrar(nombre, mail, pass){
	        var parametros = {
				"nombre" : nombre,
				"mail" : mail,
				"pass" : pass,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'registrar.php',
	                type:  'post',
	                
	                success: function (response) {
                        alert (response);
                } 
	        });
}
//LLAMADA A LA FUNCION DE COMPROBACION DE USER-PASSWORD EN LOGIN
function iniciar(mail,pass){
                var parametros = {
				"mail" : mail,
				"pass" : pass,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'LoginController.php',
	                type:  'post',
	                //devuelve 1 si correcto y 0 si incorrecto seguido de los intentos
	                success: function (response) {
                               var sA=response;
                               var res = sA.split(" ");
                               if (res[0] == 1){
                                      //window.location.href='profile.php';
                                      alert("correcto");
                                }
                                else{
                                      alert(res[1]);
                                      if (res[1]>=3){
                                         window.location.href = 'index.php#signInCaptcha';
                                      }
                                      else{
                                         alert("valores incorrectos");
                                      }
                                }
                        } 
	        });
}
function iniciarCaptcha(mail,pass,cap){
                //alert(cap);
                var parametros = {
				"mail" : mail,
				"pass" : pass,
                                "cap"  : cap,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'loginControllerCaptcha.php',
	                type:  'post',
	                success: function (response) {
                               alert(response);
                        } 
	        });
}
//LLAMADA A LA FUNCION DE LOGIN ADMINISTRADOR
function iniciarAdmin(pass){
                var parametros = {
				"pass" : pass,
	        };
                $.ajax({
	                data:  parametros,
	                url:   'LoginControllerAdmin.php',
	                type:  'post',
	                
	                success: function (response) {
                               var sA=response;
                               if (sA == 1){
                                      window.location.href='profileAdmin.php';
                                }
                                if (sA == 2){
                                      window.location.href = 'index.php#adminGoogleAuthenticator';
                                }
                                if (sA != 1 && sA != 2){
                                      alert("valores incorrectos");
                                }
                        } 
	        });
	        
}
</script>
<style>
.ui-page-theme-a .ui-panel-wrapper {
background-color: #000000;
border-color: #000000;
color: #000000;
text-shadow: 0 1px 0 #000000;
}
</style>
</head>
<body>

<script>
//CODIGO PARA USAR LA API JAVASCRIPT DE FACEBOOK

//FUNCION PARA RECOGER EL ESTADO DE USUARIO
function statusChangeCallback(response) {
    if (response.status === 'connected') {
      comprueba();
    } else if (response.status === 'not_authorized') {
      // Persona logueada en facebook pero no en esat pagina
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Loggin ' +
        'with facebook.';
    }
}

// FUNCION AL FINALIZAR LOG IN EN FACEBOOK
function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

//INICIO ASINCRONO DE LA APLICACION
window.fbAsyncInit = function() {
  FB.init({
    appId      : '529016693937946',
    cookie     :  false,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.6' // use graph api version 2.5
});


FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
};

// CARGA DEL SDK ASINCRONAMENTE
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function recogeFacebook() {
    FB.api('/me', {fields: 'last_name,name,email'}, function(response) {
      var mail=response.email;
      document.formulario.name.value=response.name;
      document.formulario.mail.value=response.email;
    });
  }
function comprueba(){
    var URLactual = window.location.href;
    //LO DIRIGIMOS AL PERFIL
    if (URLactual=="http://localhost/ElevenPaths/index.php#signIn"){
          window.location.href='profile.php';
    }
    //RECOGE LOS VALORES DE SESION
    if (URLactual=="http://localhost/ElevenPaths/index.php#signUp"){
          recogeFacebook();
    }
} 
</script>


<!-- 
******************************************
**    SECCION INiCIO     **
******************************************
-->

<div data-role="page" id="Inicio">
<div data-role="header">
<div align="left" id="TextoInicio";><h1>   </h1><h3>TFG</h3></div>
<div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div data-role="main" class="ui-content">

    <header><br><br><br><br>
     <div align="center">
     <h1>PAGINA PRINCIPAL</h1>
<!--facebook like button-->
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
<!--end of facebook like button-->
     </div>
     <p></p><br><br><br><br><br><br><br>
    </header>
</div>
    
<div data-role="footer">
   		<h1></h1>
</div>
  	
</div>



<!--
******************************************
**    SECCION REGISTRO     **
******************************************
-->


<div data-role="page" id="signUp">
<div data-role="header">
<div align="left" id="TextoR";><h1>   </h1><h3>TFG</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div></div>

<div data-role="main" class="ui-content" style="background:#000000;">
    
		<div data-role="content">

			<div class="ui-field-contain">
<form name="formulario">


<h3 align="center">Nombre</h3>
<input type="text" name="name" id="name" class="controls" value="" type="javascript;" placeholder="Name.."><br>
<h3 align="center">Correo electrónico</h3>
<input type="text" name="mail" id="mail" class="controls" value="" type="javascript;" placeholder="user@domain.com"><br>
<h3 align="center">Contraseña</h3>
<input type="password" id="pass" type="javascript;" placeholder="******"><br>
</form>
			</div>
<div align="center">
<h5> Or you can just register using any platform from the list below</h5><br>
<!--facebook login-->
<div class="fb-login-button" scope="public_profile,email" data-max-rows="0" data-size="small" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div>
<!--<div id="status">-->
<!--podemos elegir data-size=icon,small,large,medium,xlarge...-->
<!---->

<!--twitter login-->
<a title="Register with twitter" href="javascript:;" onclick="twitterLog();return false;" data-inline="true" ><img src="images/sign-in-twitter.png" width="55" height="18" border="0" /></a>
<!--<a href="process.php"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a> -->
<!---->
<a title="Log In with yahoo" href="javascript:;" onclick="yahooLog();return false;" data-inline="true" ><img src="images/sign-in-yahoo.png" width="55" height="18" border="0" /></a>


<div align="center" border-style="solid;" border-color="#000000;">
<INPUT type="submit" href="javascript:;" onclick="registrar($('#name').val(), $('#mail').val(), $('#pass').val());return false;" data-inline="true" value="REGISTRAR" class="" style="background: #D4A76B;"/>
</div>
	
		</div>
	</div>


<div data-role="footer">
   <h1></h1>
</div>
  	
</div>
</div></div></div><br>




<!--
******************************************
**    SECCION LOGIN    **
******************************************
-->


<div data-role="page" id="signIn">

	

<!--Menu principal-->
<div data-role="header">
<div align="left" id="TextoI";><h1>   </h1><h3>TFG</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>

<div class="ui-content" style="background:#000000;">
<div align="right"><a href="javascript:;" onclick="AdminLog();return false;" data-inline="true" ><h6>Admin zone</h6></a></div>    
		<div data-role="content">
			<div class="ui-field-contain">
				<h3 align="center">Correo electrónico</h3>
				<input type="text" id="mailI" class="controls" type="javascript;" placeholder="user@domain.com"><br><br>
                                <h3 align="center">Contraseña</h3>
				<input type="password" id="passI" type="javascript;" placeholder="******"><br>

			</div>
<div align="center" border-style="solid;" border-color="#000000;">
<INPUT type="submit" href="javascript:;" onclick="iniciar($('#mailI').val(), $('#passI').val());return false;" data-inline="true" value="ENTRAR" class="" style="background: #D4A76B;"/><br>
<h5> Or you can just sign in with any other platform from the list below</h5><br>

<div align="center">
<!--facebook login-->
<div class="fb-login-button" scope="public_profile,email" data-max-rows="0" data-size="small" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div>
<!--<div id="status">-->
<!--podemos elegir data-size=icon,small,large,medium,xlarge...-->
<!---->

<!--twitter login-->
<a title="Log In with twitter" href="javascript:;" onclick="twitterLog();return false;" data-inline="true" ><img src="images/sign-in-twitter.png" width="55" height="18" border="0" /></a>
<!--<a href="process.php"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a> -->
<!---->
<a title="Log In with yahoo" href="javascript:;" onclick="yahooLog();return false;" data-inline="true" ><img src="images/sign-in-yahoo.png" width="55" height="18" border="0" /></a>

<br><br><br></div>
</div>

		
		</div>
</div>
	


<div data-role="footer">
   <h1></h1>
</div>
  	
</div>
</div></div></div>


<!--
******************************************
**    SECCION ADMIN LOG   **
******************************************
-->


<div data-role="page" id="AdminLog">

	

<!--Menu principal-->
<div data-role="header">
<div align="left" id="TextoAdmin";><h1>   </h1><h3>TFG</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>

<div class="ui-content" style="background:#000000;"><br><br>   
		<div data-role="content">
			<div class="ui-field-contain">
				<br><br><br><br>
                                <h3 align="center">Admin Password</h3>
				<input type="password" id="passAdmin" type="javascript;" placeholder="******"><br>

			</div><br><br><br>
<div align="center" border-style="solid;" border-color="#000000;">
<INPUT type="submit" href="javascript:;" onclick="iniciarAdmin($('#passAdmin').val());return false;" data-inline="true" value="ENTRAR" class="" style="background: #D4A76B;"/><br>
<br><br><br>
</div>

		
		</div>
</div>
	


<div data-role="footer">
   <h1></h1>
</div>
  	
</div>
</div></div></div>



<!--
******************************************
**    SECCION ADMIN GOOGLE AUTHENTICATOR   **
******************************************
-->


<div data-role="page" id="adminGoogleAuthenticator">

	

<!--Menu principal-->
<div data-role="header">
<div align="left" id="textoAdminGoogleAuthenticator";><h1>   </h1><h3>TFG</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>

<div class="ui-content" style="background:#000000;"><br><br>   
		<div data-role="content">
			<div class="ui-field-contain">
				<br><br><br><br>
                                <h3 align="center">INSERT YOUR GOOGLE AUTHENTICATOR CODE HERE</h3>
				<input type="password" id="codeGoogleAdmin" type="javascript;" placeholder="******"><br>

			</div><br><br><br>
<div align="center" border-style="solid;" border-color="#000000;">
<INPUT type="submit" href="javascript:;" onclick="comprobarGoogleAuth($('#codeGoogleAdmin').val());return false;" data-inline="true" value="SEND CODE" class="" style="background: #D4A76B;"/><br>
<br><br><br>
</div>

		
		</div>
</div>
	


<div data-role="footer">
   <h1></h1>
</div>
  	
</div>
</div></div></div>

<!--
******************************************
**    SECCION LOGIN CON CAPTCHA  **
******************************************
-->


<div data-role="page" id="signInCaptcha">

	

<!--Menu principal-->
<div data-role="header">
<div align="left" id="TextoI";><h1>   </h1><h3>TFG</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;inicio();"><span>Home</span></a></li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signUpPage();"><span>Sign Up</span></a>
         </li>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signInPage();"><span>Sign In</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>

<div class="ui-content" style="background:#000000;">
<div align="right"><a href="javascript:;" onclick="AdminLog();return false;" data-inline="true" ><h6>Admin zone</h6></a></div>    
		<div data-role="content">
			<div class="ui-field-contain">
				<h3 align="center">Correo electrónico</h3>
				<input type="text" id="mailI" class="controls" type="javascript;" placeholder="user@domain.com"><br><br>
                                <h3 align="center">Contraseña</h3>
				<input type="password" id="passI" type="javascript;" placeholder="******"><br>
                                <h3 align="center">Introduce los caracteres de la imagen</h3>
                                <img align="center" alt="Numeros aleatorios" src="captchaImag.php"></img>
                                <input class="campos" type="text" id="captcha"name="num"><br>


			</div>
<div align="center" border-style="solid;" border-color="#000000;">
<INPUT type="submit" href="javascript:;" onclick="iniciarCaptcha($('#mailI').val(), $('#passI').val(),$('#captcha').val());return false;" data-inline="true" value="ENTRAR" class="" style="background: #D4A76B;"/><br>
<h5> Or you can just sign in with any other platform from the list below</h5><br>

<div align="center">
<!--facebook login-->
<div class="fb-login-button" scope="public_profile,email" data-max-rows="0" data-size="small" data-show-faces="false" data-auto-logout-link="false" onlogin="checkLoginState();"></div>
<!--<div id="status">-->
<!--podemos elegir data-size=icon,small,large,medium,xlarge...-->
<!---->

<!--twitter login-->
<a title="Log In with twitter" href="javascript:;" onclick="twitterLog();return false;" data-inline="true" ><img src="images/sign-in-twitter.png" width="55" height="18" border="0" /></a>
<!--<a href="process.php"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a> -->
<!---->
<a title="Log In with yahoo" href="javascript:;" onclick="yahooLog();return false;" data-inline="true" ><img src="images/sign-in-yahoo.png" width="55" height="18" border="0" /></a>

<br><br><br></div>
</div>

		
		</div>
</div>
	


<div data-role="footer">
   <h1></h1>
</div>
  	
</div>
</div></div></div>






</body>
 
</html>
