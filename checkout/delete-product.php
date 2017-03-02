<?php session_start();

    if(isset($_SESSION['user'])){
        if (isset($_GET['product_id'])) {
            $product_id = strip_tags( trim($_GET['product_id']));  
        }else{
            $product_id="";
        }
        if (isset($_GET['cart_id'])) {
            $cart_id = strip_tags( trim($_GET['cart_id']));            
        }else{
            $cart_id = '';
        }
        $screenname = strip_tags( trim($_SESSION['screenname']));
        try {
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $sql = "DELETE FROM cart WHERE cart_id = '" . $cart_id  . "' AND product_id = '" . $product_id . "' AND username ='" . $screenname .  "'";      
            $result = $conn->exec( $sql );
            
        } catch (Exception $e) {
           echo "Sorry, we are experiencing some problems.  Please try again or contact customer service."; 
        }

        header('Location: /viewcart.php');
    }else{
        header("Location: /accounts/login.php");
    }

?>