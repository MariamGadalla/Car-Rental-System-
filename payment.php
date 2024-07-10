<!DOCTYPE html>
<html>
<?php
include('session_customer.php');
// session_start();
// require 'connection.php';
// $conn = Connect();
?>

<title>Payment </title>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="css/pay.css">
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
                                            class="glyphicon glyphicon-user"></span> Control Panel <span
                                            class="caret"></span> </a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
    <div class="padding">
        <div class="row">
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-8 col-md-6">
                    <div class="card">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-6">
                                    <span>CREDIT/DEBIT CARD PAYMENT</span>

                                </div>

                                <div class="col-md-6 text-right" style="margin-top: -5px;">

                                    <img src="https://img.icons8.com/color/36/000000/visa.png">
                                    <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                    <img src="https://img.icons8.com/color/36/000000/amex.png">

                                </div>

                            </div>

                        </div>
                        <div class="card-body" style="height: 350px">
                            <div class="form-group">
                                <label for="cc-number" class="control-label">CARD NUMBER</label>
                                <input id="cc-number" type="tel" class="input-lg form-control cc-number"
                                    autocomplete="cc-number"
                                    placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;"
                                    required>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label">CARD EXPIRY</label>
                                        <input id="cc-exp" type="tel" class="input-lg form-control cc-exp"
                                            autocomplete="cc-exp" placeholder="&bull;&bull; / &bull;&bull;" required>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cc-cvc" class="control-label">CARD CVC</label>
                                        <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc"
                                            autocomplete="off" placeholder="&bull;&bull;&bull;&bull;" required>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                                <input type="text" class="input-lg form-control">
                            </div>

                            <div class="form-group">
                                <!-- <form action="index.php">
                                    <input value="MAKE PAYMENT" type="button"
                                        class="btn btn-success btn-lg form-control" style="font-size: .8rem;">
                                </form> -->

                                <button onclick="showAlert()" class="btn-success btn-lg btn-block">Pay Now</button>

                                <div class="overlay" id="overlay">
                                    <div class="alert-box">
                                        <p>Payment Successful!</p>
                                        <button onclick="closeAlert()">Close</button>
                                    </div>
                                </div>

                                <script>
                                    function showAlert() {
                                        var overlay = document.getElementById('overlay');
                                        overlay.style.display = 'flex';
                                    }

                                    function closeAlert() {
                                        var overlay = document.getElementById('overlay');
                                        overlay.style.display = 'none';

                                        // Redirect to another page after closing the alert
                                        window.location.href = 'index.php';
                                    }
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




</body>

</html>