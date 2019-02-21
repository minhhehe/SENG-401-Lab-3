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
  $db = 'seng401'; //use pgadmin to create a database e.g. SENG401
  $username = $_POST["username"];
  $password = $_POST["password"];
  $port = 5432;
  $dsn = "pgsql:host=$host; port=$port; dbname=$db; user=$username;
  password=$password";
  try{
    $section_type = $_POST['section_data'];
    $input_type = $_POST['type_data'];
    $conn = new mysqli($host, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    // set the PDO error mode to Exception
    // prepare the statement
    // $statement = $conn->prepare("SELECT * FROM CalgarySchools
    //   WHERE NAME LIKE ?");
       $tosearch = "'%".$input_school."%'";
    //   $statement->bind_param("s", $tosearch);
    //   $result2 = $statement->execute();

      $sql = "SELECT TYPE, COUNT(TYPE) FROM CalgarySchools
       WHERE Sector = $section_type GROUP BY TYPE";
      $result = $conn->query($sql);
      if (!$result) {
        echo "Nothing found";
      } else {
        if ($result->num_rows > 0) {
          echo "<br>";
          switch($input_type) {
            case "XML":
              displaySummaryXMLMySQL($result);
              break;
            case "User Designed Table":
              displaySummaryTableMySQL($result);
              break;
            case "JSON":
              displaySummaryJSONMySQL($result);
              break;
            case "Comma Separated Values":
              displaySummaryCSVMySQL($result);
              break;
          }
      // output data of each row
        while($row = $result->fetch_assoc()) {
            var_dump($row);
          }
        } else {

          echo "0 results";
        }
      }





    } catch (PDOException $e){
      // report error message
      echo $e->getMessage();
    }
    ?>

  </body>
  </html>
