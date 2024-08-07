## third tasks  
* **overview**
    * This task is based on the second task which uses PHP script to fetch the last movement of the robot but in this task we will use ESP32 and connect it with PHP file and print the last movement of the robot
* **Dependencies**
    * XAMPP
    * PHP 7.x or higher
    * MySQL database connection
    * Arduino IDE 1.18.* or above

* **files we have**
    * first file we have is d.php this file holding the connection to database also carry the query to fetch robot' last move and print out
    
    ``` php
        $sql = "SELECT /*YOUR Column*/ FROM /*YOUR TABLE*/ ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        $last_movement = "No movements recorded yet";

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_movement = $row['direction'];
        }

        $conn->close();

        echo $last_movement;
    ```
    * second file we have is MySQL.ion its the ESP32 code that will connect wifi to get access to your PC first to with through this block of code in void setup  
    but before you write any thing in void setup make sure you import these two libraries  
     
    ```cpp
    #include <HTTPClient.h>
    #include <WiFi.h>
    ```
    here is the void setup
    ```cpp
        void setup() {
            Serial.begin(115200); //HERE THE OUTPUT WILL BE PRINTED OUT
            WiFi.begin(/*YOUR WIFI NAME*/, /*PASSWORD OF THE WIFI*/);
            while (WiFi.status() != WL_CONNECTED) {
                delay(1000);
                Serial.println("Connecting to WiFi...");
            }
        }
    ```
    then the second block of code is void loop this block responsible for the connect to php script and print out what is the result of this script
    ```cpp
        http.begin("http://YOUR_IP_ADREESS/PROJECT_FOLDER/FILE_NAME.php");

        int httpResponseCode = http.GET();
        if (httpResponseCode == 200) {
            String response = http.getString();
            Serial.print("Received data: ");
            Serial.println(response);
        } else {
            Serial.print("Error fetching data. HTTP response code: ");
            Serial.println(httpResponseCode);
        }
    ```
