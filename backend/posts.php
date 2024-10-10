<?php
    include 'database_connection.php';

    $response = [
        "response" => "",
        "posts" => array()
    ];

    function getPosts() {
        $sql = "select u.Id as UserId, u.FirstName, u.LastName, p.Content, p.created_at from posts as p";
        $sql .= " join users as u";
        $sql .= " on p.UserId = u.Id";
        $sql .= " order by p.created_at desc;";

        return $sql;
    }

    $connection = connectToDatabase();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST["action"];
        if($action == 'CreatePost') { // api endpoint
            $myPost = $_POST["myPost"];
            $userId = $_POST["userId"];
            $date = date('Y-m-d H:i:s');

            $sql = "insert into posts (UserId, content, created_at) values ($userId, '$myPost', '$date');";


            if($connection->query($sql) === TRUE) {
                $response["response"] = 'successfully added post';
                
                $sql2 = getPosts();

                $result = $connection->query($sql2);

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
            else $response["response"] = $sql;
        }

    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if($_GET["action"] == 'GetPosts') { // api endpoint
            $response["response"] = 'successfully retrieved posts';
            $sql = getPosts();
            $result = $connection->query($sql);
            $myUserId = $_GET["myUserId"];

            if($result->num_rows > 0) {
                $data = array();
                // Loop through the results and add them to the array
                while ($row = $result->fetch_assoc()) {
                    $userId = $row["UserId"];
                    $firstName = $row["FirstName"];
                    $lastName = $row["LastName"];
                    $nameShortened = $firstName[0] . $lastName[0];
                    $content = $row["Content"];
                    $date = $row["created_at"];
                    $you = $myUserId == $userId ? '<span style="font-weight: 600;">(You)</span>' : '';

                    $htmlContent = <<<EOD
                    <div class="post">
                        <div class="image-container">
                            <div class="p">
                                $nameShortened
                            </div>
                        </div>
                        <div class="info">
                            <a href="profile.html?userId=$userId&name=$firstName" class="name">$firstName $lastName $you</a>
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
    }

    $connection->close();

    echo json_encode($response);
?>