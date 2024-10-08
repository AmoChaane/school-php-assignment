<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="../styles/posts.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
</head>
<body>
    <div class="nav">
        <div class="div">
            <h1>Nexus</h1>
            <form class="search" style="display: flex; align-items: center; gap: 7px;">
                <input type="text" placeholder="Search for a user">
                <a href="search.php" class="material-symbols-outlined" style="color: white; cursor: pointer; text-decoration: none;">search</a>
            </form>
        </div>
        <a href="profile.php" class="profile">
            AC
        </a>
    </div>
    <main>
        <h1 class="welcome">Welcome, Amogelang Chaane</h1>
        <div class="main-inner">
            <form class="my-post">
                <div class="inner">
                    <div class="post-block">
                        <div class="profile" style="background: #F0F3F4">AC</div>
                        <textarea name="myPost" placeholder="What's on your mind, Amogelang?" rows="4" cols="4"></textarea>
                    </div>
                    <div class="post-button-container">
                        <button>Post</button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <!-- <h1>No Posts Yet :(</h1> -->
            <h1 class="posts-heading">Posts</h1>
            <div class="posts">
                <div class="post">
                    <div class="image-container">
                        <img src="../assets/images/face1.jpg" alt="" srcset="">
                    </div>
                    <div class="info">
                        <a href="#" class="name">Amogelang Chaane</a>
                        <p class="content"> Hello Everyone. I am new on Nexus. Happy to meet all of you.</p>
                        <p class="date dim-text">12 February 2024 at 16:12</p>
                    </div>
                </div>
                <div class="post">
                    <div class="image-container">
                        <img src="../assets/images/face2.jpg" alt="" srcset="">
                    </div>
                    <div class="info">
                        <a href="#" class="name">Mary Anne</a>
                        <p class="content"> Hello Everyone. I am new on Nexus. Happy to meet all of you.</p>
                        <p class="date dim-text">12 February 2024 at 16:12</p>
                    </div>
                </div>
                <div class="post">
                    <div class="image-container">
                        <img src="../assets/images/face3.jpg" alt="" srcset="">
                    </div>
                    <div class="info">
                        <a href="#" class="name">Mark Bel</a>
                        <p class="content"> Hello Everyone. I am new on Nexus. Happy to meet all of you.</p>
                        <p class="date dim-text">12 February 2024 at 16:12</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>