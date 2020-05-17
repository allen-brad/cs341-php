<?php
//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function dbConnect(){
    try
    {
      $dbUrl = getenv('DATABASE_URL');
    
      $dbOpts = parse_url($dbUrl);
    
      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');
    
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
}



function getScriptureById($scriptureId){
    dbConnect();
    $sql = 'SELECT * FROM Scriptures WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $scriptureId, PDO::PARAM_INT);
    $stmt->execute();
    $scripture = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scripture;
  }

  function getScripturesByBook($book){
    dbConnect();
    $sql = 'SELECT * FROM Scriptures WHERE book = :book';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->execute();
    $scriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $scriptures;
   }
   
   dbConnect();
   $sql = 'SELECT * FROM Scriptures';
   $stmt = $db->prepare($sql);
   $stmt->execute();
   $allScriptures = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();

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
    print_r ($allScriptures).'<br>';
    print_r (getScriptureById(1)).'<br>';
    print_r (getScripturesByBook('Mosiah')).'<br>';
?>
</body>
</html>