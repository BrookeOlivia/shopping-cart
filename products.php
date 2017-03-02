<?php session_start(); ?>

<!DOCTYPE html>
<?php
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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Products</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/shop-homepage.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/js/custom.js"></script>

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
                <div class="row">
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="pull-left">Our Products</h1>
                        <div class="pull-right" style='padding-top: 32px;'>
                           <a href='/products.php'><span class='glyphicon glyphicon-th' style='margin-right:10px;'></span></a><a href='/product-list.php'><span class='glyphicon glyphicon-th-list'></span></a>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <?php
                        foreach ($result as $row => $product) {

                            echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
                                echo "<div class='thumbnail'>";
                                    echo "<img src='http://placehold.it/320x150' alt='" . $product['product_name'] . "'>";
                                    echo "<div class='caption'>";
                                        
                                        echo "<h4 style='white-space:pre-line'><a href='/product-detail.php?product_id=" . $product['product_id'] . "' title='" . $product['product_name'] . "'>" . $product['product_name'] . "</a></h4>";
                                        echo "<h4> $" . $product['product_price'] . "</h4>";
                                        echo "<p>" . $product['short_description'] . "</p>";
                                        
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
