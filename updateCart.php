<?php session_start();

    if (isset($_POST['product_id'])) {
        $product_id = strip_tags( trim($_POST['product_id']));  
    }
    if (isset($_POST['product_option'])) {
        $product_option = strip_tags( trim($_POST['product_option']));            
    }else{
        $product_option = '';
    }
    if (isset($_POST['cart_id'])) {
        $cart_id = strip_tags( trim($_POST['cart_id']));            
    }else{
        $cart_id = '';
    }
    if (isset($_POST['product_size'])) {
        $product_size = strip_tags( trim($_POST['product_size']));            
    }else{
        $product_size = '';
    }
    if (isset($_POST['product_quantity'])) {
        $product_quantity = strip_tags( trim($_POST['product_quantity']));
    }else{
        $product_quantity = '';
    }
    if (isset($_SESSION['user'])) {
        try{
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $sql = "UPDATE cart SET quantity = '" .  $product_quantity . "' , product_option = '" . $product_option . "' , product_size = '" . $product_size . "' WHERE product_id = '" . $product_id . "' AND username ='" . $_SESSION['screenname'] .  "' AND cart_id ='" . $cart_id .  "'";      
            
            $result = $conn->exec( $sql );
            header("Location: /viewcart.php");
        }catch(PDOException $e){
            echo "Error: ". $e;
        }            
    }else{
        header("Location: /accounts/create-account.php");
    }       
?>