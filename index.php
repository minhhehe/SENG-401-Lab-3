<?php
include_once "dbConnector.php";

$inputName = $inputFormat = $inputSector = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
            $(function() {
                $.get("handlerequest.php", function(data, status) {
                    $("#container").append("<p>" + data + "</p>");
                });
            });
        </script>
    </head>
    <body>
        <div id="banner">
            <h1>SENG 401 - Lab 3</h1>
            <p>A :() { :|:& };: production</p>
        </div>
        <div id="container">
            <div id="leftContainer">
                <div class="schoolInputBlock">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <p>School name: <input type="text" name="inputName" value="<?php echo $inputName; ?>"></p>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div id="rightContainer">
                <div id="schoolOutputBlock">
                    <p>The output</p>
                </div>
            </div>
        </div>
    </body>
</html>
