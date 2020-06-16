<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}
include_once('functions.php');

if(!isset($_SESSION['SESSION_ID'])) {
    header("Location: login.php");
}

if( validate_session() === NULL ){
    if(isset($_SESSION['SESSION_ID'])){
        $_SESSION['login_error_msg'] = "Your session has expired, please login again.";
    }
    header("Location: login.php");
}

if(!isset($_SESSION['USER_ID']) || !($user_data = get_user_info($_SESSION['USER_ID']))){
    http_response_code($user_data);
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page ?></title>
    <link 
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script
        src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous"></script>
    <script src="js/nav.js"></script>
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="menuoverlay" onclick="navHide()"></div>

<div class="navcontainer">
    <span class="fa fa-times" id="cross-nav" onclick="navHide()"></span>
    <div id="navbar">
        <div id="logo-container">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="logo"></a>
                        <h3>Meet</h3>
                    
                </div>
            </a>
            <div class="user menuicon">
                <a href="profile.php?id=<?php echo $_SESSION['USER_ID']; ?>">
                <img src="<?php 
                    echo (($user_data['avatar']) == "") ? "images/user.png" : $user_data['avatar']; 
                ?>" alt="user" class="user-img">
                </a>
            </div>
        </div>
        <a href="index.php"><div class="menuitem"><span class="fa fa-home"></span><span class="hide-small">Home</span></div></a>
        <a href="profile.php?id=<?php echo $_SESSION['USER_ID']; ?>"><div class="menuitem"><span class="fa fa-user"></span><span class="hide-small">Profile</span></div></a>
        <a href="friends_list.php"><div class="menuitem"><span class="fa fa-users"></span><span class="hide-small">Friends</span></div></a>
        <a href="covid.php"><div class="menuitem"><span class="fa fa-info-circle"></span><span class="hide-small">COVID-19 Command Center</span></div></a>
        <div class="stick-bottom menuitem search">
            <form action="search.php" method="post"><input type="text" name="" id="" placeholder="Search"><button type="submit" class="black">Search</button></form>
        </div>
        <div class="small sticky-bottom">
            <a href="settings.php"><div class="menuitem"><span class="fa fa-cog"></span></div></a>
            <a href="logout.php"><div class="menuitem"><span class="fa fa-sign-out"></span></div></a>
        </div>
    </div>
</div>

<div class="topbar">
    <div class="left"><a href="#" onclick="navSeek()" id="hamburger"><span class="fa fa-bars"></span></a></div>
    <div class="mid"><img src="images/logo.png" alt="logo" class="logoimg"><h3 align="center">Meet</h3></div>
    <div class="right"><a href="logout.php"><span class="fa fa-sign-out"></span></a></div>
</div>