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

        if(password_verify($pword, $dbHashedPassword)){
            session_start();
            $_SESSION['username'] = $uname;
            $loginMessage = "Welcome, $uname! Login successful.";
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
    <link rel="stylesheet" href="css/indexstyle.css"/>
    <title>Curious KeyPie - Home</title>
    <style>
        .message-box {
            display: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #f00; 
            color: #fff; 
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
            color: #fff;
            background-color: #f00;
            font-size: 20px;
        }
    </style>
</head>
<body>

<header>
    <a href="" class="logo">
        <i class='bx bxs-site'></i>Curious KeyPie
    </a>

    <ul class="navbar">
        <li><a href="file:///C:/Users/L11Y14W25/Desktop/index.html" class="home-active">Home </a></li>
        <li><a href="http://127.0.0.1:5500/about.html">About Us</a></li>
        <li><a href="#contact">Contact Us </a></li>
    </ul>

    <a href="login.php" class="btn"> Log In</a>
    <a href="register.php" class="btn"> Registration</a>
</header>

<section class="about">
    <img src="ckp2.png" alt="Curious KeyPie Image">
</section>

<?php if($loginMessage != ""): ?>
<div class="message-box active">
    <span class="close-btn" onclick="this.parentElement.classList.remove('active');">&times;</span>
    <?php echo $loginMessage; ?>
</div>
<?php endif; ?>

<footer>
    <p> Felicity Orate <br> Zedric Marc Tabinas <br> BSCS - 2</p>
</footer>

</body>
</html>
