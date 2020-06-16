<?php

include('dbcon.php');

function generate_session_md5($user_id) {
    $SESSION_ID = md5(microtime().$_SERVER['REMOTE_ADDR'].$user_id);
    $conn = db_create_connection();
    $sql = "INSERT INTO `session` (`id`, `user`, `remote_ip`) 
            VALUES (?, ?, ?)";
    $conn = db_create_connection($sql);

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $SESSION_ID, $user_id, $_SERVER['REMOTE_ADDR']);

    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    if ( $result ) {
        return $SESSION_ID;
    } else {
        $_SESSION['login_error_msg'] = "Sorry, please try again in a few minutes.";
        header("Location: login.php");
    }
}

function validate_session() {
    if(isset($_SESSION['SESSION_ID']) && !empty($_SESSION['SESSION_ID']) ){
        #die($_SESSION['SESSION_ID']);
        $conn = db_create_connection();
    
        $sql = "SELECT `time` FROM `session` WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['SESSION_ID']);
        $stmt->execute();
        $stmt->bind_result($session_time);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if ( $session_time != NULL ) {
            if ( isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*60) ) {
                session_unset();
                session_destroy();
                session_start();
                unset($_SESSION['SESSION_ID']);
                return NULL;
            }
            $_SESSION['LAST_ACTIVITY'] = time();
            return $_SESSION['SESSION_ID'];
        } else {
            $_SESSION['login_error_msg'] = "Invalid Session.";
            return NULL;
        }
    } else {
        return NULL;
    }
}

function get_user_id() {
    if(isset($_SESSION['SESSION_ID']) && !empty($_SESSION['SESSION_ID']) ){
        $conn = db_create_connection();
    
        $sql = "SELECT `user` FROM `session` WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['SESSION_ID']);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if ( $user_id != NULL ) {
            return $user_id;
        } else {
            return NULL;
        }
    }
}

function get_user_info($id){
    $result;
    if(isset($_SESSION['SESSION_ID']) && !empty($_SESSION['SESSION_ID']) ){
        $conn = db_create_connection();

        $sql = "SELECT * FROM `user_info` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result(
            $id,
            $result['username'], 
            $result['fname'], 
            $result['lname'], 
            $result['avatar'], 
            $result['cover_image'], 
            $result['dob'], 
            $result['desc'],
            $result['loc']
        );
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if ( $result != NULL ) {
            return $result;
        } else {
            return 404;
        }
    } else {
        return 403;
    }
}

function get_user_posts($session_id, $user_id) {
    $result = [];
    if($session_id === validate_session()){
        $conn = db_create_connection();

        $sql = "SELECT * FROM `post` WHERE `user` = ? ORDER BY `id` DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result(
            $id, 
            $user, 
            $header, 
            $content, 
            $media_url, 
            $date
        );
        while($stmt->fetch()){
            array_push($result, [
                'id' => $id,
                'user' => $user,
                'header' => $header,
                'content' => $content,
                'media_url' => $media_url,
                'date' => $date
            ]);
        }
        $stmt->close();
        $conn->close();

        if ( $result != NULL ) {
            return $result;
        } else {
            return NULL;
        }
    } else {
        return NULL;
    }
}

function get_all_friends() {
    $result = [];
    if(validate_session()){
        $conn = db_create_connection();
        $sql = "SELECT `id`, `username`, `firstname`, `lastname`, `avatar` 
            FROM `all_friends` WHERE `own_id` = ? ORDER BY `firstname` ASC, `lastname` ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['USER_ID']);
        $stmt->execute();
        
        $stmt->bind_result(
            $id, 
            $username, 
            $fname, 
            $lname, 
            $avatar
        );
        while($stmt->fetch()){
            array_push($result, [
                'id' => $id,
                'username' => $username,
                'fname' => $fname,
                'lname' => $lname,
                'avatar' => $avatar
            ]);
        }
        $stmt->close();
        $conn->close();

        if ( $result != NULL ) {
            return $result;
        } else {
            return NULL;
        }
    } else {
        return NULL;
    }
}

function get_all_friends_posts() {
    if(validate_session()){
        $conn = db_create_connection();

        $sql = "SELECT `friend_id`, `friend_username`, `friend_firstname`, `friend_lastname`, `friend_avatar`, `header`, `content`, `media_url` 
                FROM `friend_posts` WHERE `own_id` = ? ORDER BY `id` DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['USER_ID']);
        $stmt->execute();
        $stmt->bind_result(
            $friend_id, 
            $friend_username, 
            $friend_firstname, 
            $friend_lastname, 
            $friend_avatar, 
            $header, 
            $content, 
            $media_url
        );
        
        while($stmt->fetch()){
            echo    '<div class="entry">
                        <div class="userinfo">
                            <div class="user zoomed">
                                <a href="profile.php?id='.$friend_id.'"><img src="';
                            echo ($friend_avatar == "") ? "images/user.png" : $friend_avatar;
                            echo '" alt="dp" class="user-img"></a>
                            </div>
                            <a href="profile.php?id='.$friend_id.'"><h2><span class="user-name">'. $friend_firstname." ". $friend_lastname .
                            '</span><span class="username">&nbsp;&nbsp;@'. $friend_username .'</span></h2></a>
                        </div>';
                                    
                echo    '<div class="caption">
                            <h3>'.
                            $header
                            .'</h3>
                            <p>'.
                            $content
                            .'</p>
                        </div>';
                if(!empty($media_url)){
                    echo    '<div class="posted img">
                                <img src="'.$media_url.'" loading="lazy" alt="">
                            </div>';
                }
            echo    '</div>';
        }
        $stmt->close();
        $conn->close();

    } else {
        return NULL;
    }
}

