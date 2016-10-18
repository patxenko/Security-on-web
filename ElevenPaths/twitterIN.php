<?php
session_start();
$pagina=$_GET['pagina'];
include_once("APIs/twitterAPI/TwitterOAuth.php");

//SI LA PAGINA ES SIGN IN REQUERIREMOS INICIAR SESION CON TWITTER
if ($pagina=="signIn") {
     define('CONSUMER_KEY', '');
     define('CONSUMER_SECRET', '');
     define('OAUTH_CALLBACK', 'http://localhost/ElevenPaths/twitterLogin.php');

     if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        header('Location: '. $url);
     }else {
        echo $pagina;
        $access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        ?>
                <script type="text/javascript">
                window.close();
                window.opener.twitterLoginCorrect();
                </script>
               <?php
}
}
//SI LA PAGINA ES SIGN UP REQUERIREMOS RECOGER LOS VALORES PARA RELLENAR EL FORMULARIO
if ($pagina=="signUp"){
    define('CONSUMER_KEY', '');
    define('CONSUMER_SECRET', ''); 
    define('OAUTH_CALLBACK', 'http://localhost/ElevenPaths/twitterRegister.php'); 

    if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        header('Location: '. $url);
    } else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials", ["include_entities" => true, "skip_status" => true, "include_email" => "true"]);
        $nombre= $user->name;
        $mail = $user->email;
        ?>
                <script type="text/javascript">
                window.close();
                var nombre = "<?php echo $nombre; ?>" ;
                var mail= "<?php echo $mail; ?>" ;
                window.opener.getTwitterValues(nombre,mail);
                </script>
               <?php
   }
}
?>
