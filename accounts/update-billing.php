<?php session_start();
if(isset($_POST['submit'])){
	if (isset($_SESSION['user'])) {
		if(isset($_POST['billing_id']))
		{
			$billing_id = strip_tags( trim($_POST['billing_id']));
		}else{

		}
		if(isset($_POST['billing_name']))
		{
			$billing_name = strip_tags( trim($_POST['billing_name']));
		}else{
			$billing_name = '';
		}
		if(isset($_POST['billing_street']))
		{
			$billing_street = strip_tags( trim($_POST['billing_street']));
		}else{
			$billing_street = '';
		}
		if(isset($_POST['billing_city']))
		{
			$billing_city = strip_tags( trim($_POST['billing_city']));
		}else{
			$billing_city = '';
		}
		if(isset($_POST['billing_state']))
		{
			$billing_state = strip_tags( trim($_POST['billing_state']));
		}else{
			$billing_state = '';
		}
		if(isset($_POST['billing_zip']))
		{
			$billing_zip = strip_tags( trim($_POST['billing_zip']));
		}else{
			$billing_zip = '';
		}

		try{
			//set up your information here
		        $hostname = "localhost";
		        $database = "shoppingcart";
		        $username = "root";
		        $password = "root";
			$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

	        
			$sql = "UPDATE billing SET  billing_name = '" . $billing_name . "' , billing_street = '" . $billing_street . "' , billing_city = '" . $billing_city  . "' , billing_state='" . $billing_state . "' , billing_zip='" . $billing_zip . "' WHERE billing_id = '" . $billing_id . "' AND billing_username ='" . $_SESSION['screenname'] .  "'";      
	            
	    	$result = $conn->exec( $sql );   
	    }catch(PDOException $e){
	        echo "Error: ". $e;
	    }

	    header("Location: /accounts/index.php");
	}else{
		header("Location: /accounts/login.php");
	}
}else{
	header("Location: /accounts/billing.php");
}
?>