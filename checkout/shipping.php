<?php
session_start();

    if (isset($_SESSION['user'])) {
        
    try{
        //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $sql = "SELECT * FROM shipping WHERE shipping_username = '" . $_SESSION['screenname'] . "'";

        $result = $conn->query($sql);
    }catch(PDOException $e){
        echo "Error: ". $e;
    }

}else{
    header("Location: /accounts/create-account.php");
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

    <title>Simple Panda - Checkout Shipping</title>

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
                    <h1>Check Out: Shipping Address</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <form action="/checkout/payment.php" method="POST">
                        <?php
                            if (isset($_POST['billing_id'])) {
                                $billing_id = $_POST['billing_id'];
                            }
                            if(isset($_POST['total'])){
                                $total = $_POST['total'];
                            }
                            if (isset($_SESSION['user'])) {
                                    $count = 1; 
                                    foreach ($result as $row => $shipping) {
                                        echo "<div class='shipping-address col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
                                            echo "<h4>" . $shipping['shipping_name'] . "</h4>";
                                            echo "<p>" . $shipping['shipping_street'] . "<br />";
                                            echo $shipping['shipping_city'] . ", " . $shipping['shipping_state'] . " " . $shipping['shipping_zip'] . "</p>";
                                          if($count == 1){
                                            echo "<label><input type='radio' value='" . $shipping['shipping_id'] . "' name='shipping_id' checked/> Select</label>";    
                                            $count++;
                                        }else{
                                            echo "<label><input type='radio' value='" . $shipping['shipping_id'] . "' name='shipping_id' /> Select</label>";
                                        }
                                        echo "</div>";
                                    }
                                    echo "<div class='shipping-address col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                                        echo "<p><a href='/checkout/new-shipping-address.php' title='Use Different Shipping Address'>Use Different shipping Address</a></p>";
                                        
                                        
                                    echo "</div>";
                                 
                            }
                                
                            ?> 
                            <input type='hidden' value='<?php echo $billing_id ?>' name='billing_id'/>
                            <input type='hidden' name='total' id='total' value='<?php echo $total ?>' />
                        <div class='equal'>
                            <a href='/checkout/billing.php' id='go-back' class="btn btn-primary" title='Go Back'>Go Back</a>
                            <input type='submit' id='submit' name='submit' class='btn btn-primary' value="Proceed to Payment" />
                        </div>
                    </form>
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
