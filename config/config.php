<?php 
$connect = mysqli_connect("localhost","root","","my_project");

// Check connection
if (mysqli_connect_errno()){
    echo "connection failure : " . mysqli_connect_error();
}

?>