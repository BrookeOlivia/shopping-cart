<?php
session_start();
if(isset($_SESSION['user'])){
    try{
        //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";

        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $sql = "SELECT * FROM payment WHERE payment_username = '" . $_SESSION['screenname'] . "'";
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

    <title>Simple Panda - Add New Payment Method</title>

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
                    <h1>Payment Address</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php 
                            if(isset($_SESSION['user'])){
                        ?>
                                <form method='POST' action='/checkout/add-card.php'>
                                    <div class='equal'>
                                        <input type="hidden" id="payment_username" name="payment_username" value="<?php echo $_SESSION['screenname']; ?>"/>
                                    </div>
                                    <div class=''>
                                        <label for="payment_type">Payment Type: </label>
                                        
                                        <p><label><input type='radio' name='payment_type' value='Visa' /> Visa</label></p>
                                        <p><label><input type='radio' name='payment_type' value='Discover' /> Discover</label></p>
                                        <p><label><input type='radio' name='payment_type' value='Master Card' /> Master Card</label></p>
                                        <p><label><input type='radio' name='payment_type' value='American Express' /> American Express</label></p>
                                    </div>
                                    <div class='equal'>
                                        <label for="payment_card_number">Card Number: </label>
                                        <input type="number" id="payment_card_number" name="payment_card_number" max='99999999999'/>
                                    </div>
                                    <div class='equal'>
                                        <label for="payment_pin">CVC: </label>
                                        <input type="number" id="payment_pin" name="payment_pin" max='999'/>
                                    </div>
                                    <?php 
                                        if(isset($_GET['new'])){
                                            echo "<input type='hidden' name='new' id='new' value='" . $_GET['new'] . "' />";
                                        }
                                    ?>
                                    <div class="equal">
                                        <input type="submit" name="submit" value='Submit' />
                                    </div>
                                </form>

                                <?php
                                    }else{
                                        echo "<p>Please <a href='/accounts/login.php/' title='Login'>login</a> or <a href='/accounts/create-account.php/' title='Create Account'>create</a> an account to continue shopping!</p>";
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
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
