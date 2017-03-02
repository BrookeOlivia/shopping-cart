<?php
session_start();
if (isset($_SESSION['user'])) {

    //set up your information here
        $hostname = "localhost";
        $database = "shoppingcart";
        $username = "root";
        $password = "root";

        try{
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

            $sql = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.product_id WHERE cart.username = '". $_SESSION['screenname'] . "' AND cart.order_id = '0'";
            $result = $conn->query($sql);

        }catch(PDOException $e){
            echo "Error: ". $e;
        }
   
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

    <title>Simple Panda - View Cart</title>

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

                <div class="col-md-12">
                    <h1>View Cart</h1>
                </div>
                <div class="row">
                    <div class="hidden-lg hidden-md col-sm-3 col-xs-12"></div>
                <div class="col-lg-12 col-md-12 col-sm-9 col-xs-12"> 
                    <?php
                        if (isset($_SESSION['user'])) {
                    echo "<table style='width:100%;'>";
                        echo "<tr>";
                            echo "<th class='hidden-sm'></th>";
                            echo "<th>Product</th>";
                            
                            echo "<th>Quantity</th>";
                            echo "<th>Price</th>";
                            echo "<th>Update</th>";
                        echo "</tr>";

                            $subtotal = 0;
                            foreach ($result as $row => $product) { 
                                echo "<form action='/updateCart.php' method='POST'><tr>";
                                    echo "<td style='width:150px;' class='hidden-sm'>";
                                        echo "<div class='thumbnail'>";
                                            echo "<img src='http://placehold.it/150x128' alt='".$product['product_name']."' />";
                                        echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<p><a href='/product-detail.php?product_id=". $product['product_id'] . "' title='" . $product['product_name']. "'>" . $product['product_name'] . "</a></p>";
                                    echo "</td>";
                                  
                                    echo"<td>";
                                        echo "<p style='width: 95px;'>Quantity: <input type='text' name='product_quantity' value='" . $product['quantity'] . "' id='quantity' style='width:30px; text-align:center;' /></p>";
                                        if ($product['product_option']) 
                                        {
                                            echo"<p>Option: " . $product['product_option'] . "</p>";
                                        }
                                            echo "<p><input type='hidden' name='product_option' value='" . $product['product_option'] . "' id='options' /></p>";
                                        
                                        if ($product['product_size']) 
                                        {
                                            echo"<p>Size: " . $product['product_size'] . "</p>";
                                        }
                                            echo "<p><input type='hidden' name='product_size' value='" . $product['product_size'] . "' id='size' /></p>";
                                        
                                        echo"<input type='hidden' value='" .$product['product_id'] . "' name='product_id'/>";
                                        echo"<input type='hidden' value='" .$product['cart_id'] . "' name='cart_id'/>";
                                    echo "</td>";
                                    echo"<td>";
                                        echo "<p>$" . $product['product_price'] * $product['quantity'] . "</p>";   
                                        $subtotal += $product['product_price'] * $product['quantity'];
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<a href='/checkout/delete-product.php?product_id=".$product['product_id']. "&cart_id=" . $product['cart_id'] . "' title='" . $product['product_name'] . "'>";
                                            echo "<span class='glyphicon glyphicon-trash' style='margin-right:10px; padding:10px; border: none; background:none; float:left;'></span>";
                                        echo"</a>";
                                        echo "<a href=/updateCart.php?product_quantity=&product_id=".$product['product_id']. "&cart_id=" . $product['cart_id'] . "' title='" . $product['product_name'] . "'>";
                                            echo "<button type='submit'class='glyphicon glyphicon-refresh' style='padding:10px; border: none; background:none;'></button>";
                                        echo "</a>" ;
                                    echo"</td>";
                                echo "</tr></form>";

                                
                                   
                            }
                            $tax = round( $subtotal * .15, 2, PHP_ROUND_HALF_UP);
                            $shipping = round($tax * .05, 2, PHP_ROUND_HALF_UP) + 2.50;
                            $estimatedTotal = $tax + $shipping + $subtotal;
                            echo "<tr class='totals'>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th colspan='2'>Subtotal: </th>";
                                echo "<th>$" . $subtotal . "</th>";
                            echo "</tr>";
                            echo "<tr class='totals'>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th colspan='2'>Estimated Tax: </th>";
                                echo "<th>$" . $tax . "</th>";
                            echo "</tr>";
                            echo "<tr class='totals'>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th colspan='2'>Estimated Shipping: </th>";
                                echo "<th>";
                                    if ($subtotal < 50) {
                                        echo "$" .  $shipping;
                                    }
                                    else
                                    {
                                        echo "$0.00";
                                    }
                                echo "</th>";
                            echo "</tr>";
                            echo "<tr class='totals'>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th colspan='2'>Estimated Total:</th>";
                                echo "<th>$" . $estimatedTotal . "</th>";
                            echo "</tr>";
                            echo "<tr class='totals'>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th colspan='2'></th>";
                                echo "<th><a class='btn btn-primary' href='/checkout/billing.php?' style='margin-top:20px;'>Proceed to Checkout</a></th>";
                            echo "</tr>";
                        }else{
                            echo "Please <a href='/accounts/login.php' title='Login'>Login</a> to view your cart!";
                        }
                        ?>
                        

                    </table>
                    
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
