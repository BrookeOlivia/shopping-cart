<?php 
session_start();
if(isset($_POST['submit'])){
   
        if (isset($_POST['user'])) {
            $user = strip_tags( trim($_POST['user']));  
        }
        if (isset($_POST['screenname'])) {
            $screenname = strip_tags( trim($_POST['screenname']));            
        }else{
            $screenname = '';
        }
        
        if (isset($_POST['user_email'])) {
            if ( preg_match( '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $_POST[ 'user_email' ] ) ){
                $user_email = strip_tags( trim($_POST['user_email']));
            }else{
                $user_email = '';
            }
        }else{
            $user_email = '';
        }
        if (isset($_POST['user_year'])) {
            $user_year = strip_tags( trim($_POST['user_year']));
        }else{
            $user_year = '';
        }
        if (isset($_POST['user_month'])) {
            $user_month = strip_tags( trim($_POST['user_month']));
        }else{
            $user_month = '';
        }
        if (isset($_POST['user_day'])) {
            $user_day = strip_tags( trim($_POST['user_day']));
        }else{
            $user_day = '';
        }
        $user_dob = $user_year . "-" . $user_month . "-" . $user_day; 
        if (isset($_POST['user_phone_number'])) {
            $user_phone_number = strip_tags( trim($_POST['user_phone_number']));
        }else{
            $user_phone_number = '';
        }
        if (isset($_POST['user_password'])) {
            $user_password = strip_tags( trim($_POST['user_password']));
        }else{
            $user_password = '';
        }
        
        try{
            //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";

            // Make connection to db
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
             $sql = "INSERT INTO `users` (`user`, `screenname`, `user_email`, `user_dob`, `user_phone_number`, `user_password`) VALUES ('" . $user . "', '" . $screenname . "', '" . $user_email . "', '" . $user_dob . "', '" . $user_phone_number . "','". md5($user_password) . "')";
               
                $result = $conn->exec( $sql );
             
                $_SESSION['user'] = $user;
                $_SESSION['screenname'] = $screenname;
        }catch(PDOException $e){
            echo "Error: ". $e;
        }                    
        
            header("Location: /checkout/new-billing-address.php");
            echo "Success!  Your Account has been created!";
        
}else{
    header("Location: /accounts/create-account.php");
}
?>