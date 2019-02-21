

 <?php
 /*
     Database connection configuration file
     Remember to rename this file to dbConnector.php
  */
  $pathToFile = 'G:\download\CalgarySchools.csv';
  $host='localhost';
  $db = 'SENG401'; //use pgadmin to create a database e.g. SENG401
  $username = 'postgres'; //usually postgres
  $password = "Estelle@88938."; //usually postgres
  $port = 5432;
  $dsn = "pgsql:host=$host; port=$port; dbname=$db; user=$username;
  password=$password";
  try{
    // create a PostgreSQL database connection
    $conn = new PDO($dsn);
    // display a message if connected to the PostgreSQL successfully
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the PDO error mode to Exception
    $sql = "DROP TABLE IF EXISTS CalgarySchools";
    $conn->exec($sql);
    echo "checked successfully <br>";

    $sql = "CREATE TABLE CalgarySchools (name varchar(128),
    type varchar(64), sector varchar(2), address varchar(256),
    city varchar(16), province varchar(16), postalcode varchar(7),
    longitude double precision, latitude double precision)";
    $conn->exec($sql);
    echo "created table successfully <br>";

    $sql = "COPY CalgarySchools FROM 'G:\download\CalgarySchools.csv' WITH DELIMITER ',' CSV HEADER";
    $conn->exec($sql);
    echo "Copied successfully <br>";

    // sql to create table, drop if it already exists
    if($conn){
      echo "Connected to the <strong>$db</strong> database
      successfully!";
    }
  }catch (PDOException $e){
    // report error message
  echo $e->getMessage();
  }
 ?>
