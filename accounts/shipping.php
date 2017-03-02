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

        
        $shipping = "SELECT * FROM shipping WHERE shipping_username = '" . $_SESSION['screenname'] . "'";
        $result = $conn->query($shipping);
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

    <title>Simple Panda - Shipping</title>

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
                        if (isset($_SESSION['user'])) {                           
                            echo $_SESSION['user'];
                        }else{
                            echo "You're Not Logged In!";
                        }
                        ?></h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form method="POST" action="/accounts/update-shipping.php">
                            <?php
                            if (isset($_SESSION['user'])) {
                                $countCart = 0;
                                $countOrder = 0;
                                foreach ($result as $row => $shipping)
                                {   
                                   
                                        
                                        echo "<input type='hidden' id='shipping_id' name='shipping_id' value='" . $shipping['shipping_id'] . "' />";
                               
                                    echo "<div class='equal'>";
                                        echo "<label for='shipping_name'>shipping Name</label>";
                                        echo "<input type='text' id='shipping_name' name='shipping_name' value='" . $shipping['shipping_name'] . "' />";
                                    echo "</div>";
                                    echo "<div class='equal'>";
                                        echo "<label for='shipping_street'>shipping Street</label>";
                                        echo "<input type='text' id='shipping_street' name='shipping_street' value='" . $shipping['shipping_street'] . "' />";
                                    echo "</div>";
                                    echo "<div class='equal'>";
                                        echo "<label for='shipping_city'>shipping City</label>";
                                        echo "<input type='text' id='shipping_city' name='shipping_city' value='" . $shipping['shipping_city'] . "' />";
                                    echo "</div>";
                                    echo "<div class='equal'>";
                                        echo "<label for='shipping_state'>shipping State</label>";
                                        echo "<input type='text' id='shipping_state' name='shipping_state' value='" . $shipping['shipping_state'] . "' maxlength='2'/>";
                                    echo "</div>";
                                    echo "<div class='equal'>";
                                        echo "<label for='shipping_zip'>shipping Zip</label>";
                                        echo "<input type='text' id='shipping_zip' name='shipping_zip' value='" . $shipping['shipping_zip'] . "' maxlength='5'/>";
                                    echo "</div>";
                                   
                                    echo "<input type='hidden' id='shipping_username' name='shipping_username' value='" . $shipping['shipping_username'] . "'/>";
                                
                                }     
                            }else{
                                echo "<p>Please <a href='/accounts/login.php' title='Login'>Login</a> to update your shipping information</p>";
                            }                          
                            ?>
                            <div class='equal'>
                                
                                <input type='submit' id='submit' name='Update' value='Update' />
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
