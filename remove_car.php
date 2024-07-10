<html>

<head>
    <title> Car Rental System </title>
</head>
<?php session_start(); ?>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

<link rel="stylesheet" href="assets/w3css/w3.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>
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
                            <a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a>
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
                                            class="glyphicon glyphicon-align-justify"></span> Menu <span
                                            class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="add_car.php"> Add Car </a></li>
                                        <li> <a href="delete_car.php"> Delete Car </a></li>
                                        <li> <a href="pick_car_status.php"> Change Car Status</a></li>
                                        <li> <a href="view_bookings.php"> View Bookings </a></li>
                                        <li> <a href="view_customer.php"> View Customers </a></li>
                                        <li> <a href="admin_search.php"> Search </a></li>
                                        <li> <a href="reports_form.php"> Reports </a></li>

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
            } else {
                ?>

                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a>
                        </li>
                        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span>
                                Login <span class="caret"></span> </a>
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

    require 'connection.php';
    $conn = Connect();

    $car_plateID = $conn->real_escape_string($_POST['car_plateID']);

    $query1 = "SELECT car_id FROM car WHERE plate_id = '$car_plateID'";
    $result = $conn->query($query1);

    if ($result->num_rows == 0) {
        // Display error message if the car already exists
        ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                <h3>Car does not exist!</h3>
                <br><br>
                <a href="delete_car.php" class="btn btn-default"> Go Back </a>
            </div>
        </div>
        <?php
    } else {

        $query2 = "DELETE from car WHERE plate_id='$car_plateID'";
        $result2 = $conn->query($query2);

        if ($result2) {
            // Display success message
            ?>
            <div class="container">
                <div class="jumbotron" style="text-align: center;">
                    <h1>Car deleted!</h1>
                    <h2>
                        <?php echo "With Plate id: $car_plateID!" ?>
                    </h2>
                </div>
                <form action="index.php">
                    <input type="submit" value="RETURN HOME" class="btn btn-primary pull-right" />
                </form>
            </div>
            <?php
        } else {
            // Display error message for database insertion failure
            ?>
            <div class="container">
                <div class="jumbotron" style="text-align: center;">
                    <h3>Error deleting car.</h3>
                    <?php echo $conn->error; ?>
                    <br><br>
                    <a href="delete_car.php" class="btn btn-default"> Go Back </a>
                </div>
            </div>
            <?php
        }

    }

    $conn->close();

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