<!DOCTYPE html>
<html>


<?php
include('session_customer.php'); ?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
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
                    Car Rental </a>
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

    $searchTerm = '%' . $_POST['car_spec'] . '%';

    $query1 = "
    SELECT
        c.car_id,
        c.car_model,
        c.year,
        c.car_category,
        c.car_colour,
        c.plate_id,
        c.price_per_day,
        c.car_status,
        c.car_office_id,
        c.car_img,
        l.country,
        l.city
    FROM
        car c
    JOIN 
        locations l 
    ON 
        c.car_office_id = l.office_id
    WHERE
        c.car_model LIKE ?
        OR c.car_colour LIKE ?
        OR c.plate_id LIKE ?
        OR c.car_category LIKE ?
        OR l.country LIKE ?
        OR l.city LIKE ?
        OR c.car_id LIKE ? 
        OR c.year LIKE ?
";

    $stmt = $conn->prepare($query1);

    // Bind parameters
    $stmt->bind_param('ssssssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);

    // Execute the query
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Display error message if the car does not exist
        ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                <h3>Car Does not Exist!</h3>
                <br><br>
                <a href="customer_search.php" class="btn btn-default"> Go Back </a>
            </div>
        </div>
        <?php
    } else {
        $sql1 = "SELECT * FROM car JOIN locations ON car_office_id=office_id WHERE car_status ='Available'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) { ?>


            <section class="menu-content" style="padding:50px 50px;display: flex; flex-wrap: wrap; ">
                <?php


                // Process and display the results as needed
                while ($row1 = mysqli_fetch_assoc($result)) {

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
                    if($car_status=="Available") {
                        ?>
                        <a href="rent_car.php?id=<?php echo $car_id ?>&country=<?php echo $office_country ?>&city=<?php echo $office_city ?>" style="font-size: 20px; padding:30px 20px">
                            <div class="car-box menu-content" style="padding:50px 50px" >
    
                                <img class="car-img" src="<?php echo $car_img; ?>" alt="Card image ">
                                <div class='car-details'>
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
                            </div>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="#" style="font-size: 20px; padding:30px 20px">
                            <div class="car-box menu-content" style="padding:50px 50px" >
    
                                <img class="car-img" src="<?php echo $car_img; ?>" alt="Card image ">
                                <div class='car-details'>
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
                            </div>
                        </a>
                        <?php
                    }
                    ?>

                    <style>
                        .car-box {
                            width: 250px;
                            height: 300px;
                            border: 1px solid #ccc;
                            margin: 10px;
                            padding: 10px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            transition: transform 0.3s;
                        }

                        .car-box:hover {
                            transform: scale(1.05);
                        }

                        .car-img {
                            width: 100%;
                            height: 100px;
                            margin-bottom: 10px;
                        }

                        .car-details {
                            margin-top: 10px;
                            text-align: center;
                        }
                    </style>
                <?php }
                ?>
            </section>
            <?php
        }
    }

    // Close the statement
    $stmt->close();

    // Close the connection
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