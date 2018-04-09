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
   font-size: 30px;
}


.Tagbuttons {
    font-size: 250%;
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
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<script type='text/javascript' src='jquery-1.7.1.js'></script>
<script type="text/javascript">


function showHeight( element, height ) {
//console.log( "Window height: " + height + "px." );
height = height - 3;
var bigcont = document.getElementById('bigcontainer');
bigcont.setAttribute('style', 'height:' + height.toFixed(1) + 'px; background-color:#FFFFFF;');
}

window.onload= $(function() {
showHeight( "window", $( window ).height() );



//showWidth( "window", $( window ).width() );
//showDocHeight("document", $(document).height() );
});


$(window).resize(function(){
showHeight( "window", $( window ).height() );
$('.buttonbox input').css('font-size',($(window).height()*0.08)+'px');
$('.clockbox input').css('font-size',($(window).height()*0.08)+'px');
$('.buttonbox p').css('font-size',($(window).width()*0.02)+'px');
$('.buttonbox span').css('font-size',($(window).width()*0.02)+'px');
$('.titlebox a').css('font-size',($(window).width()*0.02)+'px');
});




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
var result = document.getElementById("result");
result.innerHTML = "";



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
<?php 
  function timeset($timestamp){ // Timestamp function
  date_default_timezone_set("Europe/Copenhagen");
  $date = new DateTime();
  $date -> setTimestamp($timestamp);
  return $date -> format('Y-m-d H:i'); // Returns the date in format YYYY-MM-DD hh:mm
}
date_default_timezone_set('Europe/Copenhagen');
?>
<body bgcolor="#1A171B" class="body">
<div id="bigcontainer" style="width:100%; background-color:#474747;">
<div class="header2" style="height:10%; width:100%;" >
	<div id="header2" style="height:100%; width:100%; background-color:#474747;" >
		<div id="bbb" style="height:100%; width:100%;">
			<div id="sslogo" style="width:45%; float:left;">
				<a href="#">
					<img style="width:30%;height:30%;" src="SkejSimlogo_name.png" alt="SkejSim">
				</a>
				<div class="titlebox" style="float:right;" >
					<a  style="color:#FFFFFF;font-size:100%;">Gintas View v1.3</a>
				</div>
			</div>
			<div style=" width:45%; height:100%; float:right; position:relative;">
				<span style="position:absolute; bottom:0; right:0;"><a  style=" height:100%; font-size:14px; text-decoration:none; color:#FFFFFF;"  href="index.php" target="_blank">Home page</a></span>
			</div>
		</div>
	</div>
</div>
<div id="spacer" style="background-color:#474747;"></div>
<div id="mainarea" style="height:87%; background-color:#87888A; padding-top:5px; text-align:center;">
	<div class="clockbox" style="width:46%; height:19%; text-align:center; float:left; margin:3px 0 1.3% 2.5%;">
		<input id="clock" class="green" value="00:00:0" style="text-align: center; width:100%; height:100%; font-size:300%;" readonly disabled type="text" />
	</div>
	<div class="clockbox" style="width:46%; height:19%; text-align:center; float:right; margin:3px 2.5% 1.3% 0;"">
		<form action="./" method="post" style="width:100%; height:100%; text-align:center; float:left;">
			<textarea class="txtarea" id="output" style="width:100%; height:100%; font-size:140%;" disabled ></textarea>
		</form>
	</div>
	<div class="buttonbox" style="width:46%; height:25%; text-align:center; float:left;  margin:1.3% 0 1.3% 2.5%;">
		<input id="startstopbutton" name="stop" class="Tagbuttons" value="Start" onClick="startstop();storeInArray();" type="button" style="width:100%; height:100%; background-color:#2DA903;"/>
	</div>
	<div class="buttonbox" style="width:46%; height:25%; text-align:center; float:right; margin:1.3% 2.5% 1.3% 0;">
		<input id="splitbutton" class="Tagbuttons" value="Tag time" onClick="splittime();" type="button" style="width:100%; height:100%;"/>
	</div>
	<div class="buttonbox" id="donebox" style="width:46%; height:24%; text-align:center; float:left; margin:1.3% 0 1.3% 2.5%;">
		<input type="button" id="donebutton" class="Tagbuttons" onclick="getStorageValues();"  value="Done" style="width:100%; height:100%;"/>
	</div>
	<div class="buttonbox" name="savebuttonbox" id="savebuttonbox" style="width:46%; height:38%; text-align:center; float:right; margin:1.3% 2.5% 0 0;">
		<div id="result" style="width:100%; height:100%; font-size:150%;"></div>
	</div>
	<div class="buttonbox" style="width:46%; height:14%; text-align:center; float:left;  margin:1.3% 0 0 2.5%;">
		<input id="resetbutton" class="Tagbuttons" value="Reset" onClick="resetclock(); clearstorages();" type="button" style="width:100%; height:100%; font-size:200%"/>
	</div>
	<!--<div class="buttonbox" style="width:46%; height:15%; text-align:center; float:right;  margin:1.3% 2.5% 1.3% 0;">

	</div>-->

<script type="text/javascript">

var ssbutton = document.getElementById("startstopbutton");
var donebox = document.getElementById("donebox");
var donebtn = document.getElementById("donebutton");
var resetbtn = document.getElementById("resetbutton");
var clearbtn = document.getElementById("clearbutton");

	ssbutton.addEventListener("click", function() { 
	$('#startstopbutton').css({'background-color' : 'red'});
	$('#splitbutton').css({'background-color' : 'green'});
	donebtn.setAttribute('disabled', 'true');
	donebox.setAttribute('disabled', 'true');
	$('#donebox').css({'cursor' : 'not-allowed'});
	$('#donebutton').css({'cursor' : 'not-allowed'});
	
	if ($('#startstopbutton').value == "Stop") {
	$('#startstopbutton').css({'background-color' : 'red'});
	$('#splitbutton').css({'background-color' : 'green'});
	donebox.setAttribute('disabled', 'true');
	donebtn.setAttribute('disabled', 'true');
	$('#donebox').css({'cursor' : 'not-allowed', 'background-image' : 'disabl.png', 'background-size' : '100% 100%'});
	$('#donebutton').css({'cursor' : 'not-allowed', 'background-image' : 'disabl.png', 'background-size' : '100% 100%'});
	} 
	if (ssbutton.value == "Start") {
	$('#donebutton').css({'background-color' : 'green'});
	$('#splitbutton').css({'background-color' : '#003E5C'});
	$('#startstopbutton').css({'background-color' : '#003E5C'});
	donebox.removeAttribute('disabled');
	donebtn.removeAttribute('disabled');
	$('#donebox').css({'cursor' : 'default'});
	$('#donebutton').css({'cursor' : 'default'});
	}
	
});

	donebtn.addEventListener("click", function() {
	$('#startstopbutton').css({'background-color' : '#003E5C'});
	$('#splitbutton').css({'background-color' : '#003E5C'});
	$('#donebutton').css({'background-color' : '#003E5C'});
	});
		
	resetbtn.addEventListener("click", function() {
	$('#startstopbutton').css({'background-color' : '#2DA903'});
	$('#splitbutton').css({'background-color' : '#003E5C'});
	$('#donebutton').css({'background-color' : '#003E5C'});
	$('#resetbutton').css({'background-color' : '#003E5C'});
	$('#clearbutton').css({'background-color' : '#003E5C'});
	});
	
	

/*
var stopbuttn = document.getElementsByName("stop");
stopbuttn.addEventListener("click", function() { 
	$('#donebutton').css({'background-color' : '#2C9C06'});
	ssbutton.css({'background-color' : '#003E5C'});
	});*/


/*$('#startstopbutton').click(function() {
    //Now just reference this button and change CSS
    $(this).css({'background-color' : '#005372'});
	$('#splitbutton').css({'background-color' : '#026376'});
	$('#donebutton').css({'background-color' : '#02687F'});
	
});*/

 /*
     * Date Format 1.2.3
     * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
     * MIT license
     *
     * Includes enhancements by Scott Trenda <scott.trenda.net>
     * and Kris Kowal <cixar.com/~kris.kowal/>
     *
     * Accepts a date, a mask, or a date and a mask.
     * Returns a formatted version of the given date.
     * The date defaults to the current date/time.
     * The mask defaults to dateFormat.masks.default.
     */

    var dateFormat = function () {
        var    token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
            timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
            timezoneClip = /[^-+\dA-Z]/g,
            pad = function (val, len) {
                val = String(val);
                len = len || 2;
                while (val.length < len) val = "0" + val;
                return val;
            };
    
        // Regexes and supporting functions are cached through closure
        return function (date, mask, utc) {
            var dF = dateFormat;
    
            // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
            if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
                mask = date;
                date = undefined;
            }
    
            // Passing date through Date applies Date.parse, if necessary
            date = date ? new Date(date) : new Date;
            if (isNaN(date)) throw SyntaxError("invalid date");
    
            mask = String(dF.masks[mask] || mask || dF.masks["default"]);
    
            // Allow setting the utc argument via the mask
            if (mask.slice(0, 4) == "UTC:") {
                mask = mask.slice(4);
                utc = true;
            }
    
            var    _ = utc ? "getUTC" : "get",
                d = date[_ + "Date"](),
                D = date[_ + "Day"](),
                m = date[_ + "Month"](),
                y = date[_ + "FullYear"](),
                H = date[_ + "Hours"](),
                M = date[_ + "Minutes"](),
                s = date[_ + "Seconds"](),
                L = date[_ + "Milliseconds"](),
                o = utc ? 0 : date.getTimezoneOffset(),
                flags = {
                    d:    d,
                    dd:   pad(d),
                    ddd:  dF.i18n.dayNames[D],
                    dddd: dF.i18n.dayNames[D + 7],
                    m:    m + 1,
                    mm:   pad(m + 1),
                    mmm:  dF.i18n.monthNames[m],
                    mmmm: dF.i18n.monthNames[m + 12],
                    yy:   String(y).slice(2),
                    yyyy: y,
                    h:    H % 12 || 12,
                    hh:   pad(H % 12 || 12),
                    H:    H,
                    HH:   pad(H),
                    M:    M,
                    MM:   pad(M),
                    s:    s,
                    ss:   pad(s),
                    l:    pad(L, 3),
                    L:    pad(L > 99 ? Math.round(L / 10) : L),
                    t:    H < 12 ? "a"  : "p",
                    tt:   H < 12 ? "am" : "pm",
                    T:    H < 12 ? "A"  : "P",
                    TT:   H < 12 ? "AM" : "PM",
                    Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                    o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                    S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
                };
    
            return mask.replace(token, function ($0) {
                return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
            });
        };
    }();
    
    // Some common format strings
    dateFormat.masks = {
        "default":      "ddd mmm dd yyyy HH:MM:ss",
        shortDate:      "m/d/yy",
        mediumDate:     "mmm d, yyyy",
        longDate:       "mmmm d, yyyy",
        fullDate:       "dddd, mmmm d, yyyy",
        shortTime:      "h:MM TT",
        mediumTime:     "h:MM:ss TT",
        longTime:       "h:MM:ss TT Z",
        isoDate:        "yyyy-mm-dd",
        isoTime:        "HH:MM:ss",
        isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
        isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
    };
    
    // Internationalization strings
    dateFormat.i18n = {
        dayNames: [
            "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
            "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
        ],
        monthNames: [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
        ]
    };
    
    // For convenience...
    Date.prototype.format = function (mask, utc) {
        return dateFormat(this, mask, utc);
    };






//var dateString = today.format("yyyy-mm-dd HH:mm");
//var dateString = today.format("dd-m-yy");
//alert(dateString);



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
var startstop = document.getElementById('startstopbutton');
if (startstop.value == 'Stop') {
alert("Stop the timer first!");
} else {


if (typeof(Storage) != "undefined") // If browser supports web storage
  {
var savebox = document.getElementById("savebuttonbox");
var myform=document.createElement("FORM"); // Create form in html
myform.method = "post";                    //with these attributes
myform.action = "save.php";
myform.name = "myform";
myform.setAttribute('style', 'height:100%; width:100%;');
savebox.appendChild(myform); // Attach form into body

for (var i = 0; i < localStorage.length; i++) {  // For each of the local storage value (timetag)
var myinput=document.createElement("INPUT");       //create an input field with name "tag*"
myinput.setAttribute('value', localStorage.getItem(i));
myinput.name = "tag" + i;
myinput.type = "hidden"; // Hide the fields so that user won't bother seeing them.
document.myform.appendChild(myinput); // Attach input fields into form

}


/* timestamp input */
today = new Date();
var dateString = today.format("yyyy-mm-dd HH:MM");
console.log("saved time: ", dateString);
var myinput=document.createElement("INPUT");       //create an input field with name current date
myinput.setAttribute('value', dateString );
myinput.name = "currentdate";
myinput.type = "hidden"; // Hide the fields so that user won't bother seeing them.
document.myform.appendChild(myinput); // Attach input fields into form

/*
var myinput2=document.createElement("INPUT");       //create an input field with name timestamp
myinput2.setAttribute('value', new Date().getTime() );
myinput2.name = "timestamp";
myinput2.type = "hidden"; // Hide the fields so that user won't bother seeing them.
document.myform.appendChild(myinput2); // Attach input fields into form
*/

var button=document.createElement("INPUT"); // Create button 
button.type = "submit";                     //with these attributes
button.name = "submit";
button.id = "submitbtn";
button.value = "Save";
button.setAttribute('hidden', 'true');
button.setAttribute('style', 'height:100%; width:100%;');
document.myform.appendChild(button); // Attach button into form


//document.getElementById("result").innerHTML+=' Click the "Save" button!';

  }
else // If browser does not support web storage
  {
  document.getElementById("result").innerHTML="Sorry, your browser does not support Web Storage...";
  } }
  
setTimeout(document.getElementById("submitbtn").click(), 200);
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




</div>
</div>
<script type='text/javascript' src="jquery.min.js"></script>
<script type='text/javascript' src="script.js"></script>
</body>

</html>