<?php

$page = "Friends | Meet";
require("includes/header.php"); 

?>

<h1 align="center">Friends</h1>
<div class="container friend-flow">
    <div id="content">

        <!--THIS IS WHERE THE FIRST ENTRY STARTS-->

        <?php
            $friends = get_all_friends();
            if($friends){
                foreach ($friends as $key => $friend) {
                ?>
                <div class="entry friend">
                    <div class="userinfo">
                        <a href="profile.php?id=<?php echo $friend['id'];?>">    
                            <div class="user zoomed">
                                <img src="<?php
                                echo (($friend['avatar']) == "") ? "images/user.png" : $friend['avatar'];
                                ?>" alt="" class="user-img">
                            </div>
                            <h2><span class="user-name"><?php echo $friend['fname'] . " " . $friend['lname']; ?></span></h2><span class="username">@<?php echo $friend['username']; ?></span>
                        </a>
                    </div>
                    <div class="feedback">
                        <div class="options">
                            <a href="profile.php?id=<?php echo $friend['id'];?>">View Profile<span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        ?>

    </div>
</div>

<footer>
    <div></div>
</footer>

</body>
</html>