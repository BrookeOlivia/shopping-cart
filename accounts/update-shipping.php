<?php
session_start();
if(isset($_POST['submit'])){
	if (isset($_SESSION['user'])) {
		
		if(isset($_POST['shipping_id']))
		{
			$shipping_id = strip_tags( trim($_POST['shipping_id']));
		}else{

		}
		if(isset($_POST['shipping_name']))
		{
			$shipping_name = strip_tags( trim($_POST['shipping_name']));
		}else{
			$shipping_name = '';
		}
		if(isset($_POST['shipping_street']))
		{
			$shipping_street = strip_tags( trim($_POST['shipping_street']));
		}else{
			$shipping_street = '';
		}
		if(isset($_POST['shipping_city']))
		{
			$shipping_city = strip_tags( trim($_POST['shipping_city']));
		}else{
			$shipping_city = '';
		}
		if(isset($_POST['shipping_state']))
		{
			$shipping_state = strip_tags( trim($_POST['shipping_state']));
		}else{
			$shipping_state = '';
		}
		if(isset($_POST['shipping_zip']))
		{
			$shipping_zip = strip_tags( trim($_POST['shipping_zip']));
		}else{
			$shipping_zip = '';
		}

		try{
			//set up your information here
		        $hostname = "localhost";
		        $database = "shoppingcart";
		        $username = "root";
		        $password = "root";
			$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

	        
			$sql = "UPDATE shipping SET  shipping_name = '" . $shipping_name . "' , shipping_street = '" . $shipping_street . "' , shipping_city = '" . $shipping_city  . "' , shipping_state='" . $shipping_state . "' , shipping_zip='" . $shipping_zip . "' WHERE shipping_id = '" . $shipping_id . "' AND shipping_username ='" . $_SESSION['screenname'] .  "'";      
	           
	    	$result = $conn->exec( $sql );   
	    }catch(PDOException $e){
	        echo "Error: ". $e;
	    }
		header("Location: /accounts/index.php");
	}else{
		header("Location: /accounts/login.php");
	}
}else{
	header('Location: /accounts/shipping.php');
}
?>