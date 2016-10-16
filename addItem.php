<?php session_start();
//set up your information here
        $hostname = "localhost";
        $database = "shoppingcart";
        $username = "root";
        $password = "root";

    //Make a new connection object
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

            $product_id = $_GET['product_id'];        
            $product_options = $_GET['product_options'];
            $product_size = $_GET['product_size'];
            $product_quantity = $_GET['product_quantity'];
            $username = 'bbailey';
            // echo $_SESSION['user'];
            
            $sql = "INSERT INTO `cart` (`quantity`, `product_id`, `product_options`, `product_size`, `cart_id`, `username`) VALUES ('" . $product_quantity . "', '" . $product_id . "', '" . $product_options . "', '" . $product_size . "', '', '" . $username . "')ON DUPLICATE UPDATE quantity ='" . $product_quantity . "', product_options = '" . $product_options . "' , product_size = '" . $product_size . "' WHERE username = '$username' AND product_id = '" . $product_id . "'";
            $result = $conn->exec( $sql );
           

           // Need to figure this update statement out.
            


            // $product_adjustment  =  "UPDATE products SET product_stock = product_stock - " . $product_quantity . " WHERE product_id = '". $product_id . "'"; 
            // $adjustment = $conn->exec( $product_adjustment );
           
       // header("Location: http://shoppingcart.dev/viewcart.php");
        // die();
        
        // echo "<p>Product ID: ". $product_id . "</p>";
        // echo "<p>Product Options: " . $product_options . "</p>";
        // echo "<p>Product Size: " . $product_size . "</p>";
        // echo "<p>Product Quanity: " . $product_quantity . "</p>";
        // echo "<p>Username: " . $username . "</p>";


?>