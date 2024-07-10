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
                                            class="glyphicon glyphicon-user"></span> Menu <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercar.php">Add Car</a></li>

                                        <li> <a href="clientview.php">View</a></li>

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

    // $type = $_POST['radio'];
    $customer_username = $_SESSION["login_customer"];
    $q = "SELECT c.ssn FROM customer c JOIN user u ON c.cust_id = u.user_id WHERE u.username='$customer_username'";
    $result = mysqli_query($conn, $q);
    $row_c = mysqli_fetch_assoc($result);
    $customer_ssn = $row_c['ssn'];

    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $country = $conn->real_escape_string($_POST['hidden_country']);
    $city = $conn->real_escape_string($_POST['hidden_city']);
    $start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $today = date("Y-m-d");

    if ($end_date < $start_date) {
        ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                <h3>Incorrect dates entered!</h3>
                <br><br>
                <a href="rent_car.php?id=<?php echo $car_id ?>&country=<?php echo $country ?>&city=<?php echo $city ?>"
                    class="btn btn-default"> Go Back </a>
            </div>
        </div>
        <?php
        die();
    }




    $sql0 = "SELECT * FROM car WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    $sql_office = "SELECT * FROM locations WHERE country='$country' AND city='$city'";
    // $stmt_office = $conn->prepare($sql_office);
    // $stmt_office->bind_param('ss', $country,$city);
    // $result_office = $stmt_office->execute();
    $result_office = $conn->query($sql_office);
    $row_office = mysqli_fetch_assoc($result_office);


   
    $check = "SELECT * FROM reservation WHERE rent_start_date <= '$end_date' AND rent_end_date >= '$start_date'";
    $check_result = $conn->query($check);
    if (mysqli_num_rows($check_result) == 0) {

        $sql1 = "INSERT into reservation(cust_ssn, car_id, res_date, rent_start_date, rent_end_date,office_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $result1 = $conn->query($sql1);

    } else {
        //echo "Car is already occupied during the selected period. Reservation rejected.";
        ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                <h3>Car is already occupied during the selected period. Reservation rejected.</h3>
                <br><br>
                <a href="rent_car.php?id=<?php echo $car_id ?>&country=<?php echo $country ?>&city=<?php echo $city ?>"
                    class="btn btn-default"> Go Back </a>
            </div>
        </div>
        <?php
        die();
    }



    // $result1 = $conn->query($sql1);
    
    // $sql2 = "UPDATE car SET car_status = 'Rented' WHERE car_id = '$car_id'";
    
    $sql2 = "UPDATE car JOIN reservation  ON car.car_id = reservation.car_id
    SET car.car_status = 'Rented'
    WHERE reservation.rent_start_date <= '$today'";


    $result2 = $conn->query($sql2);


    // betala3 kol el rented ghaleban 
    //$sql4 = "SELECT * FROM  car c,  reservation r, customer cust WHERE c.car_id = r.car_id AND r.cust_ssn = cust.ssn";
    $sql4 = "SELECT * FROM  car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cust ON r.cust_ssn=cust.ssn WHERE c.car_id = '$car_id'  AND r.cust_ssn= cust.ssn";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            $car_id = $row['car_id'];
            $car_model = $row['car_model'];
            $car_year = isset($row['year']) ? $row['year'] : null;
            $car_category = $row['car_category'];
            $car_colour = $row['car_colour'];
            $plate_id = $row['plate_id'];
            $price_per_day = $row['price_per_day'];
            $car_status = $row['car_status'];
            $car_office_id = $row['car_office_id'];
            $res_id = $row['res_id'];

        }
    }

    if (!$result1 | !$result2 | !$result4) {
        die("Couldnt enter data: " . $conn->error);
    }

    ?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>
                Booking
                Confirmed.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for using our Car Rental System! We wish you have a safe ride. </h2>

    <h3 class="text-center"> <strong>Your Reservation Number:</strong> <span style="color: blue;">
            <?php echo "$res_id"; ?>
        </span> </h3>


    <div class="container">
        <h5 class="text-center">Please read the following information about your reservation.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your booking has been received and placed into our system.
                </h3>
                <br>
                <h4>Please make a note of your <strong>reservation number</strong> now, and keep it in case you need
                    to
                    communicate with us about your reservation.</h4>
                <br>
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Model: </strong>
                    <?php echo $car_model; ?>
                </h4>
                <br>
                <h4> <strong>Vehicle's Plate Number:</strong>
                    <?php echo $plate_id; ?>
                </h4>
                <br>
                <h4> <strong>Booking Date: </strong>
                    <?php echo date("Y-m-d"); ?>
                </h4>
                <br>
                <h4> <strong>Start Date: </strong>
                    <?php echo $start_date; ?>
                </h4>
                <br>
                <h4> <strong>Return Date: </strong>
                    <?php echo $end_date; ?>
                </h4>
                <br>
                <h4>
                    <strong>Number of Days: </strong>
                    <?php
                    $startdate = strtotime($start_date);
                    $enddate = strtotime($end_date);
                    $days = ($enddate - $startdate) / (60 * 60 * 24);  // 60 seconds * 60 minutes * 24 hours = 1 day
                    echo $days;
                    ?>
                </h4>

                <br>
                <?php
                $total_price = $days * $price_per_day;
                ?>
                <h4> <strong>Total Price: </strong> EGP
                    <?php echo $total_price; ?>
                </h4>

                <?php
                $query_add = "UPDATE reservation SET payment = '$total_price' WHERE res_id='$res_id'";
                $result_add = $conn->query($query_add);
                ?>

                <form action="payment.php">
                    <input type="submit" value="Proceed For Payment" class="btn btn-success btn-lg btn-block">
                    <!-- <button type="button" class="btn btn-success btn-lg">Proceed For Payment </button> -->
                </form>


                <br>


                <form action="index.php">
                    <input type="submit" value="RETURN HOME" class="btn btn-primary pull-right" />
                </form>

                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. You can later
                display it in your bookings.</h6>
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