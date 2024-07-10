<html>

<head>
    <title> Customer Signup | Car Rental System </title>
</head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" type="text/css" href="assets/css/manager_registered_success.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>

    <!--Back to top button..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <!--Javacript for back to top button....................................................................-->
    <script type="text/javascript">
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

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

    <?php

    require 'connection.php';
    $conn = Connect();

    $customer_ssn = $conn->real_escape_string($_POST['customer_ssn']);
    $customer_first_name = $conn->real_escape_string($_POST['customer_first_name']);
    $customer_last_name = $conn->real_escape_string($_POST['customer_last_name']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_phone = $conn->real_escape_string($_POST['customer_phone']);
    $customer_drivers_liscence = $conn->real_escape_string($_POST['customer_drivers_liscence']);
    $customer_address = $conn->real_escape_string($_POST['customer_address']);

    $customer_username = $conn->real_escape_string($_POST['customer_username']);
    $customer_password = $conn->real_escape_string($_POST['customer_password']);
    $user_type = 'C';


    $query1 = "SELECT ssn from customer where ssn = '$customer_ssn'";
    $result1 = $conn->query($query1);
    $query2 = "SELECT username from user where username = '$customer_username'";
    $result2 = $conn->query($query2);


    if ($result1->num_rows > 0) { ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                <h2>User already has an account!</h2>
                <?php echo $conn->error; ?>
                <br><br>
                <a href="customer_signup.php" class="btn btn-default"> Go Back </a>
            </div>
            <?php
    } else if ($result2->num_rows > 0) { ?>
                <div class="container">
                    <div class="jumbotron" style="text-align: center;">
                        <h2>Username already exists!</h2>
                    <?php echo $conn->error; ?>
                        <br><br>
                        <a href="customer_signup.php" class="btn btn-default"> Go Back </a>
                    </div>
                <?php

    } else {

        // Insert into the user table
        $query3 = "INSERT INTO user (username, `password`, user_type) VALUES (?, ?, ?)";
        $stmt1 = $conn->prepare($query3);
        $stmt1->bind_param("sss", $customer_username, $customer_password, $user_type);
        $success1 = $stmt1->execute();

        if (!$success1) {
            die("Couldn't enter data: " . $stmt1->error);
        }

        // Get the user_id for the newly inserted user
        $customer_id_query = "SELECT user_id FROM user WHERE username = ? AND `password` = ?";
        $stmt2 = $conn->prepare($customer_id_query);
        $stmt2->bind_param("ss", $customer_username, $customer_password);
        $stmt2->execute();
        $stmt2->bind_result($customer_id);
        $stmt2->fetch();
        $stmt2->close();

        // Check if user_id is valid
        if (!$customer_id) {
            die("Invalid user credentials. Cannot insert into customer table.");
        }

        // Insert into the customer table
        $query = "INSERT INTO customer (ssn, cust_id, cust_fname, cust_lname, email, phone, drivers_liscence, cust_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt3 = $conn->prepare($query);
        $stmt3->bind_param("isssssss", $customer_ssn, $customer_id, $customer_first_name, $customer_last_name, $customer_email, $customer_phone, $customer_drivers_liscence, $customer_address);
        $success = $stmt3->execute();

        if (!$success) {
            die("Couldn't enter data into the customer table: " . $stmt3->error);
        }

        $stmt3->close();
        ?>

                    <div class="container">
                        <div class="jumbotron" style="text-align: center;">
                            <h2>
                            <?php echo "Welcome $customer_first_name!" ?>
                            </h2>
                            <h1>Your account has been created.</h1>
                            <p>Login Now from <a href="customer_login.php">HERE</a></p>
                        </div>
                    </div>
                <?php

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