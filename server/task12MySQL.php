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
  $db = 'seng401'; //use mysql workbench to create a database e.g. SENG401
  $username = $_POST["username"];
  $password = $_POST["password"];
  try{
    $section_type = $_POST['section_data'];
    $input_type = $_POST['type_data'];
    $conn = new mysqli($host, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    echo "<br>";
    $section_type = "'".$section_type."'";
      $sql = "SELECT TYPE, COUNT(TYPE) FROM CalgarySchools WHERE Sector = $section_type GROUP BY TYPE";
      if ($section_type === "NULL") {
        $sql = "SELECT TYPE, COUNT(TYPE) FROM CalgarySchools
         WHERE Sector IS NULL GROUP BY TYPE");
      }
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
            case "Table":
              displaySummaryTableMySQL($result);
              break;
            case "JSON":
              displaySummaryJSONMySQL($result);
              break;
            case "CSV":
              displaySummaryCSVMySQL($result);
              break;
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
