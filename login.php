<?php
include 'connect.php';

$loginMessage = "";

if(isset($_POST['btnLogin'])){
    $uname = mysqli_real_escape_string($connection, $_POST['txtusername']);
    $pword = mysqli_real_escape_string($connection, $_POST['txtpassword']);

    $query = "SELECT * FROM tbluseraccount WHERE username = '$uname'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $dbHashedPassword = $row['password'];

        if($pword == $row['password']) {
            session_start();
            $_SESSION['username'] = $uname;
            $loginMessage = "Login successful.";
        } else if(password_verify($pword, $dbHashedPassword)){
            session_start();
            $_SESSION['username'] = $uname;
            $loginMessage = "Login successful.";
        } else {
            $loginMessage = "Invalid password.";
        }
    } else {
        $loginMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Curious KeyPie - Login</title>
    <style>
        .message-box {
            display: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #fff; 
            color: #000;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message-box.active {
            display: block;
        }

        .close-btn {
            float: right;
            margin-left: 10px;
            cursor: pointer;
            color: #000;
            background-color: #fff;
            font-size: 20px;
        }
    </style>
</head>
<body class="wow">

<header>
    <a href="" class="logo">
        <i class='bx bxs-site'></i>Curious KeyPie
    </a>

    <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
    </ul>

    <a href="login.php" class="btn"> Log In</a>
    <a href="register.php" class="btn"> Registration</a>
</header>

<div class="wow">
    <div class="container">
        <p class="form-title">LOG IN</p>

        <div class="message-box <?php echo ($loginMessage != "") ? 'active' : ''; ?>">
            <span class="close-btn" onclick="this.parentElement.classList.remove('active');">&times;</span>
            <?php echo $loginMessage; ?>
        </div>

        <form id="loginForm" action="login.php" method="post">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="txtusername" placeholder="Enter Username"/>
                </div>

                <div class="user-input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="txtpassword" placeholder="Enter Password"/>
                </div>
            </div>

            <div class="form-submit-btn">
                <input type="submit" name="btnLogin" value="Log In">
            </div>
        </form>
    </div>

    <footer>
        <div class="footer_content">
            <div class="fillers">
                <a href="#" class="footer-link">Zedric Marc D. Tabinas</a>
                <a href="#" class="footer-link">BSCS - 2</a>
            </div>
        </div>
    </footer>
</div>

<script>
    window.onload = function() {
        var messageBox = document.querySelector('.message-box');
        if (messageBox.classList.contains('active')) {
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 2000); 
        }
    };
</script>

</body>
</html>
