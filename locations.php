<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Locations</title>

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
                    <h1>Find Us </h1>
                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="thumbnail">
                           
                            <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2934.010035616481!2d-89.9123210494584!3d35.06471798024621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x887f85c114cd9cfb%3A0x87e4746f2c9239a7!2s3082+Knight+Rd%2C+Memphis%2C+TN+38118!3m2!1d35.064718!2d-89.910127!5e1!3m2!1sen!2sus!4v1488390282845" height="300"  style="width:100%;"frameborder="0" style="border:0" allowfullscreen></iframe>
                            <div class="caption" style="height:auto;">
                                
                                <h4>King Knight Road</h4>
                                <p>34567 King Knight Road<br />
                                 Memphis, TN 38184
                                </p>
                            </div>
                            <div class="ratings">
                                <h5>Departments</h5>
                                <ul>
                                   <li>Mens</li> 
                                   <li>Womens</li>
                                   <li>Jewlery</li>
                                   <li>Cosmetics</li>
                                </ul>
                            </div> 
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d89847.1070466618!2d-78.947820234866!3d38.43876965173824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x89b492ddd6d840b1%3A0xe7c6c56a9230e289!2sMassanutten+Hall%2C+Harrisonburg%2C+VA!3m2!1d38.4387906!2d-78.87760829999999!5e1!3m2!1sen!2sus!4v1488390456019" style="width:100%;" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <div class="caption" style="height: auto;">
                               
                                <h4>Massanutten Hall</h4>
                                <p>Massanutten Hall, <br />Harrisonburg, VA 22801
                                </p>
                            </div>
                            <div class="ratings">
                                <h5>Departments</h5>
                                <ul>
                                   <li>Mens</li> 
                                   <li>Womens</li>
                                   <li>Jewlery</li>
                                   <li>Toys</li>
                                </ul>
                            </div>
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
