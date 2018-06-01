<?php
$title = "Sites dived by Holborn Divers in 2018";
$pagetype = "page"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
</head>
<body>
  <div class="container" style="height: 600px; ">
    <iframe src='<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/resources/dived_sites_frame.php' ?>' width="100%" height="100%"></iframe>
  </div>
</body>
</html>
