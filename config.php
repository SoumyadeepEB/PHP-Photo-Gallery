<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "photo_gallery";

    $link = mysqli_connect($server,$username,$password,$db);

    if (!$link)
    {
        die("Could not connect to database " . mysqli_connect_error());
    }
?>