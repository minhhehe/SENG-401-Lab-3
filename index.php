<?php
include "dbConnector.php";
$inputName = $inputFormat = $inputSector = "";
$output = "";
$errorName = "";

function validateInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function findSchool($name, $format) {
    $table = "CalgarySchools";
    $nameCol = "name";

    $query = $GLOBALS['conn']->prepare("SELECT $nameCol FROM $table WHERE $nameCol LIKE :name");
    $query->bindValue(":name", "%$name%");
    $query->execute();
    $results = $query->fetchAll();

    echo "<br/> Results are: ";
    var_dump($results);
}

if ($conn) {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
    exit("Error: Could not establish database connection");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["submitFindSchool"])) {
        if (!empty($_GET["inputName"])) {
            $inputName = validateInput($_GET['inputName']);
            $inputFormat = validateInput($_GET['inputFormat']);
            findSchool($inputName, $inputFormat);
        } else {
            $errorName = "* Required";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SENG 401 - Lab 3</title>
        <link rel="stylesheet" href="style.css"></link>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            // $(function() {
            //     $.get("handlerequest.php", function(data, status) {
            //         $("#container").append("<p>" + data + "</p>");
            //     });
            // });
        </script>
    </head>
    <body>
        <div id="banner">
            <h1>SENG 401 - Lab 3</h1>
            <p>A :() { :|:& };: production</p>
        </div>
        <div id="container">
            <div id="leftContainer">
                <div class="inputBlock">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                        <h3>Find School</h3>
                        <p>
                            School name:
                            <input type="text" name="inputName" value="<?php echo $inputName; ?>">
                            <span class="error"><?php echo $errorName; ?></span>
                        </p>

                        <input type="radio" name="inputFormat" value="json"
                        <?php echo ($inputFormat == "json" || $inputFormat == "") ? 'checked="checked"' : ''; // Save last checked or default if none given ?>
                        >JSON<br/>

                        <input type="radio" name="inputFormat" value="xml"
                        <?php echo ($inputFormat == "xml") ? 'checked="checked"' : ''; // Save last checked ?>
                        >XML<br/>

                        <input type="radio" name="inputFormat" value="csv"
                        <?php echo ($inputFormat == "csv") ? 'checked="checked"' : ''; // Save last checked ?>
                        >CSV<br/>

                        <input type="radio" name="inputFormat" value="table"
                        <?php echo ($inputFormat == "table") ? 'checked="checked"' : ''; // Save last checked ?>
                        >Table<br/>
                        <br/>

                        <input type="submit" name="submitFindSchool" value="Submit">
                    </form>
                </div>
            </div>
            <div id="rightContainer">
                <div id="outputBlock">
                    <?php echo $output; ?>
                </div>
            </div>
        </div>
    </body>
</html>
