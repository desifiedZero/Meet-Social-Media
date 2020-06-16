<?php
session_start();
include('functions.php');
$page = 'Login | Meet';

if(validate_session()){
    header("Location: .");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <title><?php echo $page; ?></title>
    <link 
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script
        src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous"></script>
</head>
<body>
    <div class="container login">
        <div class="logo-login">
            <div class="logo">
                <a href="#">
                    <img src="images/logo.png" alt="logo">
                </a>
                    <h3>Meet</h3>
            </div>
        </div>
        <div class="loginform" style="color: white;">
            <h2>Login</h2>

            <?php 
                if( !empty($_SESSION['login_error_msg'])) {
                    echo "<div class='error' style='text-align: 'center';'>" .
                        $_SESSION['login_error_msg'] . 
                        "</div>";
                    unset($_SESSION['login_error_msg']);
                }
            ?>

            <form action="validate.php" method="post" class="animateform" name="login">
                <label for="email">Email</label><br>
                <input type="text" name="email" id="email" required><br>
                <label for="pass">Password</label><br>
                <input type="password" name="pass" id="password" required><br>
                <a href="#" class="smalltext">Forgot Password?</a><br>
                <button type="submit" class="btn">Login</button>
                <h4>Don't have an account? <a href="signup.php" class="underline">Sign Up.</a></h4>
                <input type="hidden" value="signin" name="form" />
            </form>
        </div>
    </div>
</body>
</html>