<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <style>
        .bgimg-1 {
            background-image: url('assets/img/div1.avif');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 300px;
        }

        .bgimg-2 {
            background-image: url('assets/img/div2.avif');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 300px;
        }
    </style>


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

    
    <div class="bgimg-1">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black">CAR RENTAL SYSTEM</h1>
                            <p class="intro-text">
                                Online Car Rental Service
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2"
        style="color: #777; background-color:white ;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Available Cars</h3>
        <br>
        <section class="menu-content" style="padding:50px 50px;">
            <?php
            $sql1 = "SELECT * FROM car JOIN locations ON car_office_id=office_id WHERE car_status ='Available'";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $car_id = $row1["car_id"];
                    $car_model = $row1["car_model"];
                    //$car_plateID = $row1["car_plateID"];
                    $car_year = isset($row1['year']) ? $row1['year'] : null;
                    $car_colour = $row1['car_colour'];
                    $car_category = $row1['car_category'];
                    $price_per_day = $row1["price_per_day"];
                    $car_office_id = $row1["car_office_id"];
                    $car_status = $row1["car_status"];
                    $car_img = $row1['car_img'];
                    //$car_img = "assets/img/" . $row1['car_img'];
            
                    $office_country = $row1['country'];
                    $office_city = $row1['city'];
                    if (isset($_SESSION['login_customer'])) {
                        ?>
                        <a href="rent_car.php?id=<?php echo $car_id ?>&country=<?php echo $office_country ?>&city=<?php echo $office_city ?>"
                            style="font-size: 20px; padding:30px 20px">
                            <div class="sub-menu" style="width: 300px; height: 300px;">

                                <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image ">
                                <h6><b>
                                        <?php echo $car_model; ?><br>
                                        <?php echo $car_category; ?>
                                        <?php echo $car_year; ?><br>
                                        <?php echo $car_colour; ?> <br>
                                        EGP
                                        <?php echo $price_per_day; ?> /day <br>
                                        <?php echo $office_country; ?> <br>
                                        <?php echo $office_city; ?>
                                    </b>
                                </h6>



                            </div>
                        </a>
                        <?php
                    } else if (isset($_SESSION['login_admin'])) {
                        ?>
                            <a href="#" style="font-size: 20px; padding:30px 20px">
                                <div class="sub-menu" style="width: 300px; height: 300px;">

                                    <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image ">
                                    <h6><b>
                                        <?php echo $car_model; ?><br>
                                        <?php echo $car_category; ?>
                                        <?php echo $car_year; ?><br>
                                        <?php echo $car_colour; ?> <br>
                                            EGP
                                        <?php echo $price_per_day; ?> /day <br>
                                        <?php echo $office_country; ?> <br>
                                        <?php echo $office_city; ?>
                                        </b>
                                    </h6>



                                </div>
                            </a>
                        <?php
                    } else {
                        ?>
                            <a href="" style="font-size: 20px; padding:30px 20px">
                                <div class="sub-menu" style="width: 300px; height: 300px;">

                                    <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image ">
                                    <h6><b>
                                        <?php echo $car_model; ?><br>
                                        <?php echo $car_category; ?>
                                        <?php echo $car_year; ?><br>
                                        <?php echo $car_colour; ?> <br>
                                            EGP
                                        <?php echo $price_per_day; ?> /day <br>
                                        <?php echo $office_country; ?> <br>
                                        <?php echo $office_city; ?>
                                        </b>
                                    </h6>



                                </div>
                            </a>
                        <?php
                    }
                }


            } else {
                ?>
                <h1> No cars available :( </h1>
                <?php
            }
            ?>
        </section>

    </div>

    <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
    </div>


    <!-- Container (Contact Section) -->
    <!-- -->
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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>