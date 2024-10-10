<?php
    include 'database_connection.php';

    $connection = connectToDatabase();

    $response = [
        "response" => "",
        "messages" => array()
    ];

    function getMessages($myUserId, $otherUserId) { // specific to a chat
        return <<<EOD
            select m.* from messages as m 
            join users as u on m.SenderId = u.Id 
            where (m.SenderId = $myUserId or m.ReceiverId = $myUserId) and (m.SenderId = $otherUserId or m.ReceiverId = $otherUserId) 
            order by m.created_at asc;
        EOD;
    }

    function sendMessage($myUserId, $otherUserId, $message, $date) {
        return "insert into messages (Message, SenderId, ReceiverId, created_at) values ('$message', $myUserId, $otherUserId, '$date');";
    }

    function htmlContent($cssClass, $message, $date) {
        $htmlContent = <<<EOD
            <li class="$cssClass">
                <div class="avatar"><img src="../assets/images/face4.jpg" draggable="false"/></div>
                <div class="msg">
                    <p>$message</p>
                    <time>$date</time>
                </div>
            </li>
        EOD;

        return $htmlContent;
    }

    function getChatsHtmlContent($nameShortened, $otherUserFullName, $content,  $date, $otherUserId) {
        return <<<EOD
            <div class="message" onclick="openChat($otherUserId, '$otherUserFullName')">
                <div class="image-container">
                    <div class="p">
                        $nameShortened
                    </div>
                </div>
                <div class="info">
                    <p class="name">$otherUserFullName <span>( $date ) </span></p>
                    <p class="content">$content</p>
                </div>
            </div>
        EOD;
    }

    function getChats($myUserId) { // this also returns the last message between our user and the other users. Not specific to one chat
        return <<<EOD
            SELECT  
                sender.Id AS SenderUserId,
                receiver.Id AS ReceiverUserId,
                sender.FirstName AS SenderFirstName,
                sender.LastName AS SenderLastName,
                receiver.FirstName AS ReceiverFirstName,
                receiver.LastName AS ReceiverLastName,
                m.Message,
                m.created_at AS latest_message_time
            FROM messages m
            JOIN users sender ON m.SenderId = sender.Id
            JOIN users receiver ON m.ReceiverId = receiver.Id
            WHERE (m.SenderId = $myUserId OR m.ReceiverId = $myUserId)
            AND m.created_at = (
                SELECT MAX(m2.created_at)
                FROM messages m2
                WHERE LEAST(m.SenderId, m.ReceiverId) = LEAST(m2.SenderId, m2.ReceiverId)
                    AND GREATEST(m.SenderId, m.ReceiverId) = GREATEST(m2.SenderId, m2.ReceiverId)
            );
        EOD;
    }

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if($_GET["action"] == "GetMessages") {
            $myUserId = $_GET["myUserId"];
            $otherUserId = $_GET["otherUserId"];

            $sql = getMessages($myUserId, $otherUserId);

            $result = $connection->query($sql);

            if($result->num_rows > 0) {
                $data = array();
                while($row = $result->fetch_assoc()) {
                    $message = $row["Message"];
                    $date = $row["created_at"];
                    // $userId = $
                    $cssClass = $myUserId == $row["SenderId"] ? "self" : "other"; // other or self
                    $htmlContent = htmlContent($cssClass, $message, $date);

                    $row["html"] = $htmlContent;
                    $data[] = $row;
                }

                $response["messages"] = $data;
            }
        }
        else if($_GET["action"] == "GetChats") {
            $myUserId = $_GET["myUserId"];
            $sql = getChats($myUserId);

            $result = $connection->query($sql);

            if($result->num_rows > 0) {
                $data = array();
                while($row = $result->fetch_assoc()) { 
                    if($row["SenderUserId"] == $myUserId);
                    $otherUserFirstName = $row["SenderUserId"] == $myUserId ? $row["ReceiverFirstName"] : $row["SenderFirstName"];
                    $otherUserLastName = $row["SenderUserId"] == $myUserId ? $row["ReceiverLastName"] : $row["SenderLastName"];
                    $otherUserFullName = "$otherUserFirstName $otherUserLastName";
                    $nameShortened = $otherUserFirstName[0] . $otherUserLastName[0];
                    $date = $row["latest_message_time"];
                    $message = $row["Message"];
                    $otherUserId = $row["SenderUserId"] == $myUserId ? $row["ReceiverUserId"] : $row["SenderUserId"];

                    $htmlContent = getChatsHtmlContent($nameShortened, $otherUserFullName, $message, $date, $otherUserId);
                    $row["html"] = $htmlContent;
                    $data[] = $row;
                }
                $response["messages"] = $data;
                $response["response"] = "successfully retrieved chats";
            } else {
                $response["response"] = "No Chats Found";
            }
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["action"] == "SendMessage") {
            $myUserId = $_POST["myUserId"];
            $otherUserId = $_POST["otherUserId"];
            $message = $_POST["message"];
            $date = date('Y-m-d H:i:s');

            $sql = sendMessage($myUserId, $otherUserId, $message, $date);

            
            if($connection->query($sql) === TRUE) {
                $response["response"] = "successfully sent message";
                $sql2 = getMessages($myUserId, $otherUserId);

                $result = $connection->query($sql2);

                if($result->num_rows > 0) {
                    $data = array();
                    while($row = $result->fetch_assoc()) {
                        $message = $row["Message"];
                        $date = $row["created_at"];
                        // $userId = $
                        $cssClass = $myUserId == $row["SenderId"] ? "self" : "other"; // other or self
                        $htmlContent = htmlContent($cssClass, $message, $date);

                        $row["html"] = $htmlContent;
                        $data[] = $row;
                    }

                    $response["messages"] = $data;
                }

            }
            else $response["response"] = $connection->error;
        }
    }

    $connection->close();

    echo json_encode($response);

?>