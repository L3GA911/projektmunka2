<?php
    //Session lebontása
	session_start();
    if(session_destroy()) {
        // Vissza a loginhoz
        header("Location: login.php");
    }
?>
