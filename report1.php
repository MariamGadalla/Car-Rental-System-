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


    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    
    $query0 = "SELECT c.car_id, c.car_model, c.year, c.car_category, c.car_colour, c.plate_id, c.price_per_day,
    c.car_status, c.car_office_id FROM car  c JOIN reservation  r ON c.car_id = r.car_id WHERE
    r.res_date BETWEEN '$start_date' AND '$end_date'";
    $result0 = $conn->query($query0);

    if (mysqli_num_rows($result0) > 0) {
        ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Report Results:</h1>

            </div>
        </div>

        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <h2>Cars</h2>
                    <tr>
                        <th width="15%">Car Model</th>
                        <th width="10%">Car ID</th>
                        <th width="10%">Year Released</th>
                        <th width="15%">Car Category</th>
                        <th width="10%">Car Colour</th>
                        <th width="10%">Plate ID</th>
                        <th width="10%">Price per day</th>
                        <th width="10%">Car Status</th>
                        <th width="10%">Office ID</th>

                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result0)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row["car_model"]; ?>
                        </td>
                        <td>
                            <?php echo $row["car_id"]; ?>
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
                            <?php echo ('EGP' . $row["price_per_day"] . "/day"); ?>
                        </td>
                        <td>
                            <?php echo $row["car_status"]; ?>
                        </td>
                        <td>
                            <?php echo $row["car_office_id"]; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <br>
        <br>
        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <h2> Reservations </h2>
                    <tr>
                        <th width="10%">Reservation ID</th>
                        <th width="15%">Customer SSN</th>
                        <th width="10%">Car ID</th>
                        <th width="15%">Reservation Date</th>
                        <th width="10%">Rent Start Date</th>
                        <th width="10%">Rent End Date</th>
                        <th width="10%">Office ID</th>
                        <th width="10%">Total Amount</th>


                    </tr>
                </thead>
                <?php
                $query1 = "SELECT res_id, res_date, rent_start_date, rent_end_date, payment, cust_ssn, car_id, office_id FROM
                reservation WHERE res_date BETWEEN '$start_date' AND '$end_date'; ";
                $result_1 = $conn->query($query1);
                while ($row1 = mysqli_fetch_assoc($result_1)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row1["res_id"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["cust_ssn"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["car_id"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["res_date"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["rent_start_date"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["rent_end_date"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["office_id"]; ?>
                        </td>
                        <td>
                            <?php echo $row1["payment"]; ?>
                        </td>
                    </tr>
                    <?php
                }

    } else {
        ?>
                <h3 style="text-align: center;">(No Reservations!)</h3>
                <br><br>
                <?php
    }

    ?>
        </table>
    </div>

    <br>
    <br>
    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
        <table class="table table-striped">
            <thead class="thead-dark">
                <h2>Customers</h2>
                <tr>
                    <th width="20%">SSN</th>
                    <th width="15%">First Name</th>
                    <th width="15%">Last Name</th>
                    <th width="15%">Email</th>
                    <th width="15%">Phone</th>
                    <th width="10%">Drivers Liscence</th>
                    <th width="10%">Address</th>

                </tr>
            </thead>
            <?php

            $query2 = "SELECT c.ssn, c.cust_id,c.cust_fname, c.cust_lname,c.email , c.phone , c.drivers_liscence ,c.cust_address FROM customer c
            JOIN reservation r ON c.ssn = r.cust_ssn WHERE r.res_date BETWEEN '$start_date' AND '$end_date';";
            $result_2 = $conn->query($query2); // Rename the prepared statement variable
            while ($row2 = mysqli_fetch_assoc($result_2)) {
                ?>
                <tr>
                    <td>
                        <?php echo $row2["ssn"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["cust_fname"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["cust_lname"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["email"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["phone"]; ?>
                    </td>
                    <td>EGP
                        <?php echo $row2["drivers_liscence"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["cust_address"]; ?>
                    </td>
                </tr>
            <?php }

            ?>
        </table>
        <form action="index.php">
            <input type="submit" value="RETURN HOME" class="btn btn-primary pull-right" />
        </form>
    </div>

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