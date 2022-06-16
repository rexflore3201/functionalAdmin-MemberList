<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");
if(!$conn){
    die('error in conn' . mysqli_error($conn));
}

$userid = $_GET['userid'];

$sql = "delete from users where userid = $userid";
if(mysqli_query($conn, $sql)){
    header('location: index.php');
}else{
    echo mysqli_error($conn);
}

?>