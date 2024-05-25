<?php
    session_start(); 
    $host="localhost";
    $user="root";
    $password="";
    $db="library";
    
    $link = mysqli_connect("localhost", "root", "", "library");
    
    if(isset($_POST['delete'])){
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
            $user_id = $row['user_id'];
            $user_mail = $row['user_mail'];

            if ($row['user_mail'] === $email && $row['user_password'] === $password){
                $erase_sql = "DELETE FROM user_info WHERE user_id = $user_id";
                $erase_result = mysqli_query($link, $erase_sql);

                $erase_sql = "DELETE FROM all_message WHERE user_mail = '$user_mail'";
                $erase_result = mysqli_query($link, $erase_sql);

                $erase_sql = "DELETE FROM user_product WHERE user_product_id = $user_id";
                $erase_result = mysqli_query($link, $erase_sql);

                $erase_sql = "DELETE FROM user_thoughts WHERE user_id = $user_id";
                $erase_result = mysqli_query($link, $erase_sql);

                header("Location: register.php");
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
            Live Book | Delete Account
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
            <form action="registeration_delete_account.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="text" placeholder="Confirm With Your E-mail" name="user_mail" required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Confirm With Your Password" name="user_password" required/>
                </div>
                    
                <input type="submit" value="Delete" class="form_button" name="delete"/>
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