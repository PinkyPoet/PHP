<?php
    session_start();

    include 'connection.php';
    include 'functions.php';

    $user_data = check_login($conn);
?>

<!DOCTYPE html>  
<html>
    <head>
        <title>Garage Index Page</title>
        <link rel="stylesheet" href="https://classless.de/classless.css">
    </head>
    <body>
        <a href="logout.php">Logout</a>
        <h1>Dashboard Page</h1> <br>

        Hello, <?php echo $user_data['username']; ?> <!--Displays users name-->
    </body>
</html>