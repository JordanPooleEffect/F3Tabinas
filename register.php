<?php
include 'connect.php';

$registerMessage = "";

if(isset($_POST['btnRegister'])){      
    $fname = mysqli_real_escape_string($connection, $_POST['txtfirstname']);
    $lname = mysqli_real_escape_string($connection, $_POST['txtlastname']);
    $gender = mysqli_real_escape_string($connection, $_POST['txtgender']);
    $email = mysqli_real_escape_string($connection, $_POST['txtemail']);
    $uname = mysqli_real_escape_string($connection, $_POST['txtusername']);
    $pword = mysqli_real_escape_string($connection, $_POST['txtpassword']);
    $confirmpword = mysqli_real_escape_string($connection, $_POST['txtconfirmpassword']);

    $check_query = "SELECT * FROM tbluseraccount WHERE username = '$uname' OR emailadd = '$email'";
    $check_result = mysqli_query($connection, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        $registerMessage = "Username or email already exists. Please choose a different one.";
    } else {
        if ($pword != $confirmpword) {
            $registerMessage = "Passwords do not match.";
        } else {
            $hashedPassword = password_hash($pword, PASSWORD_DEFAULT);
              
            $sql1 = "INSERT INTO tbluserprofile(firstname, lastname, gender) VALUES ('$fname', '$lname', '$gender')";
            mysqli_query($connection, $sql1);
     
            $sql2 ="INSERT INTO tbluseraccount(emailadd, username, password) VALUES ('$email', '$uname', '$hashedPassword')";
            mysqli_query($connection, $sql2);
            
            $registerMessage = "Registration successful. You can now login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Curious KeyPie - Registration</title>
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
<body class="wow">
 
<header>
    <a href="" class="logo">
        <i class='bx bxs-site'></i>Curious KeyPie
    </a>
 
    <ul class="navbar">
        <li><a href="index.php" class="home-active">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
    </ul>
 
    <a href="login.php" class="btn"> Log In</a>
    <a href="register.php" class="btn"> Registration</a>
</header>
 
<div class="wow">
    <div class="container">
        <p class="form-title">REGISTRATION</p>

        <div class="message-box <?php echo ($registerMessage != "") ? 'active' : ''; ?>">
            <span class="close-btn" onclick="this.parentElement.classList.remove('active');">&times;</span>
            <?php echo $registerMessage; ?>
        </div>
        
        <form action="register.php" method="post">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="txtfirstname" placeholder="Enter First Name"/>
                </div>
 
                <div class="user-input-box">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="txtlastname" placeholder="Enter Last Name"/>
                </div>
 
                <div class="user-input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="txtusername" placeholder="Enter Username"/>
                </div>
 
                <div class="user-input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="txtemail" placeholder="Enter Email"/>
                </div>
 
                <div class="user-input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="txtpassword" placeholder="Enter Password"/>
                </div>
 
                <div class="user-input-box">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="txtconfirmpassword" placeholder="Confirm Password"/>
                </div>
            </div>
 
            <div class="gender-details-box">
                <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input type="radio" name="txtgender" id="male" value="Male">
                    <label for="male">Male</label>
                    <input type="radio" name="txtgender" id="female" value="Female">
                    <label for="female">Female</label>
                    <input type="radio" name="txtgender" id="other" value="Other">
                    <label for="other">Other</label>
                </div>
            </div>
 
            <div class="form-submit-btn">
                <input type="submit" name="btnRegister" value="Register">
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
 
</body>
</html>
