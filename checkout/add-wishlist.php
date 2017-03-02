<?php
session_start();
if (isset($_SESSION['user'])) {
	
		if(isset($_GET['product_id'])) {
        	$product_id = strip_tags( trim($_GET['product_id']));
        }else{
        	$product_id = '';
        }
        try{
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            
            //set up your information here
	        $hostname = "localhost";
	        $database = "shoppingcart";
	        $username = "root";
	        $password = "root";
			$sql = "INSERT INTO `wishlist` (`user`, `product_id`) VALUES ('" . $_SESSION['screenname'] . "', '" . $product_id . "')";
			                
			    $results = $conn->exec( $sql );

            /* Cart Query */
            $cart = "SELECT * FROM wishlist INNER JOIN products ON wishlist.product_id=products.product_id WHERE wishlist.user = '" . $_SESSION['screenname'] . "'";
            $result = $conn->query($cart);
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

    <title>Company - View Cart</title>

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
                    	
                        <?php
                     		$countCart = 0;
                     		$countOrder = 0;
                     		foreach ($result as $row => $wishlist)
                            {	
                            	if( $countOrder == 0){
                            		echo "<h3>Wishlist</h3>";
		                            	echo "<table style='width:100%;'>";
					                        echo "<tr>";
					                        	echo "<th colspan='3'>Products</th>";
					                        echo "</tr>";
		                    			$countOrder = 1;
                            	
			                    }
			                    echo "<tr><td colspan='2'><a href='/product-detail.php?product_id="; 
                                echo $wishlist['product_id'];
                                echo "' title='Add " . $product['product_name'] . " to my Wishlist'>" . $wishlist['product_name'] . "</a></td><td>$" . $wishlist['product_price'] . "</td></tr>";
			                    echo "<tr>";
			                            echo "<td><img src='http://placehold.it/150x128' alt='".$wishlist['product_name']."' /></td>";
			                            
			                            echo "<td colspan='2'>" . $wishlist['short_description'] . "</td>";
			                            
                                       			                            
										
			                       	echo "</tr>";
		                    }
		                    echo "</table>";
                           
                            
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
