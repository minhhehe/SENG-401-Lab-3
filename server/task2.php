<?php
  $coordinates = $_POST['coordinates'];
  $display_selected = $_POST['displayOption'];
  $params = array(
  'api_key' => '334ebb0707c2e188c4522643802154df',
  'method' => 'flickr.photos.search',
  'bbox' => $coordinates,
  'extras' => 'geo',
  'has_geo' => '1',
  'per_page' => '20',
  'page' => '1',
  'format' => 'json',
  'nojsoncallback' => '1',
  );
  $encoded_params = array();
  foreach ($params as $k => $v){
    $encoded_params[] = urlencode($k).'='.urlencode($v);
  }
  $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);
  $rsp = file_get_contents($url);
  $rsp = str_replace( 'jsonFlickrApi(', '', $rsp );
  $rsp = substr( $rsp, 0, strlen( $rsp ) );
  $rsp2 = json_decode($rsp, true);
  $photos = $rsp2['photos']['photo'];

  switch ($display_selected) {
    case "JSON":
      echo $rsp;
      break;
    case "Pictures":
      for ($i = 0; $i<20; $i++) {
        $imgsrc = 'https://farm'.$photos[$i]["farm"].'.staticflickr.com/'.
        $photos[$i]["server"] . '/'.$photos[$i]["id"].'_'.$photos[$i]["secret"].'.jpg';
        echo '<img src="'.$imgsrc.'">';
      }
      break;
  }
 ?>
