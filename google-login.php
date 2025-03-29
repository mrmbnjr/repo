<?php
session_start();
require 'vendor/autoload.php';

$client = new Google\Client();
$client->setClientId('955507573744-4clp8uahkdnf49are98m73l2atejv26f.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

// Redirect user to Google Login
header("Location: " . $client->createAuthUrl());
exit();
?>