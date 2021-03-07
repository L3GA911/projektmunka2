<?php
//sql kapcsolat
    $con = mysqli_connect("51.75.68.49","projekt2","szechenyi","projekt2");

    if (mysqli_connect_errno()){
        echo "Sql hiba: " . mysqli_connect_error();
    }
?>
