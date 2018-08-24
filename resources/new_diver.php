<?php
$title = "New Diver Form";
$pagetype = "userpage"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
</head>
<body>
    <?php require 'login/misc/pullnav.php'; ?>
    <div class="container">
      <?php
        if (!empty($_POST)):
          include 'new_diver.posted.php';
        else:
          include 'new_diver.html.php';
        endif;
      ?>
    </div>
</body>
</html>
