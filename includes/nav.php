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
      <li class="nav-item dropdown <?php if($_SERVER['SCRIPT_NAME']=="/assignments.php") echo 'active'; ?>">
            <a class="nav-link dropdown-toggle" href="https://murmuring-beyond-32193.herokuapp.com/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assignments</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/assignmentW01.php") echo 'active'; ?>" href="/assignmentW01.ph">Week 01</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/assignmentW02.php") echo 'active'; ?>" href="/assignmentW02.ph">Week 02</a>
              <a class="dropdown-item <?php if($_SERVER['SCRIPT_NAME']=="/assignmentW03.php") echo 'active'; ?>" href="/assignmentW03.php">Week 03</a>
            </div>
      </li>
    </ul>
    <?php
      if($_SERVER['SCRIPT_NAME']=="/assignmentW03.php"){
        echo '<form class="form-inline mt-2 mt-md-0">';
        echo '<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">';
        echo '<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>';
        echo '</form>';
      }
  ?>
  </div>
</nav>