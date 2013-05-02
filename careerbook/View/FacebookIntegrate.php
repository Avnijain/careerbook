<?php
require '../classes/facebook.php';
$config = array ('appId' => '539305449445045', 'secret' => '69c70e0403ae5ce4fd2173abfab8a5ca', 'cookie' => true );

$facebook = new Facebook ( $config );
$user = $facebook->getUser ();

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api ( '/me' );
    } catch ( FacebookApiException $e ) {
        error_log ( $e );
        $user = null;
    }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl ();
    echo "<a href='{$logoutUrl}'>Logout</a>";
} else {
    $loginUrl = $facebook->getLoginUrl ();
    echo "<a href='{$loginUrl}'>Login</a>";
}

