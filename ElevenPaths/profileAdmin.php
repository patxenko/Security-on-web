<?php
//start session
session_start();
error_reporting (0);
//just simple session reset on logout click
?>
<html>

	<head>
	<title> TFG </title>
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
function enableDisableGoogleA(){
$.ajax({
	        
	                url:   'comprobarGoogleA.php',
	                success: function (response) {
                                //si la respuesta es 1 es que si si es null o cero es q no
                                if (response == 1){
                                     window.location.href = 'profileAdmin.php#googleEnabled';
                                     document.getElementById("googleMessageE").innerHTML = "Google Authenticator is currently enabled in your account";
                                     document.getElementById("able").innerHTML = "DISABLE";
                                }
                                else{
                                     window.location.href = 'profileAdmin.php#googleEnabled';
                                     document.getElementById("googleMessageE").innerHTML = "Google Authenticator is currently disabled in your account";
                                     document.getElementById("able").innerHTML = "ENABLE";
                                   

                                }
                        }
	        });
}
function changeGoogleA(){
             $.ajax({
	        
	                url:   'activateGoogleA.php',
	                success: function (response) {
                             var sA=response;
                              if (response == 1){ 
                                      alert("successfully disabled");
                              }
                              if (response == 2){
                                      alert("Your account is not syncronized with google");
                              }
                              if (response == 0){
                                      alert("successfully enabled");
                              }
                              enableDisableGoogleA();
                        },
                        error: function(){
                               alert('Error generating!');
                        }
	        });
}
function generarQR(){
               $.ajax({
	        
	                url:   'generateQRCode.php',
	                success: function (response) {
                               //var sA=response;
                               document.getElementById("codigo").src = response;
                               document.getElementById("mensajeCode").innerHTML = "Please introduce the 6 digit code of the app";
                               document.getElementById("borrado2").innerHTML = "";
                               document.getElementById("textillo").innerHTML = "";
                               //Create a BUTTON type dynamically.   
                               var btn = document.createElement("BUTTON");
                               btn.setAttribute("onClick",'guardarGoogleCode($("#googleCode").val());return false;');
                               var t = document.createTextNode("SEND CODE");
                               btn.appendChild(t);
                               document.getElementById("elInput").appendChild(btn);
                               //create text input for code
                               var x = document.createElement("INPUT");
                                   x.setAttribute("type", "text");
                                   x.setAttribute("value", "");
                                   x.setAttribute("name", "googleCode");
                                   x.setAttribute("id","googleCode");
                                   document.getElementById("fooBar").appendChild(x);

                        },
                        error: function(){
                               alert('Error generating!');
                        }
	        });
}
function guardarGoogleCode(code){
var parametros = {
				"code" : code,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'verifyGoogleCode.php',
	                type:  'post',
	                
	                success: function (response) {
                               var sA=response;
                               var s=1;
                               if (response == 1){
                                      //alert("Correct code");
                                      guardarSecreto();
                                }
                                else{
                                      alert("Incorrect code, try again");
                                }
                        } 
                 
	        });
}
function guardarSecreto(){
//alert("guardar");
$.ajax({
	        
	                url:   'saveGoogleSecret.php',
	                success: function (response) {
                                  alert("Google Authenticator enabled now");
                        }
	        });
}
function parear(token){
                var parametros = {
				"latchPairingCode" : token,
	        };
	        $.ajax({
	                data:  parametros,
	                url:   'latchControllerAdmin.php',
	                type:  'post',
	                
	                success: function (response) {
                               var sA=response;
                        } 
                 
	        });
}
function disparear(){
	        $.ajax({
	                url:   'unpairAdmin.php',
	                
	                success: function (response) {
                               var sA=response;
                               alert(response);
                                
                        } 
	        });
}
function signOut(){
                $.ajax({
	                url:   'signOutAdmin.php',
                        success: function (response) {
                               var sA=response;
                               window.location.href='index.php';
                        } 
	        });
}
function aParear(){
   window.location.href = 'profileAdmin.php#PairLatch';
}
function anoParear(){
   window.location.href = 'profileAdmin.php#UnpairLatch';
}
function perfil(){
   window.location.href = 'profileAdmin.php#perfil';
}
function aGoogleAuth(){
   window.location.href = 'profileAdmin.php#googleAuth';
}
</script>
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
      //window.location.href='profile.php';
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
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
  function salir(){
      //para salir de facebook
      FB.logout(function(response) {
       window.location.href='index.php';
      });
      //para salir de twitter y redireccionar
      window.location.href = 'twitterOut.php';
      
      //window.location.href='index.php';
      
   }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '',
    cookie     : false,  // enable cookies to allow the server to access     habria que implementarlo yo lo quito para las pruebas de distintos usuarios
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
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
<!-- 
******************************************
**    SECCION INCIO PERFIL     **
******************************************
-->

<div data-role="page" id="perfil">
	



			
		<!--<p>puedes abrir y cerrar este menú simplemente deslizando el dedo sobre la pantalla.</p>-->

	 	
	
<div data-role="header">
<div align="left" id="textoPerfil";><h1>   </h1><h3>TFG Admin Zone</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;perfil();"><span>Admin Profile</span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuration</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Latch</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aParear();"><span>Pair</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;anoParear();"><span>Unpair</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>TOTP</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aGoogleAuth();"><span>Google Authenticator Sync</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;enableDisableGoogleA();"><span>Enable/Disable Google Authenticator</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;salir();"><span>Sign out</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div class="ui-content">

    <header><br>
 <h2>System Administrator</h2>
<br><br>
<h4>You can edit preferences using the top menu</h4><br><br>
<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" align="center">
</div><br><br><br><br><br><br><br><br><br><br>
     
    </header>
    


<div>   		



	<div data-role="footer">
   		<h1></h1>
  	</div>
  	
</div>
</div></div></div>




<!-- 
******************************************
**    SECCION PAIR LATCH    **
******************************************
-->

<div data-role="page" id="PairLatch">
	



			
		<!--<p>puedes abrir y cerrar este menú simplemente deslizando el dedo sobre la pantalla.</p>-->

	 	
	
<div data-role="header">
<div align="left" id="textoPairLatch";><h1>   </h1><h3>TFG Admin Zone</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;perfil();"><span>Admin Profile</span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuration</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Latch</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aParear();"><span>Pair</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;anoParear();"><span>Unpair</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signOut();"><span>Sign out</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div class="ui-content">

    <header>
 <img src="images/latch.jpeg" alt="latch" height="80" width="200" align="right">
     <h4>WELCOME TO LATCH PAIRING SITE</h4>
<p>1. First you must have an account on <A HREF="https://latch.elevenpaths.com/www/register">Eleven paths latch site.</A></p>
<p>2. Then you must download the latch app for free on your phone app market</p>
<p>3. Log in with you latch account in the app, and press "add new service"</p>
<p>4. Then press the "Generate new code" button</p>
<p>5. Copy the code into the input box below</p>
<p>For more help, just follow the tutorial in your latch app</p><br><br>
<!--pairing code-->

<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
   <form role="form" id="form-create-account" method="post" action="latchController.php">
   <div class="form-group" align="center">
        <label for="form-create-account-email">Latch pairing code:</label>
        <input name=latchPairingCode" type="javascript;" placeholder="Latch code" class="form-control" id="latchPairingCode" required>
   </div>
   <div class="form-group crealfix" align="center">
        <INPUT type="submit" href="javascript:;" onclick="parear($('#latchPairingCode').val());return false;" data-inline="true" value="SEND" class="" style="background: #D4A76B;"/>
   </div>
   </form>
</div>
<!-- fin pairing code-->
<br><br>
     
    </header>
    


<div>   		



	<div data-role="footer">
   		<h1></h1>
  	</div>
  	
</div>
</div></div></div>


<!-- 
******************************************
**    SECCION UNPAIR LATCH     **
******************************************
-->

<div data-role="page" id="UnpairLatch">
	



			
		<!--<p>puedes abrir y cerrar este menú simplemente deslizando el dedo sobre la pantalla.</p>-->

	 	
	
<div data-role="header">
<div align="left" id="textoUnpairLatch";><h1>   </h1><h3>TFG Admin Zone</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;perfil();"><span>Admin Profile</span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuration</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Latch</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aParear();"><span>Pair</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;anoParear();"><span>Unpair</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signOut();"><span>Sign out</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div class="ui-content">

    <header>
<img src="images/latch.jpeg" alt="latch" height="80" width="200" align="right"><br>
 <h3>Welcome to the Unpairing Latch site</h3><br><br>
<div align="center"  class="content-box"><h4 align="center">If you have your latch account paired with this service, and you dont want to use it anymore, you can just unpair your latch account with this site, clickin on the button below. You always could be able to pair it again when you want, on the latch pairing site. <h4></div><br><br><br>
<!--Unpairing code-->

<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
   <form role="form" id="form-uncreate-account" method="post">
   <div class="form-group" align="center">
        <INPUT type="submit" href="javascript:;" onclick="disparear();return false;" data-inline="true" value="UNPAIR" class="" style="background: #D4A76B;"/>
   </div>
   </form>
</div>
<br>
<br>
     
    </header>
    


<div>   		



	<div data-role="footer">
   		<h1></h1>
  	</div>
  	
</div>
</div></div></div>



<!-- 
******************************************
**    SECCION GOOGLE AUTHENTICATOR    **
******************************************
-->

<div data-role="page" id="googleAuth">
	



			
		<!--<p>puedes abrir y cerrar este menú simplemente deslizando el dedo sobre la pantalla.</p>-->

	 	
	
<div data-role="header">
<div align="left" id="textoGoogleAuth";><h1>   </h1><h3>TFG Admin Zone</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;perfil();"><span>Admin Profile</span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuration</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Latch</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aParear();"><span>Pair</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;anoParear();"><span>Unpair</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signOut();"><span>Sign out</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div class="ui-content">

    <header>
<img id="codigo" src="images/googleAuth.jpeg" alt="googleAuth" height="200" width="200" align="right">
 <h3 id="mensajeCode">Welcome to the Google Authenticator site</h3><br>
<div id="textillo">
<p>1. First you must download the google authenticator app from <A HREF="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">Google Play.</A></p>
<p>2. Then open your app and press the configure account button</p>
<p>3. Enter to the QR scanning mode</p>
<p>4. Press the generate QR code button below and scan it with the app</p>
<p>5. Once you have scanned the code, on your app will appear the 6 digit code for your account</p>
<p>For more help, just follow the tutorial in your google app</p></div><br><br>


<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
   <form role="form" id="form-uncreate-account" method="post">
   <div class="form-group" align="center" id="borrado2">
        <INPUT  type="submit" href="javascript:;" onclick="generarQR();return false;" data-inline="true" value="GENERATE QR CODE" class="" style="background: #D4A76B;"/>
   </div>
   </form>
</div>
<div class="ui-field-contain" align="center">
        <div id="fooBar"></div><br>
</div>
<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
   <form role="form" id="form-uncreate-account" method="post">
   <div class="form-group" align="center">
        <div id="elInput"></div>
   </div>
   </form>
</div>
<br><br><br><br><br><br><br><br><br><br>
     
    </div></header>
    


<div>   		



	<div data-role="footer">
   		<h1></h1>
  	</div>
  	
</div>
</div></div></div>



<!-- 
******************************************
**    SECCION ISGOOGLEENABLED    **
******************************************
-->

<div data-role="page" id="googleEnabled">
	



			
		<!--<p>puedes abrir y cerrar este menú simplemente deslizando el dedo sobre la pantalla.</p>-->

	 	
	
<div data-role="header">
<div align="left" id="textoGoogleEnabled";><h1>   </h1><h3>TFG Admin Zone</h3></div>
    <div id='cssmenu'>
<ul>
   <li><a href='javascript:;' onclick="window.actionEnabled=true;perfil();"><span>Admin Profile</span></a></li>
   <li class='active has-sub'><a href='#'><span>Configuration</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Latch</span></a>
            <ul>
               <li><a href='javascript:;' onclick="window.actionEnabled=true;aParear();"><span>Pair</span></a></li>
               <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;anoParear();"><span>Unpair</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product</span></a></li>
               <li class='last'><a href='#'><span>Sub Product</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>Sign</span></a>
      <ul>
         <li class='last'><a href='javascript:;' onclick="window.actionEnabled=true;signOut();"><span>Sign out</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>
</div>
<div class="ui-content">

    <header>

<h3 id="googleMessageE"></h3><br><br>
<div align="center"  class="content-box"><h4 align="center">Here you can enable or disable Google Authentication as an extra security measure. Just click the button to enable/disable your account with it. <h4></div><br><br><br>

<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
   <form role="form" id="form-uncreate-account" method="post">
   <div class="form-group" align="center">
        <a href='javascript:;' onclick="changeGoogleA();return false;"><span id="able"></span></a>
   </div>
   </form>
</div>
<br>
<br>
<br>
<br><br><br>
     
    </header>
    


<div>   		



	<div data-role="footer">
   		<h1></h1>
  	</div>
  	
</div>
</div></div></div></div>

</body>
 
</html>

