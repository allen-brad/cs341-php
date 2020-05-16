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

    case 'removeFromCart':
        $item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);
        if ( !isset($fruits[$item]) ) {
            echo "ERROR: $item is not for sale! <br>";
        } else {
            removeFromCart($item);
            header("Location: " .$_SERVER['PHP_SELF']);
            exit();
        }
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

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Order Summary</h1>
        <p class="lead">We thank you and your body will too!</p>
        
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
