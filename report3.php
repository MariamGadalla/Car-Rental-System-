<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
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


    $date = $_POST['s_date'];

    // Change the car status of the cars that would be available then
    $q1 = "UPDATE car SET car_status = 'Available' WHERE car_status = 'Rented' AND car_id NOT IN (SELECT car_id FROM reservation WHERE ? BETWEEN rent_start_date AND rent_end_date)";

    $update1 = $conn->prepare($q1);
    $update1->bind_param("s", $date);
    $update1->execute();
    $update1->close();

    // Change the car status of the cars that would be rented then
    $q2 = "UPDATE car SET car_status = 'Rented' WHERE car_status = 'Available' AND car_id IN (SELECT car_id FROM reservation WHERE ? BETWEEN rent_start_date AND rent_end_date)";

    $update2 = $conn->prepare($q2);
    $update2->bind_param("s", $date);
    $update2->execute();
    $update2->close();




    // $query0 = "SELECT c.car_model, c.car_id , c.car_status, c.plate_id FROM car c JOIN reservation r ON c.car_id = r.car_id
    // WHERE r.rent_start_date <= '$start_date' AND r.rent_end_date >= '$start_date'";
    
    $query0 = "SELECT * FROM car";

    $result0 = $conn->query($query0);

    if (mysqli_num_rows($result0) > 0) {
        ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Report Results:</h1>
                <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <h2>Cars</h2>
                            <tr>

                                <th width="10%">Car ID</th>
                                <th width="15%">Car Model</th>
                                <th width="10%">Year</th>
                                <th width="10%">Car Category</th>
                                <th width="10%">Car Colour</th>
                                <th width="10%">Plate ID</th>
                                <th width="10%">Price Per Day</th>
                                <th width="15%">Car Status</th>
                                <th width="10%">Office ID</th>

                            </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($result0)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row["car_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["car_model"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["year"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["car_category"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["car_colour"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["plate_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["price_per_day"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["car_status"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["car_office_id"]; ?>
                                </td>
                            </tr>
                        <?php }

    }

    $today = date("Y-m-d");
    //Reverse the changes made
    $q1_reverse = "UPDATE car SET car_status='Rented' WHERE car_status='Available' AND car_id IN (SELECT car_id FROM reservation WHERE ? BETWEEN rent_start_date AND rent_end_date)";
    $reverse1 = $conn->prepare($q1_reverse);
    $reverse1->bind_param("s", $today);
    $reverse1->execute();
    $reverse1->close();

    $q2_reverse = "UPDATE car SET car_status='Available' WHERE car_status='Rented' AND car_id NOT IN (SELECT car_id FROM reservation WHERE ? BETWEEN rent_start_date AND rent_end_date)";
    $reverse2 = $conn->prepare($q2_reverse);
    $reverse2->bind_param("s", $today);
    $reverse2->execute();
    $reverse2->close();


    ?>
            </div>
        </div>


        <form action="index.php"><input type="submit" value="RETURN HOME" class="btn btn-primary pull-right"></form>


    </div>


</body>

