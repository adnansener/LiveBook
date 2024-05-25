<?php
    session_start(); 
    $host="localhost";
    $user="root";
    $password="";
    $db="library";
    
    $link = mysqli_connect($host, $user, $password, $db);

    if (isset($_POST["message"])) {
        if(strlen($_POST["user_message"]) > 500){
            echo '<script>alert("Your message cannot be longer than 500 characters.");</script>';
        }
        else {
            $user_mail = $_SESSION['user_mail']; 
            $user_message = $_POST["user_message"];

            $add = "INSERT INTO all_message (user_mail, user_message) VALUES ('$user_mail', '$user_message')";
            mysqli_query($link, $add);
            mysqli_close($link);
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Contact Us
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
            <form action="contactus.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="text" placeholder="Message" name="user_message" required/>
                </div>
                    
                <input type="submit" value="Sent Message" class="form_button" name="message"/>
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