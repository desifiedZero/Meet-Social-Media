<?php

foreach ($post_data as $key => $post) {
                echo    '<div class="entry">
                            <div class="userinfo">
                                <div class="user zoomed">
                                    <a href="profile.php?id='.$_GET['id'].'"><img src="';
                                echo (($profile_data['avatar']) == "") ? "images/user.png" : $profile_data['avatar'];
                                echo '" alt="" class="user-img"></a>
                                </div>
                                <a href="profile.php?id='.$_GET['id'].'"><h2><span class="user-name">'. $user_fullname .'</span><span class="username">&nbsp;&nbsp;@'. $profile_data['username'] .'</span></h2></a>
                            </div>';
                                        
                    echo    '<div class="caption">
                                <h3>'.
                                $post['header']
                                .'</h3>
                                <p>'.
                                $post['content']
                                .'</p>
                            </div>';
                    if(!empty($post['media_url'])){
                        echo    '<div class="posted img">
                                    <img src="'.$post['media_url'].'" loading="lazy" alt="">
                                </div>';
                    }
                echo    '</div>';
            }