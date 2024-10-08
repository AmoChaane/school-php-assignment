<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    header('Location: /Nexus Social Network/frontend/pages/posts.php');
    
}

?>