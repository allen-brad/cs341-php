<?php
//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dbConnection() {try
    {
      $dbUrl = getenv('DATABASE_URL');

      $dbOpts = parse_url($dbUrl);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

      $dbConnection = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

      $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dbConnection;
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
}


function getScriptureById($scriptureId){
    $db = dbConnection();
    $sql = 'SELECT * FROM Scriptures WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $scriptureId, PDO::PARAM_INT);
    $stmt->execute();
    $scripture = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scripture;
  }

  function getScripturesByBook($chapter){
    $db = dbConnection();
    $sql = 'SELECT * FROM Scriptures WHERE chapter = :chapter';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':chapter', $chapter, PDO::PARAM_STR);
    $stmt->execute();
    $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scriptures;
   }
   function getScripturesByBook($verse){
    $db = dbConnection();
    $sql = 'SELECT * FROM Scriptures WHERE book = :verse';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':verse', $verse, PDO::PARAM_STR);
    $stmt->execute();
    $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scriptures;
   }
   function getScripturesByBook($book){
    $db = dbConnection();
    $sql = 'SELECT * FROM Scriptures WHERE book = :book';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->execute();
    $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scriptures;
   }

   function getAllScriptures(){
    $db = dbConnection();
    $sql = 'SELECT * FROM Scriptures';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $allScriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //return $allScriptures;

    foreach ($allScriptures as $scripture) {
      if ($scripture['book']) {
          echo '<p><strong>'.$scripture['book'];
      }
      if ($scripture['chapter']) {
          echo ' '.$scripture['chapter'].':';
      }
      if ($scripture['verse']) {
        echo $scripture['verse'].'</strong> ';
      }
      //if ($scripture['content']) {
       // echo $scripture['content'].'</p> ';
      //}
    }
   }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Week 05 Team Assignment">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CS341 W05 Team Assignment</title>
</head>

<body>
<?php


    echo '<div>All Scriptures: <br>';
    getAllScriptures();

    echo '<div>Scriptures by ID: <br>';
    print_r (getScriptureById(1)).'</div>';

    echo '<div>Scriptures By Book: <br>';
    print_r (getScripturesByBook('Mosiah')).'</div>';

    
?>
</body>
</html>