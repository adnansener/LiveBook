<?php
    session_start();

    $host="localhost";
    $user="root";
    $password="";
    $vt="library";

    $connect = mysqli_connect($host, $user, $password, $vt);

    if (isset($_POST["register"])) {
        if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert('You entered an invalid e-mail.'); </script>";
        }
        else if ($_POST["user_password"] != $_POST["user_password_again"]) {
            echo "<script> alert('Passwords do not match.'); </script>";
        }
        else {
            $user_name = $_POST["user_name"];
            $user_mail = $_POST["user_mail"];
            $user_password = ($_POST["user_password"]);
            $user_password_again = $_POST["user_password_again"];

            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_mail'] = $user_mail;
            $_SESSION['user_password'] = $user_password;

            $sql="SELECT * FROM user_info WHERE user_mail='".$user_mail."' limit 1";
            $result=mysqli_query($connect,$sql);
            $row = mysqli_fetch_assoc($result);

            $count = mysqli_num_rows($result);

            if(!$count) {
                $add = "INSERT INTO user_info (user_name, user_mail, user_password) VALUES ('$user_name', '$user_mail', '$user_password')";
                $compile = mysqli_query($connect, $add);

                $_SESSION['user_id'] = $row['user_id'];

                mysqli_close($connect);

                header("Location: index.php");
                exit();
            }
            else {
                echo "<script> alert('This e-mail is already exists.'); </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Register
        </title>

        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <div class="left">
                <a href="index.php">
                    Login
                </a>
            </div>

            <div class="center">
                <h2>
                    Live Book
                </h2>
            </div>

            <div class="right">
                <a href="register.php">
                    Register
                </a>
            </div>
        </div>
        
        <div class="container">
            <form action="register.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="text" placeholder="User Name" name="user_name" id = "user_name" class="form-control"  required/>
                </div>

                <div class="input_field">
                    <input type="text" placeholder="Email" name="user_mail" id = "user_mail" class="form-control"  required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Password" name="user_password" id = "user_password" class="form-control"  required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Password Again" name="user_password_again" id = "user_password_again" class="form-control"  required/>
                </div>
                    
                <input type="submit" value="Register" class="form_button" name="register"/>
            </form>                    
        </div>

        <div class="footer">
            <div class="left name">
                <a href="aboutmewithoutlogin.php">
                    Mustafa Adnan ŞENER
                </a>
            </div>

            <div class="icons">
                <a href="https://www.github.com/adnansener">
                    <img src="myIcons/github.png" alt="Github" width="30" height="30">
                </a>

                <a href="https://www.linkedin.com/in/mustafa-adnan-şener-20755720b">
                    <img src="myIcons/linkedin.png" alt="LinkedIn" width="30" height="30">
                </a>

                <a href="https://www.instagram.com/adnansener_">
                    <img src="myIcons/instagram.png" alt="Instagram" width="30" height="30">
                </a>
            </div>
        </div>
    </body>
</html>