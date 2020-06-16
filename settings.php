<?php

$page = "Settings | Meet";
require("includes/header.php"); 

?>

<div class="container settings">
    <div id="content">
        <div class="entry">
            <h1 id="title">Settings</h1>
            <div id="accordion">
                <h3 class="collapsible">Account Settings</h3>
                <div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Donec viverra magna quis lectus pharetra, quis mollis leo lobortis. 
                    Curabitur sit amet lorem a urna convallis fermentum.
                    </p>
                </div>
                <h3>Privacy Settings</h3>
                <div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Donec viverra magna quis lectus pharetra, quis mollis leo lobortis. 
                    Curabitur sit amet lorem a urna convallis fermentum.
                    </p>
                </div>
                <h3>FAQ</h3>
                <div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Donec viverra magna quis lectus pharetra, quis mollis leo lobortis. 
                    Curabitur sit amet lorem a urna convallis fermentum.
                    </p>
                </div>
                <h3>Still Need Help?</h3>
                <div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Donec viverra magna quis lectus pharetra, quis mollis leo lobortis. 
                    Curabitur sit amet lorem a urna convallis fermentum.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div></div>
</footer>
<script>
        $(function() {
            $("#accordion").accordion();
        });

        $(".collapsible").accordion("option", "collapsible", true);
    </script>

    <style>
        .ui-state-active {
            background: var(--theme-color);
            color: white !important;
        }
    </style>
</body>
</html>