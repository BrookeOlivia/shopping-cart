<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Contact Us</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
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
	include 'includes/navbar.php';
?>
  
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                include 'includes/sidenav.php';
            ?>

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1>Contact Us </h1>
                </div>
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="thumbnail">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3125.27587979553!2d-78.87194348501829!3d38.43509618166692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b492c210cfcb89%3A0x6f94c9e3f58c1de8!2sJames+Madison+University!5e0!3m2!1sen!2sus!4v1486860596728" width="847" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            
                        </div>

                        <div class="contact-info">
                            <h4><span class="glyphicon glyphicon-earphone"></span> <a href="#" title='Call 540) 999-9999'>(540) 999-9999</a></h4>
                            <h4><span class="glyphicon glyphicon-envelope"></span> <a href="#" title='Email example@example.com'>example@example.com</a></h4>
                        </div>
                    </div>

                    

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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
