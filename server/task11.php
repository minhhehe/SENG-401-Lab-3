<html>
<body>

  <?php
    var_dump($_POST);
    var_dump($_GET);
    var_dump($_REQUEST);
    $input_school = $_POST["school_data"];
    $input_type = $_POST['type_data'];
    echo $input_type;
    echo "<br>";
    echo $input_school;
   ?>

</body>
</html>
