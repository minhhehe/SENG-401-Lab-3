<?php
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
?>
