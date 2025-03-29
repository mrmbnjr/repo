<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="full-container">

        <!-- Form Switching -->
        <?php
        $activeForm = isset($_SESSION['active_form']) ? $_SESSION['active_form'] : "login"; unset($_SESSION['active_form']);
        ?>

        <!-- Success Notification -->
        <div class="message-notification">
            <?php if (isset($_SESSION['success_message'])): ?>
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php 
                        echo $_SESSION['success_message']; 
                        unset($_SESSION['success_message']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Login Form -->
        <div id="loginForm" class="login-container" style="<?php echo ($activeForm == 'login') ? 'display: block;' : 'display: none;'; ?>">
            <div class="form-container">
                <h2><img src="logo.png" alt="Logo" class="img-fluid mx-auto d-block" width="80"></h2>
                <form action="auth.php" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="form-group">
                        <input type="email" class="form-control <?php echo ($activeForm === 'login' && isset($_SESSION['emailErr'])) ? 'is-invalid' : ''; ?>" name="email" id="login-email" placeholder="" value="<?php echo ($activeForm === 'login') ? ($_SESSION['old_email'] ?? '') : ''; ?>">
                        <label for="login-email" class="form-field">Email</label>
                        <?php if ($activeForm === "login" && isset($_SESSION['emailErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['emailErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?php echo ($activeForm === 'login' && isset($_SESSION['passwordErr'])) ? 'is-invalid' : ''; ?>" name="password" id="login-password" placeholder="">
                        <label for="login-password" class="form-field">Password</label>
                        <?php if ($activeForm === "login" && isset($_SESSION['passwordErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['passwordErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <div class="swipe">
                    <p>Don't have an account? <button type="button" class="toggle-btn" onclick="registerForm()">Register here.</button></p>
                </div>

                <div class="third-party">
                    <hr class="line"><span>OR</span><hr class="line">
                </div>

                <div class="social-login">
                    <a href="google-login.php" class="google-login d-flex align-items-center justify-content-center gap-2">
                        <img src="google-logo-png.webp" alt="google-logo" class="img-fluid" width="25">
                        Login with Google
                    </a>
                </div>
                <p></p>
            </div>
        </div>

        <!-- Register Form -->
        <div id="registerForm" class="register-container" style="<?php echo ($activeForm == 'register') ? 'display: block;' : 'display: none;'; ?>">
            <div class="form-container">
                <h2>Create an account</h2>
                <form action="auth.php" method="POST">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <input type="text" class="form-control <?php echo isset($_SESSION['nameErr']) ? 'is-invalid' : ''; ?>" name="name" id="name" placeholder="" value="<?php echo $_SESSION['old_name'] ?? ''; ?>">
                        <label for="name" class="form-field">Name</label>
                        <?php if ($activeForm === "register" && isset($_SESSION['nameErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['nameErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control <?php echo ($activeForm === 'register' && isset($_SESSION['emailErr'])) ? 'is-invalid' : ''; ?>" name="email" id="register-email" placeholder="" value="<?php echo ($activeForm === 'register') ? ($_SESSION['old_email'] ?? '') : ''; ?>">
                        <label for="email" class="form-field">Email</label>
                        <?php if ($activeForm === "register" && isset($_SESSION['emailErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['emailErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?php echo ($activeForm === 'register' && isset($_SESSION['passwordErr'])) ? 'is-invalid' : ''; ?>" name="password" id="register-password" placeholder="">
                        <label for="password" class="form-field">Password</label>
                        <?php if ($activeForm === "register" && isset($_SESSION['passwordErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['passwordErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?php echo isset($_SESSION['confirmPasswordErr']) ? 'is-invalid' : ''; ?>" name="confirmPassword" id="confirmPassword" placeholder="">
                        <label for="confirmPassword" class="form-field">Confirm Password</label>
                        <?php if ($activeForm === "register" && isset($_SESSION['confirmPasswordErr'])) { ?>
                            <small class="text-danger"><?php echo $_SESSION['confirmPasswordErr'] ?? ''; ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="swipe">
                    <p>Already have an account? <button type="button" class="toggle-btn" onclick="loginForm()">Login here.</button></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Clear validation errors after displaying -->
    <?php unset($_SESSION['emailErr'], $_SESSION['passwordErr'], $_SESSION['nameErr'], $_SESSION['confirmPasswordErr'], $_SESSION['old_name'], $_SESSION['old_email']); ?>

<script src="script.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
