<?php
function validateInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

/**
 *  Get 20 photos from Flickr inside the given corodinates
 *  Returns the JSON response from the Flickr API
 */
function getFlickrPhotos($leftLong, $bottomLat, $rightLong, $topLat): string {
    $API_KEY = "334ebb0707c2e188c4522643802154df";
    $bbox = "$leftLong,$bottomLat,$rightLong,$topLat";
    $params = array(
        "api_key" => $API_KEY,
        "method" => "flickr.photos.search",
        "bbox" => $bbox,
        "extras" => "geo",
        "has_geo" => "1",
        "per_page" => "20",
        "page" => "1",
        "format" => "json",
        "nojsoncallback" => "1"
    );

    $url = "https://api.flickr.com/services/rest/?" . http_build_query($params);
    return file_get_contents($url);
}

function getImageOutputs($responseData) {
    $photos = json_decode($responseData)->photos->photo;
    $output = "";

    foreach ($photos as $photo) {
        $imgSrc = "https://farm"
                . $photo->farm
                . ".staticflickr.com/"
                . $photo->server
                . "/"
                . $photo->id
                . "_"
                . $photo->secret
                . ".jpg";

        $output .= "<img src='$imgSrc'/>";
    }

    return $output;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["requestType"])) {
        $requestType = validateInput($_GET["requestType"]);
    } else {
        exit("Error: Missing requestType parameter.");
    }

    if (isset($_GET["leftLong"])) {
        $leftLong = validateInput($_GET["leftLong"]);
    }

    if (isset($_GET["bottomLat"])) {
        $bottomLat = validateInput($_GET["bottomLat"]);
    }

    if (isset($_GET["rightLong"])) {
        $rightLong = validateInput($_GET["rightLong"]);
    }

    if (isset($_GET["topLat"])) {
        $topLat = validateInput($_GET["topLat"]);
    }


    $resultData = getFlickrPhotos($leftLong, $bottomLat, $rightLong, $topLat);

    switch ($requestType) {
        case "photos":
            echo getImageOutputs($resultData);
            break;
        case "json":
            echo htmlspecialchars($resultData);
            break;
        default:
            exit("Error: requestType $requestType not recognized");
    }
}

?>
