<?php
  /*
    FUCK IT JUST USE WORKBENCH SCREEEEEEEEEEEE
  */
  $servername = "localhost";
  $username = "minh";
  $password = "password";
  $dbname = "SENG401";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  $sql = "DROP TABLE IF EXISTS CalgarySchools";
  echo "<br>";
  if ($conn->query($sql) === TRUE) {
    echo "Table CalgarySchools cleaned successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  echo "<br>";
  $sql = "CREATE TABLE CalgarySchools (name varchar(128),
  type varchar(64), sector varchar(2), address varchar(256),
  city varchar(16), province varchar(16), postalcode varchar(7),
  longitude double precision, latitude double precision)";
  if ($conn->query($sql) === TRUE) {
    echo "Table CalgarySchools created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  echo "<br>";
  echo "<br>";
?>
