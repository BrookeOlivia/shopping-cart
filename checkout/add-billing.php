<?php session_start();
if(isset($_POST['submit'])){
    if (isset($_SESSION['user'])) {

       try{
            //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
             if (isset($_SESSION['screenname'])) {
                $billing_username = strip_tags( trim($_SESSION['screenname']));  
            }else{
                
            }
            if (isset($_POST['billing_name'])) {
                $billing_name = strip_tags( trim($_POST['billing_name']));            
            }else{
                $billing_name = '';
            }
            
            if (isset($_POST['billing_street'])) {
                $billing_street = strip_tags( trim($_POST['billing_street']));            
            }else{
                $billing_street = '';
            }
            if (isset($_POST['billing_state'])) {
                $billing_state = strip_tags( trim($_POST['billing_state']));
            }else{
                $billing_state = '';
            }
            if (isset($_POST['billing_zip'])) {
                $billing_zip = strip_tags( trim($_POST['billing_zip']));
            }else{
                $billing_zip = '';
            }
            if (isset($_POST['billing_city'])) {
                $billing_city = strip_tags( trim($_POST['billing_city']));
            }else{
                $billing_city = '';
            }
            
          
                $sql = "INSERT INTO `billing` (`billing_username`, `billing_name`, `billing_street`, `billing_state`, `billing_zip`, `billing_city`) VALUES ('" . $billing_username . "', '" . $billing_name . "', '" . $billing_street . "', '" . $billing_state . "', '" . $billing_zip . "', '" . $billing_city . "')";
                
                $result = $conn->exec( $sql );
                if(isset($_GET['new']) == 0){    
                    header("Location: /checkout/new-shipping-address.php?new=0");
                }else{
                    header("Location: /checkout/billing.php");
                }

        }catch(PDOException $e){
            echo "Error: ". $e;
        }
    }else{
        header("Location: /accounts/login.php");
    }
}
else{
    header("Location: /checkout/billing.php");
}
?>