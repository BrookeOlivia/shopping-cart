<?php
session_start();
if(isset($_POST['submit'])){
    if (isset($_SESSION['user'])) {
        try{
            //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            if (isset($_SESSION['screenname'])) {
                $user = strip_tags( trim($_SESSION['screenname']));  
            }else{
                
            }
            if (isset($_POST['payment_id'])) {
                $payment_id = strip_tags( trim($_POST['payment_id']));  
            }else{
                
            }
            if (isset($_POST['shipping_id'])) {
                $shipping_id = strip_tags( trim($_POST['shipping_id']));            
            }else{
                $shipping_id = '';
            }
            
            if (isset($_POST['billing_id'])) {
                $billing_id = strip_tags( trim($_POST['billing_id']));            
            }else{
                $billing_id = '';
            }
            if (isset($_POST['total'])) {
                $total = strip_tags( trim($_POST['total']));
            }else{
                $total = '';
            }
            /* Order Query */
              $orders = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.product_id INNER JOIN billing ON cart.username=billing.billing_username INNER JOIN shipping ON cart.username = shipping.shipping_username INNER JOIN payment on cart.username = payment.payment_username WHERE cart.username = '" . $user ."' AND payment.payment_id = '" . $payment_id . "' AND shipping.shipping_id='" . $shipping_id . "' AND billing.billing_id = '" . $billing_id . "'";
            $resultOrder = $conn->query($orders);
            
        }catch(PDOException $e){
            echo "Error: ". $e;
        }
    }else{
        header("Location: /accounts/create-account.php");
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
                    <h1><?php echo $_SESSION['user'];?></h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      
                          <?php
                            if (isset($_SESSION['user'])) {
                                $countReview = 1;
                                $order_id = 0; 
                                echo "<h3>Order Review</h3>";
                                echo "<table style='width:100%;'>";
                                
                                 
                                
                                foreach ($resultOrder as $row => $review)
                                {   
                                    if ($countReview == 1) {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'><strong>Billing Information:</strong><br />";
                                                echo "<p>" . $review['billing_name'] . "</p>";
                                                 echo "<p>" . $review['billing_street'] . "<br />";
                                                  echo $review['billing_city'] . " " . $review['billing_state'] . ", " . $review['billing_zip'];
                                                echo "</div>";
                                            
                                           
                                              echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'><strong>Shipping Information:</strong><br />";
                                                echo "<p>" . $review['shipping_name'] . "</p>";
                                                 echo "<p>" . $review['shipping_street'] . "<br />";
                                                  echo $review['shipping_city'] . " " . $review['shipping_state'] . ", " . $review['shipping_zip'];
                                                echo "</div>";
                                            
                                            echo "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'><p><strong>Payment Information:</strong></p>";
                                                echo "<p><strong>Card Type:</strong> " . $review['payment_type'] . "<br /><strong>Card Number:</strong> ";
                                                 /*HIDE ALL NUMBERS BUT  THE LAST 4 DIGITS */
                                                $cardNumber = strlen($review['payment_card_number']);
                                                
                                                for ($i=0; $i < $cardNumber - 4; $i++) { 
                                                    echo "*";
                                                }
                                                echo substr($review['payment_card_number'], $cardNumber - 4);
                                                echo "</p></div>";
                                            echo "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<th>Products</th>";
                                    echo "</tr>";
                                        $countReview++;
                                    }
                                      echo "<tr>";
                                        echo "<td><div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>"; 
     
                                        echo "<p><a href='/product-detail.php?product_id=". $review['product_id'] . "''  title='View " . $product['product_name'] . "'>" . $review['product_name']. "</a></p> "; 
                                        if ($review['quantity'] != '') {
                                             echo "<p><strong>Price: </strong>" . $review['product_price'] . "<br /><strong>Qty:</strong> ". $review['quantity'] . "</p>";
                                        }
                                        echo "</div><div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>";
                                        if ($review['product_option'] != '') {
                                            echo "<p> <strong>Options:</strong> " .$review['product_option'] . "</p>";
                                        }
                                        if ($review['product_size']) {
                                            echo "<p><strong>Size:</strong> " .$review['product_size'] . "</p>";
                                        }
                                        echo "</div>";
                                         echo"</div></td>";
                                    echo "</tr>"; 
                                    
                                }
                                    echo "<tr>";
                                            echo "<td width='20%'><p><strong>Order Total:</strong> $" . $total . "</p></td>";
                                    echo "</tr>";
                            }
                           ?>
                        <table>
                        <form action='/checkout/order-submit.php' method="POST">
                            <?php
                                if (isset($_POST['payment_id'])) {
                                    echo "<input type='hidden' name='payment_id' value='" . $payment_id . "' />";
                                }
                                if (isset($_POST['shipping_id'])) {
                                    echo "<input type='hidden' name='shipping_id' value='" . $shipping_id . "' />"; 
                                }
                                
                                if (isset($_POST['billing_id'])) {
                                    echo "<input type='hidden' name='billing_id' value='" . $billing_id . "' />";          
                                }
                                if (isset($_POST['total'])) {
                                    echo "<input type='hidden' name='total' value='" . $total . "' />";
                                }
                            ?>
                            
                            <div class='equal'>
                            <a href='/checkout/payment.php' id='go-back' class="btn btn-primary" title="Go Back">Go Back</a>
                            <input type="submit" name="submit" value="Place Order" class="btn btn-primary" />
                        </div>
                        </form>
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
