  <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="margin-top:20px;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-sm hidden-xs " href="/" title="Home" style='display:inline-block; height:auto'><img src="/images/logo.png" alt="Simple Panda Clothing Home" width="135px" /></a>
                <h1 style="margin-top:6px;"><a href="/" class="hidden-lg hidden-md visible-sm hidden-xs" style="color: #fff;margin-top:20px;" title='Home'>Simple Panda Clothing</a></h1>
                <h1><a href="/" class="hidden-lg hidden-md hidden-sm visible-xs" style="color: #fff;" title='Home'>Simple Panda Clothing</a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" style="text-align:right; background: #222">
                    <li>
                        <a href="/about.php">About</a>
                    </li>
                    <li>
                        <a href="/locations.php">Locations</a>
                    </li>
                    <li>
                        <a href="/products.php">Products</a>
                    </li>
                    <li>
                        <a href="/contact.php">Contact</a>
                    </li>
                    <?php 
                      if (isset($_SESSION['user'])) {
                        echo  "<li class='hidden-lg hidden-md hidden-sm'><a href='/accounts/index.php'>My Account</a></li>";
                        echo  "<li class='hidden-lg hidden-md hidden-sm'><a href='/accounts/logout.php'>Logout</a></li>";
                      }else{
                        echo  "<li><a href='accounts/login.php'>Login</a></li>";
                      }
                    ?>
                </ul>
                <div style="float:right;">
                <ul class='nav navbar-nav  hidden-xs'>
                    <?php
                        if (isset($_SESSION['user'])) {
                            echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#' style='float:left; padding-right:20px; color:#9d9d9d'>" .$_SESSION['user'] . "</a>";
                            echo "<ul  class='dropdown-menu'>";
                                echo "<li><a href='/accounts/index.php' class='list-group-item'>My Account</a></li>";
                                echo "<li><a href='/about.php' class='list-group-item'>About</a></li>";
                                echo "<li><a href='/locations.php' class='list-group-item'>Locations</a></li>";
                                echo "<li><a href='/products.php' class='list-group-item'>Products</a></li>";
                                echo "<li><a href='/contact.php' class='list-group-item'>Contact</a></li>";
                                echo "<li><a href='/accounts/logout.php' class='list-group-item'>Logout</a></li>";
                            echo "</ul></li>";
                        }else{
                            echo "<li class='dropdown'><a href='/accounts/login.php' style='float:left; padding-right:20px; color:#9d9d9d'>Login</a>";
                        }
                    ?>
                    <li><a href="/viewcart.php" style="color:#9d9d9d;">View Cart</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
