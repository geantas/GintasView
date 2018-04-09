<!DOCTYPE HTML>
<html>
<head>

</head>
<body>

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
$currdate = timeset(date); // Put current date into variable

$n = 1;
echo "<br>Last session: " . $sessionnumber;
$sessionnumber = $sessionnumber+ 1; // Add 1 to session number. Now it will be the next session
echo "<br>This session: " . $sessionnumber;


foreach( $_POST as $timetag ) { // For each of $_POST variables, here as $timetag

	  if ($timetag != "null" && $timetag != "Save")  // If timetag is not "null" and is not "Save",
             {						

sscanf($timetag, "%d:%d:%d", $hours, $minutes, $seconds); //then get the hours, minutes and seconds
$timetagsecs = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes; //and convert the result to
												    //seconds only;
              echo "<br>Timetag " . $n . " in seconds: " . $timetagsecs;			    // Then, print the result in
// Insertion into database start								    //new line
// SQL query 

$query = "INSERT INTO timetags (date, timetag, session) VALUES ('$currdate', '$timetagsecs', '$sessionnumber')";

if (!$result = mysqli_query($mysqli, $query)) { // If there is an error when putting data into database
    echo "<br>Could not insert into database: <br>(" . $mysqli->errno . ") " . $mysqli->error; //output the error on screen
   }
// Insertion into database end	
	    
              $n++;	// Increase number $n by 1									    
             }
          }







?>

<a href="stopwatch.php" onlick="localStorage.clear();sessionStorage.clear();">back</a>

</body>

</html>
