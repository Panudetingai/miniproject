<?php
    $conn = new mysqli('localhost', 'root', '' , 'miniproject');

    if($conn->connect_errno){
        $conn->connect_error;
    }else{
        mysqli_query($conn, "SET NAMES utf8");
    }
?>