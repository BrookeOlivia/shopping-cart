<?php session_start();
if(isset($_POST['submit'])){
    if (isset($_SESSION['user'])) {
        if (isset($_POST['payment_username'])) {
                $payment_username = strip_tags( trim($_POST['payment_username']));  
            }else{
                
            }
            if (isset($_POST['payment_type'])) {
                $payment_type = strip_tags( trim($_POST['payment_type']));            
            }else{
                $payment_type = '';
            }
            
            if (isset($_POST['payment_card_number'])) {
                $payment_card_number = strip_tags( trim($_POST['payment_card_number']));            
            }else{
                $payment_card_number = '';
            }
            if (isset($_POST['payment_pin'])) {
                $payment_pin = strip_tags( trim($_POST['payment_pin']));
            }else{
                $payment_pin = '';
            }
       try{
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";

            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $sql = "INSERT INTO `payment` (`payment_username`, `payment_type`, `payment_card_number`, `payment_pin`) VALUES ('" . $payment_username . "', '" . $payment_type . "', '" . $payment_card_number . "', '" . $payment_pin . "')";
            
            $result = $conn->exec( $sql );

            if(isset($_GET['new']) == 0 ){
                header("Location: /accounts/index.php");
            }else{
                header("Location: /checkout/payment.php");
            }
        }catch(PDOException $e){
            echo "Error: ". $e;
        }
    }else{
        header("Location: /accounts/login.php");
    }
}else{
    header("Location: /checkout/payment.php");
}
?>