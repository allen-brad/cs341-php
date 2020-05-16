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

  <title>CS341 W03 Assignment | Check Out</title>

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
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/ba.svg" alt="" width="72" height="72">
        <h2>Checkout</h2>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
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
          <h4 class="mb-3">Billing address</h4>
          <form action="assignmentW03-summary.php"  class="needs-validation" method="post" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address1">Address</label>
              <input type="text" class="form-control" name="address1" id="address1" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="mb-3">
              <label for="city">City</label>
              <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
              <div class="invalid-feedback">
                Please enter your shipping city.
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="country" id="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="state" id="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                  <option>Utah</option>
                  <option>Idaho</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <input type="hidden" name="action" value="completeOrder">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Complete Order</button>
            <a class="btn btn-secondary btn-lg btn-block" href="/assignmentW03.php">Coontinue Shopping</a>
          </form>
          <hr class="mb-4">
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
  <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

</body>

</html>
