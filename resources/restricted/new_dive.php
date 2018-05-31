<!DOCTYPE html>
<html>
  <head>
    <title>New Dive</title>
    <style>
      td {
        padding: 6px;
      }
    </style>
  </head>
  <body>
<?php
  if (!empty($_POST)):
    include 'new_dive.posted.php';
  else:
    include 'new_dive.html.php';
  endif;
?>
  </body>
</html>

