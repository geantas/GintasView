<!DOCTYPE html>
<html >
<link rel="shortcut icon" href="favicon.ico" type="image/png">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gintas View v1.3</title>


<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<link rel="stylesheet" type="text/css" href="jquery-ui.css"  media="all" />
<script type='text/javascript' src="jquery-1.10.2.js"></script>
<script type='text/javascript' src='jquery-1.7.1.js'></script>
<script type='text/javascript' src="jquery.min.js"></script>
<script type='text/javascript' src="jquery-ui.js"></script>
<script type='text/javascript' src='alljavascript.js'></script>
<script type='text/javascript' src="vidcontrol.js"></script>


<style type="text/css">
@font-face {
    font-family: "AUFont";
    src: url(/fonts/AUPassata_Bold.ttf) format("truetype");
}

@font-face {
    font-family: "AURegFont";
    src: url(/fonts/AUPassata_Rg.ttf) format("truetype");
}

html, body, input, button, p, div, textarea, label, span { 
    font-family: "AUFont";
}

.ui-slider-horizontal .ui-slider-handle { /* makes the slider handle smaller */
	top: -0.5em;
	margin-left: -0.2em;
}
.ui-slider .ui-slider-handle {
	position: absolute;
	z-index: 2;
	width: 0.3em;
	height: 1.5em;
	cursor: default;
	z-index: 101;
}

.ui-slider-tick-mark{
display:inline-block;
width:5px;
background:black;
height:24px;
position:absolute;
top:-4px;
z-index: 100;
}

.videorotate {
  -moz-transform:rotate(90deg);
  -webkit-transform:rotate(90deg);
  -o-transform:rotate(90deg);
  -ms-transform:rotate(90deg);
  transform:rotate(90deg);
}


 </style>
<script>
$(function() {
	$( "#slider2" ).slider();
});

$(document).ready(function (){
	$("#fit").click(function (){
		$('html, body').animate({
				scrollTop: $("#vid1").offset().top
		}, 500);
	});
});
</script>


<?php

	$u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $platform = 'Unknown';

    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    };
?>
</head>
<body bgcolor="#1A171B" class="disab" >
	
	<div id="box" style="text-align:center; background-color:#87888A;" hidden>    
		<span style="text-align:center;">Loading videos...</span>
		<div>
			<img src="728.GIF" style="position:relative; width:45px; height:auto;"></img>
		</div>
	</div>


<svg version="1.1" xmlns="http://www.w3.org/2000/svg" height="0" width="0">
  <defs>
     <filter id="blur" x="0" y="0">
       <feGaussianBlur stdDeviation="3" />
     </filter>
  </defs>
</svg>   
  
<div id="container">
	
	<div id="header">
		<div id="bbb">
			<div align="left" id="sslogo" style="width:600px;">
				<a href="index.php"><img style="width:30%;height:30%;" src="SkejSimlogo_name.png" alt="SkejSim"></a>
				<div style="float:right;"  >
					<a  style="color:#FFFFFF;font-size:24px;">Gintas View 
						<span>
							<a  style="text-decoration:none;color:#FFFFFF;font-size:24px;" href="news.php" target="_blank">v1.3 </a>
						<span style="color:#FFFFFF;font-size:10px"> for <?php echo $platform; ?></span>
					</a>
				</div>
			</div>
			<div align="right" style="margin-top:-10px;"  >
				<a  style="color:#FFFFFF;font-size:14px;text-decoration:none;color:#FFFFFF;" href="tag.php" target="_blank">Tag times</a>
			</div>
		</div>
		<div id="spacer"></div>
		<div id="main"><?php if(!isset($_POST['selection'])) { ?>
			<div align="center">
				<span style="font-size:20px;">Please select a video file.</span>
			</div><?php } ?>
			<div id="leftcol_container" >
				<div class="leftcol">
					<div class="leftcol">
						<?php if(isset($_POST['selection'])) { ?>
						<div>
							<button class="submitbutton" id="fit">Fit to screen</button>
						</div><?php } ?>
						<span style="font-size:16px;color:#FFFFFF;"><?php if(!isset($_POST['selection'])) { ?>Select a video here:</span><?php } ?>
						<?php // echo "<div id='labas'><span id='videofile'>". $filedate . "</span></div>"; 
						if(isset($_POST['selection'])) { ?>
						<span>Select another video:<?php } ?></span>
						<form class="green"  action="" method="post"> <!-- from this form we will have a value in $_POST['selection'] -->

<?php 
if ($platform == "Windows") {
	date_default_timezone_set('Europe/Copenhagen');
} else {
	if ($platform == "Linux") {
		date_default_timezone_set('Europe/London');
		}
	}

// The code below is needed to figure out what user is using computer. It will put the user to variable,
//so later system will automatically search for files in user's home directory, not in "gintas" home directory.

$handle = @fopen("/userr.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        list( $user, $value ) = explode( ' ', trim($buffer) );
        $$user = $value; //Double $$ to set a var with the string name in $key
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
// End of putting user into a variable

// if WINDOWS

if ($platform == "Windows") {

	$camerasconnected = 0;
	$scdirE = 'E:/';

	if (is_dir($scdirE)){ 
	// Open a directory, and read its contents
		error_reporting(E_ALL);

		$dh  = opendir($scdirE);
		while (false !== ($scfilename = readdir($dh))) {
			$scfiles[] = $scfilename;
		}
		if ($scfiles[0] == 'DCIM' || $scfiles[1] == 'DCIM' || $scfiles[2] == 'DCIM' || $scfiles[3] == 'DCIM' ) {
			$subdir = $scdirE . $scfiles[0];
			$dh2  = opendir($subdir);
			while (false !== ($scfilename2 = readdir($dh2))) {
				$scfiles2[] = $scfilename2;
			}
			if ($scfiles2[0] == '100GOPRO' || $scfiles2[1] == '100GOPRO' || $scfiles2[2] == '100GOPRO' || $scfiles2[3] == '100GOPRO' ) {
				$mediadir1 = "E";
				$files1 = glob("gopromediaE/DCIM/100GOPRO", GLOB_ONLYDIR); //gets all directories in E:/
			}
		} else {
			echo "<br>No success.. (E:/)";
		}
		$cam_dir1 = $files1[0];
		switch ($mediadir1) {
			/*case "ED":
				$cam_dir2 = "gopromediaE";
				$cam_dir3 = "gopromediaF";
				$cam_dir4 = "gopromediaG";
				break;*/
			case "E":
				$cam_dir2 = "gopromediaF";
				$cam_dir3 = "gopromediaG";
				$cam_dir4 = "gopromediaH";
				break;
			case "F":
				$cam_dir2 = "gopromediaG";
				$cam_dir3 = "gopromediaH";
				$cam_dir4 = "gopromediaI";
				break;
			case "G":
				$cam_dir2 = "gopromediaH";
				$cam_dir3 = "gopromediaI";
				$cam_dir4 = "gopromediaJ";
				break;
			case "H":
				$cam_dir2 = "gopromediaI";
				$cam_dir3 = "gopromediaJ";
				$cam_dir4 = "gopromediaK";
			case "I":
				$cam_dir2 = "gopromediaJ";
				$cam_dir3 = "gopromediaK";
				$cam_dir4 = "gopromediaL";
				break;
				break;
			default:
				echo "Could not locate cameras' directories.";
		}
	} else {
		echo "<span style='color:#FFF;'>Could not recognize a camera as E:/ drive!</span>";
		error_reporting(E_ALL & ~E_NOTICE);
	}
}

// WINDOWS FINISHED

// if LINUX
if ($platform == "Linux"){
	$dir    = '/gopromedia/' . $user; //need to find a solution how to find cameras directories when they appear not in /media/gintas
	$files1 = glob("$dir/BD*", GLOB_ONLYDIR); //gets all directories which starts with "BC" names.
	//Puts all 4 cameras directories (BC*) to 4 variables.
	$cam_dir1 = $files1[0];
	$cam_dir2 = $files1[1];
	$cam_dir3 = $files1[2];
	$cam_dir4 = $files1[3];
}
// LINUX FINISHED

function get_media($base_dir, $extentions = array('mp4')) { // Gets all media files with mp4 extensions
    if(!file_exists($base_dir)) return array();		    //from all folders and subfolders
    $extensions = implode('|', $extentions);
    $directory  = new RecursiveDirectoryIterator($base_dir);
    $iterator   = new RecursiveIteratorIterator($directory);
	$regex      = new RegexIterator($iterator, "/^.+\.$extensions$/i", RecursiveRegexIterator::GET_MATCH);
    $ret        = array();
    $i = 0;
    foreach ($regex as $filename=>$object) {
		$ret[$i]['filename'] = $filename;
		$ret[$i]['filetime'] = filemtime($filename);
        $i++;
    }
    return $ret;
}

//outputs the list of files, sorted by date, named by modification date, to the "select" tag.
$thelist = '<select size="1" name="selection">';
$prevValue = NULL;

foreach (get_media("$cam_dir1", array('mp4')) as $file) {

	$posOfPeriod = strrpos($file['filename'], ".");
    $last3digits = substr($file['filename'], $posOfPeriod -4, 4);
    if (is_numeric($last3digits)) {
			$curValue = $last3digits;
		//	if ($curValue == $prevValue) {
			//	echo "";
		//	} else {
			//    echo "Numeric: " . $last3digits . "<br>";
	//		}
   }
 
 //   else {
 //       echo "Non-Numeric: " . $last3digits . "<br>";
 //   }

	if ($curValue == $prevValue) {
		$thelist .= '<option style="display:none;" value="'.$file['filename'].'">'.date("Y-m-d H:i",$file['filetime']).'</option>';
	} else {
		$thelist .= '<option value="'.$file['filename'].'">'.date("Y-m-d H:i",$file['filetime']).'</option>';
	}
	
 $prevValue = $curValue;
	
}

$thelist .= '</select>';
echo $thelist;


//Code for first camera stream end//

if(isset($_POST['selection'])) {
	$filename = $_POST['selection']; //puts selected files name into variable filename.
}

if(isset($_POST['selection'])) { //if the file IS selected, then:
	if (file_exists($filename)) { //check if file actually exists. If yes, then:
		if ($platform == "Windows") {
			date_default_timezone_set('Europe/Copenhagen');
		} else {
			if ($platform == "Linux") {
			date_default_timezone_set('Europe/London');
			}
		}
	$filedate = date("Y-m-d H:i", filemtime($filename)); //take file modification date and put it in variable filedate.
   
   //echo $filename;
   
	require('/getID3/getid3/getid3.php');
	$getID3 = new getID3; //get selected video duration
	$file = $getID3->analyze($filename);
	$videoduration = $file['playtime_string'];
	//echo("Duration: ".$videoduration);

	$posOfPeriods2 = strrpos($filename, ".");
    $last3digitss2 = substr($filename, $posOfPeriods2 -4, 4);
	//echo "<br>searching for: " . $last3digitss2;


	$prevValue2 = $last3digitss2;
	$indic = 0;
	$totallength = 0;

	echo "<br><div id='samevideoswrapper' style='text-align:left;'>"; //creates a container where all video parts will be placed

	foreach (get_media("$cam_dir1", array('mp4')) as $file) { //checks if file's last numbers are the same
		$posOfPeriods = strrpos($file['filename'], "."); //gets each file name's last 4 digits
		$last3digitss = substr($file['filename'], $posOfPeriods -4, 4);
		if (is_numeric($last3digitss)) {
			$curValue2 = $last3digitss;
		}

		$getID3 = new getID3; //checks video duration of each video
		$file = $getID3->analyze($file['filename']);
		$duration = $file['playtime_string'];

		$indic++;
		if ($curValue2 == $prevValue2) { //if file name's last numbers are the same, then
   
			// puts video parts path to input element, so JavaScript could read them later and change tags.
			echo "<input class='samevideo' hidden id='same1video" . $indic . "' type='text' style='background-color:#ECF6CE;text-align:left;width:85%;' value='" . $cam_dir1 . "/" . $file['filename'] . "'/>" ;
			
			${"video1part$indic"} = $cam_dir1 . "/" . $file['filename']; //assigns a variable with video path which will be used to switch videos.
			$samevideodate = date("Y-m-d H:i", filemtime($cam_dir1 . "/" . $file['filename']));
			
			$vidp[$indic] = $indic; //for testing purposes. Counting of video parts; Do not delete!
			//echo "<br>the same > " . $indic; //needed to check which file's number is the same from list (to see if it recognized the right files);
	
			$str_time = $duration; 
			$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time); //converts duration of video from mm:ss to seconds only.
			sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			$duration = $hours * 3600 + $minutes * 60 + $seconds;
	
			echo "<input class='videolength' hidden id='videolength" . $indic . "' type='text' style='text-align:right; width:10%;' value='" . $duration . "'/>"; // outputs video chopped part duration;
	
			$totallength = $totallength + $duration; //sets total video duration (from chopped parts);
			$camera2videos = glob("$cam_dir2/DCIM/100GOPRO/*.*4"); 
			
			foreach ($camera2videos as $camera2video) { //puts same videos paths from camera 2 into input elements
				$camera2videotime = date("Y-m-d H:i", filemtime($camera2video));
				
				$samevideodate1 = new DateTime($samevideodate);
				$anewfiledate2 = new DateTime($camera2videotime);
				$ainterval1 = $samevideodate1->diff($anewfiledate2);
				$anewInterval1 = $ainterval1->format('%i');
				
				if ($anewInterval1 < 4) { 
					$same2video = $camera2video;	
					echo "<input class='samevideo' hidden id='same2video" . $indic . "' type='text' style='background-color:#F7BE81; text-align:left; width:85%;' value='" . $same2video . "'/>" ; 	

				}
			}
	
			$camera3videos = glob("$cam_dir3/DCIM/100GOPRO/*.*4"); 

			foreach ($camera3videos as $camera3video) { //puts same videos paths from camera 3 into input elements
				$camera3videotime = date("Y-m-d H:i", filemtime($camera3video));
		
				$samevideodate1 = new DateTime($samevideodate);
				$anewfiledate2 = new DateTime($camera3videotime);
				$ainterval1 = $samevideodate1->diff($anewfiledate2);
				$anewInterval1 = $ainterval1->format('%i');

				if ($anewInterval1 < 4) { 
					$same3video = $camera3video;	
					echo "<input class='samevideo' hidden id='same3video" . $indic . "' type='text' style='background-color:#A9E2F3; text-align:left; width:85%;' value='" . $same3video . "'/>" ; 	
				}
			}
	
			$camera4videos = glob("$cam_dir4/DCIM/100GOPRO/*.*4"); 
	
			foreach ($camera4videos as $camera4video) { //puts same videos paths from camera 4 into input elements
				$camera4videotime = date("Y-m-d H:i", filemtime($camera4video));
		
				$samevideodate1 = new DateTime($samevideodate);
				$anewfiledate2 = new DateTime($camera4videotime);
				$ainterval1 = $samevideodate1->diff($anewfiledate2);
				$anewInterval1 = $ainterval1->format('%i');

				if ($anewInterval1 < 4) { 
					$same4video = $camera4video;	
					echo "<input class='samevideo' hidden id='same4video" . $indic . "' type='text' style='background-color:#F5A9E1; text-align:left; width:85%;' value='" . $same4video . "'/>" ; 	
				}
			}
		} else { //if file's last numbers are not the same
	
			//echo "<br>NOT the same > " . $indic; //needed to check which file's number is NOT the same from list (to see if it recognized the right files);
	
			//echo "<input class='videolength' id='videolength" . $indic . "' type='text' style='text-align:right;' value='" . $duration . "'/>"; //outputs video duration;
		}
	}
	
	echo "</div>";
	echo "<input hidden class='totallength' id='totallength' type='text' style='text-align:right; width:10%' value='" . $totallength ."' />"; //outputs total video duration;
	echo "<input hidden class='videocount' id='videocount' type='text' style='text-align:right; width:10%' value='" . count($vidp) ."' />"; //for testing purposes. Prints how many video parts there are.
	}
}

echo "<p>";

//Code for second camera stream
if(isset($_POST['selection'])) {
	date_default_timezone_set("Europe/Copenhagen");
	$filedatetimestamp = strtotime($filedate);
}
//$filedatetimestamp = strtotime('2014-06-27 09:48');

$files2 = glob("$cam_dir2/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in second camera directory

foreach ($files2 as $filename2) {
	$filedate2 = date("Y-m-d H:i", filemtime($filename2));
	
	if(isset($_POST['selection'])) {
		$newfiledate1 = new DateTime($filedate); //takes $filedate time and makes it as a new time; puts in variable
		$newfiledate2 = new DateTime($filedate2); //takes $filedate2 time and makes it as a new time; puts in variable
		$interval1 = $newfiledate1->diff($newfiledate2); //calculates the time difference (interval) between two newly created variables
		$newInterval1 = $interval1->format('%i'); //outputs the value in numberic format (1,2,3, etc..)

		if ($newInterval1 < 4) { //if the difference between two newly created times are less than 6, then
			$file2 = $filename2; //put filename2 to file2 variable
		}
	} 
}
//Code for second camera stream end//


//Code for third camera stream//
$files3 = glob("$cam_dir3/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in third camera directory

foreach ($files3 as $filename3) {
	$filedate3 = date("Y-m-d H:i", filemtime($filename3));
	if(isset($_POST['selection'])){
		$newfiledate3 = new DateTime($filedate3); //takes $filedate3 time and makes it as a new time; puts in variable
		$interval2 = $newfiledate1->diff($newfiledate3); //calculates the time difference (interval) between two newly created variables
		$newInterval2 = $interval2->format('%i'); //outputs the value in numberic format (1,2,3, etc..)
		
		if ($newInterval2 < 4){ //if the difference between two newly created times are less than 6, then
			$file3 = $filename3; //puts filename3 to file3 variable
		}
	}
}
//Code for third camera stream end//

//Code for fourth camera stream//
$files4 = glob("$cam_dir4/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in fourth camera directory

foreach ($files4 as $filename4) {
	$filedate4 = date("Y-m-d H:i", filemtime($filename4));
	
	if(isset($_POST['selection'])){
		$newfiledate4 = new DateTime($filedate4); //takes $filedate4 time and makes it as "time"; puts in variable
		$interval3 = $newfiledate1->diff($newfiledate4); //calculates the time difference (interval) between two newly created variables
		$newInterval3 = $interval3->format('%i'); //outputs the value in numberic format (1,2,3, etc..)

		if ($newInterval3 < 4){
			$file4 = $filename4; //puts filename4 to file4 variable
		}
	}
} 



//Code for fourth camera stream end//
?>

							<input type="submit" class="submitbutton" value="    Select   "/>
							<input type="hidden" name="vtime"/>
						</form>

						<?php if(isset($_POST['selection'])) { ?>
						<div id="cont1" class="rightcol">
<img id="imgcont11" class="vidimage contimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont111" class="vidimage contimages" src="yellow01.png" style="display:none; z-index:0;  position: absolute; " />
<img id="imgcont12" class="vidimage contimages" src="red02.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont122" class="vidimage contimages" src="yellow02.png" style="display:none; z-index:0;  position: absolute; " />
<img id="imgcont13" class="vidimage contimages" src="red03.png" style="display:none; z-index:0;  position: absolute; " />   
<img id="imgcont133" class="vidimage contimages" src="yellow03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont14" class="vidimage contimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont144" class="vidimage contimages" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="fullc11" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc12" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc13" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc14" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blurc11" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc12" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc13" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc14" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="aud11" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();" />
<img id="aud12" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute2();"/>
<img id="aud13" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute3();"/>
<img id="aud14" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
						</div>
        
						<div id="cont2" class="rightcol">
<img id="imgcont21" class="vidimage contimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont211" class="vidimage contimages" src="yellow01.png" style="display:none; z-index:0;  position: absolute; " />
<img id="imgcont22" class="vidimage contimages" src="red02.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont222" class="vidimage contimages" src="yellow02.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont23" class="vidimage contimages" src="red03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont233" class="vidimage contimages" src="yellow03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont24" class="vidimage contimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont244" class="vidimage contimages" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="fullc21" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc22" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc23" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc24" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blurc21" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc22" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc23" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc24" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="aud21" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();"/>
<img id="aud22" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute2();"/>
<img id="aud23" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute3();"/>
<img id="aud24" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
						</div>
        
						<div id="cont3" class="rightcol">
<img id="imgcont31" class="vidimage contimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont311" class="vidimage contimages" src="yellow01.png" style="display:none; z-index:0;  position: absolute; " />
<img id="imgcont32" class="vidimage contimages" src="red02.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont322" class="vidimage contimages" src="yellow02.png" style="display:none; z-index:0;  position: absolute; " />
<img id="imgcont33" class="vidimage contimages" src="red03.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont333" class="vidimage contimages" src="yellow03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont34" class="vidimage contimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont344" class="vidimage contimages" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="fullc31" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc32" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc33" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc34" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blurc31" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc32" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc33" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc34" class="vidimage fullimages contimages fullcont" src="blur.png" style="display:none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="aud31" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();"/>
<img id="aud32" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute2();"/>
<img id="aud33" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute3();"/>
<img id="aud34" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
						</div>


						<?php } ?>
					</div>
				</div>
			</div>   

				<?php if(isset($_POST['selection'])) { // This will hide the video before submission ?>
				<table class="vid">
					<tr>
						<td colspan="2" style="width:10px;">
							<div class="maincol"> 
								<div id="vid1"  >
<img id="aud1" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();"/>
<img id="fullscreenvid1" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<!--<img id="rotate" class="vidimage fullimages" src="rotate.png" style=" z-index:1; margin-left: 52px; width:26px; height:26px; position: absolute; " />-->
<img id="blur1" class="vidimage fullimages" src="blur.png" style="display:none; z-index:1; margin-top:26px; width:28px; height:28px; position:absolute; " />
<img id="img1" class="vidimage images redimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " />   
<img id="img11" class="vidimage images" src="yellow01.png" style="display:none; z-index:0; position: absolute; " />
<video id="Video1" class="videos" style="z-index:0;" >
	<source src="<?php $file1 = $_POST['selection']; $file1 = str_replace('\\', '/', $file1); echo $file1; ?>" type="video/mp4"></source> 
	Browser does not support HTML5. Video could not be loaded.
</video>
								</div>
							</div>
							<div class="maincol_bottom"></div>
						</td>
						<td >
							<div class="maincol">    
							<div id="vid2" >
<img id="aud2" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute2();"/>
<img id="fullscreenvid2" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blur2" class="vidimage fullimages" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="img2" class="vidimage images redimages" src="red02.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="img22" class="vidimage images" src="yellow02.png" style="display:none; z-index:0;  position: absolute; " /> 
<video id="Video2" class="videos" style="z-index:0;">
	<source src="<?php if(isset($file2)) { echo $file2; }; ?>" type="video/mp4"></source> 
	Browser does not support HTML5. Video could not be loaded.
</video>
							</div>
						</div>
						<div class="maincol_bottom"></div>
						</tr>
						<tr>
							<td colspan="3" style="text-align:center" id="center">
								<div class="maincol" id="cont4">  
<img id="imgcont41" class="vidimage contimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont411" class="vidimage contimages" src="yellow01.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont42" class="vidimage contimages" src="red02.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont422" class="vidimage contimages" src="yellow02.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont43" class="vidimage contimages" src="red03.png" style="display:none; z-index:0;  position: absolute; " />    
<img id="imgcont433" class="vidimage contimages" src="yellow03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="imgcont44" class="vidimage contimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " />   
<img id="imgcont444" class="vidimage contimages" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="fullc41" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc42" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc43" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="fullc44" class="vidimage fullimages contimages fullcont" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blurc41" class="vidimage fullimages contimages fullcont" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc42" class="vidimage fullimages contimages fullcont" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc43" class="vidimage fullimages contimages fullcont" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="blurc44" class="vidimage fullimages contimages fullcont" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="aud41" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();"/>
<img id="aud42" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute2();"/>
<img id="aud43" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute3();"/>
<img id="aud44" class="vidimage fullimages contimages fullcont" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
								</div>
								<div class="maincol_bottom"></div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="width:10px;">
								<div class="maincol">          
									<div id="vid3" >
<img id="aud3" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute3();"/>
<img id="fullscreenvid3" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blur3" class="vidimage fullimages" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="img3" class="vidimage images redimages" src="red03.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="img33" class="vidimage images" src="yellow03.png" style="display:none; z-index:0;  position: absolute; " /> 
<video id="Video3" class="videos" style="z-index:0;">
	<source src="<?php if(isset($file3)) { echo $file3; }; ?>" type="video/mp4"></source> 
	Browser does not support HTML5. Video could not be loaded.
</video>
								</div>
							</div>
							<div class="maincol_bottom"></div>
							</td>
							<td >
								<div class="maincol">    
									<div id="vid4">
<img id="aud4" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top:53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
<img id="fullscreenvid4" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left:26px; width:26px; height:26px; position: absolute; " />
<img id="blur4" class="vidimage fullimages" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="img4" class="vidimage images redimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="img44" class="vidimage images" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
<video id="Video4" class="videos" style="z-index:0;">
	<source src="<?php if(isset($file4)) { echo $file4; }; ?>" type="video/mp4"></source> 
	Browser does not support HTML5. Video could not be loaded.
</video>
									</div>
								</div>
								<?php } ?>
			</div>
			<div class="maincol_bottom"></div>
			</td>		
		</tr>
        <div class="maincol_bottom"></div>
	</table>
	
<script>
var firstplay = 1;
</script>
        
	<div>
	<!-- here was the timetag output test place -->
	</div>
	<div id="rightcol_container"> 
		<div class="maincol_bottom"></div>
	</div>
	<div class="clear"></div>
	<table width="100%" class="vid">
		<tr>
			<td style="width:10px;" ></td>
			<td style="width:30%;padding-top:5px;padding-right:1px;text-align:right;">
			<?php if(isset($_POST['selection'])) { ?>
				<label for="amount2">Time: </label>
				<td style="padding-top:5px;padding-left:1px;text-align:left;">
					<input type="text" id="amount2" style="border: 0 none;border-radius: 4px 4px 4px 4px;color: #F6931F;padding-left: 9px;width: 60px;height:20px;font-size:18px;"> <?php echo "Playing video: " . $filedate;  } ?>
				</td>
			</td>
		</tr>
		<tr>
			<td style="width:10px;padding-top:12px;" >
				<div style="background-color:transparent;" class="maincol" id="playbuttoncol">
					<?php if(isset($_POST['selection'])) { ?>
					<div>
						<input id="playpausebutton" onClick="playpause();" type="button" class="playpausebtn"/>
					</div>
				</div>
			<td colspan="2" style="text-align:top;" id="timeline">
				<div style="background-color:transparent;" class="maincol" id="timelinecol">  
					<div id="slider2" style="width:100%;z-index:99;" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div>
				</div>
				<div class="maincol_bottom"></div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="background-color:transparent;" class="maincol">
					<input id="resetbutton" value="" onClick="resetclock();" type="button" class="resetbtn" />
				</div>
				<?php } ?>
			</td>
		</tr>
        <div class="maincol_bottom"></div>
	</table>

	<div id="footer"></div>
	<div id="testcontainer" class="selectable" style="clear:both;"> <!--background-color:grey; -->
		<br>
		<input id="changer" hidden value=""/>
		<?php if(isset($_POST['selection'])) {
			$mysqli = new mysqli('localhost','gopro','gopro','timetagging'); // Establish database connection
			//$query = "SELECT timetag FROM timetags WHERE date='$filedate' ORDER BY id ASC"; // Query to check the last session number
			$query = "SELECT timetag FROM timetags WHERE timestamp BETWEEN $filedatetimestamp-300 AND $filedatetimestamp+300";
			$n = 1;
			
			if ($result = mysqli_query($mysqli, $query)) { // If there is no error
				$row_cnt = $result->num_rows;
				//echo "<br>Rows: " . $row_cnt;
				while ($row = $result->fetch_row()) { 
					foreach ($row as $rowvalue){
						$timetag[$n] = $rowvalue; ?>
<script type="text/javascript">
<?php 
echo "var time" . $n . " = " . $timetag[$n] . ";";
echo "var n = " . $n . ";";?>
</script>

<?php
						$n++;
					}
				}
			} else {
				echo "<br>Could not load the timetags:<br> (" . $mysqli->errno . ") " . $mysqli->error; // Output error on screen
			}
		}

		/*
$date111 = date("Y-m-d H:i", 1410511560);
$timestamp211 = strtotime('2014-09-12 09:46');
$timestamp212 = strtotime('2014-09-12 09:47');

echo "<br>Date: = " . $date111;
echo "<br>Timestamp 2014-09-12 09:46 = " . $timestamp211;
echo "<br>Timestamp 2014-09-12 09:47 = " . $timestamp212;
$date111 = date("Y-m-d H:i", 1412168859);

echo "<br>Timestamp of 2014-09-12 07:53 (is) = " . $timestamp11;
echo "<br>Timestamp of 2014-09-12 09:53 (should be) = " . $timestamp22;
echo "<br>Time of 1412168859 (is) = " . $date111;

$timestamp1 = strtotime('2014-06-26 18:11');
$timestamp2 = strtotime('2014-06-26 18:22');

if(isset($_POST['selection'])) 
{
  echo '===== TEST CONTAINER =====';
echo "<br>sss";
}
*/
?>

	</div>
	
<script type="text/javascript">

$(document).ready(function (){		
  
	/*for (ind2 = 1; ind2 <= videocount; ind2++) { 
		videopart[ind2] = document.getElementById('samevideo' + ind2).value;
	}*/
	
	
	videocount = document.getElementById('videocount').value;
	parts = document.getElementById('videocount').value;
	totallength = document.getElementById("totallength");
	if (parts > 1) {
		for (i = 1; i <= videocount; i++) { //puts paths to video parts into variables.
			
			window['video1part' + i] = document.getElementById('same1video' + i).value;
			window['video2part' + i] = document.getElementById('same2video' + i).value;
			window['video3part' + i] = document.getElementById('same3video' + i).value;
			window['video4part' + i] = document.getElementById('same4video' + i).value;
			
			window['videolength' + i] = document.getElementById('videolength' + i).value;
			
			/*
			console.log('video4part' + i + ': ' + window['video4part' + i] );
			*/
		}	
	}
});

	parts = document.getElementById('videocount').value;

    var video1 = document.querySelector('#Video1');
    var video2 = document.querySelector('#Video2');
    var video3 = document.querySelector('#Video3');
    var video4 = document.querySelector('#Video4');
	var videos = document.getElementById('.videos');

	window.onload= $(function() {
		var after;
		var currentpart = 1;
		var indic = 0;

		totallength = document.getElementById("totallength");
		maxvalue = document.getElementById("main").clientWidth;
		video1 = document.getElementById("Video1");
		video2 = document.getElementById("Video2");
		video3 = document.getElementById("Video3");
		video4 = document.getElementById("Video4");
		setTimeout(function(){$("#slider2").slider("option", "max", totallength.value)},330);

        $( "#slider2" ).slider({
            step: 1,
    	    animate: true,
			min: 0,
			range: "min",
            slide:  function ( event, ui ) {
			
				stoptime = ui.value * 1000;
				window.clearTimeout(refresh);

				flagplaying = 1;
				if (flagclock==0) {
					if (flagplaying == 1) {
						playpause();
						playpause();
						video1.play() & video2.play() & video3.play() & video4.play();
						playpause.value = 'Pause';
						flagstop = 1;
					}
				} else {
					if (flagplaying == 0) {
						video1.pause() & video2.pause() & video3.pause() & video4.pause();
						playpause.value = 'Play';
						playpause();
						playpause();
						flagclock = 0;
					}
				}
				if (flagplaying == 1) {
					playpause();
					//var playpause = document.getElementById('playpausebutton');
					//setTimeout(function(){playpause.click();},380);
					video1.play() & video2.play() & video3.play() & video4.play();
					playpause.value = 'Pause';
					flagstop = 1;
				}

				if (parts = 1) 	{
					video1.currentTime = ui.value;
					video2.currentTime = ui.value;
					video3.currentTime = ui.value;
					video4.currentTime = ui.value;
				}
				
				if (parts > 1) 	{
				
					$('#Video1').on('ended', function (event) {
						currentpart++;
			
						video1 = document.getElementById("Video1");
						video2 = document.getElementById("Video2");
						video3 = document.getElementById("Video3");
						video4 = document.getElementById("Video4");
						
						playpause();
						video1.setAttribute("src", window['video1part' + currentpart] );
						video2.setAttribute("src", window['video2part' + currentpart] );
						video3.setAttribute("src", window['video3part' + currentpart] );
						video4.setAttribute("src", window['video4part' + currentpart] );
						//video1.pause() & video2.pause() & video3.pause() & video4.pause();
						
						console.log(window['video1part' + currentpart]);
						console.log(window['video2part' + currentpart]);
						console.log(window['video3part' + currentpart]);
						console.log(window['video4part' + currentpart]);
						
						//console.log('indic: ' + indic);
						indic = 1;
						console.log('new indic: ' + indic);

						var ready = 0;
						var v1canplay0 = 0;
						var v2canplay0 = 0;
						var v3canplay0 = 0;
						var v4canplay0 = 0;
		
						function video1ready0() {
							if (video1.readyState == 4) {
								//video1.currentTime = ui.value - videolength1 + 1;
								$('#Video1').on('canplay', function (event) {
									console.log('v1 canplay0');
									v1canplay0 = 1;
								});
							} else {
								v1canplay0 = 0;
								setTimeout(function(){ video1ready0(); }, 800);
							}
						} 
						video1ready0();

						function video2ready0() {
							if (video2.readyState == 4) {
								//video2.currentTime = ui.value - videolength1 + 1;
								$('#Video2').on('canplay', function (event) {
									console.log('v2 canplay0');
									v2canplay0 = 1;
								});
							} else {
								v2canplay0 = 0;
								setTimeout(function(){ video2ready0(); }, 800);
							}
						}
						video2ready0();
		
						function video3ready0() {
							if (video3.readyState == 4) {
								//video3.currentTime = ui.value - videolength1 + 1;
								$('#Video3').on('canplay', function (event) {
									console.log('v3 canplay0');
									v3canplay0 = 1;
								});
							} else {
								v3canplay0 = 0;
								setTimeout(function(){ video3ready0(); }, 800);
							}
						}
						video3ready0();
		
						function video4ready0() {
							if (video4.readyState == 4) {
								//video4.currentTime = ui.value - videolength1 + 1;
								$('#Video4').on('canplay', function (event) {
								console.log('v4 canplay0');
								v4canplay0 = 1;
								});
							} else {
								v4canplay0 = 0;
								setTimeout(function(){ video4ready0(); }, 800);
							}
						} 
						video4ready0();
		
						function canplay0() {
							if (v1canplay0 == 1 && v2canplay0 == 1 && v3canplay0 == 1 && v4canplay0 == 1) {
								$("#box").dialog("close");
								$("#box").dialog("close");
								playpause();
								playpause();
								video1.play() & video2.play() & video3.play() & video4.play();
								$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
								$("#playpausebutton").css('background-size', '48px 48px');
							} else {
								//console.log('checking: ' + i);
								video1.pause() & video2.pause() & video3.pause() & video4.pause();
								setTimeout(function(){ canplay0(); }, 1000);
								i++;
							} 
						} 
						canplay0();
					});
					
					if (ui.value < videolength1) {
						currentpart = 1;
						//console.log('on first part');
						video1.currentTime = ui.value;
						video2.currentTime = ui.value;
						video3.currentTime = ui.value;
						video4.currentTime = ui.value;

						if (indic == 1) {
							playpause();
							//if (after == 1) {
							console.log('indic: ' + indic);
							indic = 0;
							console.log('new indic: ' + indic);
							/* if handler was placed FROM more than 17:26 TO less than 17:26 */
							video1.setAttribute("src", video1part1 );
							video2.setAttribute("src", video2part1 );
							video3.setAttribute("src", video3part1 );
							video4.setAttribute("src", video4part1 );
							console.log('time is now before 17:26');

							var ready = 0;
							var v1canplay1 = 0;
							var v2canplay1 = 0;
							var v3canplay1 = 0;
							var v4canplay1 = 0;
		
							function video1ready1() {
								if (video1.readyState == 4) {
									video1.currentTime = ui.value;
									$('#Video1').on('canplay', function (event) {
										console.log('v1 canplay*');
										v1canplay1 = 1;
									});
								} else {
									v1canplay1 = 0;
									setTimeout(function(){ video1ready1(); }, 800);
								}
							} 
							video1ready1();
		
							function video2ready1() {
								if (video2.readyState == 4) {
									video2.currentTime = ui.value;
									$('#Video2').on('canplay', function (event) {
										console.log('v2 canplay*');
										v2canplay1 = 1;
									});
								} else {
									v2canplay1 = 0;
									setTimeout(function(){ video2ready1(); }, 800);
								}
							} 
							video2ready1();
		
							function video3ready1() {
								if (video3.readyState == 4) {
									video3.currentTime = ui.value;
									$('#Video3').on('canplay', function (event) {
										console.log('v3 canplay*');
										v3canplay1 = 1;
									});
								} else {
									v3canplay1 = 0;
									setTimeout(function(){ video3ready1(); }, 800);
								}
							} 
							video3ready1();
		
							function video4ready1() {
								if (video4.readyState == 4) {
									video4.currentTime = ui.value;
									$('#Video4').on('canplay', function (event) {
										console.log('v4 canplay*');
										v4canplay1 = 1;
									});
								} else {
									v4canplay1 = 0;
									setTimeout(function(){ video4ready1(); }, 800);
								}
							} 
							video4ready1();
		
							function canplay1() {
								if (v1canplay1 == 1 && v2canplay1 == 1 && v3canplay1 == 1 && v4canplay1 == 1) {
									$("#box").dialog("close");
									$("#box").dialog("close");
									playpause();
									video1.play() & video2.play() & video3.play() & video4.play();
									$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
									$("#playpausebutton").css('background-size', '48px 48px');
								} else {
									//console.log('checking: ' + i);
									video1.pause() & video2.pause() & video3.pause() & video4.pause();
									setTimeout(function(){ canplay1(); }, 1000);
									i++;
								} 
							} 
							canplay1();
				/* video swapping code end */
						}
						//}
					} 
			
	//if (ui.value >= videolength1) {

					if (ui.value >= videolength1) {
					
						if (parts == 2) {
							if (indic == 1) {
								/* if handler WAS placed after 17:26 when clicked */
								currentpart = 2;
								console.log('indic: ' + indic);
								indic = 1;
								console.log('still after 17:26!');	
								console.log('new indic: ' + indic);
								//video1.pause() & video2.pause() & video3.pause() & video4.pause();
								video1.currentTime = ui.value - videolength1;
								video2.currentTime = ui.value - videolength1;
								video3.currentTime = ui.value - videolength1;
								video4.currentTime = ui.value - videolength1;
							}

							if (indic == 0) {
								currentpart = 2;
								console.log('indic: ' + indic);
								indic = 1;
								var ready = 0;
								var v1canplay2 = 0;
								var v2canplay2 = 0;
								var v3canplay2 = 0;
								var v4canplay2 = 0;
								i = 0;
								/* if handler WAS NOT placed after 17:26 when clicked */
								console.log('changed from 0 to 1! video is now after 17:26!');
								console.log('new indic: ' + indic);
								//console.log(ui.value);
								video1.setAttribute("src", video1part2 );
								video2.setAttribute("src", video2part2 );
								video3.setAttribute("src", video3part2 );
								video4.setAttribute("src", video4part2 );
		
								function video1ready2() {
									if (video1.readyState == 4) {
										video1.currentTime = ui.value - videolength1;
										$('#Video1').on('canplay', function (event) {
											console.log('v1 canplay***');
											v1canplay2 = 1;
										});
									} else {
										v1canplay2 = 0;
										setTimeout(function(){ video1ready2(); }, 800);
									}
								} 
								video1ready2();
		
								function video2ready2() {
									if (video2.readyState == 4) {
										video2.currentTime = ui.value - videolength1;
										$('#Video2').on('canplay', function (event) {
											console.log('v2 canplay***');
											v2canplay2 = 1;
										});
									} else {
										v2canplay2 = 0;
										setTimeout(function(){ video2ready2(); }, 800);
									}
								} 
								video2ready2();
		
								function video3ready2() {
									if (video3.readyState == 4) {
										video3.currentTime = ui.value - videolength1;
										$('#Video3').on('canplay', function (event) {
											console.log('v3 canplay***');
											v3canplay2 = 1;
										});
									} else {
										v3canplay2 = 0;
										setTimeout(function(){ video3ready2(); }, 800);
									}
								} 
								video3ready2();
		
								function video4ready2() {
									if (video4.readyState == 4) {
										video4.currentTime = ui.value - videolength1;
										$('#Video4').on('canplay', function (event) {
											console.log('v4 canplay***');
											v4canplay2 = 1;
										});
									} else {
										v4canplay2 = 0;
										setTimeout(function(){ video4ready2(); }, 800);
									}
								}
								video4ready2();
		
								function canplay2() {
									if (v1canplay2 == 1 && v2canplay2 == 1 && v3canplay2 == 1 && v4canplay2 == 1) {
										$("#box").dialog("close");
										playpause();
										video1.play() & video2.play() & video3.play() & video4.play();
										$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
										$("#playpausebutton").css('background-size', '48px 48px');
										after = 1;
									} else {
										//console.log('checking: ' + i);
										video1.pause() & video2.pause() & video3.pause() & video4.pause();
										setTimeout(function(){ canplay2(); }, 1000);
										i++;
									} 
								}
								canplay2();
							}
						}
		/* video swapping code end */
		
		
		/*if (parts == 3) {
			var parts3videolength = videolength1 + videolength2;
		if (ui.value >= parts3videolength) {
			if (indic == 1) {
			indic = 1;
		console.log('still after 17:26!');	
		video1.pause() & video2.pause() & video3.pause() & video4.pause();
		video1.currentTime = ui.value - parts3videolength;
		video2.currentTime = ui.value - parts3videolength;
		video3.currentTime = ui.value - parts3videolength;
		video4.currentTime = ui.value - parts3videolength;
		//playpause();
		}


		if (indic == 0) {
			indic = 1;
			var ready = 0;
			var v1canplay = 0;
			var v2canplay = 0;
			var v3canplay = 0;
			var v4canplay = 0;
			i = 0;
		console.log('changed from 0 to 1! video is now after 17:26!');
		//console.log(ui.value);
		
		video1.setAttribute("src", video1part2 );
		video2.setAttribute("src", video2part2 );
		video3.setAttribute("src", video3part2 );
		video4.setAttribute("src", video4part2 );
		
		function video1ready() {
			if (video1.readyState == 4) {
				video1.currentTime = ui.value - parts3videolength;
				$('#Video1').on('canplay', function (event) {
				console.log('v1 canplay');
				v1canplay = 1;
				});
			} else {
				v1canplay = 0;
				setTimeout(function(){ video1ready(); }, 800);
			}
		} video1ready();
		
		function video2ready() {
			if (video2.readyState == 4) {
				video2.currentTime = ui.value - parts3videolength;
				$('#Video2').on('canplay', function (event) {
				console.log('v2 canplay');
				v2canplay = 1;
				});
			} else {
				v2canplay = 0;
				setTimeout(function(){ video2ready(); }, 800);
			}
		} video2ready();
		
		function video3ready() {
			if (video3.readyState == 4) {
				video3.currentTime = ui.value - parts3videolength;
				$('#Video3').on('canplay', function (event) {
				console.log('v3 canplay');
				v3canplay = 1;
				});
			} else {
				v3canplay = 0;
				setTimeout(function(){ video3ready(); }, 800);
			}
		} video3ready();
		
		function video4ready() {
			if (video4.readyState == 4) {
				video4.currentTime = ui.value - parts3videolength;
				$('#Video4').on('canplay', function (event) {
				console.log('v4 canplay');
				v4canplay = 1;
				});
			} else {
				v4canplay = 0;
				setTimeout(function(){ video4ready(); }, 800);
			}
		} video4ready();
		
		function canplay() {
		if (v1canplay == 1 && v2canplay == 1 && v3canplay == 1 && v4canplay == 1) {
			$("#box").dialog("close");
				playpause();
				video1.play() & video2.play() & video3.play() & video4.play();
				$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
				$("#playpausebutton").css('background-size', '48px 48px');
		} else {
			//console.log('checking: ' + i);
			video1.pause() & video2.pause() & video3.pause() & video4.pause();
			setTimeout(function(){ canplay(); }, 1000);
			i++;
		} 
		} canplay();
		
		
		}
		}
		}*/
		
		
					}
				}
				
				var timeInSecs = ui.value;
				var date4 = new Date(null);
				date4.setSeconds(timeInSecs);
				var showtime = date4.getMinutes() + ':' +  date4.getSeconds();

				$( "#amount2" ).val(showtime);
				//	}; CheckLoads().done(NextFunction);
			}
		});
		
		$( "#amount2" ).val($( "#slider2" ).slider( "value" ) );
	
		setTimeout(function(){

		var $slider =  $("#slider2");
		var $timelinecol =  $("#timelinecol");
		var maxx =  $slider.slider("option", "max");
		//var spacing2 =  $slider.width() / (maxx);
		var spacing = $slider.width() / maxx;
		<?php echo "var rowcnt = " . $row_cnt . ";";?>
		//console.log('maxx: ', maxx);
		//console.log('slider width: ', $slider.width());
		//console.log('themax: ', maxx);
		//console.log('spacing: ', spacing);
		//console.log('myVid.duration: ', myVid.duration);
		//console.log('rowcnt: ', rowcnt);
		for (i=1; i <= rowcnt; i++) {
			var tag = eval('tag = --time'+i) * spacing ; // Creating a tag. Dangerous function!!
			var labelInSecs = eval('++time'+i); // Creating a label. Dangerous function!!
			var date3 = new Date(null);
			date3.setSeconds(labelInSecs);
			var label = date3.getMinutes() + ':' +  date3.getSeconds();
			$("<span class='ui-slider-tick-mark'><br><span style='font-size:12px;text-align:left;'>"+label+"</span></span>").css('left', tag + 'px').appendTo($slider); // Puts the tag and label on the timeline
		}},340);
		
	});

</script>


<script type="text/javascript">

myVid=document.getElementById("Video1");
setTimeout(function() {
	test=myVid.duration;
},300);


/*function getVidDuration() //this gets the video length. Used for test purposes
  { 
setTimeout(function(){document.getElementById('time').innerHTML=test.toFixed(1)+" seconds";},380);
}*/



var flagclock = 0;
var flagstop = 0;
var stoptime = 0;
var flagplaying = 0;
var video1 = document.getElementById("Video1");
var video2 = document.getElementById("Video2");
var video3 = document.getElementById("Video3");
var video4 = document.getElementById("Video4");
var slider = $("#slider2");

function playpause() {
	//var playpausefunction = function() {
	if ( video1.readyState === 4 && video2.readyState === 4 && video3.readyState === 4 && video4.readyState === 4 ) {
			
		var playpause = document.getElementById('playpausebutton');
		var startdate = new Date();
		var starttime = startdate.getTime();
		if (flagclock==0) {
			video1.play() & video2.play() & video3.play() & video4.play();
			//playpause.value = 'Pause';
			$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
			$("#playpausebutton").css('background-size', '48px 48px');
			flagclock = 1;
			flagplaying = 1;
			counter(starttime);
			// output.value = ''; // Needed only to clear the output field. Usefull when there are unnecessary tags left in it.
		} else {
			video1.pause() & video2.pause() & video3.pause() & video4.pause();
			//playpause.value = 'Play';
			$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
			$("#playpausebutton").css('background-size', '48px 48px');
			flagplaying = 0;
			flagclock = 0;
			flagstop = 1;
			//counter(starttime);
		}
	}
	//};
	//CheckLoads().done(playpausefunction);
}

function counter(starttime) {
	firstplay = 0;
	//var counterfunction = function() {
	
	//output = document.getElementById('timeValue2');
	clock = document.getElementById('amount2');

	currenttime = new Date();
	var timediff = currenttime.getTime() - starttime;

	if (flagstop == 1) {
		timediff = timediff + stoptime;
	}
	if (flagclock == 1) {
		clock.value = formattime(timediff,'');
		refresh = setTimeout('counter(' + starttime + ');',10);
		formattime2();
	} else {
		window.clearTimeout(refresh);
		stoptime = timediff;
		//console.log(stoptime);
	}
	// };  CheckLoads().done(counterfunction);
}  

function formattime(rawtime,roundtype) {

	if (roundtype == 'round') {
		var ds = Math.round(rawtime/100) + '';
	} else {
		var ds = Math.floor(rawtime/100) + '';
	}
	
	var sec = Math.floor(rawtime/1000);
	var min = Math.floor(rawtime/60000);
	ds = ds.charAt(ds.length - 1);
	
	if (min >= 60) {
		playpause();
	}
	
	sec = sec - 60 * min + '';
	
	if (sec.charAt(sec.length - 2) != '') {
		sec = sec.charAt(sec.length - 2) + sec.charAt(sec.length - 1);
	} else {
		sec = 0 + sec.charAt(sec.length - 1);
	}
	
	min = min + '';
	
	if (min.charAt(min.length - 2) != '') {
		min = min.charAt(min.length - 2)+min.charAt(min.length - 1);
	} else {
		min = 0 + min.charAt(min.length - 1);
	}
	
	return min + ':' + sec;
}

function formattime2() {

	var hms = clock.value;   // your input string
	var a = hms.split(':'); // split it at the colons

	// minutes are worth 60 seconds. Hours are worth 60 minutes.
	var seconds1 = (+a[0] * 60 + +a[1]); 

	slider.slider('option', 'value', seconds1);
}

function resetclock() {

	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	video1.currentTime = 0 ;
	video2.currentTime = 0 ;
	video3.currentTime = 0 ;
	video4.currentTime = 0 ;
	slider.slider("option", "value", 0);
	flagstop = 0;
	stoptime = 0;
	splitdate = '';
	window.clearTimeout(refresh);
	//output.value = '';
	splitcounter = 0;
	//playpause.value = 'Play';
	
	if (flagclock == 1) {
		//playpause.value = 'Play';
		flagclock = 0;
		flagstop = 1;
		clock.value = "00:00";
		sessionStorage.clear();
		localStorage.clear();
	} else {
		//playpause.value = 'Play';
		clock.value = "00:00";
	}
}

function splittime() {
	if (flagclock == 1) {
		if (splitdate != '') {
			var splitold = splitdate.split(':');
			var splitnow = clock.value.split(':');
			var numbers = new Array();
			var i = 0
			for (i; i<splitold.length; i++) {
				numbers[i] = new Array();
				numbers[i][0] = splitold[i]*1;
				numbers[i][1] = splitnow[i]*1;
			}
			if (numbers[1][1] < numbers[1][0]) {
				numbers[1][1] += 60;
				numbers[0][1] -= 1;
			}
			var mzeros = (numbers[0][1] - numbers[0][0]) < 10?'0':'';
			var szeros = (numbers[1][1] - numbers[1][0]) < 10?'0':'';
		}

		splitdate = clock.value;
		output.value += clock.value + " \n";
	}
}

function produceDialog(){
	$("#box").dialog({
		open : function ( event, ui ) {
			$(".ui-dialog-titlebar-close").hide();
			$(".ui-dialog-titlebar").hide();
		},
		resizable : false,
		modal : true,
		draggable : false,
		height : 130,
		width : 250,
		create : function ( event ) {
			$(event.target).parent().css('position', 'fixed');
		},
	});
}
	
var v1 = 0;
var v2 = 0;
var v3 = 0;
var v4 = 0;
video1 = document.getElementById("Video1");
video2 = document.getElementById("Video2");
video3 = document.getElementById("Video3");
video4 = document.getElementById("Video4");
playppause = document.getElementById('playpausebutton');

$('#Video1').on('waiting', function (event) {
	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
	$("#playpausebutton").css('background-size', '48px 48px');
    produceDialog();
	//$('#main').addClass('whitebck');
	v1 = 0;
});

$('#Video2').on('waiting', function (event) {
 	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
	$("#playpausebutton").css('background-size', '48px 48px');
    produceDialog();
	//$('#main').addClass('whitebck');
	v2 = 0;
});

$('#Video3').on('waiting', function (event) {
 	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
	$("#playpausebutton").css('background-size', '48px 48px');
    produceDialog();
	//$('#main').addClass('whitebck');
	v3 = 0;
});

$('#Video4').on('waiting', function (event) {
 	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
	$("#playpausebutton").css('background-size', '48px 48px');
    produceDialog();
	//$('#main').addClass('whitebck');
	v4 = 0;
});
	
$('.videos').on('waiting', function (event) {
	//$('#main').removeClass('whitebck');
	playpause();
	playpause();
	video1.pause() & video2.pause() & video3.pause() & video4.pause();
	$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
	$("#playpausebutton").css('background-size', '48px 48px');
	produceDialog();
	v1 = 0;
	v2 = 0;
	v3 = 0;
	v4 = 0;
});
  
$('#Video1').on('canplay', function (event) {
	v1 = 1;
});
$('#Video2').on('canplay', function (event) {
	v2 = 1;
});
$('#Video3').on('canplay', function (event) {
	v3 = 1;
});
$('#Video4').on('canplay', function (event) {
	v4 = 1;
});
  
$('.videos').on('canplay', function (event) {
	if (v1 == 1 && v2 == 1 && v3 == 1 && v4 == 1) {
		$("#box").dialog("close");
		if (firstplay == 1) {
			video1.pause() & video2.pause() & video3.pause() & video4.pause();
			$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
			$("#playpausebutton").css('background-size', '48px 48px');
		} else {
			firstplay = 0;
			playpause();
			video1.play() & video2.play() & video3.play() & video4.play();
			$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
			$("#playpausebutton").css('background-size', '48px 48px');
		}
	} else {
		video1.pause() & video2.pause() & video3.pause() & video4.pause();
		$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
		$("#playpausebutton").css('background-size', '48px 48px');
		produceDialog();
	}
});
  
  
/*
    function vidplay() {
       var video1 = document.getElementById("Video1");
       var video2 = document.getElementById("Video2");
       var video3 = document.getElementById("Video3");
       var video4 = document.getElementById("Video4");
       if (video1.paused) {
          video1.play() & video2.play() & video3.play() & video4.play();
      } else {
          video1.pause() & video2.pause() & video3.pause() & video4.pause();
       }
    }


function forcevidplay() {
       var video1 = document.getElementById("Video1");
       var video2 = document.getElementById("Video2");
       var video3 = document.getElementById("Video3");
       var video4 = document.getElementById("Video4");
       var button = document.getElementById("play");
          video1.play() & video2.play() & video3.play() & video4.play();
          //button.textContent = "Pause";
   }*/


$(document).ready(function() {

	/* ========================== Rotate video ===================== */

	/*
	$('#rotate').on('click', function () {
		$('#Video1').addClass('videorotate');
	});
	*/




	/* ========================== Blur the screen ================== */

	$('#blur1').click(function() {
		$('#Video1').toggleClass('blurblur');
	});

	$('#blur2').click(function() {
		$('#Video2').toggleClass('blurblur');
	});

	$('#blur3').click(function() {
		$('#Video3').toggleClass('blurblur');
	});

	$('#blur4').click(function() {
		$('#Video4').toggleClass('blurblur');
	});

	$('#blurc11').click(function() {
		$('#Video1').toggleClass('blurblur');
	});

	$('#blurc12').click(function() {
		$('#Video2').toggleClass('blurblur');
	});

	$('#blurc13').click(function() {
		$('#Video3').toggleClass('blurblur');
	});

	$('#blurc14').click(function() {
		$('#Video4').toggleClass('blurblur');
	});

	$('#blurc21').click(function() {
		$('#Video1').toggleClass('blurblur');
	});

	$('#blurc22').click(function() {
		$('#Video2').toggleClass('blurblur');
	});

	$('#blurc23').click(function() {
		$('#Video3').toggleClass('blurblur');
	});

	$('#blurc24').click(function() {
		$('#Video4').toggleClass('blurblur');
	});

	$('#blurc31').click(function() {
		$('#Video1').toggleClass('blurblur');
	});

	$('#blurc32').click(function() {
		$('#Video2').toggleClass('blurblur');
	});

	$('#blurc33').click(function() {
		$('#Video3').toggleClass('blurblur');
	});

	$('#blurc34').click(function() {
		$('#Video4').toggleClass('blurblur');
	});

	$('#blurc41').click(function() {
		$('#Video1').toggleClass('blurblur');
	});

	$('#blurc42').click(function() {
		$('#Video2').toggleClass('blurblur');
	});

	$('#blurc43').click(function() {
		$('#Video3').toggleClass('blurblur');
	});

	$('#blurc44').click(function() {
		$('#Video4').toggleClass('blurblur');
	});
});

$(window).load(function() {
  
	$('#fullscreenvid1').hover(function() {
		$("#fullscreenvid1").show();
	});
	$('#fullscreenvid2').hover(function() {
		$("#fullscreenvid2").show();
	});
	$('#fullscreenvid3').hover(function() {
		$("#fullscreenvid3").show();
	});
	$('#fullscreenvid4').hover(function() {
		$("#fullscreenvid4").show();
	});

	$('#blur1').hover(function() {
		$("#blur1").show();
	});
	$('#blur2').hover(function() {
		$("#blur2").show();
	});
	$('#blur3').hover(function() {
		$("#blur3").show();
	});
	$('#blur4').hover(function() {
		$("#blur4").show();
	});

	$('#aud1').hover(function() {
		$("#aud1").show();
	});
	$('#aud2').hover(function() {
		$("#aud2").show();
	});
	$('#aud3').hover(function() {
		$("#aud3").show();
	});
	$('#aud4').hover(function() {
		$("#aud4").show();
	});

	$('#fullc11').hover(function() {
		$("#fullc11").show();
	});
	$('#fullc12').hover(function() {
		$("#fullc12").show();
	});
	$('#fullc13').hover(function() {
		$("#fullc13").show();
	});
	$('#fullc14').hover(function() {
		$("#fullc14").show();
	});
	$('#fullc21').hover(function() {
		$("#fullc21").show();
	});
	$('#fullc22').hover(function() {
		$("#fullc22").show();
	});
	$('#fullc23').hover(function() {
		$("#fullc23").show();
	});
	$('#fullc24').hover(function() {
		$("#fullc24").show();
	});
	$('#fullc31').hover(function() {
		$("#fullc31").show();
	});
	$('#fullc32').hover(function() {
		$("#fullc32").show();
	});
	$('#fullc33').hover(function() {
		$("#fullc33").show();
	});
	$('#fullc34').hover(function() {
		$("#fullc34").show();
	});
	$('#fullc41').hover(function() {
		$("#fullc41").show();
	});
	$('#fullc42').hover(function() {
		$("#fullc42").show();
	});
	$('#fullc43').hover(function() {
		$("#fullc43").show();
	});
	$('#fullc44').hover(function() {
		$("#fullc44").show();
	});

	$('#blurc11').hover(function() {
		$("#blurc11").show();
	});
	$('#blurc12').hover(function() {
		$("#blurc12").show();
	});
	$('#blurc13').hover(function() {
		$("#blurc13").show();
	});
	$('#blurc14').hover(function() {
		$("#blurc14").show();
	});
	$('#blurc21').hover(function() {
		$("#blurc21").show();
	});
	$('#blurc22').hover(function() {
		$("#blurc22").show();
	});
	$('#blurc23').hover(function() {
		$("#blurc23").show();
	});
	$('#blurc24').hover(function() {
		$("#blurc24").show();
	});
	$('#blurc31').hover(function() {
		$("#blurc31").show();
	});
	$('#blurc32').hover(function() {
		$("#blurc32").show();
	});
	$('#blurc33').hover(function() {
		$("#blurc33").show();
	});
	$('#blurc34').hover(function() {
		$("#blurc34").show();
	});
	$('#blurc41').hover(function() {
		$("#blurc41").show();
	});
	$('#blurc42').hover(function() {
		$("#blurc42").show();
	});
	$('#blurc43').hover(function() {
		$("#blurc43").show();
	});
	$('#blurc44').hover(function() {
		$("#blurc44").show();
	});

	$('#aud11').hover(function() {
		$("#aud11").show();
	});
	$('#aud12').hover(function() {
		$("#aud12").show();
	});
	$('#aud13').hover(function() {
		$("#aud13").show();
	});
	$('#aud14').hover(function() {
		$("#aud14").show();
	});
	$('#aud21').hover(function() {
		$("#aud21").show();
	});
	$('#aud22').hover(function() {
		$("#aud22").show();
	});
	$('#aud23').hover(function() {
		$("#aud23").show();
	});
	$('#aud24').hover(function() {
		$("#aud24").show();
	});
	$('#aud31').hover(function() {
		$("#aud31").show();
	});
	$('#aud32').hover(function() {
		$("#aud32").show();
	});
	$('#aud33').hover(function() {
		$("#aud33").show();
	});
	$('#aud34').hover(function() {
		$("#aud34").show();
	});
	$('#aud41').hover(function() {
		$("#aud41").show();
	});
	$('#aud42').hover(function() {
		$("#aud42").show();
	});
	$('#aud43').hover(function() {
		$("#aud43").show();
	});
	$('#aud44').hover(function() {
		$("#aud44").show();
	});

	var $contimages = $('.contimages');
	var $fullcont = $('.fullcont');
	if ($("#vid1").find("#Video1").length ) {
	
		$contimages.hide();
		$fullcont.hide();
		$('#Video1').hover(function() {
			$("#fullscreenvid1").show();
			$("#blur1").show();
			$("#aud1").show();
		  }, function() {
			$("#fullscreenvid1").hide();
			$("#blur1").hide();
			$("#aud1").hide();
		  });
		  
		$('#Video2').hover(function() {
			$("#fullscreenvid2").show();
			$("#blur2").show();
			$("#aud2").show();
		}, function() {
			$("#fullscreenvid2").hide();
			$("#blur2").hide();
			$("#aud2").hide();
		});

		$('#Video3').hover(function() {
			$("#fullscreenvid3").show();
			$("#blur3").show();
			$("#aud3").show();
		}, function() {
			$("#fullscreenvid3").hide();
			$("#blur3").hide();
			$("#aud3").hide();
		});

		$('#Video4').hover(function() {
			$("#fullscreenvid4").show();
			$("#blur4").show();
			$("#aud4").show();
		}, function() {
			$("#fullscreenvid4").hide();
			$("#blur4").hide();
			$("#aud4").hide();
		});
	} else {
		$("#fullscreenvid1").hide();
		$("#fullscreenvid2").hide();
		$("#fullscreenvid3").hide();
		$("#fullscreenvid4").hide();
		$("#blur1").hide();
		$("#blur2").hide();
		$("#blur3").hide();
		$("#blur4").hide();
		("#aud1").hide();
		("#aud2").hide();
		("#aud3").hide();
		("#aud4").hide();
	}
});

$(window).load(function() {
	var $images = $('.images');
	var $redimages = $('.redimages');
	$redimages.show();

	if (document.getElementById('Video1').muted == false) {
		$("#img1").hide();
		$("#img11").show();
	}

	if (document.getElementById('Video2').muted == false) {
		$("#img2").hide();
		$("#img22").show();
	}

	if (document.getElementById('Video3').muted == false) {
		$("#img3").hide();
		$("#img33").show();
	}

	if (document.getElementById('Video4').muted == false) {
		$("#img4").hide();
		$("#img44").show();
	}
});


var $images = $('.images');
function mute1() {
	$images.hide();
	document.getElementById('Video1').muted=false; 
	document.getElementById('Video2').muted=true;
	document.getElementById('Video3').muted=true;
	document.getElementById('Video4').muted=true;

	if ($("#vid1").find("#Video1").length) {
		$images.hide();
		$("#img11").show();
		$("#img2").show();
		$("#img3").show(); 
		$("#img4").show();
	} else {
		if ($("#cont1").find("#Video1").length) {
			$images.hide();
			$("#imgcont11").hide();
			$("#imgcont111").show();
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}

		if ($("#cont2").find("#Video1").length) {
			$images.hide();
			$("#imgcont21").hide();
			$("#imgcont211").show();
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		
		if ($("#cont3").find("#Video1").length) {
			$images.hide();
			$("#imgcont31").hide();
			$("#imgcont311").show();
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		
		if ($("#cont4").find("#Video1").length) {
			$images.hide();
			$("#imgcont41").hide();
			$("#imgcont411").show();
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont433").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
		}
	}
};


function mute2() {
	$images.hide();
	document.getElementById('Video1').muted=true; 
	document.getElementById('Video2').muted=false;
	document.getElementById('Video3').muted=true;
	document.getElementById('Video4').muted=true;

	if ($("#vid2").find("#Video2").length) {
		$images.hide();
		$("#img1").show();
		$("#img22").show();
		$("#img3").show(); 
		$("#img4").show();
	} else {
		if ($("#cont1").find("#Video2").length) {
			$images.hide();
			$("#imgcont12").hide();
			$("#imgcont122").show();
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		
		if ($("#cont2").find("#Video2").length) {
			$images.hide();
			$("#imgcont22").hide();
			$("#imgcont222").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont11").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		
		if ($("#cont3").find("#Video2").length) {
			$images.hide();
			$("#imgcont32").hide();
			$("#imgcont322").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		if ($("#cont4").find("#Video2").length) {
			$images.hide();
			$("#imgcont42").hide();
			$("#imgcont422").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont22").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont32").show();
				$("#imgcont344").hide();
			}
		} 
	}
};

function mute3() {
	$images.hide();
	document.getElementById('Video1').muted=true; 
	document.getElementById('Video2').muted=true;
	document.getElementById('Video3').muted=false;
	document.getElementById('Video4').muted=true;

	if ($("#vid3").find("#Video3").length) {
		$images.hide();
		$("#img1").show();
		$("#img2").show();
		$("#img33").show(); 
		$("#img4").show();
	} else {
		if ($("#cont1").find("#Video3").length) {
			$images.hide();
			$("#imgcont13").hide();
			$("#imgcont133").show();
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
	
		if ($("#cont2").find("#Video3").length) {
			$images.hide();
			$("#imgcont23").hide();
			$("#imgcont233").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		if ($("#cont3").find("#Video3").length) {
			$images.hide();
			$("#imgcont33").hide();
			$("#imgcont333").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video4").length) {
				$("#imgcont14").show();
				$("#imgcont144").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		}
		if ($("#cont4").find("#Video3").length) {
			$images.hide();
			$("#imgcont43").hide();
			$("#imgcont433").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont2").find("#Video4").length) {
				$("#imgcont24").show();
				$("#imgcont244").hide();
			}
			if ($("#cont3").find("#Video4").length) {
				$("#imgcont34").show();
				$("#imgcont344").hide();
			}
			if ($("#cont4").find("#Video4").length) {
				$("#imgcont44").show();
				$("#imgcont444").hide();
			}
		} 
	}
};

function mute4() {
	$images.hide();
	document.getElementById('Video1').muted=true; 
	document.getElementById('Video2').muted=true;
	document.getElementById('Video3').muted=true;
	document.getElementById('Video4').muted=false;

	if ($("#vid4").find("#Video4").length) {
		$images.hide();
		$("#img1").show();
		$("#img2").show();
		$("#img3").show(); 
		$("#img44").show();
	} else {
		if ($("#cont1").find("#Video4").length) {
			$images.hide();
			$("#imgcont14").hide();
			$("#imgcont144").show();
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
		}
		
		if ($("#cont2").find("#Video4").length) {
			$images.hide();
			$("#imgcont24").hide();
			$("#imgcont244").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont311").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
		}
		
		if ($("#cont3").find("#Video4").length) {
			$images.hide();
			$("#imgcont34").hide();
			$("#imgcont344").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont4").find("#Video1").length) {
				$("#imgcont41").show();
				$("#imgcont411").hide();
			}
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont4").find("#Video2").length) {
				$("#imgcont42").show();
				$("#imgcont422").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont4").find("#Video3").length) {
				$("#imgcont43").show();
				$("#imgcont433").hide();
			}
		}
		
		if ($("#cont4").find("#Video4").length) {
			$images.hide();
			$("#imgcont44").hide();
			$("#imgcont444").show();
			if ($("#cont1").find("#Video1").length) {
				$("#imgcont11").show();
				$("#imgcont111").hide();
			}
			if ($("#cont2").find("#Video1").length) {
				$("#imgcont21").show();
				$("#imgcont211").hide();
			}
			if ($("#cont3").find("#Video1").length) {
				$("#imgcont31").show();
				$("#imgcont3111").hide();
			}
			if ($("#cont1").find("#Video2").length) {
				$("#imgcont12").show();
				$("#imgcont122").hide();
			}
			if ($("#cont2").find("#Video2").length) {
				$("#imgcont22").show();
				$("#imgcont222").hide();
			}
			if ($("#cont3").find("#Video2").length) {
				$("#imgcont32").show();
				$("#imgcont322").hide();
			}
			if ($("#cont1").find("#Video3").length) {
				$("#imgcont13").show();
				$("#imgcont133").hide();
			}
			if ($("#cont2").find("#Video3").length) {
				$("#imgcont23").show();
				$("#imgcont233").hide();
			}
			if ($("#cont3").find("#Video3").length) {
				$("#imgcont33").show();
				$("#imgcont333").hide();
			}
		} 
	}
};

(function(window, document){
	var $ = function(selector,context){return(context||document).querySelector(selector)};
	var video1  = $("#Video1"),
	domPrefixes = 'Webkit Moz O ms Khtml'.split(' ');
	var video2  = $("#Video2"),
	domPrefixes = 'Webkit Moz O ms Khtml'.split(' ');
	var video3  = $("#Video3"),
	domPrefixes = 'Webkit Moz O ms Khtml'.split(' ');
	var video4  = $("#Video4"),
	domPrefixes = 'Webkit Moz O ms Khtml'.split(' ');

	var fullscreen = function(elem) {
		var prefix;
		// Mozilla and webkit intialise fullscreen slightly differently
		for ( var i = -1, len = domPrefixes.length; ++i < len; ) {
			prefix = domPrefixes[i].toLowerCase();
				  
			if ( elem[prefix + 'EnterFullScreen'] ) {
				// Webkit uses EnterFullScreen for video
				return prefix + 'EnterFullScreen';
				break;
				} else if ( elem[prefix + 'RequestFullScreen'] ) {
				// Mozilla uses RequestFullScreen for all elements and webkit uses it for non video elements
					return prefix + 'RequestFullScreen';
					break;
				}
		}
		return false;
	};
			
		// Will return fullscreen method as a string if supported e.g. "mozRequestFullScreen" || false;
		var fullscreenvideo1 = fullscreen(document.createElement("videoo1"));
		var fullscreenvideo2 = fullscreen(document.createElement("videoo2"));
		var fullscreenvideo3 = fullscreen(document.createElement("videoo3"));
		var fullscreenvideo4 = fullscreen(document.createElement("videoo4"));
			
		if(!fullscreen) {
			alert("Fullscreen won't work, please make sure you're using a browser that supports it and you have enabled the feature");
			return;
		}
			
		// Should add prefixed events for potential ms/o or unprefixed support too
		video1.addEventListener("webkitfullscreenchange",function(){
			console.log(document.webkitIsFullScreen);
		}, false);
		video2.addEventListener("webkitfullscreenchange",function(){
			console.log(document.webkitIsFullScreen);
		}, false);
		video3.addEventListener("webkitfullscreenchange",function(){
			console.log(document.webkitIsFullScreen);
		}, false);
		video4.addEventListener("webkitfullscreenchange",function(){
			console.log(document.webkitIsFullScreen);
		}, false);
		video1.addEventListener("mozfullscreenchange",function(){
			console.log(document.mozFullScreen);
		}, false);
		video2.addEventListener("mozfullscreenchange",function(){
			console.log(document.mozFullScreen);
		}, false);
		video3.addEventListener("mozfullscreenchange",function(){
			console.log(document.mozFullScreen);
		}, false);
		video4.addEventListener("mozfullscreenchange",function(){
			console.log(document.mozFullScreen);
		}, false);

		$("#fullscreenvid1").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video1[fullscreenvideo1]();
		}, false);
		$("#fullscreenvid2").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video2[fullscreenvideo2]();
		}, false);
		$("#fullscreenvid3").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video3[fullscreenvideo3]();
		}, false);
		$("#fullscreenvid4").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video4[fullscreenvideo4]();
		}, false);
		$("#fullc11").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video1[fullscreenvideo1]();
		}, false);
		$("#fullc12").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video2[fullscreenvideo2]();
		}, false);
		$("#fullc13").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video3[fullscreenvideo3]();
		}, false);
		$("#fullc14").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video4[fullscreenvideo4]();
		}, false);
		$("#fullc21").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video1[fullscreenvideo1]();
		}, false);
		$("#fullc22").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video2[fullscreenvideo2]();
		}, false);
		$("#fullc23").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video3[fullscreenvideo3]();
		}, false);
		$("#fullc24").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video4[fullscreenvideo4]();
		}, false);
		$("#fullc31").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video1[fullscreenvideo1]();
		}, false);
		$("#fullc32").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video2[fullscreenvideo2]();
		}, false);
		$("#fullc33").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video3[fullscreenvideo3]();
		}, false);
		$("#fullc34").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video4[fullscreenvideo4]();
		}, false);
		$("#fullc41").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video1[fullscreenvideo1]();
		}, false);
		$("#fullc42").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video2[fullscreenvideo2]();
		}, false);
		$("#fullc43").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video3[fullscreenvideo3]();
		}, false);
		$("#fullc44").addEventListener("click", function(){
			// The test returns a string so we can easily call it on a click event
			video4[fullscreenvideo4]();
		}, false);
		
})(this, this.document);
	</script>

         <div id="footer">
			<h3>created by gintas pociunas, 2014. 
				<span>
					<img id="copyleft" src="copyleft.png" alt="cl logo" />
				</span> (copyleft) OpenSource
			</h3>
		</div>
		<div id="footer" class="selectable" style="font-family:Calibri, Helvetica, sans-serif;">
			<a class="selectable" style="text-decoration:none;color:#1A171B;" href="mailto:geantas@gmail.com" target="_top">info@ginto.lt</a>
		</div>
	</div>
</div>
</body>
</html>

