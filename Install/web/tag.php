<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gintas View v1.3</title>

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
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script type='text/javascript' src='jquery-1.7.1.js'></script>
<script type="text/javascript">
document.onload=function(){
sessionStorage.clear();
localStorage.clear();
};

$(document).ready(function(){
sessionStorage.clear();
localStorage.clear();
});

$(window).load(function()
{
sessionStorage.clear();
localStorage.clear();
});

var flagclock = 0;
var flagstop = 0;
var stoptime = 0;
var splitcounter = 0;
var currenttime;
var splitdate = '';
var output;
var clock; function startstop()
{
var startstop = document.getElementById('startstopbutton');
var startdate = new Date();
var starttime = startdate.getTime();
if(flagclock==0)
{
startstop.value = 'Stop';
flagclock = 1;
counter(starttime);
// output.value = ''; // Needed only to clear the output field. Usefull when there are unnecessary tags left in it.
}
else
{
startstop.value = 'Start';
flagclock = 0;
flagstop = 1;
splitdate = '';
}
}
function counter(starttime)
{
output = document.getElementById('output');
clock = document.getElementById('clock');
currenttime = new Date();
var timediff = currenttime.getTime() - starttime;
if(flagstop == 1)
{
timediff = timediff + stoptime
}
if(flagclock == 1)
{
clock.value = formattime(timediff,'');
refresh = setTimeout('counter(' + starttime + ');',10);
}
else
{
window.clearTimeout(refresh);
stoptime = timediff;
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
startstop();
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
function resetclock()
{
flagstop = 0;
stoptime = 0;
splitdate = '';
window.clearTimeout(refresh);
output.value = '';
splitcounter = 0;
if(flagclock == 1)
{
var resetdate = new Date();
var resettime = resetdate.getTime();
counter(resettime);
sessionStorage.clear();
localStorage.clear();
}
else
{
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
//output.value += '\n\t+' + mzeros + (numbers[0][1] - numbers[0][0]) + ':' + szeros + (numbers[1][1] - numbers[1][0]) + ':' + (numbers[2][1] - numbers[2][0]) + 'aaaaa\n';
}
splitdate = clock.value;



output.value += clock.value + " \n";




}
}

</script>
<style type="text/css">
*
{
margin: 0;
padding: 0;
}
textarea
{
width: 100%;
height: 75px;
}
</style>
</head>

<body bgcolor="#1A171B">

<div id="container">
	
<div id="header">
<div id="bbb">
<div align="left" id="sslogo" style="width:600px;"><a href="index.php"><img style="width:30%;height:30%;" src="SkejSimlogo_name.png" alt="SkejSim"></a>
<div style="float:right;" ><a  style="color:#FFFFFF;font-size:24px;">Gintas View v1.3</a></div>

</div>
<div align="right" ><a  style="font-size:14px;text-decoration:none;color:#FFFFFF;" href="index.php" target="_blank">Home page</a></div>
</div>
<div id="spacer"></div>
    <div id="main">


<input id="clock" class="green" value="00:00:0" style="text-align: center;" readonly type="text"><br>
<input id="startstopbutton" class="submitbutton2" value="Start" onClick="startstop();storeInArray();" type="button">
<br>
<input id="splitbutton" class="submitbutton2" value="Split time" onClick="splittime();" type="button">
<br>
<input id="resetbutton" class="submitbutton2" value="Reset" onClick="resetclock();" type="button">
<br>
<form action="./" method="post">
<textarea class="txtarea" id="output" style="height:150px;"></textarea>
</form>


<script type="text/javascript">
function storeInArray() { // places timetags into array
var lines = $('#output').val().split(/\n/);
var texts = [];
for (var i=0; i < lines.length; i++) {
  // only push this line if it contains a non whitespace character.
  if (/\S/.test(lines[i])) {
    texts.push($.trim(lines[i]));
  }
}


var a = texts;

if (typeof(Storage) != "undefined"){
	  // store all timetag array values into web storage
sessionStorage.clear();
localStorage.clear();
for (var arrayNumber = 0; arrayNumber < a.length; arrayNumber++) { 
localStorage.setItem(arrayNumber, a[arrayNumber]);
document.getElementById("result").innerHTML+= a[arrayNumber] + '\n';
}
	}
	else{
	  document.getElementById("result").innerHTML="Sorry, your browser does not support Web Storage...";
	 
	}



}


function getStorageValues(){

if (typeof(Storage) != "undefined") // If browser supports web storage
  {

var myform=document.createElement("FORM"); // Create form in html
myform.method = "post";                    //with these attributes
myform.action = "save.php";
myform.name = "myform";
document.body.appendChild(myform); // Attach form into body

for (var i = 0; i < localStorage.length; i++) {  // For each of the local storage value (timetag)
var myinput=document.createElement("INPUT");       //create an input field with name "tag*"
myinput.setAttribute('value', localStorage.getItem(i));
myinput.name = "tag" + i;
myinput.type = "hidden"; // Hide the fields so that user won't bother seeing them.
document.myform.appendChild(myinput); // Attach input fields into form
}

var button=document.createElement("INPUT"); // Create button 
button.type = "submit";                     //with these attributes
button.name = "submit";
button.id = "submitbtn";
button.value = "Save";
document.myform.appendChild(button); // Attach button into form

document.getElementById("result").innerHTML+='Click the "Save" button!';

  }
else // If browser does not support web storage
  {
  document.getElementById("result").innerHTML="Sorry, your browser does not support Web Storage...";
  }
}


function clearstorages() { // Clear the web storages
sessionStorage.clear();
localStorage.clear();
output.value = '';
document.getElementById("result").innerHTML = '';
function remove(id)
{
    return (elem=document.getElementById(id)).parentNode.removeChild(elem);
}
myform.remove();
}

</script>

<!-- <a id="backbtn" style="text-decoration:none;color:#1A171B" href="tag.php" href="javascript:window.close();" target="_blank" onlick="localStorage.clear();sessionStorage.clear();">Back to timetagging</a> -->
<p><button id="buttontest" class="submitbutton2" onclick="getStorageValues()" type="button">Get storage values</button></p>
<p><button id="clearstorage" style="width:16%; float:right;" class="submitbutton2" onclick="clearstorages()" type="button">Clear storages</button></p>
<div id="result" style="height:30px;"></div>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
        <script src="script.js"></script>
</div>
</body>
</html>
