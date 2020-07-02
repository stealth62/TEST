<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<style>
	html {
		background-color:white;
	}
	body{ font: 16px sans-serif; }
	
a:-webkit-any-link {
    color: #1371ff;
    cursor: pointer;
    text-decoration: none;
}
	</style>

	
    <title>Welcome</title>
	
	
</head>



<style>
.box-left {
    background-color: #ffffff;
    margin-left: 65vw;
    padding: 1vw;
    border-radius: 13px;
    box-shadow: 0px 1px 8px 0px #7f7979;
    margin-top: 6px;
}
.box-left:hover {
	 box-shadow: 0px 1px 1px 0px #7f7979;
}
.tagline {
    font-size: xxx-large;
    color: #ffffff;
    margin-left: 0%;
    box-shadow: 0px 1px 8px 0px #7f7979;
    background-color: #2a0cff;
    width: -webkit-fill-available;
    margin-top: 3.5vw;
    padding: 39px;
}
.header {
	font-size: 5vw;
    font-family: sans-serif;
    position: fixed;
    top: 1.7vw;
    width: 69%;
    margin-left: 1%;
    background-color: #ffffff00;
    text-align: left;
    color: #2b07bc;
	text-shadow: -1px 2px 4px grey;
}
button {
    -webkit-appearance: button;
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: center;
    align-items: flex-start;
    cursor: default;
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 1vw;
    font: 400 13.3333px Arial;
    padding: 1% 2%;
    border-width: 2px;
    border-style: outset;
    border-color: transparent;
    border-image: initial;
    border-radius: 9vw;
    box-shadow: 0px 0px 5px 0px grey;
    color: #2a0cff;
}
button:hover {
	box-shadow: 0px 0px 2px 0px grey;
    color: #fbb027;
}

.clock {
	color: #023b92;
    float: left;
    font-size: 1.1vw;
    font-weight: bold;
    text-shadow: -3px 2px 6px grey;
	
}
</style>
<body>
<p  class="header">DELIVERY APP SOLUTION</p>
<div class="box-left"> 
     <div class="clock">   <span id="MyClockDisplay" onload="showTime()"></span>
		<p><span id="datetime"></span></p> </div>
		<br></br>
		<p style="text-align:right;margin-right:2vw;">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</p>

 
<p>
		<div style="text-align:right;margin-right:2vw;" id="harhar2"> <a href="reset-password.php" class="btn btn-warning">Change Password</a></div>
		<div style="text-align:right;margin-right:2vw;" id="harhar">  <a href="logout.php" class="btn btn-danger">Sign Out</a></div>
</div>
</p>
	<p class="tagline">Make Fast &amp; <br>
        Real-Time Update<br>
       Delivery Solution</p>
	
	
	<div style="margin-left:5vw;">
	 <a href="/f/main.html" class="btn btn-info"><button> REAL TIME DELIVERY SOLUTION</button></a>
	  <a href="https://sites.google.com/view/logs-view" class="btn btn-info"><button>LOGISTICS DELIVERY SOLUTION</button></a>

	</div>
	
<div style="font-size:0.8vw;font-family:sans-serif;position:fixed;left: -42px;bottom:0;width:100%;background-color:transparent;text-align:right;color: #0000ff47;">Copyright (c) 2020, InboTech Solution by Dennis Borgs<br></br></div>

</body>
<script>
function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}
 function showDate(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}


showTime();
</script>
<script>
var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
</script>
</html>
