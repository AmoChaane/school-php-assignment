<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../styles/chat.css">
</head>
<body>
    <div class="menu">
        <a href="profile.php" class="back"><i class="fa fa-chevron-left"></i> <img src="../assets/images/face4.jpg" draggable="false"/></a>
        <div class="name">Alex</div>
    </div>
    <ol class="chat">
        <li class="other">
            <div class="avatar"><img src="../assets/images/face4.jpg" draggable="false"/></div>
            <div class="msg">
                <p>Hey!</p>
                <p>You heading out yet?</p>
                <time>20:17</time>
            </div>
        </li>
        <li class="self">
            <div class="avatar"><img src="https://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
            <div class="msg">
                <p>Yo...</p>
                <p>Nah not yet</p>
                <time>20:18</time>
            </div>
        </li>
        <li class="other">
            <div class="avatar"><img src="../assets/images/face4.jpg" draggable="false"/></div>
            <div class="msg">
                <p>You know we're late right?</p>
                <time>20:18</time>
            </div>
        </li>
        <li class="self">
            <div class="avatar"><img src="https://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
            <div class="msg">
                <p>Yeah no kidding</p>
                <time>20:18</time>
            </div>
        </li>
        <li class="other">
            <div class="avatar"><img src="../assets/images/face4.jpg" draggable="false"/></div>
            <div class="msg">
                <p></p>
                <p>So why do I feel like you're just chilling?</p>
                <time>20:18</time>
            </div>
        </li>
    </ol>
    <input class="textarea" type="text" placeholder="Type here!"/><div class="emojis"></div>
</body>
</html>