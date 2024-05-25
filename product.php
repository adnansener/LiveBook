<?php
    session_start();

    $host="localhost";
    $user="root";
    $password="";
    $vt="library";

    $connect = mysqli_connect($host, $user, $password, $vt);
    mysqli_set_charset($connect,"UTF8"); 

    $id = $_SESSION['user_id'];
    $date = date("Y/m/d");

    if (isset($_GET['product_id'])) {
        $_SESSION['product_id'] = $_GET['product_id'];
    }
    $product_id = $_SESSION['product_id'];

    if(isset($_GET['include_spoiler'])) {
        $spoiler = '1';
    } else {
        $spoiler = '0';
    }

    if (isset($_GET['send_message'])) { 
        $query = "SELECT * FROM user_info where user_id = $id";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result);
        $userName = $row['user_name'];

        $user_thoughts = $_GET['user_thoughts'];

        $add = "INSERT INTO user_thoughts (user_name, user_id, product_id, user_message, spoiler) VALUES ('$userName', $id, '$product_id', '$user_thoughts', '$spoiler')";
        $compile = mysqli_query($connect, $add);
    }

    $photo = "SELECT product_photo FROM product where product_id= $product_id";
    $name = "SELECT product_name FROM product where product_id= $product_id";
    $author = "SELECT product_author FROM product where product_id= $product_id";

    $count = "SELECT COUNT(*) FROM user_product WHERE user_product_id = $id AND product_id= $product_id";
    $count_query = mysqli_query($connect,$count);
    $count_result = mysqli_fetch_array($count_query);
    $count = $count_result[0];

    $quantity = "SELECT product_quantity FROM product where product_id = $product_id ";
    $quantity_query=mysqli_query($connect,$quantity);
    $quantity_result = mysqli_fetch_array($quantity_query);
    $quantity = $quantity_result[0];

    $photo_query = mysqli_query($connect, $photo);
    $PhotoData = mysqli_fetch_assoc($photo_query);

    $name_query = mysqli_query($connect, $name);
    $NameData = mysqli_fetch_assoc($name_query);

    $author_query = mysqli_query($connect, $author);
    $AuthorData = mysqli_fetch_assoc($author_query);

    if (isset($_GET['submit'])){
        if($quantity > 0){
            if($count < 1){
                $add = "INSERT INTO `user_product` (`user_product_id`, `product_id`, `purchase_date`) VALUES ('$id', '$product_id','$date') ";
                mysqli_query($connect, $add);
    
                header("location:myproducts.php");
                mysqli_close($connect);
            }
            else {
                ECHO '<script>alert("You cant add same book.");</script>';
            }
        }
        else {
            ECHO '<script>alert("This book is out of stock.");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Product
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
            <img src="<?php echo $PhotoData["product_photo"]; ?>" alt="Kapak resmi" width="400" height="500">
       
            <div class="book_info">
                <h1>
                    <?php echo $NameData["product_name"]; ?>
                </h1>

                <h1>
                    <?php echo $AuthorData["product_author"]; ?> 
                </h1>
            </div>

            <div class="buy_1">
                <h1>
                    <?php 
                        $get = "SELECT product_quantity FROM `product` WHERE product_id = $product_id " ;
                    
                        $print = mysqli_query($connect, $get);   
                                        
                        if (mysqli_num_rows($print) === 1){
                            $rowData = mysqli_fetch_assoc($print);
                                            
                            if($rowData["product_quantity"]>=1){
                                echo $rowData["product_quantity"];
                            }  
                            else{
                                echo 'Out of Stock';
                            }
                        }
                    ?>
                    Book in Storage
                </h1>
            </div>

            <div class="buy_2">
                <form action="product.php" method="get" class="form" role="form" name="form">
                    <input type="hidden">
                    <button class="submit_button" type="submit" name="submit">
                        <b>
                            Buy
                        </b>
                    </button>
                </form>
            </div>

            <div class="buy_3">
                <h1>
                    <?php
                        $date = date("Y-m-d");
                        $get = "SELECT COUNT(*) FROM `buy_history` WHERE `product_id` = $product_id AND DATE(`purchase_date`) = '$date'";
                        $count = mysqli_query($connect, $get);
                        $count_result = mysqli_fetch_array($count);
                        $count = $count_result[0];

                        echo $count;
                    ?>
                    Books Were Sold <br>Today
                </h1>
            </div>

            <div class="buy_4">
                <form action="product.php" method="GET" class="thoughts">
                    <input type="text" class="user_thoughts" name="user_thoughts" id="user_thoughts" placeholder="Book Name" required>
                    <input type="checkbox" class="user_thoughts include_spoiler" name="include_spoiler" id="include_spoiler">
                    <h2>
                        Spoiler
                    </h2>

                    <input type="submit" name = "send_message" class="send_message" value="Send">
                </form>
            </div>

            <div class="buy_5">
                <?php
                    $sql = "SELECT * FROM user_thoughts WHERE product_id = $product_id ORDER BY message_id DESC";

                    $statement = mysqli_prepare($connect, $sql);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $any_spoiler = $row['spoiler'];

                        echo    '<div class="message_writer">
                                    <b>'
                                        .$row['user_name'].
                                    '</b>
                                </div>';

                        if($any_spoiler == '1') {
                            echo    '(Include Spoiler)

                                    <div class="message_border any_spoiler">'
                                        .$row['user_message'].
                                    '</div>';
                            
                        }
                        else {
                            echo    '<div class="message_border">'
                                        .$row['user_message'].
                                    '</div>';
                        }
                    }

                    mysqli_stmt_close($statement);
                    mysqli_close($connect);
                ?>
            </div>
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