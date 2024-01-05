<?php
$lifetime=1800;
$path="/";
$domain="http://xampp:81/";
$cookieParams = session_get_cookie_params();
session_set_cookie_params(
    $lifetime,
    $path,
    $domain, 
    false,  // Secure: true (HTTPS üzerinden iletim)
    true   // HttpOnly: true (JavaScript tarafından erişim engellensin)
);
session_start();

if (isset($_SESSION['username'])  && $_SESSION['adminLoggedIn']==true ) {
    $loggedIn=true;
}
else{
    $loggedIn=false;
    header('Location: login');
}

?>