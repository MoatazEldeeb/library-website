<?php
    //Connecting to Database
    $conn = mysqli_connect('localhost','moataz','1234','my_library');

    //Checking connection
    if(!$conn){
        echo 'Connection error ' . mysqli_connect_error();
    }
?>