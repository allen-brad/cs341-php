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
echo "ACTION IS: $action <br>";

/* foreach ($fruits as $key=>$value) {
  echo 'Name: '. $key .'<br>';
  echo 'Desc: '. $fruits[$key]['desc'] .'<br>';
  echo 'Price: $'. number_format($fruits[$key]['price'], 2) .'<br>';
} */

if ( isset($_SESSION["cart"]) ) {
  echo 'CART: '.count($_SESSION["cart"]);
} else {
  echo 'CART: 0';
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
            echo "$item found in fruits... safe to proceed. <br>";
            
            //shopping cart is an associative array with fruit name and quantity
            //if cart does not exist then create it and add item
            if ( !isset($_SESSION["cart"]) ) {
                //make the cart and add item
                echo "MAKING CART <br>";
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

  <title>CS341 W03 Assignment</title>

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
      <h1 class="display-4">Friuty Fresh</h1>
      <p class="lead">We're keepin' it fresh. Fight of those quaranteen pounds by eating our fresh friut insead of that junk in your pantry!</p>
    </div>

    <div class="container">
      <div>
      <?php

        // show session variables
        echo "Session variables are:<br>";
        print_r($_SESSION).'<br>';

        echo '<br>Items in cart: ' . itemCountInCart();

      ?>
      </div>
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Bananas</h4>
            </div>
            <div class="card-body d-flex flex-column">
              <h1 class="card-title pricing-card-title">$1.00 <small class="text-muted">/ mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Friut Description</li>
              </ul>
              <label class="d-inline" for="quantity">Quantity:</label>
              <select class="d-inline" id="quantity" name="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>

              <input type="hidden" name="action" value="addToCart">
              <input type="hidden" name="item" value="Lime">

              <button type="submit" class="btn btn-lg btn-block btn-primary mt-auto">Order Lemons</button>
              
            </div>
          </form>
        </div>

        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Lemons</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
              <li>10 GB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Strawberries</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Lime</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>10 users included</li>
              <li>2 GB of storage</li>
              <li>Email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Orange</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>20 users included</li>
              <li>10 GB of storage</li>
              <li>Priority email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Pineapple</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>30 users included</li>
              <li>15 GB of storage</li>
              <li>Phone and email support</li>
              <li>Help center access</li>
            </ul>
            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
          </div>
        </div>
      </div>

      <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
          <label for="quantity">Quantity:</label>

          <select id="quantity" name="quantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
          </select>

          <input type="hidden" name="action" value="addToCart">
          <input type="hidden" name="item" value="Lemon">
          <input type="submit" value="Order Lemons" >
        </form>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <label for="quantity">Quantity:</label>

            <select id="quantity" name="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <input type="hidden" name="action" value="addToCart">
            <input type="hidden" name="item" value="Lime">
            <input type="submit" value="Order Limes" >
        </form>


      <br>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
          <input type="hidden" name="action" value="addMoreLemons">
          <input type="hidden" name="item" value="Lemon">
          <input type="hidden" name="quantity" value="6">
          <input type="submit" value="Order More Lemons" >
      </form>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
          <input type="hidden" name="action" value="checkForLemons">
          <input type="hidden" name="item" value="Lemon">
          <input type="submit" value="Check Cart for Lemons" >
      </form>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
          <input type="hidden" name="action" value="checkPriceOfLemons">
          <input type="hidden" name="item" value="Lemon">
          <input type="submit" value="Check Price for Lemons" >
      </form>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
          <input type="hidden" name="action" value="addToCart">
          <input type="hidden" name="item" value="Potato">
          <input type="hidden" name="quantity" value="6">
          <input type="submit" value="Order Potatos" >
      </form>

      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Cool stuff</a></li>
              <li><a class="text-muted" href="#">Random feature</a></li>
              <li><a class="text-muted" href="#">Team feature</a></li>
              <li><a class="text-muted" href="#">Stuff for developers</a></li>
              <li><a class="text-muted" href="#">Another one</a></li>
              <li><a class="text-muted" href="#">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Resource</a></li>
              <li><a class="text-muted" href="#">Resource name</a></li>
              <li><a class="text-muted" href="#">Another resource</a></li>
              <li><a class="text-muted" href="#">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Team</a></li>
              <li><a class="text-muted" href="#">Locations</a></li>
              <li><a class="text-muted" href="#">Privacy</a></li>
              <li><a class="text-muted" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
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
