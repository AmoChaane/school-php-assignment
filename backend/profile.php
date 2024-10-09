<?php
    include 'database_connection.php';

    $connection = connectToDatabase();

    $response = [
        "response" => "",
        "posts" => array(),
        "profile" => array()
    ];

    function getProfile($userId) {
        $sql = "select * from users where Id = $userId;";
        return $sql;
    }

    function getPostsByUserId($userId) {
        $sql = "select u.FirstName, u.LastName, p.Content, p.created_at from posts as p";
        $sql .= " join users as u";
        $sql .= " on p.UserId = u.Id where u.Id = $userId";
        $sql .= " order by p.created_at desc;";

        return $sql;
    }
    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if($_GET["action"] == "GetPostsByUserId") {
            $userId = $_GET["userId"];
            $response["response"] = 'successfully retrieved posts';
            $sql = getPostsByUserId($userId);
            $result = $connection->query($sql);

            if($result->num_rows > 0) {
                $data = array();
                // Loop through the results and add them to the array
                while ($row = $result->fetch_assoc()) {
                    $firstName = $row["FirstName"];
                    $lastName = $row["LastName"];
                    $nameShortened = $firstName[0] . $lastName[0];
                    $content = $row["Content"];
                    $date = $row["created_at"];

                    $htmlContent = <<<EOD
                    <div class="post">
                        <div class="image-container">
                            <div class="p">
                                $nameShortened
                            </div>
                        </div>
                        <div class="info">
                            <a href="#" class="name">$firstName $lastName</a>
                            <p class="content">$content</p>
                            <p class="date dim-text">$date</p>
                        </div>
                    </div>
                    EOD;

                    $row["html"] = $htmlContent;
                    $data[] = $row;
                }

                $response["posts"] = $data;
            }
        }
        else if($_GET["action"] == "GetProfile") {
            $userId = $_GET["userId"];
            $sql = getProfile($userId);
            $result = $connection->query($sql);

            if($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $response["profile"] = $data;
            }
        }
    }

    
    $connection->close();

    echo json_encode($response);
?>