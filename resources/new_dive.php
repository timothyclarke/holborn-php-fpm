<?php
$title = "New Dive Form";
$userrole = "Dive Manager"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
</head>
<body>
    <?php require 'login/misc/pullnav.php'; ?>
    <div class="container">
      <?php
        if (!empty($_POST)):
          include 'new_dive.posted.php';
        else:
          include 'new_dive.html.php';
        endif;
      ?>
    </div>
</body>
</html>
