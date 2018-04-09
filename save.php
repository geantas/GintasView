<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gintas View v1.3</title>
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script type='text/javascript' src='jquery-1.7.1.js'></script>
<style type="text/css">
@font-face {
    font-family: "AUFont";
    src: url(/fonts/AUPassata_Bold.ttf) format("truetype");
}
html, body, input, button, p, div, textarea, label, span { 
    font-family: "AUFont";
	font-size: 30px;
}


.Tagbuttons {
    font-size: 180%;
	background-color: #003E5C;
    border-radius: 5px;
	-webkit-border-radius: 5px;
    -moz-border-border-radius: 5px;
    border: solid;
    color: #FFFFFF;
	display:inline;
	position:relative;
	
}

.Tagbuttons:hover {
opacity: 0.9;
}

input[type="text"]:disabled {
	background-color:#FFFFFF;
	color:black;
}

textarea:disabled {
	background-color:#FFFFFF;
	color:black;
}
</style>
<script type="text/javascript">

function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        javascript:window.close();
		setTimeout(window.close, 320);
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);


function wclose() {
        window.close();
}


function showHeight( element, height ) {
//console.log( "Window height: " + height + "px." );
height = height - 3;
var bigcont = document.getElementById('bigcontainer');
bigcont.setAttribute('style', 'height:' + height.toFixed(1) + 'px; background-color:#FFFFFF;');
}

window.onload= $(function() {
showHeight( "window", $( window ).height() );

$(window).resize(function(){
showHeight( "window", $( window ).height() );
$('.buttonbox input').css('font-size',($(window).height()*0.055)+'px');
$('.buttonbox p').css('font-size',($(window).width()*0.03)+'px');
$('.buttonbox span').css('font-size',($(window).width()*0.03)+'px');
$('.titlebox a').css('font-size',($(window).width()*0.02)+'px');
});



//showWidth( "window", $( window ).width() );
//showDocHeight("document", $(document).height() );

 
});

</script>
</head>
<body bgcolor="#1A171B">
<div id="bigcontainer" style="width:100%; background-color:#474747;">
<div class="header2" style="height:10%; width:100%;" >
	<div id="header2" style="height:100%; width:100%; background-color:#474747;" >
		<div id="bbb" style="height:100%; width:100%;">
			<div id="sslogo" style="width:45%; float:left;">
				<a href="index.php">
					<img style="width:30%;height:30%;" src="SkejSimlogo_name.png" alt="SkejSim">
				</a>
				<div  class="titlebox" style="float:right;" >
					<a style="color:#FFFFFF;font-size:100%;">Gintas View v1.3</a>
				</div>
			</div>
			<div style=" width:45%; height:100%; float:right; position:relative;">
				<span style="position:absolute; bottom:0; right:0;"><a  style=" height:100%; font-size:14px; text-decoration:none; color:#FFFFFF;"  href="index.php" onClick="localStorage.clear();sessionStorage.clear();">Home page</a></span>
				<span style="position:absolute; bottom:1; right:0;"><a  style=" height:100%; font-size:14px; text-decoration:none; color:#FFFFFF;"  href="tag.php" onClick="localStorage.clear();sessionStorage.clear();">Timetagging page</a></span>
			</div>
		</div>
	</div>
</div>
<div id="spacer" style="background-color:#474747;"></div>
<div id="mainarea" style="height:84%; background-color:#87888A; padding-top:5px; padding-bottom:5px; text-align:center;">
	<div class="buttonbox" style="width:95%; height:20%; text-align:center; float:left;  margin:3px;">
		<p>Timetags were successfully placed into database!
			<p style='font-size:100%;'>
				You can now close the window or go back to timetag again.
			</p>
		</p>
	</div>
	<div class="buttonbox" style="width:46%; height:25%; text-align:center; float:left;  margin:1.3% 0 1.3% 2.5%;">
		<a  href="tag.php">
			<input type="button" id="backbtn" class="Tagbuttons" value="Back to timetagging"  onClick="localStorage.clear();sessionStorage.clear();"  style="width:100%; height:100%; background-color:green; white-space:normal; padding:2px 0 2px 0; font-size:auto;"/>
		</a>
	</div>
	<div class="buttonbox" style="width:46%; height:25%; text-align:center; float:right; margin:1.3% 2.5% 1.3% 0;">
		<a  href="index.php">
			<input type="button" id="homebtn" class="Tagbuttons" value="Home page" onClick="localStorage.clear();sessionStorage.clear();" style="width:100%; height:100%; white-space:normal; padding:2px 0 2px 0; font-size:auto;"/>
		</a>
	</div>
	<div class="buttonbox" style="width:90%; height:10%; text-align:center; float:left;  margin:3px;">
		<p>Window will close in 
			<span id="counter">
				10
			</span>
			second(s) to clear storages.
		</p>
	</div>
	<div class="buttonbox" style="width:90%; height:10%; text-align:center; float:left;  margin:3px;">
		<p id="datebox"></p>
		<p id="sessionbox"></p>
	</div>
<?php
//error_reporting(0);

date_default_timezone_set('Europe/Copenhagen');

$mysqli = new mysqli('localhost','gopro','gopro','timetagging'); // Make database connection

$query2 = "SELECT session FROM timetags ORDER BY id DESC LIMIT 1"; // Query to check the last session number

if ($result2 = mysqli_query($mysqli, $query2)) { // If there is no error,

while ($row = $result2->fetch_row()) {
 $sessionnumber = $row[0]; //put the last session number from array to variable

}

} else {
    echo "<br>Could not check the session number: <br> (" . $mysqli->errno . ") " . $mysqli->error; // Output error on screen
   
}

//$currdate = date("Y-m-d H:i", $fulldate);
//$fulldate = $_POST['currentdate'];

$currdate = $_POST['currentdate'];
$timestamp = strtotime($currdate);

//echo "currdate: " . $currdate . "<br>";
//echo "timestamp: " . $timestamp . "<br>";


//echo "<br>Last session: " . $sessionnumber;
	$sessionnumber = $sessionnumber+ 1; // Add 1 to session number. Now it will be the next session




$n = 1;
foreach( $_POST as $timetag ) { // For each of $_POST variables, here as $timetag

	  if ($timetag != "null" && $timetag != "Save" && $timetag != $currdate )  // If timetag is not "null" and is not "Save",
             {						
sscanf($timetag, "%d:%d:%d", $hours, $minutes, $seconds); //then get the hours, minutes and seconds
$timetagsecs = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes; //and convert the result to
												    //seconds only;
			//echo "<br>Timetag " . $n . ": " . $timetag;
              //echo "<br>Timetag " . $n . " in seconds: " . $timetagsecs;			    // Then, print the result in
												    //new line


// Insertion into database start								    
// SQL query 

$query = "INSERT INTO timetags (date, timestamp, timetag, session) VALUES ('$currdate', '$timestamp', '$timetagsecs', '$sessionnumber')";

if (!$result = mysqli_query($mysqli, $query)) { // If there is an error when putting data into database
    echo "<br>Could not insert into database: <br>(" . $mysqli->errno . ") " . $mysqli->error; //output the error on screen
   }
// Insertion into database end	
	    
              $n++;	// Increase number $n by 1									    
             }
          }
?>
</div>
</div>


</body>
<script>
$(document).ready(function (){

var sessionbox = document.getElementById("sessionbox");
var datebox = document.getElementById("datebox");
var session=document.createElement("SPAN"); // Create form in html
session.id = "session";
session.name = "session";
session.innerHTML="<?php echo 'Session ID: ' . $sessionnumber; ?>";
sessionbox.appendChild(session); // Attach form into body

var dateofsession=document.createElement("SPAN"); // Create form in html
dateofsession.id = "dateofs";
dateofsession.name = "dateofs";
dateofsession.innerHTML="<?php echo 'Timetag date: ' . $currdate; ?>";
datebox.appendChild(dateofsession); // Attach form into body

});

</script>
</html>
