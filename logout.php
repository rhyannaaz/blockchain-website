<?php
    // This page destroys the session and redirects to the login page
    // Access session storage
    session_start(); 
    // Destroy session
    if (session_destroy()) {
        header("location: login.php");
    }
?>