<?php
$title = "GPS Marks from Holborn Diver";
$pagetype = "page"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
</head>
<body>
  <div class="container">
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdPmKRoNC4BzWbDlsngEbpBKQ-Av_lQ9w&callback=initMap">
    </script>
  </div>
</body>
</html>
