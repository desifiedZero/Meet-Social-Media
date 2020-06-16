<?php

session_start();
include('functions.php');

if($_POST['form'] == 'signin'){
    $conn = db_create_connection();
    $input_email = mysqli_real_escape_string($conn, strtolower($_POST['email']));

    $sql = "SELECT `id`, `password` FROM `user` WHERE `email` = ? OR `username` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_email, $input_email);
    $stmt->execute();
    $stmt->bind_result($user_id, $password);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if ( $password != NULL ) {

        if ( $_POST['pass'] == $password ){
            $_SESSION['SESSION_ID'] = generate_session_md5($user_id);
            $_SESSION['USER_ID'] = $user_id;
            
            header("Location: .");
        } else {
            $_SESSION['login_error_msg'] = "Wrong username/password.";
            header("Location: login.php");
        }

    } else {
        $_SESSION['login_error_msg'] = "Wrong username/password.";
        header("Location: login.php");
    }

} elseif ($_POST['form'] == 'signup') {
    if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['email']) &&
    isset($_POST['pass']) &&
    isset($_POST['dob']) &&
    isset($_POST['username']) &&
    isset($_POST['tos'])
    ){
        $sql = "INSERT INTO `user` (email, username, password, firstname, lastname, dob) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $conn = db_create_connection();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $input_email, $input_username, $input_pass, $input_fname, $input_lname, $input_dob);
        
        $input_fname = mysqli_real_escape_string($conn, strtolower($_POST['fname']));
        $input_lname = mysqli_real_escape_string($conn, strtolower($_POST['lname']));
        $input_email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $input_pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $input_dob = date("Y-m-d",strtotime(mysqli_real_escape_string($conn, $_POST['dob'])));
        $input_username = mysqli_real_escape_string($conn, strtolower($_POST['username']));

        $result = $stmt->execute();
        if ( $result ) {
            $stmt->close();
            $conn->close();
            $_SESSION['SESSION_ID'] = generate_session_md5($user_id);
            $_SESSION['USER_ID'] = get_user_id();
        } else {
            if(strpos($stmt->error, "user.user_email")){
                $stmt->close();
                $conn->close();
                $_SESSION['error_signup'] = "Sorry, this email already Exists.";
                header("Location: signup.php");
            } else if (strpos($stmt->error, "user.user_username")){
                $stmt->close();
                $conn->close();
                $_SESSION['error_signup'] = "Sorry, this username already Exists.";
                header("Location: signup.php");
            }
        }
    } else {
        $_SESSION['error_signup'] = "Please fill required information.";
        header("Location: signup.php");
    }
}