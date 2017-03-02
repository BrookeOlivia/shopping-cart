<?php session_start();
    if (isset($_SESSION['user'])) {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];  
        }else{
            
        }
        if (isset($_GET['product_option'])) {
            $product_option = $_GET['product_option'];            
        }else{
            $product_option = '';
        }
        
        if (isset($_GET['product_size'])) {
            $product_size = $_GET['product_size'];            
        }else{
            $product_size = '';
        }
        if (isset($_GET['product_quantity'])) {
            $product_quantity = $_GET['product_quantity'];
        }else{
            $product_quantity = '1';
        }
       try{
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";

            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            if ($product_id !='') {
                $sql = "INSERT INTO `cart` (`quantity`, `product_id`, `product_option`, `product_size`, `cart_id`, `username`) VALUES ('" . $product_quantity . "', '" . $product_id . "', '" . $product_option . "', '" . $product_size . "', '', '" . $_SESSION['screenname'] . "')";
                
                    $result = $conn->exec( $sql );
                     header("Location: http://shoppingcart.dev/viewcart.php");
               
            }else{
                echo "We are sorry we couldn't find your product. We are sorry for this inconvenience.";
            }
        }catch(PDOException $e){
            echo "Error: ". $e;
        }
    }else{
        header("Location: /accounts/login.php");
    }

?>