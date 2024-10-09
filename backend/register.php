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

        try {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $emailDuplicateCheclSql = "select count(*) as count from users as u where u.Email = '$email';"; // this checks if the email already exists
            $duplicateCheckResult = $connection->query($emailDuplicateCheclSql);

            $sql = "insert into users(FirstName, LastName, Email, Password) values ('$firstName', '$lastName', '$email', '$password')";

            if($duplicateCheckResult->num_rows > 0) {
                $row = $duplicateCheckResult->fetch_assoc();
                $duplicateCheckResult = $row['count'];
            }

            if($duplicateCheckResult == 0) { // if the email doesn't exist
                if($connection->query($sql) === TRUE) {
                    $response['response'] = "Successfully created account";
                    $response['firstName'] = $firstName;
                    $response['lastName'] = $lastName;
                    $response['email'] = $email;

                    $sql2 = "select Id from users as u where u.Email = '$email';"; // we want the Id of the record we just created
                    $result = $connection->query($sql2);
                    if($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $response['userId'] = $row["Id"];
                    }
                }
                else $response = "Error occurred on the server";
            }
            else $response = "Email already exists";
        } catch (\Throwable $th) {
            $response = "Error occurred on the server";
            // $result = $th;
        }



        $connection->close();
    }

    echo json_encode($response);

?>