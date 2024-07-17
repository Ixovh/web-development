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


    /*              INSERTING RECORD               */
if(isset($_POST['dir'])){
        
        $dir = $_POST['dir'];
        $sql = "INSERT INTO robotmove (direction) 
        VALUES ('$dir')";

        if(mysqli_query($conn,$sql)){
            switch ($dir) {
                case 'stop':
                    echo 'the robot has stopted';
                    break;
                case 'right':
                        echo 'the robot has move right';
                        break;
                case 'left':
                        echo 'the robot has move left';
                        break;
                case 'front':
                        echo 'the robot has move forward';
                        break;
                case 'back':
                        echo 'the robot has move backward';
                default:
                    echo 'the robot is not responding';
                    break;
            }
        
        }
        else{
            echo "Error: failed to move ".'<br>';
        }
}
else{
    echo "robot is not responsing <br>";
}
header("Refresh: 3; url=index.html");
exit;
?>