<?

// Start the session
session_start();

//for debugging
// remove all session variables
/* session_unset();
// destroy the session
session_destroy(); */

//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include $_SERVER['DOCUMENT_ROOT'].'/includes/friut_functions.php';

include $_SERVER['DOCUMENT_ROOT'].'/includes/friuts.php';


/*_____________________ actions _____________________*/

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
$action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'uptateQuantity':
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
        if ( !isset($fruits[$item]) ) {
            echo "ERROR: $item is not for sale! <br>";
        } else {
            updateQuantityInCart($item,$quantity);
        }
    break;

    case 'checkPriceOfLemons':
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);

        echo 'The unit price of lemons is: ' . $fruits[$item]['price'] . '<br>';
    break;
    }
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
  <?php
  echo "ACTION IS: $action <br>"; 
  print_r($_SESSION).'<br>';
  ?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Cart</h1>
        <p class="lead">We're keepin' it fresh. Fight off those quaranteen pounds by eating our fresh friut insead of that junk in your pantry!</p>
    </div>

    <div class="container">
        <!-- start of cart -->
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"> <?php echo itemCountInCart(); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <!-- build indiviual cart items  -->
                    <?php
                    if ( isset($_SESSION['cart']) ) {
                        $total = 0;
                        foreach($_SESSION['cart'] as $item){
                            $total += $fruits[$item['product']]['price']*$item['quantity'];
                            echo '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                            echo '<di>';
                            echo '<h6 class="my-0">'. $item['product'] . '</h6>';
                            echo '<small class="text-muted">'. $fruits[$item['product']]['desc'] . '<br>Quantity:'.$item['quantity']. '</small>';
                            echo '</di>';
                            echo '<span class="text-muted">$' .number_format($fruits[$item['product']]['price']*$item['quantity'], 2) . '</span>';
                            echo '</li>';
                        }
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong><?php echo $total; ?></strong>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-4">Item</div>
            <div class="col-2">Quantity</div>
            <div class="col-3">Price</div>
            <div class="col-3">Price</div>
        </div>
        <div class="row">
            <div class="col-4">Banana</div>
            <div class="col-2">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                    <div class="input-group mb-3">
                        <input type="text" name="quantity" class="form-control" placeholder="3" aria-label="Quantity" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <input type="hidden" name="action" value="uptateQuantity">
                            <input type="hidden" name="item" value="Banana">
                            <button class="btn btn-outline-secondary" type="sumbit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3">$2.00</div>
            <div class="col-3">$6.00</div>
        </div>
    </div>

    

<!-- scripts -->
  <script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
