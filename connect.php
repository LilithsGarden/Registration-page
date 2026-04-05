<?php
$HOSTNAME='localhost';
$USERNMAE='root';
$PASSWORD='';
$DBNAME='signupforms';

$conn=mysqli_connect($HOSTNAME,$USERNMAE,$PASSWORD,$DBNAME);

if(!$conn){
    die(mysqli_error($conn));
}else{
    
}

?>