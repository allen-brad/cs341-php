<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="index.php"><img src="img/cropped-ba-32x32.png" alt="BA Home"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if($_SERVER['SCRIPT_NAME']=="/about.php") echo 'active'; ?>">
        <a class="nav-link" href="about.php">About Me<?php if($_SERVER['SCRIPT_NAME']=="/about.php") echo '<span class="sr-only">(current)</span>'; ?></a>
      </li>
      <li class="nav-item <?php if($_SERVER['SCRIPT_NAME']=="/assignments.php") echo 'active'; ?>">
        <a class="nav-link" href="assignments.php">Weekly<?php if($_SERVER['SCRIPT_NAME']=="/about.php") echo '<span class="sr-only">(current)</span>'; ?></a>
      </li>
      <li class="nav-item dropdown <?php if($_SERVER['SCRIPT_NAME']=="/assignments.php") echo 'active'; ?>">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Week 01</a>
              <a class="dropdown-item" href="#">Week 02</a>
              <a class="dropdown-item" href="/assignmentW03.php">Week 03</a>
            </div>
      </li>
    </ul>
  </div>
</nav>
  