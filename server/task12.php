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
  $username = 'postgres'; //usually postgres
  $password = "Estelle@88938."; //usually postgres
  $port = 5432;
  $dsn = "pgsql:host=$host; port=$port; dbname=$db; user=$username;
  password=$password";
  try{

    $input_type = $_POST['section_data'];
    echo $input_type;
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    // display a message if connected to the PostgreSQL successfully
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the PDO error mode to Exception

    //prepare the statement
    $statement = $conn->prepare("SELECT * FROM CalgarySchools
      WHERE NAME LIKE :input");
      $tosearch = "%$input_school%";
      $statement->bindParam(":input", $tosearch);
      $statement->execute();
      $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
      $result2 = $statement->fetchAll();
      echo "<br>";
      switch($input_type) {
        case "XML":
          displayXML($result2);
          break;
        case "User Designed Table":
          displayTable($result2);
          break;
        case "JSON":
          displayJSON($result2);
          break;
        case "Comma Separated Values":
          displayCSV($result2);
          break;
      }

    } catch (PDOException $e){
      // report error message
      echo $e->getMessage();
    }
    ?>

  </body>
  </html>
