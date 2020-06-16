<?php

$page = "Home | Meet";

require("includes/header.php"); 

?>

<div class="container feed">
    <div id="sidebar">
        <?php include 'includes/newpost.snippet.php'; ?>
    </div>
    <div id="content">
        
    </script>

        <!--THIS IS WHERE THE FIRST ENTRY STARTS-->

        <?php
            get_all_friends_posts();
        ?>

        <div class="lds-facebook">
            <div></div><div></div><div></div>
        </div>

    </div>
</div>

<footer>
    <div></div>
</footer>

</body>
</html>