<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $vt = "library";

    $connect = mysqli_connect($host, $user, $password, $vt);
    mysqli_set_charset($connect,"UTF8");  

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['erase'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $process_id = $_POST['process_id'];
        
        $erase_sql = "DELETE FROM user_product WHERE process_id = $process_id";
        $erase_result = mysqli_query($connect, $erase_sql);
    }

    if(isset($_POST['submitButton'])) { 
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM `product`,`user_product` WHERE `product`.`product_id` = `user_product`.`product_id` AND `user_product_id` = '$user_id' "; 
        $getAll = mysqli_query($connect, $sql);

        $count = mysqli_num_rows($getAll);

        while ($count >= 1) {
            $sqlQuery = "SELECT * FROM `product`,`user_product` WHERE `product`.`product_id` = `user_product`.`product_id` AND `user_product_id` = '$user_id' ORDER BY purchase_date DESC LIMIT 1;"; 
            $getAll = mysqli_query($connect, $sqlQuery);
            $rowData = mysqli_fetch_assoc($getAll);

            $product_quantity = $rowData["product_quantity"] - 1;
            $product_id = $rowData["product_id"];
            $process_id = $rowData["process_id"];

            $update_quantity = "UPDATE product SET product_quantity ='$product_quantity' Where product_id = $product_id";
            mysqli_query($connect,$update_quantity);

            $date = date("Y/m/d");
            $insert_history = "INSERT INTO  buy_history(product_id, purchase_date) VALUES ('$product_id', '$date')";
            mysqli_query($connect,$insert_history);

            $erase_sql = "DELETE FROM user_product WHERE process_id = $process_id";
            $erase_result = mysqli_query($connect, $erase_sql);

            $count -=1;
        }
    } 
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | My Products
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

        <form action="myproducts.php" method="POST" class="form" role="form" name="form">
            <button class="buy_button" type="submit" name="submitButton">
                <b>
                    Buy
                </b>
            </button>
        </form>
        
        <div class="book_list">
            <?php
                $user_id = $_SESSION['user_id'];
                $bool = 1;

                $sql = "SELECT * FROM `product`,`user_product` WHERE `product`.`product_id` = `user_product`.`product_id` AND `user_product_id` = '$user_id' "; 
                $printAll = mysqli_query($connect, $sql);

                if(!$printAll) {
                    die(mysqli_error($connect));
                    $bool = 0;
                }

                $count = mysqli_num_rows($printAll);

                while ($count>= 1) {
                    $rowData = mysqli_fetch_assoc($printAll);
                    $photo=$rowData["product_photo"];    
            ?>
                        
            <div class="images">
                <img src="<?php echo $photo ;  ?>"alt="Kapak resmi"  height="350">
                
                <h1>
                    <?php
                        $purchase_date = date("d/m/Y", strtotime($rowData["purchase_date"]));
    
                        echo 'Name: '.$rowData["product_name"]. '<br>';
                        echo 'Author: '.$rowData["product_author"]. '<br>' ;
                        echo 'Date: '.$purchase_date.'<br>';
               
                    ?>
                </h1>   
                    
                <form method="POST" action="" class="per_img">
                    <input type="hidden" name="product_id" value="<?php echo $rowData["product_id"]; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $rowData["product_name"]; ?>">
                    <input type="hidden" name="process_id" value="<?php echo $rowData["process_id"]; ?>"><br>
                    <button class="cancel_button" type="submit" name="erase">
                        -
                    </button>
                </form>
            </div>    
        
            <?php
                $count -=1;
                }
            ?>
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