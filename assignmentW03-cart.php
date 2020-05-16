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
    case 'addToCart':
        //filter post variables
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
        
        //test to see if item really is a fruit before adding it to the cart
        //if ( !searchForFruitByName($item, $fruits)) {
        if ( !isset($fruits[$item]) ) {
            echo "ERROR: $item is not for sale! <br>";
        } else {
            //echo "$item found in fruits... safe to proceed. <br>";
            
            //shopping cart is an associative array with fruit name and quantity
            //if cart does not exist then create it and add item
            if ( !isset($_SESSION["cart"]) ) {
                //make the cart and add item
                //echo "MAKING CART <br>";
                $_SESSION["cart"][] = array(
                    'product' => $item,
                    'quantity' => $quantity
                );
            } else {
                //cart exists so check and see if the item is already in the cart and increase the quantity to it
                if ( searchCartByItem($item) ) {
                    echo "$item found in cart... increment. <br>";
                    updateQuantityInCart($item, $quantity);
                } else {
                    echo "$item not found in cart... adding to cart. <br>";
                    $_SESSION["cart"][] = array(
                        'product' => $item,
                        'quantity' => $quantity,
                    );
                }
            }
        }
        // PGR to redirect to this page to prevent page refresh resubmiting form post
    break;

    case 'checkForLemons':
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
        if ( !searchCartByItem($item)) {
            echo "CheckForLemons: $item is NOT in Cart <br>";
            echo searchCartByItem($item, $_SESSION['cart']) .'<br>';
        } else {
            echo "CheckForLemons: $item is in Cart <br>";
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

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Cart</h1>
      <p class="lead">We're keepin' it fresh. Fight off those quaranteen pounds by eating our fresh friut insead of that junk in your pantry!</p>
  </div>

  <div class="container">
    <div>
      <?php

        // show session variables
        echo "Session variables are:<br>";
        print_r($_SESSION).'<br>';

        echo '<br>Items in cart: ' . itemCountInCart() . '<br>';

        echo "ACTION IS: $action <br>";
        ?>


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
                            echo '<li class="list-group-item d-flex justify-content-between lh-condensed">;';
                            echo '<di>';
                            echo '<h6 class="my-0">'. $item['product'] . '</h6>';
                            echo '<small class="text-muted">'. $fruits[$item['product']]['desc'] . '</small>';
                            echo '<small class="text-muted">'. $item['quantity'] . '</small>';
                            echo '</di>';
                            echo '<span class="text-muted">$' .number_format($fruits[$item['product']]['price']*$item['quantity'], 2) . '</span>';
                            echo '</li>';
                        }
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$20</strong>
                    </li>
                </ul>
            </div>
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

</body>

</html>
