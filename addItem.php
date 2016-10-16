<?php session_start();

// Need addistion property for unique id for update.  Add all sql changes here



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
   
        // echo "<p>Product ID: ". $product_id . "</p>";
        // echo "<p>Product Options: " . $product_options . "</p>";
        // echo "<p>Product Size: " . $product_size . "</p>";
        // echo "<p>Product Quanity: " . $product_quantity . "</p>";
        // echo "<p>Username: " . $username . "</p>";


?>
