<?php
session_start();
    try{
        //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
    }catch(PDOException $e){
        echo "Error: ". $e;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
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

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                <div class="row carousel-holder">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="Slide 1">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="Slide 2">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="Slide 3">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <?php
                        foreach ($result as $row => $product) {
                            echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
                                echo "<div class='thumbnail'>";
                                    echo "<img src='http://placehold.it/320x150' alt='" . $product['product_name'] . "'>";
                                    echo "<div class='caption'>";
                                        
                                        echo "<h4 style='white-space:pre-line'><a href='/product-detail.php?product_id=" . $product['product_id'] . "' title='" . $product['product_name'] . "'>" . $product['product_name'] . "</a></h4>";
                                        echo "<h4> $" . $product['product_price'] . "</h4>";
                                        echo "<p>" . $product['short_description'] . " <a href='/product-detail.php?product_id=" . $product['product_id'] . "' title='More Details About " . $product['product_name'] . "'>More Details</p>";
                                    echo "</div>";
                                    echo "<div class='ratings'>";
                                        echo "<a class='pull-right btn btn-primary' href='/product-detail.php?product_id=" . $product['product_id'] . "' title='View " . $product['product_name'] . "'>View</a>"; 
                                        if ($product['product_stock'] != 0) {
                                            echo "<a class='btn btn-primary' href='/addItem.php?product_id=" . $product['product_id'] . "&product_quantity=1";
                                            if ($product['size']) {
                                                $size = explode(":",$product['size']);
                                                echo "&product_size=" . $size[0];
                                            }
                                            if ($product['product_options']) {
                                                $options = explode(":",$product['product_options']);
                                                echo "&product_options = " . $options[0];
                                            }
                                            echo "' title='Add " . $product['product_name'] . " to my Cart'>Add to Cart</a>";
                                        }
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
