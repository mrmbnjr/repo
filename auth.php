<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // login
    if ($action === "login") {
        
        $_SESSION['active_form'] = "login";

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $_SESSION['old_email'] = $email;

        // Validation
        if (empty($email)) {
            $_SESSION['emailErr'] = "Email is required!";
        }
        if (empty($password)) {
            $_SESSION['passwordErr'] = "Password is required!";
        }

        if (!empty($_SESSION['emailErr']) || !empty($_SESSION['passwordErr'])) {
            header("Location: index.php");
            exit();
        }

        // Check if email exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $_SESSION['emailErr'] = "Email doesn't exist!";
            header("Location: index.php");
            exit();
        }

        // Check password
        if (!password_verify($password, $user['password'])) {
            $_SESSION['passwordErr'] = "Wrong password!";
            header("Location: index.php");
            exit();
        }

        // Successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: dashboard.php");
        exit();
    } 

    // registration
    if ($action === "register") {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirmPassword'] ?? '');
        
        $_SESSION['old_name'] = $name;
        $_SESSION['old_email'] = $email;

        $_SESSION['active_form'] = "register";

        // Validation
        if (empty($name)) {
            $_SESSION['nameErr'] = "Name is required!";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $_SESSION['nameErr'] = "Name should only contain letters and spaces!";
        }

        if (empty($email)) {
            $_SESSION['emailErr'] = "Email is required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailErr'] = "Invalid email format!";
        }

        if (empty($password)) {
            $_SESSION['passwordErr'] = "Password is required!";
        } elseif (strlen($password) < 6) {
            $_SESSION['passwordErr'] = "Password must be at least 6 characters!";
        }

        if (!empty($password) && $password !== $confirmPassword) {
            $_SESSION['confirmPasswordErr'] = "Passwords do not match!";
        }
        
        if (!empty($_SESSION['nameErr']) || !empty($_SESSION['emailErr']) || !empty($_SESSION['passwordErr']) || !empty($_SESSION['confirmPasswordErr'])) {
            header("Location: index.php");
            exit();
        }

        // Check if email is already registered
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['emailErr'] = "Email already registered!";
            header("Location: index.php");
            exit();
        }

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Registration successful! You can now log in.";
            
            $_SESSION['active_form'] = "register";

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Something went wrong. Please try again.";
            header("Location: index.php");
            exit();
        }
    }
}

exit();
?>