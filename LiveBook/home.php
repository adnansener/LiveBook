<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $vt = "library";

    $connection = mysqli_connect($host, $user, $password, $vt);
    mysqli_set_charset($connection,"UTF8");
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">

        <title>
            Live Book | Home
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

        <div class="top">
            <h1>
                Welcome, <?php echo $_SESSION['user_name'];?>
            </h1>

            <form method="GET" class="inputs">
                <input type="text" name="bookName" placeholder="Book Name">
                <input type="text" name="authorName" placeholder="Author Name">

                <input type="submit" value="Search">
            </form>
        </div>

        <div class="book_list">
            <?php
                $sql = "SELECT * FROM product";
                if(isset($_GET['bookName']) || isset($_GET['authorName'])) {
                    $bookName = mysqli_real_escape_string($connection, $_GET['bookName']);
                    $authorName = mysqli_real_escape_string($connection, $_GET['authorName']);
                    $sql .= " WHERE product_name LIKE '%$bookName%'";
                    $sql .= " AND product_author LIKE '%$authorName%'";
                }
                $statement = mysqli_prepare($connection, $sql);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo    '<div class="urunkarti">
                                <a href="product.php?product_id='. $row['product_id'] .'">
                                    <img src="' . $row['product_photo'] . '" alt="product">
                                </a>
                            </div>';
                }

                mysqli_stmt_close($statement);
                mysqli_close($connection);
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