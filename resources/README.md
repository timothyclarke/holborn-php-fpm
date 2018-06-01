# Adding content to this site

## Add to menu
Edit login/partials/barmenu.php and link the page

## Require login
We need to set the page type to a userpage eg

```
<?php
$title = "New Dive Form";
$pagetype = "userpage"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
```

## Framing correctly
Put the content within the 'container' class

```
</head>
<body>
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
```
