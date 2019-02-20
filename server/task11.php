<html>
<body>

  <?php

    $host='localhost';
    $db = 'SENG401'; //use pgadmin to create a database e.g. SENG401
    $username = 'postgres'; //usually postgres
    $password = "Estelle@88938."; //usually postgres
    $port = 5432;
    $dsn = "pgsql:host=$host; port=$port; dbname=$db; user=$username;
    password=$password";
    try{
      $input_school = $_POST["school_data"];
      $input_type = $_POST['type_data'];
      echo $input_type;
      //JSON
      echo "<br>";
      echo $input_school;
      //value= zzzz
      echo "<br>";
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
      echo $result;
      echo "<br>";
      } catch (PDOException $e){
      // report error message
      echo $e->getMessage();
    }
    ?>

</body>
</html>
