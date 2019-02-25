<?php
include "dbConnector.php";
$inputName = $inputFormatByName = $inputFormatBySector = $inputSector = "";
$output = "";
$errorName = "";

function validateInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

/**
 * Get an output based on the desired input format
 * Returns a string representation of the output. Double-spaces and newlines are replaced with their HTML equivalents
 */
function getOutput($queryResults, $format) {
    switch ($format) {
        case "json":
            $output = getJsonOutput($queryResults);
            break;
        case "xml":
            $output = getXmlOutput($queryResults);
            break;
        case "csv":
            $output = getCsvOutput($queryResults);
            break;
        case "table":
            $output = getTableOutput($queryResults);
            break;
        default:
            exit("Requested format '$format' not recognized!");
    }

    return str_replace("  ", "&nbsp;&nbsp;",str_replace("\n", "<br/>", $output));
}

/**
 * Get a JSON-formatted output from a query result
 */
function getJsonOutput($queryResults) {
    return json_encode($queryResults, JSON_PRETTY_PRINT);
}

/**
 * Get an XML-formatted output from a query result.
 * The output is encoded with the htmlspecialchars() function
 */
function getXmlOutput($queryResults) {
    $output = "<results>\n";
    foreach ($queryResults as $result) {
        $output .= "    <result>\n";

        foreach ($result as $colName => $colVal) {
            $output .= "        <" . $colName . ">" . $colVal . "</" . $colName . ">\n";
        }

        $output .= "    </result>\n";
    }

    $output .= "</results>";
    return htmlspecialchars($output);
}

/**
 * Get a CSV-formatted output from a query result
 */
function getCsvOutput($queryResults) {
    // Build header
    $output = implode(",", array_keys($queryResults[0]));
    $output .= "\n";

    $output .= implode("\n", array_map(function($result) { return implode(",", array_values($result)); }, $queryResults));

    return $output;
}

/**
 * Get an HTML table formatted output from a query result
 */
function getTableOutput($queryResults) {
    $output = "<table>";

    // Build header
    $output .= "<tr>";
    foreach (array_keys($queryResults[0]) as $colName) {
        $output .= "<th>" . $colName . "</th>";
    }
    $output .= "</tr>";

    // Build body
    foreach ($queryResults as $result) {
        $output .= "<tr>";
        foreach (array_values($result) as $colVal) {
            $output .= "<td>" . $colVal . "</td>";
        }
        $output .= "</tr>";
    }

    $output .= "</table>";
    return $output;
}

function findSchool($name, $format) {
    $table = "CalgarySchools";
    $nameCol = "name";
    $typeCol = "type";
    $addressCol = "address";

    $query = $GLOBALS["conn"]->prepare("SELECT $nameCol, $typeCol, $addressCol FROM $table WHERE $nameCol LIKE :name");
    $query->bindValue(":name", "%$name%");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all results with only associative indexing
    $GLOBALS["output"] = getOutput($results, $format);
}

function getSectorSummary($sector, $format) {
    $table = "CalgarySchools";
    $nameCol = "name";
    $typeCol = "type";
    $sectorCol = "sector";
    $addressCol = "address";

    $query = $GLOBALS["conn"]->prepare("SELECT $typeCol AS 'Type', COUNT($typeCol) AS 'Count'
            FROM $table
            WHERE $sectorCol = :sector
            GROUP BY $typeCol");
    $query->bindValue(":sector", $sector);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $GLOBALS["output"] = getOutput($results, $format);
}

if ($conn) {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
    exit("Error: Could not establish database connection");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["submitFindSchool"])) {
        if (!empty($_GET["inputName"])) {
            $inputName = validateInput($_GET["inputName"]);
            $inputFormatByName = validateInput($_GET["inputFormatByName"]);
            findSchool($inputName, $inputFormatByName);
        } else {
            $errorName = "* Required";
        }
    } else if (!empty($_GET["submitSectorSummary"])) {
        $inputSector = validateInput($_GET["inputSector"]);
        $inputFormatBySector = validateInput($_GET["inputFormatBySector"]);
        getSectorSummary($inputSector, $inputFormatBySector);
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

                        <input type="radio" name="inputFormatByName" value="json"
                        <?php echo ($inputFormatByName == "json" || $inputFormatByName == "") ? 'checked="checked"' : ''; // Save last checked or default if none given ?>
                        >JSON<br/>

                        <input type="radio" name="inputFormatByName" value="xml"
                        <?php echo ($inputFormatByName == "xml") ? 'checked="checked"' : ''; // Save last checked ?>
                        >XML<br/>

                        <input type="radio" name="inputFormatByName" value="csv"
                        <?php echo ($inputFormatByName == "csv") ? 'checked="checked"' : ''; // Save last checked ?>
                        >CSV<br/>

                        <input type="radio" name="inputFormatByName" value="table"
                        <?php echo ($inputFormatByName == "table") ? 'checked="checked"' : ''; // Save last checked ?>
                        >Table<br/>
                        <br/>

                        <input type="submit" name="submitFindSchool" value="Submit">
                    </form>
                </div>
                <br>
                <div class="inputBlock">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                        <h3>Get Summary by Sector</h3>
                        <p>
                            Sector:
                            <select name="inputSector">
                                <option value="nw"
                                <?php echo ($inputSector == "nw" || $inputSector == "") ? 'selected="selected"' : ''; // Save last checked ?>
                                >NW</option>

                                <option value="ne"
                                <?php echo ($inputSector == "ne") ? 'selected="selected"' : ''; // Save last checked ?>
                                >NE</option>

                                <option value="sw"
                                <?php echo ($inputSector == "sw") ? 'selected="selected"' : ''; // Save last checked ?>
                                >SW</option>

                                <option value="se"
                                <?php echo ($inputSector == "se") ? 'selected="selected"' : ''; // Save last checked ?>
                                >SE</option>
                            </select>
                        </p>

                        <input type="radio" name="inputFormatBySector" value="json"
                        <?php echo ($inputFormatBySector == "json" || $inputFormatBySector == "") ? 'checked="checked"' : ''; // Save last checked or default if none given ?>
                        >JSON<br/>

                        <input type="radio" name="inputFormatBySector" value="xml"
                        <?php echo ($inputFormatBySector == "xml") ? 'checked="checked"' : ''; // Save last checked ?>
                        >XML<br/>

                        <input type="radio" name="inputFormatBySector" value="csv"
                        <?php echo ($inputFormatBySector == "csv") ? 'checked="checked"' : ''; // Save last checked ?>
                        >CSV<br/>

                        <input type="radio" name="inputFormatBySector" value="table"
                        <?php echo ($inputFormatBySector == "table") ? 'checked="checked"' : ''; // Save last checked ?>
                        >Table<br/>
                        <br/>
                        <input type="submit" name="submitSectorSummary" value="Submit">
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
