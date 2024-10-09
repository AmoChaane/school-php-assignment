<?php
    include 'database_connection.php';

    $response = [
        'response' => '',
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'userId' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $connection = connectToDatabase();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "select * from users as u where u.Email = '$email' and u.Password = '$password'";
        $result = $connection->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response['response'] = "successfully logged in";
            $response['firstName'] = $row['FirstName'];
            $response['lastName'] = $row['LastName'];
            $response['email'] = $row['Email'];
            $response['userId'] = $row['Id'];
        }
        else $response['response'] = "Invalid email or password";
        
        
        $connection->close();
    }

    echo json_encode($response);
?>