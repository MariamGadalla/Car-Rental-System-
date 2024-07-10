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

    if (isset($_POST['submit'])) {
        // Validate and sanitize user inputs
        $attribute = filter_input(INPUT_POST, 'attribute', FILTER_SANITIZE_STRING);
        $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_STRING);

        // Check if attribute is valid
        $validAttributes = ['plate_id', 'car_model', 'year', 'car_category', 'car_colour', 'car_status', 'office_name', 'cust_fname', 'cust_lname', 'ssn'];
        if (!in_array($attribute, $validAttributes)) {
            // Handle invalid attribute value
            echo "<div class='container'><div class='jumbotron' style='text-align: center;'><h3>Invalid attribute selected!</h3><br><br><a href='admin_search.php' class='btn btn-default'> Go Back </a></div></div>";
            die();
        }

        echo "Value from POST: " . $_POST['value'];

        // Use a switch statement to dynamically set the column in your SQL query
        switch ($attribute) {
            case 'plate_id':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.plate_id LIKE ?";
                break;
            case 'car_model':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.car_model LIKE ?";
                break;
            case 'year':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.year LIKE ?";
                break;
            case 'car_category':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.car_category LIKE ?";
                break;
            case 'car_colour':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.car_colour LIKE ?";
                break;
            case 'car_status':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE c.car_status = ?";
                break;

            case 'cust_fname':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE cu.cust_fname LIKE ?";
                break;
            case 'cust_lname':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE cu.cust_lname LIKE ?";
                break;
            case 'ssn':
                $query = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id JOIN customer cu ON r.cust_ssn=cu.ssn WHERE cu.ssn LIKE ?";
                break;
            default:
                // Handle invalid attribute value
                ?>
                <div class="container">
                    <div class="jumbotron" style="text-align: center;">
                        <h3>Invalid attribute selected!</h3>
                        <br><br>
                        <a href="admin_search.php" class="btn btn-default"> Go Back </a>
                    </div>
                </div>
                <?php
                die();
        }

        $stmt = $conn->prepare($query);
        //$stmt->bind_param("s", $value);
    
        // if (is_numeric($value)) {
        //     // If numeric, bind as integer
        //     $stmt->bind_param('i', $value);
        // } else {
        //     // If not numeric, bind as string
        //     $stmt->bind_param('s', $value);
        // }
    
        // Determine the data type for binding
        if ($attribute === 'car_office_id' || $attribute === 'year') {
            // If numeric, bind as integer
            $stmt->bind_param('i', $value);
        } elseif ($attribute === 'res_date') {
            // If date, bind as string
            $stmt->bind_param('s', $value);
        } else {
            // If not numeric, bind as string
            $stmt->bind_param('s', $value);
        }

        $stmt->execute();

        if ($stmt->error) {
            //echo "Error: " . $stmt->error;
            error_log("Error: " . $stmt->error);
            echo "<div class='container'><div class='jumbotron'><h1>Error Occurred</h1></div></div>";
        } else {
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) > 0) {
                ?>
                <div class="container">
                    <div class="jumbotron">
                        <h1 class="text-center">Search Results:</h1>
                        <h3 class="text-center">(
                            <?php
                            echo ($value);
                            ?>)
                        </h3>
                    </div>
                </div>

                <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <h3>Cars</h3>
                            <tr>
                                <th width="15%">Car</th>
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
                        while ($row = mysqli_fetch_assoc($result)) {
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
                                <td>EGP
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
                            <h3>Reservations</h3>
                            <tr>
                                <th width="10%">Reservation ID</th>
                                <th width="15%">Customer SSN</th>
                                <th width="10%">Car ID</th>
                                <th width="15%">Reservation Date</th>
                                <th width="10%">Rent Start Date</th>
                                <th width="10%">Rent End Date</th>
                                <th width="10%">Number of Days</th>
                                <th width="10%">Total Amount</th>
                                <th width="10%">Office ID</th>
                            </tr>
                        </thead>
                        <?php

                        $result_1 = $conn->prepare($query);
                        $result_1->bind_param("s", $value);
                        $result_1->execute();
                        if ($result_1->error) {
                            // Handle the error
                            error_log("Error: " . $result_1->error);
                            echo "<div class='container'><div class='jumbotron'><h1>Error Occurred</h1></div></div>";
                        } else {
                            $result_1 = $result_1->get_result();

                            while ($row_1 = mysqli_fetch_assoc($result_1)) {
                                $car_id = $row_1['car_id'];
                                $customer_ssn = $row_1['cust_ssn'];
                                $query1 = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id WHERE c.car_id='$car_id' AND r.cust_ssn='$customer_ssn'";
                                $result1 = $conn->query($query1);

                                if (mysqli_num_rows($result1) > 0) {
                                    // $car_id = $row_1['car_id'];
                                    // $query1 = "SELECT * FROM car c JOIN reservation r ON c.car_id=r.car_id WHERE c.car_id='$car_id' AND car_status='Rented'";
                                    // $result1 = $conn->query($query1);
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
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
                                                <?php
                                                $start_date = strtotime($row1["rent_start_date"]);
                                                $end_date = strtotime($row1["rent_end_date"]);
                                                $days = ($end_date - $start_date) / (60 * 60 * 24);  // 60 seconds * 60 minutes * 24 hours = 1 day
                                                echo $days;
                                                ?>
                                            </td>
                                            <td>EGP
                                                <?php
                                                $total_amount = $days * $row1["price_per_day"];
                                                echo $total_amount;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $row1["car_office_id"]; ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <h3 style="text-align: center;">(No Reservations!)</h3>
                                    <br><br>
                                    <?php
                                }
                            }
                        } ?>
                    </table>
                </div>




                <br>
<br>
<div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
    <table class="table table-striped">
        <thead class="thead-dark">
            <h3>Customers</h3>
            <tr>
                <th width="20%">SSN</th>
                <th width="15%">First Name</th>
                <th width="15%">Last Name</th>
                <th width="15%">Email</th>
                <th width="15%">Phone</th>
                <th width="10%">Drivers License</th>
                <th width="10%">Address</th>
            </tr>
        </thead>
        <?php
        $query2 = "SELECT cu.ssn, cu.cust_fname, cu.cust_lname, cu.email, cu.phone, cu.drivers_liscence, cu.cust_address 
                   FROM car c 
                   JOIN reservation r ON c.car_id = r.car_id 
                   JOIN customer cu ON r.cust_ssn = cu.ssn 
                   WHERE $attribute LIKE ? 
                   GROUP BY cu.ssn";

        $result2_stmt = $conn->prepare($query2);
        $result2_stmt->bind_param("s", $value);
        $result2_stmt->execute();

        if ($result2_stmt->error) {
            // Handle the error
            error_log("Error: " . $result2_stmt->error);
            echo "<div class='container'><div class='jumbotron'><h1>Error Occurred</h1></div></div>";
        } else {
            $result2 = $result2_stmt->get_result();

            while ($row2 = mysqli_fetch_assoc($result2)) {
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
                    <td>
                        <?php echo $row2["drivers_liscence"]; ?>
                    </td>
                    <td>
                        <?php echo $row2["cust_address"]; ?>
                    </td>
                </tr>
            <?php
            }
        }
        ?>
    </table>
    <form action="index.php">
        <input type="submit" value="RETURN HOME" class="btn btn-warning pull-right" />
    </form>
</div>

                <?php


            } else {
                ?>
                <div class="container">
                    <div class="jumbotron">
                        <h1>No Results for this Search!</h1>
                        <p>
                            <?php echo $conn->error; ?>
                        </p>
                        <a href="admin_search.php" class="btn btn-default"> Go Back </a>
                    </div>
                </div>
                <?php
            }

        }
    }
    ?>


<form action="index.php">
            <input type="submit" value="RETURN HOME" class="btn btn-primary pull-right" />
        </form>
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