## first tasks  
* **overview**
    * This task is a web-based interface for controlling a robot's movement. The interface allows users to control the robot's direction (left, right, forward, backward) and store its movements in a database

* **Dependencies**
    * XAMPP
    * PHP 7.x or higher
    * MySQL database connection

* **files we have**
    * first file we have is index.html is holding the interface structure   
        * **first thing** is the head that contain:  
            * charset=UTF-8 is to handle page characters correcrtly
            * viewport is to ensure that page displays correctly on different devices  
            * the link to the css file that contains the design for web page

        * **second thing** is the body that contain:  
            * form that act like a controller for robot movement, sends the robot move  to database to store its movement and its link to a file called controller.  php that handle the data moving from the buttons to data base

            * a second form to retreive the robot's last move from database and its     link to last-move.php that gets the data from database and prints the last

    * second file we have is The design.css file defines the visual styling and layout  of the index.html page 

    * third file is controller.php it is divided into three parts  
        * first part is connection to database through  
            ``` php
                $conn = mysqli_connect($servername,$username,$password,$DBname);
                if(!$conn){
                    die("connection failed". mysqli_connect_error().'<br>');
                }
                else{
                    echo 'conncted successfully <br>';
                }
            ```
        * second part is store the data into database using this command
        ``` php
            if(isset($_POST['dir'])){
            
            $dir = $_POST['dir'];
            $sql = "INSERT INTO robotmove (direction) 
            VALUES ('$dir')";
            }
            else{
                echo "robot is not responsing <br>";
            }
        ```
        * third part is to print out where the does it move and redirecting to index.   html after 3 seconds
        ``` php
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

            header("Refresh: 3; url=index.html");
            exit;
        ```
    * last file we have is last-move.php is print out the last-move of the robot using  this commnad and then redirecting to index.html after 3 seconds
    ``` php
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
    ```
