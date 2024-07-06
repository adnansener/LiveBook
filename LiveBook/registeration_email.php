<?php
    session_start();

    $host="localhost";
    $user="root";
    $password="";
    $vt="library";

    $connect = mysqli_connect($host, $user, $password, $vt);

    $id = $_SESSION['user_id'];

    if(isset($_POST['change'])){
        $new_value = $_POST["new_email"];
        $password = $_POST["user_password"];

        $sql="SELECT * FROM user_info WHERE user_id='".$id."'AND user_password='".$password."' limit 1";
        $result=mysqli_query($connect,$sql);

        if (!filter_var($_POST["new_email"], FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert('You entered an invalid e-mail.'); </script>";
        }
        else{
            if(mysqli_num_rows($result)===1){
                $row = mysqli_fetch_assoc($result);
    
                $old_value = $row['user_mail'];

                if($row['user_mail'] != $new_value){
                    $sql = "SELECT * FROM user_info WHERE user_mail='".$new_value."' limit 1";
                    $result = mysqli_query($connect,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $count = mysqli_num_rows($result);
    
                    if(!$count) {
                        $_SESSION['user_mail'] = $new_value;

                        $sql = "UPDATE user_info SET user_mail = '".$new_value."' WHERE user_id = $id";
                        mysqli_query($connect, $sql);

                        $sql = "UPDATE all_message SET user_mail = '".$new_value."' WHERE user_mail = '$old_value'";
                        mysqli_query($connect, $sql);

                        mysqli_close($connect);
                    }
                    else {
                        echo "<script> alert('This e-mail is already exists.'); </script>";
                    }
                }
                else{
                    ECHO '<script>alert("Your new e-mail cannot be the same as your old one.")</script>';
                }
            }
            else {
                ECHO '<script>alert("This password is incorrect.")</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Change E-mail
        </title>

        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <div class="left">
                <a href="myproducts.php">
                    My Products
                </a>
            </div>

            <div class="center">
                <a href="home.php">
                    <h2>
                        Live Book
                    </h2>
                </a>
            </div>

            <div class="right">
                <a href="settings.php">
                    Settings
                </a>
            </div>
        </div>

        <div class="container">
            <form action="registeration_email.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="text" placeholder="New E-mail" name="new_email" required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Confirm With Password" name="user_password" required/>
                </div>
                    
                <input type="submit" value="Change" class="form_button" name="change"/>
            </form> 
        </div>

        <div class="footer">
            <div class="left name">
                <a href="aboutmewithlogin.php">
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

            <div class="right contactus">
                <a href="contactus.php">
                    Contact Us
                </a>
            </div>
        </div>
    </body>
</html>