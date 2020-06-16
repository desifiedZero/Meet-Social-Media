<?php

if(isset($_FILES['media']) && $_FILES['media'] != '' && $_FILES['media']['error'] < 1){
    $errors = array();
    $file_name = $_FILES['media']['name'];
    $file_size = $_FILES['media']['size'];
    $file_tmp = $_FILES['media']['tmp_name'];
    $file_type = $_FILES['media']['type'];
    $file_ext = $_FILES['media']['name'];
    $file_ext = strtolower( end( explode('.', $file_ext) ) );

    $photo_ext = array("jpeg","jpg","png");
    $video_ext = array("mp4", "webm");

    if(in_array($file_ext,$photo_ext) || in_array($file_ext,$video_ext)) {
        if(in_array($file_ext,$photo_ext) && $file_size > 4194304){
            $errors[] = "Image size must be less than 4 MB.";
        } else if (in_array($file_ext,$video_ext) && $file_size > 20971520) {
            $errors[] = "Video size must be less than 20 MB.";
        }
    } else {
        $errors[] = "Extension not allowed.";
    }

    if(empty($errors)==true){
        $file_name = strtolower(md5(time().$_POST['user_id']) . "_" . $file_name);
        move_uploaded_file($file_tmp, dirname(__FILE__)."/../uploads/". $file_name);
    } else {
        http_response_code(400);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Meet</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container login" >
        <h1 style="font-size: 3em;">Stay Home, Stay Safe.</h1>
        <a href="index.php">&nbsp;&nbsp;Wanna go home now?</a>
    </div>
</body>
</html>