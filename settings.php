<?php
    /*
    //live server connection
    $host = "localhost";
    $user = "id16501827_s103698709";
    $pwd = "T)1k5bY^&A&b|PMa";
    $sql_db = "id16501827_s103698709_db";
    */

    
    // local server connection
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $sql_db = "s103698709_db";
    $db = @mysqli_connect($host,$user,$pwd,$sql_db);
    
?>