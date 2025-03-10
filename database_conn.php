<?php 
    $dbConn = new mysqli('localhost', '*****', '*****', '*****');
    if ($dbConn->connect_error){
        echo"<p>Connection failed: ".$dbConn->connect_error."</p>\n";
    }
?>