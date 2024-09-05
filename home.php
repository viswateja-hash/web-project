<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="csssty.css">
</head>
<body>
   <div class="container">
        <div class="photo">
            <img src="C:\Users\teja\AppData\Roaming\Microsoft\Windows\Network Shortcuts\images.png" alt="Resume Image">
        </div>
        <div class="details">
            <p>NAME: ViswaTeja</p> 
            <p>GENDER: Male</p>
            <p>LANGUAGES KNOWN: Telugu, English</p>
            <p>EXPERIENCE: None</p>
        </div>
        <div class="about">
            <h2>ABOUT</h2>
            <p>CONTACT: 9876678654</p>
            <p>EMAIL:viswateja4949@gmail.com</p>
            <p>EDUCATION:Bachelor of science</p>
            <p></p>
        </div>
        <div class="detail">
            <h2>CAREER OBJECTIVE</h2>
            <p>Organized and motivated employee with superior [skill],Certified [position] looking to join [company] as a part of the [department] teamDetail-oriented individual seeking to help [company] achieve its goals as a [position].</p>
        </div>
        <div class="qualifications">
            <h2>ACADEMIC QUALIFICATION</h2>
            <table border="2" bordercolour="yellow">
                <tr>
                    <th>QUALIFICATION</th>
                    <th>BOARD</th>
                    <th>YEAR</th>
                    <th>PERCENTAGE</th>
                </tr>
                <tr>
                    <td >10th</td>
                    <td>SSC</td>
                    <td>2018</td>
                    <td>95%</td>
                </tr>
                <tr>
                    <td>12th</td>
                    <td>HSS</td>
                    <td>2021</td>
                    <td>90%</td>
                </tr>
                <tr>
                    <td>B.Tech</td>
                    <td>Pondicherry University</td>
                    <td>2025</td>
                    <td>83%</td>
                </tr>
            </table>
        </div>
        <div class="strength">
            <h2>STRENGTH</h2>
            <ul type="square">
                <li>Strong problem solving skills</li>
                <li>Good communiction</li>
                <li>Team Management</li>
            </ul> 
        </div>
        <div class="skills">
            <h2>Skills</h2>
            <ul>
                <li>c,c++ languages</li>
                <li>Designer</li>
                <li>web developer</li>
            </ul> 
        </div>
        
         <div class="audio">
           <h2>Embedded Audio</h2>
               <audio controls>
           <source src="C:\Users\teja\Downloads\audio.mp3" type="audio/mpeg">
    
               Your browser does not support the audio element.
             </audio>
            <h2>Embedded Video<br><br></h2>
             <video controls width="600" height="400">
               <source src="C:\Users\teja\Pictures\Camera Roll\WIN_20240410_00_22_14_Pro.mp4" type="video/mp4">
                Your browser does not support the video element.
               </video>
               
    </div>
    <h1>Programming Skills</h1>
<canvas id="skillCanvas" width="400" height="200"></canvas>
<script>

var canvas = document.getElementById('skillCanvas');
var ctx = canvas.getContext('2d');


var skills = [
    { name: 'C', level: 90 },
    { name: 'C++', level: 85 },
    { name: 'Java', level: 75 }
];


var barWidth = 200;
var barHeight = 30;
var barMargin = 10;
var startX = 50;
var startY = 30;

for (var i = 0; i < skills.length; i++) {
    var skill = skills[i];
    ctx.fillStyle = '#007bff'; 
    ctx.fillRect(startX, startY + (barHeight + barMargin) * i, skill.level * 2, barHeight);
    ctx.fillStyle = '#000';
    ctx.fillText(skill.name + ': ' + skill.level + '%', startX + skill.level * 2 + 10, startY + (barHeight + barMargin) * i + barHeight / 2 + 5);
}


</script>
<div class="local">
    <h2>Local Storage Example</h2>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email">
    </div>
    <button onclick="saveData()">Save Data</button>
    
    <script>
        
        function saveData() {
            var index = parseInt(localStorage.getItem("userIndex")) || 0;
            
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var userData = {
                name: name,
                email: email
            };

            localStorage.setItem("user_" + index, JSON.stringify(userData));
            
            
            localStorage.setItem("userIndex", index + 1);
            
            alert("Data saved successfully!");
            
        }
    </script>
    
    <h2>Session Storage Example</h2>
    <input type="text" id="textInput" placeholder="enter your hobbies">
    <button onclick="saveText()">Save</button>
    <p>Stored text:</p>
    <p id="storedText"></p>
    
    <script>
       
        function saveText() {
           
            var index = parseInt(sessionStorage.getItem("userIndex")) || 0;
            
            var text = document.getElementById('textInput').value;
            var key = 'userText_' + index;
            
       
            sessionStorage.setItem(key, text);
            
            
            sessionStorage.setItem("userIndex", index + 1);
            textInput.value='';
            displayStoredText();
        }
        
       
        function displayStoredText() {
            var storedText = '';
            var index = parseInt(sessionStorage.getItem("userIndex")) || 0;
            for (var i = 0; i < index; i++) {
                var key = 'userText_' + i;
                storedText += sessionStorage.getItem(key) + '\n';
            }
            var displayElement = document.getElementById('storedText');
            displayElement.textContent = storedText;
        }
    
        
        displayStoredText();
    </script>
</div>    
   

    <div class="container2"> 
     <h2>Drag and Drop </h2> 
    <div id="ENGLISH" class="box" draggable="true" ondragstart="drag(event)">ENGLISH</div> 
    <div id="HINDI" class="box" draggable="true" ondragstart="drag(event)">HINDI</div> 
    <div id="TELUGU" class="box" draggable="true" ondragstart="drag(event)">TELUGU</div> 
</div> 
 
<div class="container2" ondrop="drop(event)" ondragover="allowDrop(event)"> 
    <div id="box3" class="box" ondrop="drop(event)" ondragover="allowDrop(event)">Drop Known Programming languages</div> 
<script> 
    function allowDrop(ev) { 
        ev.preventDefault(); 
    } 
    function drag(ev) { 
        ev.dataTransfer.setData("text", ev.target.id); 
    } 
    function drop(ev) { 
        ev.preventDefault(); 
        var data = ev.dataTransfer.getData("text"); 
        var draggedElement = document.getElementById(data); 
        ev.target.appendChild(draggedElement); 
    } 
</script>
</div> 

    </div>
</body>
</html>