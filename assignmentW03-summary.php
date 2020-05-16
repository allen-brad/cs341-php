<?
    // Start the session
    session_start();

    //error logging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include $_SERVER['DOCUMENT_ROOT'].'/includes/friut_functions.php';

    include $_SERVER['DOCUMENT_ROOT'].'/includes/friuts.php';

    //Filter and store data
    $orderFirstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $orderLastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $orderEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $orderAddress1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
    $orderAddress2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
    $orderCity = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $orderState = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $orderZip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
    $orderCountry = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Week 03 Assignment">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa"><!-- this alters the google chrome toolbar color -->

  <title>CS341 W03 Assignment | Cart</title>

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="cropped-ba-192x192.png">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/w03.css">

</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'; ?>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Order Summary</h1>
            <p class="lead">We thank you and your body will too!</p>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Order Summary</span>
                    <span class="badge badge-secondary badge-pill"> <?php echo itemCountInCart(); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    if ( isset($_SESSION['cart']) ) {
                        $total = 0;
                        foreach($_SESSION['cart'] as $item){
                            $total += $fruits[$item['product']]['price']*$item['quantity'];
                            echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                            echo '<di>';
                            echo '<h6 class="my-0">'. $item['product'] . '</h6>';
                            echo '<small class="text-muted">'. $fruits[$item['product']]['desc'] . '<br>Quantity:&nbsp'.$item['quantity']. '</small>';
                            echo '</di>';
                            echo '<span class="text-muted">$' .number_format($fruits[$item['product']]['price']*$item['quantity'], 2) . '</span>';
                            echo '</li>';
                        }
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong><?php echo '$'. number_format($total,2); ?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h2 class="text-mutes">Shipping Information</h2>
                <?php
                    echo "<p>$orderFirstName $orderLastName <br>";
                    echo "$orderAddress1 <br>";
                    if ($orderAddress2) {
                        echo $orderAddress2 . "<br>";
                    }
                    echo "$orderCity $orderState $orderZip <br>";
                    echo $orderCountry;
                ?>
            </div>
        </div>
    </div>

<!-- scripts -->
  <script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
<?php
//destroy the cart so they can create a new order
unset($_SESSION['cart']);
?>
</body>

</html>
