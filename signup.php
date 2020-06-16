<?php

session_start();
include('functions.php');
if(validate_session()){
    header("Location: .");
}

$page = "Sign Up | Meet";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <title><?php print $page; ?></title>
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
            <form action="validate.php" method="post" name="signup">
            <h2>Sign Up</h2>
            <?php 
            if(isset($_SESSION['error_signup'])){
                echo "<div class='error' style='text-align: 'center';'>" .
                    $_SESSION['error_signup'] .
                    "</div>";
                unset($_SESSION['error_signup']);
            }
            ?>
                <div class="flexbox">
                    <div class="flex1" style="margin: 0 30px 0 0;">
                        <label for="fname">First Name <span class="red">*</span></label><br>
                        <input type="text" name="fname" id="fname" required>
                    </div>
                    <div class="flex1">
                        <label for="lname">Last Name <span class="red">*</span></label><br>
                        <input type="text" name="lname" id="lname" required>
                    </div>
                </div>
                <label for="email">Email <span class="red">*</span></label><br>
                <input type="email" name="email" id="email" required>

                <label for="username">Username <span class="red">*</span></label><br>
                <input type="text" name="username" id="username" required>

                <label for="pass">Password <span class="red">*</span></label><br>
                <input type="password" name="pass" id="pass" required>

                <label for="dob">Date of Birth <span class="red">*</span></label><br>
                <input type="date" name="dob" id="dob" required>

                <input type="checkbox" name="tos" id="tos" required><label for="tos">I agree to the Terms of Services <span class="red">*</span></label><br>

                <a href="#" class="smalltext">Click to read our terms of agreement and EULA</a><br>
                <span class="red">* <span class="smalltext">Required information</span></span><br>
                <button type="submit" class="btn">Sign Up</button>
                <h4>Already have an accout? <a href="login.php" class="underline">Sign In.</a></h4>
                <input type="hidden" name="form" value="signup">
            </form>
        </div>
    </div>
</body>
</html>