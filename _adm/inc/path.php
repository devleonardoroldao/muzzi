<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
    $link = "http";

// Here append the common URL characters.
$link .= "://";

// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];

if ($_SERVER['HTTP_HOST']  == "localhost") {
    // Append the requested resource location to the URL
    $link .= "/aclutas/admin";
}

define('PATH', preg_replace('/[\/]$/', "", $link));
?>