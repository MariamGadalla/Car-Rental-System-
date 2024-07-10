<!DOCTYPE html>
<html>

<?php
include('session_admin.php'); ?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
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
                                aria-haspopup="true" aria-expanded="false"> <span
                                    class="glyphicon glyphicon-log-in"></span>Login <span class="caret"></span> </a>
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

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="change_car_status.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Please input Plate Id of car
                        you wish to change its status: </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="car_plateID" name="car_plateID"
                            placeholder="Plate ID" required>
                        <select class="form-control" id="car_status" name="car_status" required>
                            <option value="" disabled selected>Select Car Status</option>
                            <!-- Options will be dynamically loaded here -->
                        </select>
                    </div>

                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right">Change Car
                        Status</button>
                </form>

            </div>
        </div>


    </div>
    </div>
    <script>
        document.getElementById("car_plateID").addEventListener("input", function () {
            loadCarStatusOptions();
        });

        function loadCarStatusOptions() {
            var plateID = document.getElementById("car_plateID").value;

            console.log("Plate ID:", plateID); // Check if plateID is correct

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    console.log("Response status:", this.status); // Check the response status
                    if (this.status == 200) {
                        document.getElementById("car_status").innerHTML = this.responseText;
                    }
                }
            };

            // Check the request URL before sending
            var requestURL = "get_car_status_options.php?plateID=" + plateID;
            console.log("Request URL:", requestURL);

            xmlhttp.open("GET", requestURL, true);
            xmlhttp.send();
        }
    </script>


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





<!-- <script>
    function loadCarStatusOptions() {
        var plateID = document.getElementById("car_plateID").value;

        // Use AJAX to fetch options based on the plate ID
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("car_status").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "get_car_status_options.php?plateID=" + plateID, true);
        xmlhttp.send();
    }
</script> -->

</html>