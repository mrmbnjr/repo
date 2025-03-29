<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <title>Left Side Collapse Menu</title>

</head>
<body>

<div class="container">

    <div id="mySidebar" class="sidebar">
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div id="navbar" class="navbar">
        <div class="navbar-items">
            <button id="toggleBtn" class="openbtn" onclick="toggleNav()">
                <i class="bi bi-list"></i>
            </button>
            <span class="navbar-title">Dashboard</span>
            
        </div>
    </div>

    <div class="child3">

    </div>

    <div class="child4">

    </div>

</div>

<script src=dashboard.js></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
