<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {lat: 50.615, lng: -1.816}
        });

        var ctaLayer = new google.maps.KmlLayer({
          url: '<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/resources/all_sites_kml.php?ver=' . time() ?>' ,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdPmKRoNC4BzWbDlsngEbpBKQ-Av_lQ9w&callback=initMap">
    </script>
  </body>
</html>
