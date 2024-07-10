<!DOCTYPE html>
<html>
<?php
include('session_admin.php');

?>

<title>Reports</title>

<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    Car Rental System </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
            if (isset($_SESSION['login_admin'])) {
                ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
                                <?php echo $_SESSION['login_admin']; ?>
                            </a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><span
                                            class="glyphicon glyphicon-user"></span> Control Panel <span
                                            class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="add_car.php"> Add Car </a></li>
                                        <li> <a href="delete_car.php"> Delete Car </a></li>
                                        <li> <a href="view_bookings.php"> View Bookings </a></li>
                                        <li> <a href="admin_search.php"> Search </a></li>
                                        <li> <a href="reports.php"> Reports </a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

                <?php
            } else if (isset($_SESSION['login_customer'])) {
                ?>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
                                <?php echo $_SESSION['login_customer']; ?>
                                </a>
                            </li>
                            <ul class="nav navbar-nav">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"> Menu <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="mybookings.php"> My Bookings</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <li>
                                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                            </li>
                        </ul>
                    </div>

                <?php
            } else {
                ?>

                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"> Login <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="admin_login.php"> Admin </a></li>
                                    <li> <a href="customer_login.php"> Customer</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
            <?php }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the selected option from the form
        $selectedOption = $_POST["options"];


        // Perform actions based on the selected option
        switch ($selectedOption) {
            case "report1":
                $today = date("Y-m-d")
                    // Code for handling Option 1
                    ?>
                <div class="container" style="margin-top: 65px;">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="form-area">
                        <form role="form" action="report1.php" method="POST">
                            <br style="clear: both">
                            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> All reservations within a
                                specific period </h3>
                            <br style="clear: both">
                            <label>
                                <h5>Start Date:</h5>
                            </label>
                            <input type="date" name="start_date" max="<?php echo ($today); ?>" required="">

                            &nbsp;
                            <label>
                                <h5>End Date:</h5>
                            </label>
                            <input type="date" name="end_date" max="<?php echo ($today); ?>" required="">
                            <br><br>
                            <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">GO</button>
                        </form>
                        </div>
                    </div>
                </div>

                <?php


                break;
            case "report2":
                // Code for handling Option 2
    
                $today = date("Y-m-d")

                    ?>
                <div class="container" style="margin-top: 65px;">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="form-area">
                            <br style="clear: both">
                            <form role="form" action="report2.php" method="POST">
                            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> All reservations of any car </h3>
                            <input type="text" class="form-control" id="car_plateID" name="car_plateID" placeholder="Plate ID"
                                required>
                            <label>
                                <br>
                                <label>
                                    <h5>Start Date:</h5>
                                </label>
                                <input type="date" name="start_date" max="<?php echo ($today); ?>" required="">

                                &nbsp;

                                <label>
                                    <h5>End Date:</h5>
                                </label>
                                <input type="date" name="end_date" max="<?php echo ($today); ?>" required="">
                                <br><br>
                                <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">GO</button>
            </form>
                        </div>
                    </div>
                </div>

                <?php
                break;
            case "report3":
                // Code for handling Option 3
    
                $today = date("Y-m-d")

                    ?>
                <div class="container" style="margin-top: 65px;">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="form-area">
                            <br style="clear: both">
                            <form role="form" action="report3.php" method="POST">
                            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> The status of all cars on a
                                specific day. </h3>
                            <label>
                                <h5>Pick a Day:</h5>
                            </label>
                            <input type="date" name="s_date" min="<?php echo ($today); ?>" required="">

                            <br><br>
                            <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">GO</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                break;
            case "report4":
                // Code for handling Option 4
                $today = date("Y-m-d")

                    ?>
                <div class="container" style="margin-top: 65px;">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="form-area">
                        <form role="form" action="report4.php" method="POST">
                            <br style="clear: both">
                            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> All reservations of a specific
                                customer </h3>
                            <input type="text" class="form-control" id="cust_ssn" name="cust_ssn" placeholder="Customer SSN"
                                required>
                            <br><br>
                            <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">GO</button>
                        </form>
                        </div>
                    </div>
                </div>

                <?php
                break;
            case "report5":
                // Code for handling Option 5
                $today = date("Y-m-d")
                    
                    ?>
                <div class="container" style="margin-top: 65px;">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="form-area">
                        <form role="form" action="report5.php" method="POST">
                            <br style="clear: both">
                            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;">Payments within specific period </h3>
                            <br style="clear: both">
                            <label>
                                <h5>Start Date:</h5>
                            </label>
                            <input type="date" name="start_date" max="<?php echo ($today); ?>" required="">

                            &nbsp;
                            <label>
                                <h5>End Date:</h5>
                            </label>
                            <input type="date" name="end_date" max="<?php echo ($today); ?>" required="">
                            <br><br>
                            <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">GO</button>
            </form>
                        </div>
                    </div>
                </div>

                <?php
                break;
            default:
                // Handle any other cases or provide a default action
                echo "Invalid option selected.";
                break;
        }
    } else {
        // Handle cases where the form is not submitted
        echo "Form not submitted.";
    }





    ?>




</body>

<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>©
                    <?php echo date("Y"); ?> Car Rental System
                </h5>
            </div>
        </div>
    </div>
</footer>

</html>