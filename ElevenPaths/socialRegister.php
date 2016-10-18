<?php
if (isset($_GET['mail'])){
$mail=$_GET['mail'];
}
if (isset($_GET['name'])){
$name=$_GET['name'];
}
?>
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
function yahooRegister(){
window.location.href = 'register-yahoo.php';
}
function yahooLog(){
window.location.href = 'login-yahoo.php';
}
function comprobarGoogleAuth(pass){
                //alert(pass);
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

function signUpPage(){
    window.location.href = 'index.php#signUp';
}
function twitterLog(){
 window.location.href = 'process.php';
}
function twitterRegister(){
window.location.href = 'twitter-register.php';
}
function signInPage(){
    window.location.href = 'index.php#signIn';
}
function inicio(){
    window.location.href = 'index.php#Inicio';
}
function AdminLog(){
     window.location.href = 'index.php#AdminLog';
}
function registrar(nombre, mail, pass){
                //alert(pass);
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
function iniciar(mail,pass){
                var parametros = {
				"mail" : mail,
				"pass" : pass,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'LoginController.php',
	                type:  'post',
	                
	                success: function (response) {
                               var sA=response;
                               if (sA == 1){
                                      //window.location.href='profile.php';
                                      alert("correcto");
                                }
                                else{
                                      alert("valores incorrectos");
                                      //alert(response);
                                }
                        } 
	        });
}
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
                               //alert(response);
                               if (sA == 1){
                                      window.location.href='profileAdmin.php';
                                      //alert(response);
                                }
                                if (sA == 2){
                                      window.location.href = 'index.php#adminGoogleAuthenticator';
                                }
                                if (sA != 1 && sA != 2){
                                      alert("valores incorrectos");
                                      //alert(response);
                                }
                        } 
	        });
	        
}

</script>
<script>

    /**

    * Array con las imagenes que se iran mostrando en la web

    */

    var imagenes=new Array(

        'unav.png',

        'upna.png',

        'images.jpeg',

        '3.jpeg',

        '4.png'

    );

 

    /**

    * Funcion para cambiar la imagen

    */

    function rotarImagenes()

    {

        // obtenemos un numero aleatorio entre 0 y la cantidad de imagenes que hay

        var index=Math.floor((Math.random()*imagenes.length));

 

        // cambiamos la imagen

        document.getElementById("imagen").src=imagenes[index];

    }

 

    /**

    * Función que se ejecuta una vez cargada la página

    */

    onload=function()

    {

        // Cargamos una imagen aleatoria

        rotarImagenes();

 

        // Indicamos que cada 5 segundos cambie la imagen

        setInterval(rotarImagenes,5000);

    }

</script>

<script>
    $('.bwWrapper').BlackAndWhite({
        hoverEffect : true, // default true
        // set the path to BnWWorker.js for a superfast implementation
        webworkerPath : false,
        // to invert the hover effect
        invertHoverEffect: false,
        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
        intensity:1,
        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
            fadeIn: 200, // 200ms for fadeIn animations
            fadeOut: 800 // 800ms for fadeOut animations
        },
        onImageReady:function(img) {
            // this callback gets executed anytime an image is converted
        }
    });
</script>
<style>
 
  
	.ui-page-theme-a .ui-panel-wrapper {
    background-color: #000000;
    border-color: #000000;
    color: #000000;
    text-shadow: 0 1px 0 #000000;
}</style>

</head>

<body>
<!-- facebook sdk load-->
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      window.location.href='profile.php';
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Loggin ' +
        'with facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  //function salir(){
      //FB.logout(function(response) {
       // user is now logged out
      //});
   //}

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '',
    cookie     :  false,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', {fields: 'last_name,name,email'}, function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';cd
    });
  }
  
</script>
<!--
******************************************
**    SECCION REGISTRO     **
******************************************
-->


<div data-role="page" id="signUp">
	

<!--Menu principal-->
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
                                <h3 align="center">Nombre</h3>
<?php
echo '<input type="text" id="name" class="controls" type="javascript;" placeholder="Name.." value="'.$name.'"><br>';
echo '				<h3 align="center">Correo electrónico</h3>';
echo '<input type="text" id="mail" class="controls" type="javascript;" placeholder="user@domain.com" value="'.$mail.'"><br>';
echo '                               <h3 align="center">Contraseña</h3>';
echo '				<input type="password" id="pass" type="javascript;" placeholder="******"><br>';
?>
			</div>
<div align="center">
<h5> Introduce the values for the none filled boxes</h5><br>


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




</body>
 
</html>
