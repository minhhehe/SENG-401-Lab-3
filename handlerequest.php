<?php
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

echo getImageOutputs(getFlickrPhotos(-114, 50, -113, 51));

?>
