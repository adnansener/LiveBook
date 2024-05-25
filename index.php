<?php
    session_start(); 
    $host="localhost";
    $user="root";
    $password="";
    $db="library";
    
    $link = mysqli_connect("localhost", "root", "", "library");
    
    if(isset($_POST['login'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $email= validate($_POST['user_mail']);
        $password= validate($_POST['user_password']);

        $sql="SELECT * FROM user_info WHERE user_mail='".$email."'AND user_password='".$password."' limit 1";
        $result=mysqli_query($link,$sql);

        if(mysqli_num_rows($result)===1){
            $row = mysqli_fetch_assoc($result);

            if ($row['user_mail'] === $email && $row['user_password'] === $password){

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_mail'] = $row['user_mail'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_password'] = $row['user_password'];

                header("Location: home.php");
                exit();
            }
        }
        else{
            echo "<script> alert('This e-mail or password is incorrect.'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Login
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
            <form action="index.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="text" placeholder="E-mail" name="user_mail" required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Password" name="user_password" required/>
                </div>
                    
                <input type="submit" value="Login" class="form_button" name="login"/>
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
