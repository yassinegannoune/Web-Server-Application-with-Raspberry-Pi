<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/0a2599193e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>My Web Page</title>
    <style>
        /* Styling for the status div */
        #status {
            background-color: cyan;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #img_s img {
            position: absolute;
            width: px;
            height: 58px;
            margin-right: 10px;
        }
        #status h1 {
            margin: 0;
        }
    
        #navbar {
            background-color: #ff6200;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        #navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        #navbar ul li {
            margin-right: 10px;
        }
        #navbar ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 5px;
            transition: background-color 0.3s ease;
        }
        #navbar ul li a:hover {
            background-color: #cc00c2;
        }
        /* Styling for the content */
        #content {
            padding-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;

        }
        
        #weatherTable {
        border-collapse: collapse;
        width: 100%;
    }

         #weatherTable th,
         #weatherTable td {
        padding: 10px;
        text-align: left;
        }

         #weatherTable th {
        background-color: #f2f2f2;
        }
        .section {
            display: none;
            border: 3px solid black;
        }
        .section.active {
            display: block;
        }
        
     
        #exit-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>

        window.onload = function() {
            var sections = document.getElementsByClassName('section');
            sections[0].classList.add('active');
            var navbarLinks = document.getElementsByTagName('a');
            for (var i = 0; i < navbarLinks.length; i++) {
                navbarLinks[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = document.querySelector(this.getAttribute('href'));
                    for (var j = 0; j < sections.length; j++) {
                        sections[j].classList.remove('active');
                    }
                    target.classList.add('active');
                });
            }
        }
        
    </script>
</head>
<body>
    <div id="img_s">
        <img src="img.png" alt="Logo"">
    </div>
    <div id="status">
        <h1>the raspyberry pi operations/web_server</h1>
    </div>
    <div id="navbar">
        <ul>
            <li><a href="#section1"><i class="fa fa-house"></i></a></li>
            <li><a href="#section2"><i class="fa fa-lightbulb"></i> LED</a></li>
            <li><a href="#section3"><i class="fa fa-compass"></i>Servomotor</a></li>
            <li><a href="#section4"><i class="fa fa-display"></i> LCD 4</a></li>
            <li><a href="#section5"><i class="fa fa-temperature-three-quarters"></i>dht11 </a></li>
            <li><a href="#section6"><i class="fa fa-history"></i> history</a></li>
            <li><a href="#section7"><i class="fa fa-circle-info"></i> infos</a></li>
        </ul>
    </div>
    <div id="content">
        <div id="section1" class="section active" style="font-size: 23px;">
            <h2>Welcome to your web server</h2>
            <label for="name">Name:</label>
            <span id="name">admin</span> 
            <br>
            <label for="statu">Status:</label>
            <span id="statu">Online</span> 
            <br>
            <label for="time">Time:</label>
            <span id="time">0 seconds</span> 
            <br>
            <button id="exit-button" style="margin-left:115px;" onclick="window.open('framwork.php')">Exit</button>
            <script>
                var countdownDate = new Date();
        countdownDate.setMinutes(countdownDate.getMinutes() + 10); 
        var timeElement = document.getElementById('time'); 

        var countdownInterval = setInterval(function() {
            var now = new Date().getTime();
            var distance = countdownDate - now; 


            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            timeElement.textContent = minutes + ' minutes ' + seconds + ' seconds';


            if (distance <= 0) {
                clearInterval(countdownInterval); 
                timeElement.textContent = 'Time expired!'; 

                setTimeout(function() {
                    window.location.href = 'framwork.php'; 
                }, 10000);
            }
        }, 1000);
            </script>
        </div>
        <div id="section2" class="section" style="font-size: 30px;width: 700px;">
            <h2>LED Control</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="ledState">LED State:</label>
            <select id="ledState" name="ledState">
                <option value="on">ON</option>
                <option value="off">OFF</option>
                <option value="blink">BLINK</option>
                <option value="brightness">Brightness</option>
            </select>
        <br>
        <label for="pinNumber">Pin Number:</label>
        <input type="number" id="pinNumber" name="pinNumber1" >
        <br>
        <label for="pinNumber">Pin Number2:</label>
        <input type="number" id="pinNumber" name="pinNumber2" >
        <br>
        <input type="submit" value="Submit" style="margin-left: 300px;font-size: 20px;margin-top: 15px;">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ledState = $_POST['ledState'];
        $pinNumber1 = $_POST['pinNumber1'];
        $pinNumber2 = $_POST['pinNumber2'];
        if ($ledState == "on") {
            echo shell_exec("sudo ./test_gpios 0 1");
            echo shell_exec("sudo ./test_gpios 1 1");
            shell_exec("python3 db_code.py insert led_on");
        } elseif ($ledState == "off") {
            echo shell_exec("sudo ./test_gpios 0 0");
            echo shell_exec("sudo ./test_gpios 1 0");
            shell_exec("python3 db_code.py insert led_off");
        } elseif ($ledState == "blink") {
            echo shell_exec("python3 blink_led_same_time.py");
            shell_exec("python3 db_code.py insert led_blink");
        }elseif ($ledState == "brightness") {
            echo shell_exec(" python3 brightness.py");
            shell_exec("python3 db_code.py insert led_brihtness");
        }
    }
    ?>


        </div>
        <div id="section3" class="section" style="width: 1000px;height: 300px;">
            <h2 style="font-size: 50px;margin-left: 300px;text-decoration:underline;">Control ServoMotor</h2>
            <form method="post">
                <label for="speed" style="font-size: 30px;">Speed (0-100):</label>
                <input type="number" id="speed" name="speed" min="0" max="100" style="font-size: 30px;">
                <br>    
                <button type="submit" name="submit" style="font-size: 50px;margin-left: 450px;margin-top: 30px;">Start</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $speed = $_POST['speed'];
                echo shell_exec("sudo python3 /home/pi/www/servo_motor.py $speed");
                shell_exec("python3 db_code.py insert servo_motor_with speed_$speed");
            }   
            ?>
            
        </div>
        <div id="section4" class="section">
            <h2 style="font-size: 80px;text-decoration: underline;">Control LCD</h2>
            <form method="post" style="font-size: 30px;">
                <label for="text">Text:</label>
                <input type="text" id="text" name="text">
                <br>
                <label for="row">Row:</label>
                <input type="number" id="row" name="row" min="0" max="1">
                <br>
                <label for="col">Column:</label>
                <input type="number" id="col" name="col" min="0" max="15">
                <br>
                <input type="submit" value="Submit" style="font-size: 30px;background-color: #ff6200;margin-left: 180px;">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $text = $_POST['text'];
                $row = $_POST['row'];
                $col = $_POST['col'];
                echo shell_exec("sudo python3 /home/pi/www/lcd.py $text $row $col");
                shell_exec("python3 db_code.py insert lcd_with_text_$text");
            }
            ?>
    </div>
<div id="section5" class="section" style="height:430px;width: 700px;">
            <h2>Display temperature/Humidity</h2>
            <canvas id="chart" style="width:100%;max-width:700px"></canvas>
            <button  id="downloadButton" type="submit" name="submit">Download</button>
        </div>
<div id="section5" class="section" style="height:430px;width: 700px;">
            <h2>Display temperature/Humidity</h2>
            <canvas id="chart" style="width:100%;max-width:700px"></canvas>
            <button  id="downloadButton" type="submit" name="submit">Download</button>
            <script>
                // Read the data.txt file using XMLHttpRequest
                
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "data.txt", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = xhr.responseText;
                        var lines = data.split('\n');
                        var labels = [];
                        var temperatureData = [];
                        var humidityData = [];
                        lines.forEach(function(line, index) {
                            if (line.trim() !== '') {
                                var values = line.split(',');
                                var timestamp = new Date(index * 2000); 
                                var temperature = parseFloat(values[0]);
                                var humidity = parseFloat(values[1]);
                                labels.push(timestamp);
                                temperatureData.push(temperature);
                                humidityData.push(humidity);
                            }
                        });
        
                        // Create a chart using Chart.js
                        var ctx = document.getElementById('chart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Temperature (°C)',
                                    data: temperatureData,
                                    borderColor: 'red',
                                    backgroundColor: 'rgba(255, 0, 0, 0.1)',
                                    fill: true
                                }, {
                                    label: 'Humidity (%)',
                                    data: humidityData,
                                    borderColor: 'blue',
                                    backgroundColor: 'rgba(0, 0, 255, 0.1)',
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'second',
                                            displayFormats: {
                                                second: 'h:mm:ss a'
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Time'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Value'
                                        }
                                    }
                                }
                            }
                        });
        
                        document.querySelector('#downloadButton').addEventListener('click', function() {
                            var chartDataURL = chart.toBase64Image();
                            var downloadLink = document.createElement('a');
                            downloadLink.href = chartDataURL;
                            downloadLink.download = 'chart.png';
                            downloadLink.click();
                        });
                    }
                };
                xhr.send();
            </script>
</div>
<div id="section6" class="section" style="height:430px;width: 700px;">
            <h2>History state</h1>
            <table id="weatherTable">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>      
            <script>
                // Fetch weather data from the TXT file
                var request = new XMLHttpRequest();
                request.open('GET', 'history.txt', true);
                request.onreadystatechange = function () {
                    if (request.readyState === 4 && request.status === 200) {
                        var data = request.responseText;
                        displayWeatherData(data);
                    }
                };
                request.send();
        
                // Display weather data in the table
                function displayWeatherData(data) {
                    var lines = data.split('\n');
                    var tableBody = document.querySelector('#weatherTable tbody');
        
                    for (var i = 1; i < lines.length; i++) {
                        var line = lines[i].split(',');
                        var Time = line[0];
                        var Action = line[1];
        
                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${Time}</td>
                            <td>${Action}</td>
                        `;
        
                        tableBody.appendChild(row);
                    }
                }
            </script>
</div>
	<div id="section7" class="section">
	<h2>Fell free to conect to shell of raspberry and execute commands</h2>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<input type="text" id="commandInput" placeholder="Enter a command">
        <button onclick="executeProgram()">Execute</button>
        <pre id="output"></pre>
	<script>
    function executeProgram() {
      var command = document.getElementById('commandInput').value;
      $.ajax({
        url: 'execute.php',
        type: 'POST',
        data: { command: command },
        dataType: 'json',
        success: function(response) {
          displayOutput(response.output);
        }
      });
    }

    function displayOutput(output) {
      var outputElement = document.getElementById('output');
      outputElement.textContent = output;
    }
  </script>
</div>

</body>
<footer>
    <div id="footer" style="position:fixed;top: 600px;left: 175px;font-size: 25px;border:1px solid brown;">
        <span style="justify-content: center;"> Author rights ©Yassine_Gannoune.Made with <i class="fa fa-heart"></i>.All rights reserved |Licenses OPen Source</span>
    </div>
</footer>
</html>
