<?php
    include 'database_connection.php';

    function search($data, $searchQuery) {
        $searchQuery = strtolower($searchQuery);
    
        $results = array_filter($data['results'], function($object) use ($searchQuery) {
            foreach ($object as $property => $value) {
                if (strpos(strtolower($value), $searchQuery) !== false) {
                    return true;
                }
            }
            return false;
        });
    
        return $results;
    }

    function getAllUsers() {
        $sql = "select * from users";
        return $sql;
    }

    $connection = connectToDatabase();
    $response = [
        "results" => array()
    ];

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if($_GET["action"] == 'Search') {
            $search_query = $_GET["search_query"];
            $sql = getAllUsers();

            $result = $connection->query($sql);

            if($result->num_rows > 0) {
                $data = array();

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                } 

                $response["results"] = $data;
                $results = search($response, $search_query);
                foreach ($results as $key => $user) {
                    $firstName = $user['FirstName'];
                    $lastName = $user['LastName'];
                    $email = $user['Email'];
                    $userId = $user['Id'];
                    $htmlContent = <<<EOD
                        <div class="result">
                            <p class="name">Name: $firstName $lastName</p>
                            <p class="email">Email: $email</p>
                            <a href="profile.html?userId=$userId&name=$firstName" class="view-profile">View Profile</a>
                        </div>
                        EOD;
                    $results[$key]['html'] = $htmlContent;
                }
                $response["results"] = $results;
            }

            
        }
    }

    $connection->close();

    echo json_encode($response);

?>