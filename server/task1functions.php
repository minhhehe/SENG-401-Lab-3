<?php

  function displayXML($data) {
    if (count($data) > 0) {
      echo "<?xml version='1.0' encoding='UTF-8'?>";
      echo "<br>";
      echo "<CalgarySchools>";
      echo "<br>";
      foreach ($data as $a_row) {
        foreach ($a_row as $a_row_data => $a_row_data_value) {
          echo "<$a_row_data>";
          echo "$a_row_data_value";
          echo "</$a_row_data>";
        }
        echo "<br>";
      }
      echo "</CalgarySchools>";
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displayTable($data) {
    if (count($data) > 0) {
      echo "<table style='width:100%'>";
      echo "<tr>";
      echo "<th>School Name</th>";
      echo "<th>Type</th>";
      echo "<th>Sector</th>";
      echo "<th>Address_AB</th>";
      echo "<th>City</th>";
      echo "<th>Province</th>";
      echo "<th>Postal_code</th>";
      echo "<th>Longitude</th>";
      echo "<th>Latitude</th>";
      echo "</tr>";

      foreach ($data as $a_row) {
        echo "<tr>";
        foreach ($a_row as $a_row_data => $a_row_data_value) {
          echo "<td>$a_row_data_value</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displayTableMySQL($data) {
      echo "<table style='width:100%'>";
      echo "<tr>";
      echo "<th>School Name</th>";
      echo "<th>Type</th>";
      echo "<th>Sector</th>";
      echo "<th>Address_AB</th>";
      echo "<th>City</th>";
      echo "<th>Province</th>";
      echo "<th>Postal_code</th>";
      echo "<th>Longitude</th>";
      echo "<th>Latitude</th>";
      echo "</tr>";
      // output data of each row
      while($row = $data->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $a_row_data => $a_row_data_value) {
          echo "<td>$a_row_data_value</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
  }

  function displayCSV($data) {
    if (count($data) > 0) {
      $delimiter =";";
      $f = fopen('php://memory', 'w');
      $a_header = ["Name",
        "Type",
        "Sector",
        "Address",
        "City",
        "Province",
        "Postal",
        "Longitude",
        "Latitude"
      ];
      fputcsv($f, $a_header, $delimiter);
      foreach ($data as $a_row) {
        fputcsv($f, $a_row, $delimiter);
      }
      fseek($f, 0);
      fpassthru($f);
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displayJSON($data) {
    if (count($data) > 0) {
      $a_header = ["Name",
        "Type",
        "Sector",
        "Address",
        "City",
        "Province",
        "Postal",
        "Longitude",
        "Latitude"
      ];
      echo json_encode($a_header);
      echo "<br>";
      echo json_encode($data);
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displaySummaryXML($data) {
    if (count($data) > 0) {
      echo "<?xml version='1.0' encoding='UTF-8'?>";
      echo "<br>";
      echo "<CalgarySchools>";
      echo "<br>";
      foreach ($data as $a_row) {
        foreach ($a_row as $a_row_data => $a_row_data_value) {
          echo "<$a_row_data>";
          echo "$a_row_data_value";
          echo "</$a_row_data>";
        }
        echo "<br>";
      }
      echo "</CalgarySchools>";
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displaySummaryTable($data) {
    if (count($data) > 0) {
      echo "<table style='width:100%'>";
      echo "<tr>";
      echo "<th>Type</th>";
      echo "<th>Number</th>";
      echo "</tr>";

      foreach ($data as $a_row) {
        echo "<tr>";
        foreach ($a_row as $a_row_data => $a_row_data_value) {
          echo "<td>$a_row_data_value</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displaySummaryCSV($data) {
    if (count($data) > 0) {
      $delimiter =";";
      $f = fopen('php://memory', 'w');
      $a_header = [
        "Type",
        "Number"
      ];
      fputcsv($f, $a_header, $delimiter);
      foreach ($data as $a_row) {
        fputcsv($f, $a_row, $delimiter);
      }
      fseek($f, 0);
      fpassthru($f);
    } else {
      echo "No school with the above input found <br>";
    }
  }

  function displaySummaryJSON($data) {
    if (count($data) > 0) {
      $a_header = [
        "Type",
        "Number"
      ];
      echo json_encode($a_header);
      echo "<br>";
      echo json_encode($data);
    } else {
      echo "No school with the above input found <br>";
    }
  }

 ?>
