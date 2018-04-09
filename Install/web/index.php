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


 </style>
<script>
 $(function() {
$( "#slider2" ).slider();
});
</script>
<script>
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
    };?>

</head>

<body bgcolor="#1A171B" class="disab" >

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
<div style="float:right;"  ><a  style="color:#FFFFFF;font-size:24px;">Gintas View <span><a  style="text-decoration:none;color:#FFFFFF;font-size:24px;" href="news.php" target="_blank">v1.3 </a><span style="color:#FFFFFF;font-size:10px"> for <?php echo $platform; ?></span></a></div>

</div>
<div align="right" style="margin-top:-10px;"  ><a  style="color:#FFFFFF;font-size:14px;text-decoration:none;color:#FFFFFF;" href="tag.php" target="_blank">Tag times</a></div>
</div>

<div id="spacer"></div>
    <div id="main"><?php if(!isset($_POST['selection'])) { ?><div align="center"> <span style="font-size:20px;">Please select a video file. </span></div><?php } ?>
    <div id="leftcol_container" >
    	<div class="leftcol">
    	<div class="leftcol">
<?php if(isset($_POST['selection'])) { ?><div><button class="submitbutton" id="fit">Fit to screen</button></div><?php } ?>
<span style="font-size:16px;color:#FFFFFF;"><?php if(!isset($_POST['selection'])) { ?>Select a video here:</span><?php } ?>
<?php echo "<div id='labas'><span id='videofile'>". $filedate . "</span></div>";?>
<?php if(isset($_POST['selection'])) { ?>
<span>Select another video:<?php } ?></span>
        	 <form class="green"  action="" method="post"> <!-- from this form we will have a value in $_POST['selection'] -->

<?php 
date_default_timezone_set('UTC');


    



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


$dir    = '/gopromedia/' . $user; //need to find a solution how to find cameras directories when they appear not in /media/gintas


$files1 = glob("$dir/BC*", GLOB_ONLYDIR); //gets all directories which starts with "BC" names.


//Puts all 4 cameras directories (BC*) to 4 variables.
$cam_dir1 = $files1[0];
$cam_dir2 = $files1[1];
$cam_dir3 = $files1[2];
$cam_dir4 = $files1[3];

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
        $ret[$i]['filetime'] = filectime($filename);
        $i++;
    }
    return $ret;
}


//outputs the list of files, sorted by date, named by modification date, to the "select" tag.
$thelist = '<select size="1" name="selection">';
foreach (get_media("$cam_dir1", array('mp4')) as $file)
{
    $thelist .= '<option value="'.$file['filename'].'">'.date("Y-m-d H:i",$file['filetime']).'</option>';
}
$thelist .= '</select>';
echo $thelist;


//Code for first camera stream end//

?>

<?php
$filename = $_POST['selection']; //puts selected files name into variable filename.
if(isset($_POST['selection']))  //if the file IS selected, then:
{
 if (file_exists($filename)) //check if file actually exists. If yes, then:
 {
   $filedate = date("Y-m-d H:i", filemtime($filename)); //take file modification date and put it in variable filedate.

}
}
echo "<p>";

?>

<?php //Code for second camera stream
   $filedatetimestamp = strtotime($filedate);
//$filedatetimestamp = strtotime('2014-06-27 09:48');

$files2 = glob("$cam_dir2/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in second camera directory

foreach ($files2 as $filename2)
{

$filedate2 = date("Y-m-d H:i", filemtime($filename2));

$newfiledate1 = new DateTime($filedate); //takes $filedate time and makes it as a new time; puts in variable
$newfiledate2 = new DateTime($filedate2); //takes $filedate2 time and makes it as a new time; puts in variable
$interval1 = $newfiledate1->diff($newfiledate2); //calculates the time difference (interval) between two newly created variables
$newInterval1 = $interval1->format('%i'); //outputs the value in numberic format (1,2,3, etc..)

if ($newInterval1 < 6)
{ //if the difference between two newly created times are less than 6, then

$file2 = $filename2; //put filename2 to file2 variable
} 
}
//Code for second camera stream end//
?>


<?php //Code for third camera stream

$files3 = glob("$cam_dir3/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in third camera directory

foreach ($files3 as $filename3)
{

$filedate3 = date("Y-m-d H:i", filemtime($filename3));

$newfiledate3 = new DateTime($filedate3); //takes $filedate3 time and makes it as a new time; puts in variable
$interval2 = $newfiledate1->diff($newfiledate3); //calculates the time difference (interval) between two newly created variables
$newInterval2 = $interval2->format('%i'); //outputs the value in numberic format (1,2,3, etc..)

if ($newInterval2 < 6) 
{
$file3 = $filename3; //puts filename3 to file3 variable
} 
}
//Code for third camera stream end//

?>

<p hidden>originally created by gintas pociunas, 2014</p>



<?php //Code for fourht camera stream

$files4 = glob("$cam_dir4/DCIM/100GOPRO/*.*4"); //gets all file names which end with "4" in fourth camera directory

foreach ($files4 as $filename4)
{

$filedate4 = date("Y-m-d H:i", filemtime($filename4));

$newfiledate4 = new DateTime($filedate4); //takes $filedate4 time and makes it as "time"; puts in variable
$interval3 = $newfiledate1->diff($newfiledate4); //calculates the time difference (interval) between two newly created variables
$newInterval3 = $interval3->format('%i'); //outputs the value in numberic format (1,2,3, etc..)

if ($newInterval3 < 6) 
{
$file4 = $filename4; //puts filename4 to file4 variable
}
}
//Code for fourth camera stream end//
?>

     <input type="submit" class="submitbutton" value="    Select   " onclick="getVidDuration()">
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
</div></div>
        </div>   
        <div id="maincol_container" >
 
<?php if(isset($_POST['selection'])) { // This will hide the video before submission ?>
<table class="vid">
<tr>
<td colspan="2" style="width:10px;">
<STYLE>
video.videos {
   /* background-image: url(fullscreen.png);
    background-repeat: no-repeat;*/
    z-index:1;
}
</STYLE>


<div class="maincol"> 
<div id="vid1"  >
<img id="aud1" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute1();"/>
<img id="fullscreenvid1" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blur1" class="vidimage fullimages" src="blur.png" style="display:none; z-index:1; margin-top:26px; width:28px; height:28px; position:absolute; " />
<img id="img1" class="vidimage images redimages" src="red01.png" style="display:none; z-index:0;  position: absolute; " />   
<img id="img11" class="vidimage images" src="yellow01.png" style="display:none; z-index:0; position: absolute; " />
<!-- <button id="fullscreenvid1" class="button fullscreenvideoo images" style="display:none; z-index:0; margin-left: 26px; margin-top:1px; position: absolute;"  ></button> -->

  <video id="Video1" class="videos" style="z-index:0;" >
       <source src="<?php echo $_POST['selection']; ?>" type="video/mp4"></source> 
<!--<source src="/media/gintas/GOPR0005.MP4" type="video/mp4"></source> -->
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
   <source src="<?php echo $file2; ?>" type="video/mp4"></source> 
<!--   <source src="/media/gintas/GOPR0014.MP4" type="video/mp4"></source>-->
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
</td></tr>
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
   <source src="<?php echo $file3; ?>" type="video/mp4"></source>   
 <!-- <source src="/media/gintas/GOPR0017.MP4" type="video/mp4"></source> -->
     Browser does not support HTML5. Video could not be loaded.
</video>
</div>

        </div>
        <div class="maincol_bottom"></div>
</td>
  <td >
<div class="maincol">    

<div id="vid4">
<img id="aud4" class="vidimage fullimages" src="audio.png" style="display:none; z-index:1; margin-top: 53px; width:26px; height:26px; position: absolute; " onclick="mute4();"/>
<img id="fullscreenvid4" class="vidimage fullimages" src="fullscreen.png" style="display:none; z-index:1; margin-left: 26px; width:26px; height:26px; position: absolute; " />
<img id="blur4" class="vidimage fullimages" src="blur.png" style="display: none; z-index:1; margin-top: 26px; width:28px; height:28px; position: absolute; " />
<img id="img4" class="vidimage images redimages" src="red04.png" style="display:none; z-index:0;  position: absolute; " /> 
<img id="img44" class="vidimage images" src="yellow04.png" style="display:none; z-index:0;  position: absolute; " /> 
      <video id="Video4" class="videos" style="z-index:0;">
     <source src="<?php echo $file4; ?>" type="video/mp4"></source>  
<!--<source src="/media/gintas/GOPR0198.MP4" type="video/mp4"></source>--> 
     Browser does not support HTML5. Video could not be loaded.
</video>
</div></div>
<?php } ?>

        </div>
        <div class="maincol_bottom"></div>
</td>		
</tr>
        <div class="maincol_bottom"></div>
</table>


<style type="text/css">



</style>


        
<div>
<!-- here was the timetag output test place -->
</div>
        </div>

     <div id="rightcol_container"> 
    
 <div class="maincol_bottom"></div>


        </div>
        <div class="clear"></div>
<table width="100%" class="vid">
<tr><td style="width:10px;" ></td>
<td style="width:30%;padding-top:5px;padding-right:1px;text-align:right;">
<?php if(isset($_POST['selection'])) { ?>
                <label for="amount2">Time: </label>
<td style="padding-top:5px;padding-left:1px;text-align:left;">
                <input type="text" id="amount2" style="border: 0 none;border-radius: 4px 4px 4px 4px;color: #F6931F;padding-left: 9px;width: 60px;height:20px;font-size:18px;"> <?php echo "Playing video: " . $filedate;  } ?>
</td></td></tr>
<tr><td style="width:10px;padding-top:12px;" >
<div style="background-color:transparent;" class="maincol" id="playbuttoncol">
<?php if(isset($_POST['selection'])) { ?>
<div><input id="playpausebutton" onClick="playpause();" type="button" class="playpausebtn"></div>
</div>
<td colspan="2" style="text-align:top;" id="timeline">
<div style="background-color:transparent;" class="maincol" id="timelinecol">  
            <div id="slider2" style="width:100%;z-index:99;" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div>
        </div>
        <div class="maincol_bottom"></div>
</tr></td>
<tr><td>
<div style="background-color:transparent;" class="maincol">
<input id="resetbutton" value="" onClick="resetclock();" type="button" class="resetbtn" >
</div> <?php } ?>
</td></tr>
        <div class="maincol_bottom"></div>
</table>

<div id="footer">
</div>
<div id="testcontainer" style="clear:both;">
<br>

<!-- <button hidden onclick="getVidDuration()"  type="button">Show the time</button> // Shows the duration of video. For testing purposes 
<!-- <div hidden id="time"></div> -->



<?php if(isset($_POST['selection'])) {
$mysqli = new mysqli('localhost','gopro','gopro','timetagging'); // Establish database connection
//$query = "SELECT timetag FROM timetags WHERE date='$filedate' ORDER BY id ASC"; // Query to check the last session number
$query = "SELECT timetag FROM timetags WHERE timestamp BETWEEN $filedatetimestamp-250 AND $filedatetimestamp+250";
//$query = "SELECT timetag FROM timetags WHERE session='6' BY id ASC"; // Query to check the last session number
$n = 1;
if ($result = mysqli_query($mysqli, $query)) { // If there is no error

$row_cnt = $result->num_rows;
//echo "<br>Rows: " . $row_cnt;

while ($row = $result->fetch_row()) { 
foreach ($row as $rowvalue){
$timetag[$n] = $rowvalue; ?>

<script type="text/javascript">

<?php echo "var time" . $n . " = " . $timetag[$n] . ";";
echo "var n = " . $n . ";";?>

</script>
<?php


$n++;
}

		}?>
<?php
} else {
    echo "<br>Could not load the timetags:<br> (" . $mysqli->errno . ") " . $mysqli->error; // Output error on screen
   
}
}
?>








<?php
 /*
$timestamp1 = strtotime('2014-06-26 18:11');
$timestamp2 = strtotime('2014-06-26 18:22');
$timestamp3 = strtotime('2014-06-26 18:23');
$timestamp4 = strtotime('2014-06-26 18:24');
$timestamp5 = strtotime('2014-06-26 18:25');

if(isset($_POST['selection'])) 
{
  echo '===== TEST CONTAINER =====';
echo "<br>sss";
}

if(!isset($_POST['selection'])) 
{ 
  echo '===== TEST CONTAINER =====';
}
echo '<br>ss';
echo "<br>==========<br>";

if(isset($_POST['vtime']))
{
$duration1 = $_POST["vtime"];
echo "<br>duration: " . $duration1;
}
echo "<br>This is the time: " . $filedate;
echo "<br>timestamp1 (18:11): " . $timestamp1;
echo "<br>timestamp2 (18:22): " . $timestamp2;
echo "<br>timestamp3 (18:23): " . $timestamp3;
echo "<br>timestamp4 (18:24): " . $timestamp4;
echo "<br>timestamp5 (18:25): " . $timestamp5;


function timeset($timestamp){
  $date = new DateTime();
  $date -> setTimestamp($timestamp);
  $currdate = timeset(date);
}
echo "<br>Currdate: " . $currdate;*/

?>

</div>
<script type="text/javascript">




window.onload= $(function() {
myVid=document.getElementById("Video1");
setTimeout(function(){themax = myVid.duration;},300);
setTimeout(function(){$("#slider2").slider("option", "max", themax.toFixed(0))},330);

        $( "#slider2" ).slider({
            step: 1,
    	    animate: true,
	    min: 0,
	    range: "min",
            slide: function( event, ui ) {
		stoptime = ui.value * 1000;
		window.clearTimeout(refresh);
		console.log(stoptime);
//flagclock = 0;
//flagstop = 0;
//stoptime = 0;
if(flagclock==0)
{	
playpause();
video1.play() & video2.play() & video3.play() & video4.play();
//playpause.value = 'Pause';
flagstop = 1;
}else{
video1.pause() & video2.pause() & video3.pause() & video4.pause();
//playpause.value = 'Play';
playpause();
flagclock = 0;
}
        video1.currentTime = ui.value;
        video2.currentTime = ui.value;
        video3.currentTime = ui.value;
        video4.currentTime = ui.value;

	var timeInSecs = ui.value;
	var date4 = new Date(null);
	date4.setSeconds(timeInSecs);
	var showtime = date4.getMinutes() + ':' +  date4.getSeconds();
	$( "#amount2" ).val(showtime);
            }
        });
        $( "#amount2" ).val($( "#slider2" ).slider( "value" ) );

setTimeout(function(){

  	var $slider =  $("#slider2");
	var maxx =  $slider.slider("option", "max");
	var spacing =  $slider.width() / (maxx);
	<?php echo "var rowcnt = " . $row_cnt . ";";?>
	//alert(spacing);
	for (i=1; i <= rowcnt; i++)
{
	var tag = eval('tag = --time'+i) * spacing; // Creating a tag. Dangerous function!!

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
setTimeout(
function()
{
test=myVid.duration;
},300);


function getVidDuration() //this gets the video length. Used for test purposes
  { 
setTimeout(function(){document.getElementById('time').innerHTML=test.toFixed(1)+" seconds";},380);
}



var flagclock = 0;
var flagstop = 0;
var stoptime = 0;
var video1 = document.getElementById("Video1");
var video2 = document.getElementById("Video2");
var video3 = document.getElementById("Video3");
var video4 = document.getElementById("Video4");
var slider = $("#slider2");
function playpause()
{
var playpause = document.getElementById('playpausebutton');
var startdate = new Date();
var starttime = startdate.getTime();
if(flagclock==0)
{
video1.play() & video2.play() & video3.play() & video4.play();
//playpause.value = 'Pause';
$("#playpausebutton").css('background', 'url(pause.png) no-repeat top right');
$("#playpausebutton").css('background-size', '48px 48px');
flagclock = 1;
counter(starttime);
// output.value = ''; // Needed only to clear the output field. Usefull when there are unnecessary tags left in it.
}
else
{
video1.pause() & video2.pause() & video3.pause() & video4.pause();
//playpause.value = 'Play';
$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
$("#playpausebutton").css('background-size', '48px 48px');
flagclock = 0;
flagstop = 1;
}
}
function counter(starttime)
{
//output = document.getElementById('timeValue2');
clock = document.getElementById('amount2');

currenttime = new Date();
var timediff = currenttime.getTime() - starttime;

if(flagstop == 1)
{

timediff = timediff + stoptime;

}
if(flagclock == 1)
{
clock.value = formattime(timediff,'');
refresh = setTimeout('counter(' + starttime + ');',10);
formattime2();

}
else
{
window.clearTimeout(refresh);
stoptime = timediff;
console.log(stoptime);
}
}
function formattime(rawtime,roundtype)
{
if(roundtype == 'round')
{
var ds = Math.round(rawtime/100) + '';
}
else
{
var ds = Math.floor(rawtime/100) + '';
}
var sec = Math.floor(rawtime/1000);
var min = Math.floor(rawtime/60000);
ds = ds.charAt(ds.length - 1);
if(min >= 60)
{
playpause();
}
sec = sec - 60 * min + '';
if(sec.charAt(sec.length - 2) != '')
{
sec = sec.charAt(sec.length - 2) + sec.charAt(sec.length - 1);
}
else
{
sec = 0 + sec.charAt(sec.length - 1);
}
min = min + '';
if(min.charAt(min.length - 2) != '')
{
min = min.charAt(min.length - 2)+min.charAt(min.length - 1);
}
else
{
min = 0 + min.charAt(min.length - 1);
}
return min + ':' + sec;
}
function formattime2(){

var hms = clock.value;   // your input string
var a = hms.split(':'); // split it at the colons

// minutes are worth 60 seconds. Hours are worth 60 minutes.
var seconds1 = (+a[0] * 60 + +a[1]); 

slider.slider('option', 'value', seconds1);
}

function resetclock()
{
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
if(flagclock == 1)
{
//playpause.value = 'Play';
flagclock = 0;
flagstop = 1;

clock.value = "00:00";
sessionStorage.clear();
localStorage.clear();
}
else
{
//playpause.value = 'Play';
clock.value = "00:00";
}
}
function splittime()
{
if(flagclock == 1)
{
if(splitdate != '')
{
var splitold = splitdate.split(':');
var splitnow = clock.value.split(':');
var numbers = new Array();
var i = 0
for(i;i<splitold.length;i++)
{
numbers[i] = new Array();
numbers[i][0] = splitold[i]*1;
numbers[i][1] = splitnow[i]*1;
}
if(numbers[1][1] < numbers[1][0])
{
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

$(window).load(function()
{
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
if ($("#vid1").find("#Video1").length )
{
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
}
else {
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


</script>

<script type="text/javascript">
$(window).load(function()
{
var $images = $('.images');
var $redimages = $('.redimages');

$redimages.show();

if (document.getElementById('Video1').muted == false)
{
$("#img1").hide();
$("#img11").show();
}

if (document.getElementById('Video2').muted == false)
{
$("#img2").hide();
$("#img22").show();
}

if (document.getElementById('Video3').muted == false)
{
$("#img3").hide();
$("#img33").show();
}

if (document.getElementById('Video4').muted == false)
{
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
} }

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
} }



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
} }

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
} }


};


</script>


<script>
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
		          } else if( elem[prefix + 'RequestFullScreen'] ) {
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

         <div id="footer"><h3>created by gintas pociunas, 2014. <span><img id="copyleft" src="copyleft.png" alt="cl logo"></span> (copyleft) OpenSource</h3></div>
         <div id="footer" class="selectable" style="font-family:Calibri, Helvetica, sans-serif;"><a class="selectable" style="text-decoration:none;color:#1A171B;" href="mailto:geantas@gmail.com" target="_top">geantas@gmail.com</a></div>
  </div>
</div>
</body>
</html>

