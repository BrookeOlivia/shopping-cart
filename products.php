<!DOCTYPE html>
<?php
//set up your information here
        $hostname = "localhost";
        $database = "shoppingcart";
        $username = "root";
        $password = "root";

    //Make a new connection object
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    //write a SQL query string
        

        $sql = "SELECT * FROM products";

    //run the query against the connected database, then...
    //store the result (all records matching the query)
        $result = $conn->query($sql);

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Company - Products</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
	include 'includes/navbar.php';
?>
  
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                include 'includes/sidenav.php';
            ?>

            <div class="col-md-9">

                <div class="col-md-12">
                    <h1>Our Products</h1>
                </div>
                <div class="row">
                    <?php
                        foreach ($result as $row => $product) {
                            echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
                                echo "<div class='thumbnail'>";
                                    echo "<img src='http://placehold.it/320x150' alt=''>";
                                    echo "<div class='caption'>";
                                        echo "<h4 class='pull-right'>" . $product['product_name'] . "</h4>";
                                        echo "<h4><a href='#'> $" . $product['product_price'] . "</a></h4>";
                                        echo "<p>" . $product['short_description'] . " <a target='_blank' href='http://www.bootsnipp.com'>More Details</p>";
                                    echo "</div>";
                                    echo "<div class='ratings'>";
                                        echo "<a class='btn btn-primary' target='_blank' href='/viewcart.php?" . $product['product_id'] . "'>Add to Cart</a>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
                
            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
