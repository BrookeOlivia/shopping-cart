<?php
// Start the session
session_start();
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['user'])) {
        	header("Location: /accounts/index.php");
        }else{
            try{
                //set up your information here
                $hostname = "localhost";
                $database = "shoppingcart";
                $username = "root";
                $password = "root";

            	$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    	      	$screenname = strip_tags( trim($_POST["screenname"]));
    	    	$userPassword = strip_tags( trim($_POST["user_password"]));
               

            	$sql = "SELECT * FROM users WHERE screenname = '" . $screenname . "' AND user_password = '" . md5($userPassword) . "'";
    		    $result = $conn->query($sql, PDO::FETCH_ASSOC);
            }catch(PDOException $e){
            	echo "Error: ". $e;
            }
                $dbP = '';
                $dbScreenname = '';
                $dbUser = '';
            foreach ($result as $row => $user) { 
                $dbP = $user['user_password'];
                $dbScreenname = $user['screenname'];
                $dbUser = $user['user'];
    		}
           if( md5 ($userPassword) === $dbP && $dbScreenname === $screenname){
                    $_SESSION['user'] = $dbUser;
                    $_SESSION['screenname'] = $dbScreenname;
                    header("Location: /accounts/index.php?new=0");
            }else{
                header("Location: /accounts/login.php?error=5");
            }
        }
    }else{
        header("Location: /accounts/login.php");
    }
?>