<!DOCTYPE html>
<html>
<head>
  <style>
  table, th, td {
    border: 1px solid black;
  }
  </style>
</head>

<body>

  <?php
  include 'task1functions.php';
  $host='localhost';
  $db = 'SENG401'; //use pgadmin to create a database e.g. SENG401
  $username = $_POST["username"];
  $password = $_POST["password"];
  $port = 5432;
  $dsn = "pgsql:host=$host; port=$port; dbname=$db; user=$username;
  password=$password";
  try{

    $section_type = $_POST['section_data'];
    $input_type = $_POST['type_data'];
    echo $input_type;
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    // display a message if connected to the PostgreSQL successfully
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the PDO error mode to Exception

    //prepare the statement
    $statement = $conn->prepare("SELECT TYPE, COUNT(TYPE) FROM CalgarySchools
     WHERE Sector = :input GROUP BY TYPE");
      $statement->bindParam(":input", $section_type);
      if ($section_type === "NULL") {
        $statement = $conn->prepare("SELECT TYPE, COUNT(TYPE) FROM CalgarySchools
         WHERE Sector IS NULL GROUP BY TYPE");
      }
      $statement->execute();

      $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
      $result2 = $statement->fetchAll();
      echo "<br>";
      switch($input_type) {
        case "XML":
          displaySummaryXML($result2);
          break;
        case "Table":
          displaySummaryTable($result2);
          break;
        case "JSON":
          displaySummaryJSON($result2);
          break;
        case "CSV":
          displaySummaryCSV($result2);
          break;
      }

    } catch (PDOException $e){
      // report error message
      echo $e->getMessage();
    }
    ?>

  </body>
  </html>
