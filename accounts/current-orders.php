<?php
session_start();
if (isset($_SESSION['user'])) {
    try{
        //set up your information here
            $hostname = "localhost";
            $database = "shoppingcart";
            $username = "root";
            $password = "root";

        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

        /* Order Query */
        $order = "SELECT * FROM cart INNER JOIN orders ON cart.order_id=orders.order_id INNER JOIN products ON cart.product_id = products.product_id WHERE orders.username = '" . $_SESSION['screenname']. "' AND complete = '0' ORDER BY orders.order_id ASC";
        $resultOrder = $conn->query($order);
        
    }catch(PDOException $e){
        echo "Error: ". $e;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Panda - Current Orders</title>

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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
</head>

<body>
<?php
    include '../includes/navbar.php';
?>
  
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                include '../includes/sidenav-accounts.php';
            ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1><?php 
                        if (isset($_SESSION['user'])) {                           
                            echo $_SESSION['user'];
                        }else{
                            echo "You're Not Logged In!";
                        }
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php 
                        if (isset($_SESSION['user'])) {
                          
                    ?>
                        <p>Bacon ipsum dolor amet ham hock filet mignon short loin magna dolore picanha pork chop ea beef. Bacon boudin prosciutto elit, doner andouille sint ut tempor. Eu magna minim, in mollit swine turducken enim exercitation. Aute chuck ribeye consectetur jerky dolore sirloin officia id pariatur nisi. Short ribs eu in, sunt boudin tenderloin ham flank andouille prosciutto ground round dolore cupidatat pork loin nostrud. Spare ribs short ribs venison, nostrud turkey officia salami hamburger sausage anim. Exercitation landjaeger reprehenderit, cow excepteur porchetta fatback.

</p>

                          <?php
                            if (isset($_SESSION['user'])) {

                            $countOrder = 0;
                            $order_id = 0; 
                            echo "<h3>Orders</h3>";
                            echo "<table style='width:100%;' id='orders' class='display' cellspacing='0'>";
                                            echo "<thead><tr>";
                                                echo "<th>Order Details</th>";
                                                echo "<th>Order Products</th>";
                                                // echo "<th>Total</th>";
                                                // echo "<th>More Information</th>";
                                            echo "</tr></thead>";
                            foreach ($resultOrder as $row => $orders)
                            {   
                                if ($order_id != $orders['order_id']) {
                                    echo "<tr>";
                                        echo "<td><p>Order ID: " . $orders['order_id'] . "<br />Total: $" . $orders['total'] . "<br />";
                                        
                                            $orderDate = strtotime($orders['date']);
                                            echo "Date: " . date('D M d', $orderDate);
                                        echo "</p></td>";
                                        echo "<td>";
                                        echo "<p class='divide'><a href='/product-detail.php?product_id=". $orders['product_id'] . "'title='View " . $orders['product_name'] . "'>" . $orders['product_name']. "</a>"; 
                                        if ($orders['quantity'] != '') {
                                             echo "<br /><strong>Qty:</strong> ". $orders['quantity'];
                                        }
                                        if ($orders['product_option'] != '') {
                                            echo "<br /> <strong>Options:</strong> " .$orders['product_option'];
                                        }
                                        if ($orders['product_size']) {
                                            echo "<br /><strong>Size:</strong> " .$orders['product_size'];
                                        }
                                        echo "</p>";
                                }elseif ($order_id != $orders['order_id']){
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td><p>Order ID: " . $orders['order_id'] . "<br />Total: $" . $orders['total'] . "<br />";
                                        
                                            $orderDate = strtotime($orders['date']);
                                            echo "Date: " . date('D M t', $orderDate);
                                        echo "</p></td>";
                                }elseif($order_id  == $orders['order_id']){
 
                                    echo "<p class='divide'><a href='/product-detail.php?product_id=". $orders['product_id'] . "'title='View " . $orders['product_name'] . "'>" . $orders['product_name']. "</a>"; 
                                    if ($orders['quantity'] != '') {
                                         echo "<br /><strong>Qty:</strong> ". $orders['quantity'];
                                    }
                                    if ($orders['product_option'] != '') {
                                        echo "<br /> <strong>Options:</strong> " .$orders['product_option'];
                                    }
                                    if ($orders['product_size']) {
                                        echo "<br /><strong>Size:</strong> " .$orders['product_size'];
                                    }
                                    echo "</p>";
                                }
                                   $order_id = $orders['order_id'];
                                }
                                echo"</td>";
                            }else{
                                header("Location: /accounts/login.php");
                            }
                           ?>

                        <table>
                        <?php
                            }else{
                                 echo "<p>Please <a href='/accounts/login.php' title='Login'>Login</a></p>";
                            }  
                        ?>
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
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
     <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

<script type="text/javascript">
        $(document).ready( function () {
             // Setup - add a text input to each footer cell
    $('#orders th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#orders').DataTable({
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        sorting: false
    });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
        } );

    </script>
</body>

</html>
