<?php session_start();
if(isset($_POST['submit'])){
    if (isset($_SESSION['user'])) {
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
        
           try{
                //set up your information here
                    $hostname = "localhost";
                    $database = "shoppingcart";
                    $username = "root";
                    $password = "root";
                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                if ($payment_id !='') {
                    $sql = "INSERT INTO `orders` (`billing_id`, `shipping_id`, `payment_id`, `username`, `total`, `complete`) VALUES ('" . $billing_id . "', '" . $shipping_id . "', '" . $payment_id . "', '" . $user . "', '" . $total . "', '0')";
                    
                         $result = $conn->exec( $sql );
                    $grabDate = "SELECT * FROM orders WHERE username = '". $_SESSION['screenname'] . "' ORDER BY order_id DESC LIMIT 1";
                    
                    $dates = $conn->query( $grabDate );  

                    /* GRAB LAST ENTRY FROM USER IN THE ORDERS TABLE AND PLACE ORDER_ID IN CART TABLE */
                    $order_id_new = 0;
                    $order_date = '';
                    foreach ($dates as $key => $value) {
                       $order_id_new = $value['order_id'];
                       $order_date = $value['date'];

                    }
                    $updateCart = "UPDATE cart SET order_id ='" . $order_id_new . "' WHERE username = '". $_SESSION['screenname'] . "' AND order_id = '0'";

                        $resultUpdateCart = $conn->exec( $updateCart );
                    
                    $orders = "SELECT * FROM cart INNER JOIN  products ON cart.product_id = products.product_id WHERE username = '". $_SESSION['screenname'] . "' AND order_id = '" . $order_id_new ."' ORDER BY order_id DESC";
                    
                    $order = $conn->query( $orders );

                    foreach ($order as $key => $value) {
                        $stock = $value['product_stock'] - $value['quantity'];

                        $stockUpdate = "UPDATE products SET product_stock = '" . $stock . "' WHERE product_id = '" . $value['product_id'] . "'";
                        $order = $conn->exec( $stockUpdate );
                    }
                        
                }else{
                    echo "We are sorry we couldn't place your order. We are sorry for this inconvenience.";
                }
            }catch(PDOException $e){
                echo "Error: ". $e;
            }   
    }else{
        header("Location: /accounts/login.php");
    }
}else{
    header("Location: /checkout/billing.php");
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

    <title>Simple Panda - Submit Order</title>

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
                include '../includes/sidenav.php';
            ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>Thank you for your Order!</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <p>You can check the status of your order in your accout under <a href='/accounts/current-orders.php' title='View Current Orders'>Current Orders</a>.</p>
                        <p>Your Package will arrive between
                        <?php 
                            
                            $threeDays = date( "M d Y", strtotime( "$order_date +3 day" ) );
                            $sevenDays = date( "M d Y", strtotime( "$order_date +7 day" ) );
                             echo $threeDays . " and " . $sevenDays . ".";
                        ?>
                        
                        </p>
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





