<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gintas View v1.3</title>
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<style type="text/css">
@font-face {
    font-family: "AUFont";
    src: url(/fonts/AUPassata_Bold.ttf) format("truetype");
}
html, body, input, button, p, div, textarea, label, span { 
    font-family: "AUFont";
   font-size: 20px;
}
</style>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        window.close();
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>
</head>
<body bgcolor="#1A171B">
<div id="container">
<div id="header">
<div id="bbb">
<div align="left" id="sslogo" style="width:600px;"><a href="index.php"><img style="width:30%;height:30%;" src="SkejSimlogo_name.png" alt="SkejSim"></a>

<div style="float:right;"  ><a  style="color:#FFFFFF;font-size:24px;">Gintas View v1.3</a></div>
</div>
<div align="right" style="margin-top:-10px;" ><a  style="font-size:14px;text-decoration:none;color:#FFFFFF;" href="index.php" >Home page</a></div>
<div align="right" style="margin-top:-10px;" ><a  style="font-size:14px;text-decoration:none;color:#FFFFFF;" href="tag.php" target="_blank">Timetagging page</a></div>
</div>
<div id="spacer"></div>
    <div id="main">

<?php

$mysqli = new mysqli('localhost','gopro','gopro','timetagging'); // Make database connection

$query2 = "SELECT session FROM timetags ORDER BY id DESC LIMIT 1"; // Query to check the last session number

if ($result2 = mysqli_query($mysqli, $query2)) { // If there is no error,

while ($row = $result2->fetch_row()) { 
        $sessionnumber = $row[0]; //put the last session number from array to variable
		}

} else {
    echo "<br>Could not check the session number: <br> (" . $mysqli->errno . ") " . $mysqli->error; // Output error on screen
   
}

  function timeset($timestamp){ // Timestamp function

  $date = new DateTime();
  $date -> setTimestamp($timestamp);
  return $date -> format('Y-m-d H:i'); // Returns the date in format YYYY-MM-DD hh:mm
}

date_default_timezone_set('UTC');
$currdate = timeset(date); 
$timestamp = strtotime($currdate);


//echo "<br>Last session: " . $sessionnumber;
$sessionnumber = $sessionnumber+ 1; // Add 1 to session number. Now it will be the next session


echo "<span style='font-size:14px;'>Session number: " . $sessionnumber . "</span>";


$n = 1;
foreach( $_POST as $timetag ) { // For each of $_POST variables, here as $timetag

	  if ($timetag != "null" && $timetag != "Save")  // If timetag is not "null" and is not "Save",
             {						

sscanf($timetag, "%d:%d:%d", $hours, $minutes, $seconds); //then get the hours, minutes and seconds
$timetagsecs = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes; //and convert the result to
												    //seconds only;
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
echo "<br><br>Timetags were successfully placed into database!<br><span style='font-size:18px;'> You can now close the window or back to timetagging page for another tagging session.</span>";
?></div>
<br><br>
<a id="backbtn" style="text-decoration:none;color:#1A171B" href="tag.php" href="javascript:window.close();" target="_blank" onlick="localStorage.clear();sessionStorage.clear();">Back to timetagging</a>
<br><br>
<p>Window will close in <span id="counter">100</span> second(s) to clear storages.</p>

</div>
</body>

</html>
