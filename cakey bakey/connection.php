<?php

//connection to the database
$servername="localhost";
$username="root";
$password="";
$database="cakey-bakey";

//create connection
$conn=mysqli_connect($servername, $username,$password,$database);

//check connection
if(!$conn){
 die("Connection failed:" . mysqli_connect_error());

}
// else{
//    echo "Connection successfull";

//  }

 ?>