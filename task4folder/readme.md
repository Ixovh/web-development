## fourth task  

* **Overview**  
    * this task is about how to bulid speech-to-text web page that takes speech as an argument then convert it to text and save it to database using php code  

* **Dependencies**  
    * XAMMP
    * PHP 7.x or higher
    * MySQL database connection
    * JavaScript  
        * Web Speech API
        * Fetch API


* **files we have**  
    * first file we have is index.html that contain the struture for web page 
        * the body its link to speech-to-text.js that will covert speech to text
        * also its link to controller.php that will save text to databse  

    * second file we its design.css that contain the design of the page  

    * third file we is speech-to-text it consist of several functions (methods)  
        * first of all i use **webkitSpeechRecognition** to convert the button to be able to starts the recording   

        * second when its starts recording it will display the converted speech in teaxarea tag

        * last thing it will sends the text to controller.php to store it in database using this code:  
        ```JS
            function sendRequest(transcript) {
                fetch('controller.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `text=${transcript}`
                    })
                .then(response => response.text())
                .then(data => {
                document.getElementById('output').value = data;
                });
            }
        ```
        here will search on file named controller.php and it will pass the text through post method  

        * last file we have its controller.php and its consist of several blocks  
            * first block its setup the conncetion with database to prepare it to store data through this code:  
            ```php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $DBname = "robot";
                $conn = mysqli_connect($servername,$username,$password,$DBname);
                if(!$conn){
                    die("connection failed". mysqli_connect_error().'<br>');
                }
            ```  

            * second block is receive the converted text from JavaSript   
            ```php
                $text = $_POST['text'];
                $text = trim(mysqli_real_escape_string($conn, $text));
            ```  
            here trim function and mysqli_real_escape_string it will escape any special characters like **'\n'**  
            * last block of code is store the text into database using this command  
            ```php
                $sql = "INSERT INTO conSpeech (speech) VALUES ('$text')";
                if(mysqli_query($conn,$sql)){
                    echo $text;
                }    
                else {
                    echo "Error" ;
                }
            ```
