<!DOCTYPE html>
<html>
<?php
include('session_customer.php');
// session_start();
// require 'connection.php';
// $conn = Connect();
?>

<title>Book Car </title>

<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
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
                        <li>
                            <a href="customer_search.php"><span class="glyphicon glyphicon-search"></span>Search</a>
                        </li>
                        <li>
                            <a href="customer_bookings.php"><span class="glyphicon glyphicon-list-alt"></span>View My
                                Bookings</a>
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
                                <a href="index.php">Home</a>
                            </li>
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"> Login <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="admin_login.php"> Admin </a></li>
                                    <li> <a href="customer_login.php"> Customer</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="admin_login.php">Admin</a>
                            </li>
                            <li>
                                <a href="customer_login.php">Customer</a>
                            </li> -->
                        </ul>
                    </div>
            <?php }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="rent_confirmation.php" method="POST">
                    <br style="clear: both">
                    <br>
                    <?php
                    $car_id = $_GET["id"];
                    $office_country = $_GET["country"];
                    $office_city = $_GET["city"];
                    $sql1 = "SELECT * FROM car WHERE car_id = '$car_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {

                            $car_id = $row1['car_id'];
                            $car_model = $row1['car_model'];
                            $car_year = isset($row1['year']) ? $row1['year'] : null;
                            $car_category = $row1['car_category'];
                            $car_colour = $row1['car_colour'];
                            $plate_id = $row1['plate_id'];
                            $price_per_day = $row1['price_per_day'];
                            $car_status = $row1['car_status'];
                            $car_office_id = $row1['car_office_id'];

                        }
                    }

                    ?>

                    <!-- <div class="form-group"> -->
                    <h5> Selected Car:&nbsp; <b>
                            <?php echo ($car_model); ?>
                        </b></h5>
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <h5> Plate Number:&nbsp;<b>
                            <?php echo ($plate_id); ?>
                        </b></h5>
                    <!-- </div>      -->
                    <!-- <div class="form-group"> -->
                    <?php $today = date("Y-m-d") ?>
                    <label>
                        <h5>Start Date:</h5>
                    </label>
                    <input type="date" name="rent_start_date" min="<?php echo ($today); ?>" required="">

                    &nbsp;
                    <label>
                        <h5>End Date:</h5>
                    </label>
                    <input type="date" name="rent_end_date" min="<?php echo ($today); ?>" required="">
                    <!-- </div>      -->

                    <h5> Price Per Day: &nbsp; EGP
                        <?php echo ($price_per_day); ?> /day
                        </b>
                    </h5>



                    <input type="submit" name="submit" value="Rent" class="btn btn-primary pull-right">

                    <!-- </div>   -->
            </div>
        </div>

        <br><br>

        <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
        <input type="hidden" name="hidden_country" value="<?php echo $office_country; ?>">
        <input type="hidden" name="hidden_city" value="<?php echo $office_city; ?>">

        </form>

    </div>

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