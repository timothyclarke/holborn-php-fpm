<?php
$title = "Boat Report Form";
$pagetype = "userpage"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
</head>
  <style>
  .tooltip {
      position: relative;
      display: inline-block;
      border-bottom: 1px dotted black;
      opacity: 1;
      font-size: 14px;
  }

  .tooltip .tooltiptext {
      visibility: hidden;
      width: 360px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;

      /* Position the tooltip */
      position: absolute;
      z-index: 1;
      top: -5px;
      left: 105%;
  }

  .tooltip:hover .tooltiptext {
      visibility: visible;
  }
  </style>
<body>
    <?php require 'login/misc/pullnav.php'; ?>
    <div class="container">
      <?php
        if (!empty($_POST)):
          include 'boat_form.posted.php';
        else:
          include 'boat_form.html.php';
        endif;
      ?>
    </div>
</body>
</html>

