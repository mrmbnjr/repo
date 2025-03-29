<?php
session_start();
require 'vendor/autoload.php';

$client = new Google\Client();
$client->setClientId('955507573744-4clp8uahkdnf49are98m73l2atejv26f.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth2 = new Google\Service\Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    // Check if the user exists in database
    $conn = new mysqli("localhost", "root", "", "transaction-history");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $userInfo->email;
    $name = $userInfo->name;
    $google_id = $userInfo->id;

    // Check if user already exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // User exists, log them in
        $_SESSION['user'] = $result->fetch_assoc();
    } else {
        // New user, insert into database
        $insert = "INSERT INTO users (name, email, google_id) VALUES ('$name', '$email', '$google_id')";
        if ($conn->query($insert) === TRUE) {
            $_SESSION['user'] = [
                'name' => $name,
                'email' => $email
            ];
        }
    }

    $conn->close();
    header("Location: dashboard.php");
    exit();
}
?>
