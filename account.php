<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: index.php");
    }
    $feedHTML = "";
    $errorMessage = "";
    $username = $_SESSION["username"];
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "Zwitter1";
    $conn = mysqli_connect($server, $user, $pass, $db);
    $selectquery = "SELECT * FROM users WHERE username='$username'";
    $squery = mysqli_query($conn,$selectquery);
    if (mysqli_num_rows($squery) > 0) {
        while($row = mysqli_fetch_assoc($squery)) {
            $email = $row["email"];
            $password = $row["password"];
        }
    }
    if (isset($_POST["changePassword"])) {
        $currentPassword = $_POST["currentPassword"];
        $newPassword1 = $_POST["newPassword1"];
        $newPassword2 = $_POST["newPassword2"];
        if ($currentPassword === $password) {
            if ($newPassword1 === $newPassword2) {
                if (strlen($newPassword1) >= 8 && strlen($newPassword1) <= 15) {
                    $updatequery = "UPDATE users SET password = '$newPassword1' WHERE username = '$username'";
                    $uquery = mysqli_query($conn,$updatequery);
                    $errorMessage = "Password successfully updated";
                } else {
                    $errorMessage = "Password should be 8-15 chars.";
                }
            } else {
                $errorMessage = "New passwords do not match";
            }
        } else {
            $errorMessage = "Your current password is incorrect.";
        }
    }
    if (isset($_POST["logOut"])) {
        unset($_SESSION["username"]);
        header("Location: index.php");
    }
    if (isset($_POST["delete1"])) {
        $postID = 1;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete2"])) {
        $postID = 2;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete3"])) {
        $postID = 3;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete4"])) {
        $postID = 4;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete5"])) {
        $postID = 5;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete6"])) {
        $postID = 6;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete7"])) {
        $postID = 7;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete8"])) {
        $postID = 8;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete9"])) {
        $postID = 9;
        $deletequery = "DELETE FROM posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    if (isset($_POST["delete10"])) {
        $postID = 10;
        $deletequery = "DELETE posts WHERE postID = '$postID'";
        $dquery = mysqli_query($conn,$deletequery);
    }
    $selectquery = "SELECT * FROM posts WHERE username = '$username' ORDER BY postID DESC";
    $squery = mysqli_query($conn,$selectquery);
    if ($squery->num_rows > 0) {
        $feedHTML = "<table class='feedTable'><tr class='feedTable'><th class='feedTable header-content'>My Posts</th></tr>";
        while ($row = $squery->fetch_assoc()) {
            if (!$row["photo"] && !$row["video"]) {
                $postContent = $row["text"] . "<br><br>Likes: " . $row["likes"];
            } elseif (!$row["video"]) {
                $postContent = "<img class='feedImage' src='posts/" . $row["photo"] . "'><br><br>Likes: " . $row["likes"];
            } else {
                $postContent = "<video class='feedVideo' controls><source src='posts/" . $row["video"] . "'></video><br><br>Likes: " . $row["likes"];
            }
            $nameID = "delete" . $row["postID"];
            $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable content'>" . $postContent . "<br><form id='deletePostForm' action='' method='POST'><input type='submit' value='Delete Post' name='" . $nameID . "' id='" . $nameID . "' class='deleteButton'></td></tr>";
            while ($row = $squery->fetch_assoc()) {
                if (!$row["photo"] && !$row["video"]) {
                    $postContent = $row["text"] . "<br><br>Likes: " . $row["likes"];
                } elseif (!$row["video"]) {
                    $postContent = "<img class='feedImage' src='posts/" . $row["photo"] . "'><br><br>Likes: " . $row["likes"];
                } else {
                    $postContent = "<video class='feedVideo' controls><source src='posts/" . $row["video"] . "'></video><br><br>Likes: " . $row["likes"];
                }
                $nameID = "delete" . $row["postID"];
                $feedHTML = $feedHTML . "<tr class='feedTable'><td class='feedTable content'>" . $postContent . "<br><input type='submit' value='Delete Post' name='" . $nameID . "' id='" . $nameID . "' class='deleteButton'></td></tr>";
            }
        }
        $feedHTML = $feedHTML . "</form></table>";
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="logos/logo-blue1.jpeg" type="image/png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>
            Acccount | Zwitter
        </title>
        <style>
        body {
                background-color: #99c2ff;
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            }
            a.nav-link {
                font-size: 25px;
                font-family: 'Roboto', sans-serif;
                margin: 10px;
            }
            table.feedTable {
                float: right;
                margin-top: 1%;
                margin-right: 30%;
            }
            #usernameInformation, #emailInformation {
                font-size: 25px;
            }
            #changePasswordHeader {
                font-size: 25px;
            }
            td, input {
                font-size: 20px;
            }
            td {
                padding: 5px;
            }
            #errorMessage {
                font-size: 15px;
            }
            #logOut {
                font-size: 30px;
                padding: 5px 20px;
            }
            img.pagelogos {
                margin-bottom: 0px;
            }
            td.textPost {
                padding-right: 20px;
            }
            td.imagePost {
                padding-left: 10px;
            }
            img.feedImage {
                width: 500px;
            }
            td.username {
                font-size: 20px;
                text-align: center;
            }
            th.FeedTable {
                font-size: 30px;
                border-bottom: 2px solid black;
            }
            table.FeedTable {
                margin-left: 10%;
            }
            td.content {
                padding: 10px;
                max-width: 520px;
                word-wrap: normal;
                font-size: 18px;
            }
            th.header-content {
                padding-left: 10px;
                padding-bottom: 5px;
            }
            input.deleteButton {
                width: 110px;
                margin-top: 6px;
                font-size: 18px;
            }
            video.feedVideo {
                width: 500px;
            }
            input.password {
                width: 200px;
            }
            div.mainBody {
                margin-left: 1%;
                margin-top: 1%;
                color:blue;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-heavy bg- #FFD700">
            <a class="navbar-brand" href="home.php">
            <body style="color: #ff6600;">
                <img src="logos/logo-blue1.jpeg" height="60" alt="ZwitterS" id="logo">
            </a>
            </nav>
        <script type="text/javascript">
            var el = document.getElementById('deletePostForm');
            el.addEventListener('submit', function(){
                return confirm('Are you sure you want to submit this form?');
            }, false);
        </script>
        <?php echo $feedHTML; ?>
        <div class="mainBody">
            <div id="usernameInformation">Account Username - <?php echo $_SESSION["username"]; ?></div><br>
            <div id="emailInformation">Email ID - <?php echo $email ?></div><br>
            <div>
                <span id="changePasswordHeader">Change Password</span>
                <form method="POST" action=""><table>
                    <tr>
                        <td class="formHeaders" align="left">Current Password</td></tr><tr><td><input type="password" class="password" name="currentPassword" id="currentPassword" required></td>
                    </tr><br>
                    <tr>
                        <td class="formHeaders" align="left">New Password</td></tr><tr><td><input type="password" class="password" name="newPassword1" id="newPassword1" required></td>
                    </tr>
                    <tr>
                        <td class="formHeaders" align="left">Confirm New Password</td></tr><tr><td><input type="password" class="password" name="newPassword2" id="newPassword2" required></td>
                    </tr>
                </table><br>
                <input type="submit" value="Change Password" name="changePassword" id="changePassword">
                <br><br><div id="errorMessage"><?php echo $errorMessage; ?></div>
                </form>
                <form method="POST" action="">
                    <input type="submit" value="Log Out" name="logOut" id="logOut">
                </form>
            </div>
        </div>
    </body>
</html>
