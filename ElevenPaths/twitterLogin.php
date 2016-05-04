<?php
session_start();
include_once("APIs/twitterAPI/TwitterOAuth.php");
define('CONSUMER_KEY', '36pqTjCQvw55sWNYgQOvAUQyo'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', 'AUpIegOT0Do8ZDQOUTbWvsPOR3rDZGzXiNg74v46kfPztvYigC'); // add your app consumer secret key between single quotes

if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {
	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
	$_SESSION['access_token'] = $access_token;
	// redirect user back to index page
	header('Location: twitterIN.php?pagina=signIn');
}
?>
