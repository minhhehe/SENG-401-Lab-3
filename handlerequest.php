<?php
include_once "dbConnector.php"; // Load up the dbConnector information

if ($conn) {
    echo "Connection to $db has succeeded!";
} else {
    echo "Connection to $db has failed!";
}
?>
