<?php
    session_start();

    $host="localhost";
    $user="root";
    $password="";
    $vt="library";

    $connect = mysqli_connect($host, $user, $password, $vt);

    $id = $_SESSION['user_id'];

    if(isset($_POST['change'])){
        $new_value = $_POST["new_password"];
        $new_value_again = $_POST["new_password_again"];
        $password = $_POST["user_password"];

        $sql = "SELECT * FROM user_info WHERE user_id='".$id."'AND user_password='".$password."' limit 1";
        $result = mysqli_query($connect,$sql);

        if(mysqli_num_rows($result)===1){
            $row = mysqli_fetch_assoc($result);
    
            if($password != $new_value){
                if($new_value_again == $new_value) {
                    $_SESSION['user_password'] = $new_value;

                    $sql = "UPDATE user_info SET user_password = '".$new_value."' WHERE user_id = $id";
                    mysqli_query($connect, $sql);
                    mysqli_close($connect);
                }
                else {
                    echo "<script> alert('Your new passwords do not match.'); </script>";
                }
            }
            else{
                ECHO '<script>alert("Your new password cannot be the same as your old one.")</script>';
            }
        }
        else {
            ECHO '<script>alert("Your old password is incorrect.")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Change Password
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
            <form action="registeration_password.php" method="post" class="form" role="form">
                <div class="input_field">
                    <input type="password" placeholder="New Password" name="new_password" required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="New Password Again" name="new_password_again" required/>
                </div>

                <div class="input_field">
                    <input type="password" placeholder="Confirm With Old Password" name="user_password" required/>
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