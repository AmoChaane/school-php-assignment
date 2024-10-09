<?php

    function connectToDatabase() {
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "@@AmoChaane200";
        $dbname = "social_network";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
?>