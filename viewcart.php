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
   
            $sql = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.product_id WHERE cart.username = 'bbailey'";


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

    <title>Company - View Cart</title>

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
                    <h1>View Cart</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12"> 
                    <table style="width:100%;">
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th style="width: 360px;">Description</th>
                            <th>Quantity</th><th>Price</th>
                            
                        </tr>
                        <?php
                            $subtotal = 0;
                            foreach ($result as $row => $product) {
                                
                                echo "<tr>";
                                    echo "<td style='width:150px;'>";
                                        echo "<div class='thumbnail'>";
                                            echo "<img src='http://placehold.it/150x128' alt='".$product['product_name']."' />";
                                        echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<p><a href='http://shoppingcart.dev/product-detail.php?product_id=". $product['product_id'] . "'>" . $product['product_name'] . "</a></p>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<p>" . $product['product_description'] . "</p>";
                                    echo "</td>";
                                    echo"<td>";
                                        echo "<p>" . $product['quantity'] . "</p>";
                                    echo "</td>";
                                    echo"<td>";
                                        echo "<p>$" . $product['product_price'] * $product['quantity'] . "</p>";   
                                        $subtotal += $product['product_price'] * $product['quantity'];
                                    echo "</td>";
                                    
                                echo "</tr>";

                                
                                   
                            }
                            $tax = round( $subtotal * .15, 2, PHP_ROUND_HALF_UP);
                            $shipping = round($tax * .05, 2, PHP_ROUND_HALF_UP) + 2.50;
                            $estimatedTotal = $tax + $shipping + $subtotal;
                            echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th style='text-align: right;' colspan='2'>Subtotal: </th>";
                                echo "<th  style='text-align: right;'>$" . $subtotal . "</th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th style='text-align: right;' colspan='2'>Estimated Tax: </th>";
                                echo "<th  style='text-align: right;'>$" . $tax . "</th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th style='text-align: right;'  colspan='2'>Estimated Shipping: </th>";
                                echo "<th  style='text-align: right;'>";
                                    if ($subtotal < 50) {
                                        echo "$" .  $shipping;
                                    }
                                    else
                                    {
                                        echo "$0.00";
                                    }
                                echo "</th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th style='text-align: right;' colspan='2'>Estimated Total:</th>";
                                echo "<th  style='text-align: right;'>$" . $estimatedTotal . "</th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<th style='text-align: right;' colspan='2'></th>";
                                echo "<th  style='text-align: right;'><a class='btn btn-primary' target='_blank' href='/addItem.php?product_id=&product_options=&product_size=&product_quantity=&username=' style='margin-top:20px;'>Proceed to Checkout</a></th>";
                            echo "</tr>";
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
