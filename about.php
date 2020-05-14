<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="About">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa"><!-- this alters the google chrome toolbar color -->

  <title>About</title>

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="cropped-ba-192x192.png">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'; ?>

  <div id="about-me-carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#about-me-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#about-me-carousel" data-slide-to="1"></li>
      <li data-target="#about-me-carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/about_me_hero_1600x500.jpg" class="d-block w-100" alt="winter training">
        <div class="carousel-caption d-none d-md-block">
          <h5><span class="inverse-text">Winter Training</span></h5>
          <p><span class="inverse-text">Cherry Peak on the left, Mt. Naomi on the right.</span></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/about_me_hero_2_1600x500.jpg" class="d-block w-100" alt="a helicopter hoist">
        <div class="carousel-caption d-none d-md-block">
          <h5>Hoist Training with Life Flight</h5>
          <p>Swinging below a helicopter in flight is a blast!</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/about_me_hero_3_1600x500.jpg" class="d-block w-100" alt="a high angle rescue">
        <div class="carousel-caption d-none d-md-block">
          <h5>High Angle Training</h5>
          <p>Training with Grand County and the National Park Service.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#about-me-carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#about-me-carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="container marketing">
    <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">I'm a member of Wasatch County Search and Rescue. <span class="text-muted">We're all volunteers.</span></h2>
          <p class="lead">It's a fun way for me to serve others and do the things I love. I'm on the Winter Mountain Rescue, Swiftwater, High Angle, Sonar, and Dive teams. I have served on the Board of Directors for nearly 5 years. It puts a smile on my face.</p>
        </div>
        <div class="col-md-5">
          <img src="img/smiles.jpg" alt="smilling men" class="featurette-image img-fluid mx-auto" width="601" height="500"  role="img" aria-label="smiles: 500x500">
        </div>
    </div>
  </div>

  <script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
