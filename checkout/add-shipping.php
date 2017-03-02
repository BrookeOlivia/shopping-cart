<?php session_start();
if (isset($_POST['submit'])) {
    if (isset($_SESSION['user'])) {

    //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";

        //Make a new connection object
           try{
                $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                 if (isset($_SESSION['screenname'])) {
                    $shipping_username = strip_tags( trim($_SESSION['screenname']));  
                }else{
                    
                }
                if (isset($_POST['shipping_name'])) {
                    $shipping_name = strip_tags( trim($_POST['shipping_name']));            
                }else{
                    $shipping_name = '';
                }
                
                if (isset($_POST['shipping_street'])) {
                    $shipping_street = strip_tags( trim($_POST['shipping_street']));            
                }else{
                    $shipping_street = '';
                }
                if (isset($_POST['shipping_state'])) {
                    $shipping_state = strip_tags( trim($_POST['shipping_state']));
                }else{
                    $shipping_state = '';
                }
                if (isset($_POST['shipping_zip'])) {
                    $shipping_zip = strip_tags( trim($_POST['shipping_zip']));
                }else{
                    $shipping_zip = '';
                }
                if (isset($_POST['shipping_city'])) {
                    $shipping_city = strip_tags( trim($_POST['shipping_city']));
                }else{
                    $shipping_city = '';
                }
                
              
                    $sql = "INSERT INTO `shipping` (`shipping_username`, `shipping_name`, `shipping_street`, `shipping_state`, `shipping_zip`, `shipping_city`) VALUES ('" . $shipping_username . "', '" . $shipping_name . "', '" . $shipping_street . "', '" . $shipping_state . "', '" . $shipping_zip . "', '" . $shipping_city . "')";
                    
                    $result = $conn->exec( $sql );
                    if(isset($_GET['new']) == 0){
                        header("Location: /checkout/new-payment-method.php?new=0");
                    }else{
                        header("Location: /checkout/billing.php");
                    }
            }catch(PDOException $e){
                echo "Error: ". $e;
            }
    }else{
        header("Location: /accounts/login.php");
    }
}else{
        header("Location: /checkout/shipping.php");
    }
?>