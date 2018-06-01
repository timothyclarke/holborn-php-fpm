<?php
$title = 'Resources Home';
include "login/misc/pagehead.php";
?>
</head>
<body>
    <div class="container">

<?php

$auth = new AuthorizationHandler;

if ($auth->isLoggedIn()){

    echo '<div class="jumbotron text-center"><h1>Hi, '.$_SESSION['username'].'!</h1>
    <p>Click on your username in the top right corner to expose menu options</p></div>
    <div class="col-lg-2"></div><div class="col-lg-8">
    <h2>Menu Items:</h2>

    <p><b><em>Edit Profile</em></b> - Edit your own user profile information including your name, contact info, avatar, etc</p>

    <p><b><em>Account Settings</em></b> - Change your email address and/or password</p>';

    if ($auth->isAdmin()) {
        echo '<p><b><em>Verify/Delete Users</em></b> - Admin mass verify or delete new user requests</p>';
    }

    if ($auth->isSuperAdmin()) {
        echo '<p><b><em>Edit Site Config</em></b> - Superadmin edit site configuration in one page</p>';
        echo '<p><b><em>Mail Log</em></b> - Superadmin mail status logging</p>';
    }

} else {

    echo '<div class="jumbotron text-center"><h1 class="display-1">Resources Homepage</h1>
    <small>This is the holborn resources home. You are currently signed out.</small><br><br>
    <p>You can sign in or create a new account by clicking "Sign In" in the top right corner!</p>';
}

?>

        </div><div class="col-lg-2"></div>



    </div>
</body>
</html>
