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
                                <a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a>
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
                                <a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a>
                            </li>
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span> </a>
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

    <?php $customer_username = $_SESSION['login_customer'];

    $q = "SELECT c.ssn FROM customer c JOIN user u ON c.cust_id=u.user_id WHERE u.username='$customer_username'";
    $res = $conn->query($q);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $customer_ssn = $row['ssn'];

        $query = "SELECT * FROM reservation r JOIN car c ON r.car_id=c.car_id WHERE r.cust_ssn='$customer_ssn' AND c.car_status='Rented'";
        $result1 = $conn->query($query);

        if (mysqli_num_rows($result1) > 0) {
            ?>
            <div class="container">
                <div class="jumbotron">
                    <h1 class="text-center">Your Bookings:</h1>
                </div>
            </div>

            <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="20%">Car</th>
                            <th width="20%">Start Date</th>
                            <th width="20%">End Date</th>
                            <th width="10%">Price per day</th>
                            <th width="15%">Number of Days</th>
                            <th width="15%">Total Amount</th>
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
                                <?php echo $row["rent_start_date"]; ?>
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
                    <h1 class="text-center">You have not rented any cars yet!</h1>
                    <p class="text-center"> Please rent cars in order to view your data here. </p>
                </div>
                <form action="index.php">
                    <input type="submit" value="RETURN HOME" class="btn btn-warning pull-right" />
                </form>
            </div>

            <?php
        }
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