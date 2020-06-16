<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);*/

include_once 'functions.php';
session_start();

if (isset($_GET['id'])) {
    if(!($profile_data = get_user_info($_GET['id']))){
        http_response_code($profile_data);
        exit();
    }
} else {
    http_response_code(404);
    exit();
}

$user_fullname = $profile_data['fname'] . " " . $profile_data['lname'];
$page = $user_fullname . " | Meet";
require "includes/header.php";

?>

<div id="banner">
    <div class="cover">
        <img src="
        <?php
        if($profile_data['cover_image'] == ""){
        echo "https://www.vitruvianpartners.com/wp-content/uploads/placeholder-banner.png";
        } else {
            echo $profile_data['cover_image'];
        }
        ?>
        " alt="banner" class="obj-cover">
    </div>
    <div class="avatar"><img src="<?php echo (($profile_data['avatar']) == "") ? "images/user.png" : $profile_data['avatar']; ?>" alt="avatar"></div>
    <h1><?php echo $user_fullname; ?></h1>
    <h3>@<?php echo $profile_data['username']; ?></h3>
</div>

<div class="container profile feed">
    <div id="sidebar">
        <h1>Bio</h1>
        <?php 
            if(!empty($profile_data['desc'])){
                echo '<p class="bio">' . 
                    $profile_data['desc'] . '</p>';
            } else {
                echo "None";
            }
        ?>
    </div>
    <div id="content">
        <div class="entry">
            <?php include 'includes/newpost.snippet.php'; ?>
        </div>
        <?php

        $post_data = get_user_posts($_SESSION['SESSION_ID'], $_GET['id']);

        if($post_data){
            include('includes/displayProfilePosts.snippet.php');
        }
        ?>
    </div>
</div>

<footer>
    <div></div>
</footer>

</body>
</html>