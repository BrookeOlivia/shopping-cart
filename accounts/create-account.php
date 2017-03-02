<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Create Account</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/shop-homepage.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
	include '../includes/navbar.php';
?>
  
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                include '../includes/sidenav.php';
            ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>Create Account</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                            if(!isset($_Session['user'])){
                                
                            
                        ?>
                                <form action="/accounts/add-account.php" class="create-account" method="POST">
                                    <div class='equal'>
                                        <label for="user">Name: </label>
                                        <input type="text" id="user" name="user" required/>
                                    </div>
                                     <div class='equal'>
                                        <label for="screenname">Screen Name: </label>
                                        <input type="text" id="screenname" name="screenname" required/>
                                    </div>
                                    <div class='equal'>
                                        <label for="user_email">Email Address: </label>
                                        <input type="text" id="user_email" name="user_email" required/>
                                    </div>
                                    <label for="user_dob">Birth Date: </label>
                                    <div class='equal'>
                                        <label for="user_dob">Birth Year: </label>
                                        <input type="text" id="user_dob" name="user_year" required/>
                                    </div>
                                    <div class='equal'>
                                        <label for="user_month">Birth Month: </label>
                                        <input type="text" id="user_month" name="user_month" required/>
                                    </div>
                                    <div class='equal'>
                                        <label for="user_day">Birth Day: </label>
                                        <input type="text" id="user_day" name="user_day" required/>
                                    </div>
                                    <div class='equal'>
                                        <label for="user_phone_number">Phone Number: </label>
                                        <input type="text" id="user_phone_number" name="user_phone_number" required/>
                                    </div>
                                    <div class='equal'>
                                        <label for="user_password">Password: </label>
                                        <input type="text" id="user_password" name="user_password" required/>
                                    </div>
                                    <div class='equal'>
                                        <button type="submit" name="submit">Submit</button>
                                    </div>
                                </form>

                                <?php
                                    }else{
                                        echo $_SESSION['user'] . ", you already have an account with us!";
                                    }
                                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
