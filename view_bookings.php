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

    $sql1 = "SELECT * FROM reservation r JOIN car c ON r.car_id=c.car_id JOIN locations l ON r.office_id=l.office_id";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
        ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">All Bookings:</h1>
            </div>
        </div>

        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="10%">Car</th>
                        <th width="10%">Plate ID</th>
                        <th width="10%">Customer SSN</th>
                        <th width="15%">Rent Start Date</th>
                        <th width="15%">Rent End Date</th>
                        <th width="10%">Price per day</th>
                        <th width="10%">Number of Days</th>
                        <th width="10%">Total Amount</th>
                        <th width="10%">Office</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row["car_model"]; ?>
                        </td>
                        <td>
                            <?php echo $row["plate_id"]; ?>
                        </td>
                        <td>
                            <?php echo $row["cust_ssn"]; ?>
                        </td>
                        <td>
                            <?php echo $row["rent_start_date"] ?>
                        </td>
                        <td>
                            <?php echo $row["rent_end_date"]; ?>
                        </td>
                        <td>EGP
                            <?php echo ($row["price_per_day"] . "/day"); ?>
                        </td>
                        <td>
                            <?php
                            $start_date = strtotime($row["rent_start_date"]);
                            $end_date = strtotime($row["rent_end_date"]);
                            $days = ($end_date - $start_date) / (60 * 60 * 24);  // 60 seconds * 60 minutes * 24 hours = 1 day
                            echo $days;
                            ?>
                        </td>
                        <td>EGP
                            <?php
                            $total_amount = $days * $row["price_per_day"];
                            echo $total_amount;
                            ?>
                        </td>
                        <td>
                            <?php echo $row["office_name"]; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <form action="index.php">
                    <input type="submit" value="RETURN HOME" class="btn btn-warning pull-right" />
                </form>
        </div>
    <?php } else {
        ?>
        <div class="container">
            <div class="jumbotron">
                <h1>No Booked Cars :(</h1>
                <p>
                    <?php echo $conn->error; ?>
                </p>
            </div>
        </div>

        <?php
    } ?>


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