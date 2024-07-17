<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname = "robot";
    $conn = mysqli_connect($servername,$username,$password,$DBname);
    if(!$conn){
        die("connection failed". mysqli_connect_error().'<br>');
    }


    $text = $_POST['text'];
    $text = trim(mysqli_real_escape_string($conn, $text));

    $sql = "INSERT INTO conSpeech (speech) VALUES ('$text')";

    if(mysqli_query($conn,$sql)){
        echo $text;
        
    }    
    else {
        echo "Error" ;
    }
