<?php
session_start();
if (isset($_SESSION['user'])) {
    //set up your information here
        $hostname = "localhost";
        $database = "shoppingcart";
        $username = "root";
        $password = "root";

        try{
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

            /* Order Query */
            $order = "SELECT * FROM orders WHERE username = '" . $_SESSION['screenname'] . "' ORDER BY orders.date DESC";
            $resultOrder = $conn->query($order);

            /* Cart Query */
            $cart = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.product_id WHERE cart.username = '" . $_SESSION['screenname'] . "'AND cart.order_id = '0'";
            $resultCart = $conn->query($cart);
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

    <title>Simple Panda - View All Orders</title>

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
                                $countCart = 0;
                            $countOrder = 0;
                            foreach ($resultOrder as $row => $orders)
                            {   
                                if( $countOrder == 0){
                                    echo "<h3>Orders</h3>";
                                        echo "<table style='width:100%;' id='orders'  class='display' cellspacing='0'>";
                                            echo "<thead><tr>";
                                                echo "<th>Date</th>";
                                                echo "<th>ID</th>";
                                                echo "<th>Total</th>";
                                                echo "<th>Status</th>";
                                            echo "</tr></thead>";
                                        $countOrder = 1;
                                
                                }
                                
                                echo "<tr class='";
                                if($orders['complete'] == 1)
                                {
                                    echo "complete";
                                }else
                                {
                                    echo "in-progress";
                                }
                                echo "'>";
                                        echo "<td>"; 
                                            $orderDate = strtotime($orders['date']);
                                            echo date('D M d', $orderDate);
                                           
                                        echo "</td>";
                                        echo "<td>" . $orders['order_id'] . "</td>";
                                        echo "<td>$" . $orders['total'] . "</td>";
                                        echo "<td>";
                                        
                                        if($orders['complete'] == 1)
                                        {
                                            echo "Fullfilled<br />";
                                        }else{
                                            echo "In Progress<br />";
                                        }
                                        echo "<a href=/accounts/orders.php?order_id='" . $orders['order_id'] . "'&username='" . $_SESSION['screenname'] . "' title='View " . $orders['product_name'] . "'>More Information</a>";
                                         echo "</td>";
                                        
                                    echo "</tr>";
                            }
                            echo "</table>";
                           
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
        "scrollX": true,
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