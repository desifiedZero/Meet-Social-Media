<?php

include_once '../functions.php';

$file_name;

if(isset($_POST['body']) && $_POST['body'] != "") {
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
    
    try {
        $conn = db_create_connection();
    
        $header = mysqli_real_escape_string($conn, htmlspecialchars($_POST['header']));
        $body = mysqli_real_escape_string($conn, htmlspecialchars($_POST['body']));
    
        $file_path = isset($file_name) ? "uploads/" . $file_name : NULL;
    
        $header = isset($header) ? $header : NULL;
    
        $SESSION_ID = validate_session();
    
        $sql = "INSERT INTO `post` (`user`, `header`, `content`, `media_url`) 
                VALUES (?, ?, ?, ?)";
        $conn = db_create_connection($sql);
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_POST['user_id'], 
            $header,
            $body,
            mysqli_real_escape_string($conn, $file_path));
    
        $result = $stmt->execute();
        if ( $result ) {
            http_response_code(200);
        } else {
            http_response_code(400);
            if($stmt->error){
                echo("<br>".$stmt->error."<br>");
            }
        }
        $stmt->close();
        $conn->close();
        http_response_code(200);
        exit();
    } catch (\Throwable $e) {
        http_response_code(400);
        exit();
    }
}