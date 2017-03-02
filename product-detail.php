<?php session_start();

if (isset($_GET['product_id'])) {
    
    try{
        //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";

        //Make a new connection object
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

            $selectProduct = strip_tags( trim($_GET['product_id']));

            $sql = "SELECT * FROM products LEFT JOIN reviews ON reviews.review_product=products.product_id WHERE products.product_id = '". $_GET['product_id']."'";
            $result = $conn->query($sql);
    }catch(PDOException $e){
            echo "Error: ". $e;
        }
}else{
    header("Location: /products.php");

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

    <title>Simple Panda - Locations</title>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
                <form action="/addItem.php" method="GET">
                <?php
                    $reviewCount = 0;
                    $count = 0;
                    $row_count = $result->rowCount();
                                        
                    foreach ($result as $row => $product) {
                       
                       if ($count == 0) {
                        echo "<div class='row'>";
                            echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                                echo"<h1>" . $product['product_name'] . "</h1>";
                            echo "</div>";
                        echo"</div>";

                        echo "<div class='row'>";
                            echo "<div class='col-lg-5 col-md-5 col-sm-12 col-xs-12'>";
                                echo "<img src='http://placehold.it/320x150' alt='" .  $product['product_name'] . "' class='img-responsive'>";
                            echo "</div>";

                            echo "<div class='col-lg-7 col-md-7 col-sm-12 col-xs-12'>";
                                echo "<div class='col-lg-7 col-md-7 col-sm-7 col-xs-6' style='color: #d17581;'>";
                                    if ($row_count > 1 && $product['review']) {
                                     
                                        echo "<p><span id='ratings'></span> <a href='#reviews' title='Read Reviews About " . $product['product_name'] . "'><br /> Read ". $row_count  ." reviews</a></p>";
                                    }
                                    elseif ($row_count <= 1 && $product['review']) {
                                        echo "<p> <span id='ratings'></span> <a href='#reviews' title='Read Reviews About " . $product['product_name'] . "'><br/> Read ". $row_count  ." review</a></p>";
                                    }
                                    else
                                    {
                                      echo "<p>There are no reviews.</p>";   
                                    }
                                echo "</div>";
                                    echo "<div class='col-lg-5 col-md-5 col-sm-5 col-xs-6'>";
                                    echo "<h4 class='pull-right'>$" . $product['product_price'] . "</h4>";
                                    echo "</div>";
                                    echo "<div class='clearfix'></div>";
                                    echo "<p>" . $product['product_description'] . "</p>";
                                    if ($product['size'] || $product['product_options'] && $product['product_stock'] != 0) {
                                    
                                    
                                     if ($product['size'] && $product['product_stock'] != 0) {
                                        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
                                            $size = explode(":",$product['size']);
                                            echo "<label for='size' style='margin-right:10px;'>Size:</label> <select name='product_size' id='size'>";
                                           
                                                foreach($size as $sizeOption => $sizes)
                                                {
                                                    echo "<option value='" . $sizes . "'>". $sizes ."</option>";
                                                }
                                            echo "</select>";
                                        echo "</div>";
                                     }else
                                     {
                                        echo "<input name='product_size' style='visibility:hidden;' value='none' />";
                                     }
                                     if ($product['product_options'] && $product['product_stock'] != 0) {
                                        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
                                            $option =explode(":",$product['product_options']);
                                            echo "<label for='options' style='margin-right:10px;'>Option:</label> <select name='product_options' id='options'>";
                                                foreach($option as $productOption => $options)
                                                {
                                                    echo "<option value='" . $options . "'>". $options ."</option>";
                                                }
                                            echo "</select>";
                                        echo "</div>";
                                     }
                                     else
                                     {
                                        echo "<input name='product_options' style='visibility:hidden;' value='none' />";
                                     }
                                    }
                                        echo "<input type='text' style='visibility:hidden;' name='product_id' value='" . $product['product_id']  . "' />";
                               

                                 echo "<div>";
                                     if ($product['product_stock'] != 0) {
                                        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
                                            echo "<label for='quantity'>Quantity</label><input type='text' name='product_quantity' style='width: 30px; margin-left: 15px;' value='1' />";
                                         echo "</div>";
                                        echo "<div class='col-lg-6 col-md-6 col-sm-6  col-xs-6 ratings'>";
                                            echo "<p><input type='submit' class='btn btn-primary' value='Add to Cart'  title='Add " . $product['product_name'] . " to my Cart'/></p>";
                                            echo "<p><a href='/accounts/add-wishlist.php?product_id="; 
                                            echo $product['product_id'];
                                            echo "' class='btn btn-primary' title='Add " . $product['product_name'] . " to my Wishlist'>Add to Wishlist</a></p>";
                                        echo "</div>";
                                     }
                                     else
                                     { 
                                        echo "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
                                            echo "Out of Stock";
                                        echo "</div>";
                                     }
                                echo "</div>";  
                            echo "</div>";
                        echo "</div>";
                    }
                        echo "<div  id='reviews'></div>";
                         if($product['review']){
                            if ($count == 0) {
                                echo "<div class='row'>";
                                    echo "<div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                                        echo "<h2 >ProductReviews</h2>";
                                        echo "<hr />";
                                     echo "</div>";    
                                echo "</div>";
                            }
                                
                                echo "<div class='row'>";
                                    echo "<div class=' col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                                        echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";
                                        echo "<p>" . $product['review_name'] . "</p>";
                                        echo "</div>";
                                        echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";
                                        for ($rateCount = 0; $rateCount <= 4; $rateCount++) {
                                            if ($rateCount < $product['review_rating']) {
                                                echo "<span class='glyphicon glyphicon-star'></span>";
                                            }
                                            else{
                                                // echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                            }                                        
                                        }
                                        echo "</div>";

                                        echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                                        echo "<p class='star-review' data-rating='".$product['review_rating']."'>" . $product['review'] . "</p>";

                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                if ($count != $row_count - 1) {
                                    echo "<hr />";
                                }
                            
                            
                         }
                    $count++; 
                    }

                ?>
                </form>

                <button onclick="window.history.go(-1)" class="btn btn-primary">Go Back</button>
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