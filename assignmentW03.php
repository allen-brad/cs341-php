<?

// Start the session
session_start();

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
                header("Location: " .$_SERVER['PHP_SELF']);
                exit();
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
                            // PRG to redirect to this page to prevent page refresh resubmiting form post
                    header("Location: " .$_SERVER['PHP_SELF']);
                    exit();
                }
            }
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

  <div class="pricing-header px-3 py-3 pt-md-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Friuty Fresh</h1>
      <p class="lead">We're keepin' it fresh. Fight off those quaranteen pounds by eating our fresh friut insead of that junk in your pantry!</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">

        <?php
        //make cards from fruit array
          foreach ($fruits as $key=>$value) {
          echo '<div class="card mb-4 box-shadow">';
          echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" >' ;
          echo '<div class="card-header">';
          echo '<h4 class="my-0 font-weight-normal">'. $key . '</h4>';
          echo '</div>';
          echo '<div class="card-body d-flex flex-column">';
          echo '<h1 class="card-title pricing-card-title">$'. number_format($fruits[$key]['price'], 2) .'</h1>';
          echo '<ul class="list-unstyled mt-3 mb-4">';
          echo '<li>'.$fruits[$key]['desc']. '</li>';
          echo '</ul>';
          echo '<div class="container"><div class="row mt-2">  <div class="form-group">';
          echo '<label class="d-inline-block" for="quantity">Quantity:&nbsp</label>';
          echo '<select name="quantity" class="form-control form-control-sm d-inline-block" style="width: auto;" id="quantity">';
          echo '<option value="1">1</option>   <option value="2">2</option>   <option value="3">3</option>   <option value="4">4</option>   <option value="5">5</option>';
          echo '</select>   </div>   </div>   </div>';
          echo '<input type="hidden" name="action" value="addToCart">';
          echo '<input type="hidden" name="item" value="'.$key.'">';
          echo '<button type="submit" class="btn btn-lg btn-block btn-primary mt-auto">Add to Cart</button>';
          echo '</div>  </form>  </div>';

          }
        ?>

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
