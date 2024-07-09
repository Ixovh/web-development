<?php

$servername = "localhost";
$username = "root";
$password = "";
$DBname = "robot";
$conn = mysqli_connect($servername,$username,$password,$DBname);
if(!$conn){
    die("connection failed". mysqli_connect_error().'<br>');
}
else{
    echo 'conncted successfully <br>';
}

$sql = 'SELECT direction FROM robotmove ORDER BY id DESC LIMIT 1';
$result = mysqli_query($conn, $sql);

// Fetch the result
if(mysqli_num_rows($result) == 0){
    echo "the robot has not moved".'<br>';
}
else{
    $row = mysqli_fetch_assoc($result);
    echo $row['direction'];   
}

header("Refresh: 3; url=index.html");
exit;
?>
