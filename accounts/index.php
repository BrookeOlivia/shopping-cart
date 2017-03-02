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

            /* Order Query */
            $order = "SELECT * FROM orders WHERE username = '" . $_SESSION['screenname'] . "' ORDER BY orders.order_id DESC LIMIT 6";
            $resultOrder = $conn->query($order);

            /* Cart Query */
            $cart = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.product_id WHERE cart.username = '" . $_SESSION['screenname'] . "'AND cart.order_id = '0'";
            $resultCart = $conn->query($cart);
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

    <title>Simple Panda - My Account</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/shop-homepage.css" rel="stylesheet">
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
	include '../includes/navbar.php';
?>
  
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                include '../includes/sidenav-accounts.php';
            ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1><?php 
                        if(isset($_SESSION['user'])){
                            echo $_SESSION['user'];
                        }else{
                            echo "Please Login";
                        }

                        ?></h1>
                </div>
                <div class="row"><?php
                   if(isset($_SESSION['user'])){  ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<p>Bacon ipsum dolor amet ham hock filet mignon short loin magna dolore picanha pork chop ea beef. Bacon boudin prosciutto elit, doner andouille sint ut tempor. Eu magna minim, in mollit swine turducken enim exercitation. Aute chuck ribeye consectetur jerky dolore sirloin officia id pariatur nisi. Short ribs eu in, sunt boudin tenderloin ham flank andouille prosciutto ground round dolore cupidatat pork loin nostrud. Spare ribs short ribs venison, nostrud turkey officia salami hamburger sausage anim. Exercitation landjaeger reprehenderit, cow excepteur porchetta fatback.
                        </p>
                        <?php
                     		$countCart = 0;
                     		$countOrder = 0;
                     		foreach ($resultOrder as $row => $orders)
                            {	
                            	if( $countOrder == 0){
                            		echo "<h3>Orders</h3>";
		                            	echo "<table style='width:100%;'>";
					                        echo "<tr>";
					                        	echo "<th>Order Date</th>";
					                            echo "<th>Order ID</th>";
					                            echo "<th>Total</th>";
					                            echo "<th>More Information</th>";
					                            echo "<th>Fullfilled</th>";
					                        echo "</tr>";
		                    			$countOrder = 1;
                            	
			                    }
			                    
			                    echo "<tr class='";
			                    if($orders['complete'] == 1)
	                            {
	                            	echo "complete";
								}else
								{
									echo "in-progress";
								}
			                    echo "'>";
			                            echo "<td>"; 
			                            	$orderDate = strtotime($orders['date']);
			                            	echo date('D M d', $orderDate);
                                           
			                            echo "</td>";
			                            echo "<td>" . $orders['order_id'] . "</td>";
			                            echo "<td>" . $orders['total'] . "</td>";
			                            echo "<td><a href=/accounts/orders.php?order_id='" . $orders['order_id'] . "'&username='" . $_SESSION['screenname'] . "' title='More Information About " . $orders['order_id'] . "'>More Information</a></td>";
			                            echo "<td>";
			                            if($orders['complete'] == 1)
			                            {
			                            	echo "Fullfilled";
										}else{
											echo "In Progress";
										}
			                             echo "</td>";
										
			                       	echo "</tr>";
		                    }
		                    echo "</table>";
                           
                            foreach ($resultCart as $row => $product)
                            {
                            	if ($countCart == 0) {
                            		echo "<h3>Current Cart Items</h3>";
		                            	echo "<table style='width:100%;'>";
					                        echo "<tr>";
					                            echo "<th class='hidden-sm'></th>";
					                            echo "<th>Product</th>";
					                            echo "<th>Quantity</th>";
					                            echo "<th>Price</th>";
					                            echo "<th>Update</th>";
					                        echo "</tr>";
		                    			$countCart = 1;
		                    	}
                                echo "<form action='/updateCart.php' method='POST'><tr>";
                                    echo "<td style='width:150px;' class='hidden-sm'>";
                                        echo "<div class='thumbnail'>";
                                            echo "<img src='http://placehold.it/150x128' alt='".$product['product_name']."' />";
                                        echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<p><a href='http://shoppingcart.dev/product-detail.php?product_id=". $product['product_id'] . "' title='View " . $product['product_name'] . "'>" . $product['product_name'] . "</a></p>";
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
                                        
                                    echo "</td>";
                                    echo "<td><a href='/checkout/delete-product.php?product_id=".$product['product_id']. "&cart_id=" . $product['cart_id'] . "&username=" .$product['username'] ."' title='Delete " . $product['product_name'] . "'><button class='glyphicon glyphicon-trash' style='margin-right:10px; padding:10px; border: none; background:none; float:left;'></a><button type='submit'class='glyphicon glyphicon-refresh' style='padding:10px; border: none; background:none;'></button></td>";
                                echo "</tr></form>";   
                            }	
                        }else{
                        	echo "<p>Please <a href='/accounts/login.php' title='Login'>Login</a> to see your account information</p>";
                        }

                        ?>
                        

                    </table>
                    </div>
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
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
