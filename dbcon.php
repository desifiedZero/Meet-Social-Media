<?php
    require 'config.php';

    function db_create_connection(){
        $conn = new mysqli(url, db_username, db_pass, db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }