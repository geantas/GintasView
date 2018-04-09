


$(window).load(function()
{
    var $contimages = $('.contimages');
	var $vidimages = $('.vidimage');
    var $images = $('.images');
    //add event for all videos 
    $('.videos').click(videoClicked);
 var $fullcont = $('.fullcont');
var playpause = document.getElementById('playpausebutton');
 //remember last video clicked (you could check last container instead)
  var lastclicked;

$contimages.hide();
$images.hide();
$fullcont.hide();

function videoClicked(e)
{


setTimeout(function(){playpause.click();},380);

$contimages.hide();
$images.hide();
$fullcont.hide();
    var sender = e.target;
  //get all the videos 
    var $videos = $('.videos');


    if(sender==lastclicked){
      //reset to original positions

      $.each($videos,function(){
        var ind =     this.id.substring(this.id.length-1); //based on the video + number naming convention
        $(this).appendTo('#vid' + ind);
      });
      lastclicked = null;

        //remove all big classes
        $videos.removeClass('big');
        //and small class
        $videos.removeClass('small');
        //then add normal class
        $videos.addClass('normal');
        $contimages.hide();
	$images.hide();
	$fullcont.hide();
	

if ($("#vid1").find("#Video1").length)
{
$('#Video1').hover(function() {
$fullcont.hide();
$("#fullscreenvid1").show();
$("#blur1").show();
$("#aud1").show();
  }, function() {
$("#fullscreenvid1").hide();
$("#blur1").hide();
$("#aud1").hide();
  });
if (document.getElementById('Video1').muted == true)
{
$("#img1").show();
} else { 
$("#img1").hide();
$("#img11").show();
} };

if ($("#vid2").find("#Video2").length)
{
$('#Video2').hover(function() {
$fullcont.hide();
$("#fullscreenvid2").show();
$("#blur2").show();
$("#aud2").show();
  }, function() {
$("#fullscreenvid2").hide();
$("#blur2").hide();
$("#aud2").hide();
  });
if (document.getElementById('Video2').muted == true)
{
$("#img2").show();
} else { 
$("#img2").hide();
$("#img22").show();
} };

if ($("#vid3").find("#Video3").length)
{
$('#Video3').hover(function() {
$fullcont.hide();
$("#fullscreenvid3").show();
$("#blur3").show();
$("#aud3").show();
  }, function() {
$("#fullscreenvid3").hide();
$("#blur3").hide();
$("#aud3").hide();
  });
if (document.getElementById('Video3').muted == true)
{
$("#img3").show();
} else { 
$("#img3").hide();
$("#img33").show();
} };

if ($("#vid4").find("#Video4").length)
{
$('#Video4').hover(function() {
$fullcont.hide();
$("#fullscreenvid4").show();
$("#blur4").show();
$("#aud3").show();
  }, function() {
$("#fullscreenvid4").hide();
$("#blur4").hide();
$("#aud3").hide();
  });
if (document.getElementById('Video4').muted == true)
{
$("#img4").show();
} else { 
$("#img4").hide();
$("#img44").show();
} };

flagclock = 0;
flagstop = 1;
$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
$("#playpausebutton").css('background-size', '48px 48px');

//flagclock = 0;
//playpause();

	return;
    }

    lastclicked= sender;  

     var i = 1;  
     //place all non clicked videos in cont1/cont2/etc
     $.each($videos.not(sender),function()
     { 
    $(this).appendTo('#cont' + i++ );
    //remove big from all videos
    $videos.removeClass('big');
    //remove normal from all videos
    $videos.removeClass('normal');
    //add small to videos that were not the sender (aka clicked video)
    $videos.not(sender).addClass('small');
    //add big to the sender
    $(sender).addClass('big');



flagclock = 0;
flagstop = 1;
$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
$("#playpausebutton").css('background-size', '48px 48px');

//flagclock = 0;
//playpause();






     });

     //place the clicked video in the last container
     $(sender).appendTo('#cont4'); //always cont4 with fixed divs, but this is dynamic in case more adding is needed
flagclock = 0;
flagstop = 1;
$("#playpausebutton").css('background', 'url(play.png) no-repeat top right');
$("#playpausebutton").css('background-size', '48px 48px');

//flagclock = 0;
//playpause();
$vidimages.hide();
$contimages.hide();
$images.hide();
$fullcont.hide();

if ($("#cont1").find("#Video1").length)
{
$('#Video1').hover(function() {
$("#fullscreenvid1").hide();
$("#blur1").hide();
$("#aud1").hide();
$fullcont.hide();
$("#fullc11").show();
$("#blurc11").show();
$("#aud11").show();
  }, function() {
$("#fullc11").hide();
$("#blurc11").hide();
$("#aud11").hide();
  });
if (document.getElementById('Video1').muted == true)
{
$("#imgcont11").show();
} else { 
$("#imgcont11").hide();
$("#imgcont111").show();
} }

if ($("#cont1").find("#Video2").length)
{
$('#Video2').hover(function() {
$("#fullscreenvid2").hide();
$("#blur2").hide();
$("#aud2").hide();
$fullcont.hide();
$("#fullc12").show();
$("#blurc12").show();
$("#aud12").show();
  }, function() {
$("#fullc12").hide();
$("#blurc12").hide();
$("#aud12").hide();
  });
if (document.getElementById('Video2').muted == true)
{
$("#imgcont12").show();
} else { 
$("#imgcont12").hide();
$("#imgcont122").show();
} };

if ($("#cont1").find("#Video3").length)
{
$('#Video3').hover(function() {
$("#fullscreenvid3").hide();
$("#blur3").hide();
$("#aud3").hide();
$fullcont.hide();
$("#fullc13").show();
$("#blurc13").show();
$("#aud13").show();
  }, function() {
$("#fullc13").hide();
$("#blurc13").hide();
$("#aud13").hide();
  });
if (document.getElementById('Video3').muted == true)
{
$("#imgcont13").show();
} else { 
$("#imgcont13").hide();
$("#imgcont133").show();
} };

if ($("#cont1").find("#Video4").length)
{
$('#Video4').hover(function() {
$("#fullscreenvid4").hide();
$("#blur4").hide();
$("#aud4").hide();
$fullcont.hide();
$("#fullc14").show();
$("#blurc14").show();
$("#aud14").show();
  }, function() {
$("#fullc14").hide();
$("#blurc14").hide();
$("#aud14").hide();
  });
if (document.getElementById('Video4').muted == true)
{
$("#imgcont14").show();
} else { 
$("#imgcont14").hide();
$("#imgcont144").show();
} };


if ($("#cont2").find("#Video1").length)
{
$('#Video1').hover(function() {
$("#fullscreenvid1").hide();
$("#blur1").hide();
$("#aud1").hide();
$fullcont.hide();
$("#fullc21").show();
$("#blurc21").show();
$("#aud21").show();
  }, function() {
$("#fullc21").hide();
$("#blurc21").hide();
$("#aud21").hide();
  });
if (document.getElementById('Video1').muted == true)
{
$("#imgcont21").show();
} else { 
$("#imgcont21").hide();
$("#imgcont211").show();
} };

if ($("#cont2").find("#Video2").length)
{
$('#Video2').hover(function() {
$("#fullscreenvid2").hide();
$("#blur2").hide();
$("#aud2").hide();
$fullcont.hide();
$("#fullc22").show();
$("#blurc22").show();
$("#aud22").show();
  }, function() {
$("#fullc22").hide();
$("#blurc22").hide();
$("#aud22").hide();
  });
if (document.getElementById('Video2').muted == true)
{
$("#imgcont22").show();
} else { 
$("#imgcont22").hide();
$("#imgcont222").show();
} };


if ($("#cont2").find("#Video3").length)
{
$('#Video3').hover(function() {
$("#fullscreenvid3").hide();
$("#blur3").hide();
$("#aud3").hide();
$fullcont.hide();
$("#fullc23").show();
$("#blurc23").show();
$("#aud23").show();
  }, function() {
$("#fullc23").hide();
$("#blurc23").hide();
$("#aud23").hide();
  });
if (document.getElementById('Video3').muted == true)
{
$("#imgcont23").show();
} else { 
$("#imgcont23").hide();
$("#imgcont233").show();
} };


if ($("#cont2").find("#Video4").length)
{
$('#Video4').hover(function() {
$("#fullscreenvid4").hide();
$("#blur4").hide();
$("#aud4").hide();
$fullcont.hide();
$("#fullc24").show();
$("#blurc24").show();
$("#aud24").show();
  }, function() {
$("#fullc24").hide();
$("#blurc24").hide();
$("#aud24").hide();
  });
if (document.getElementById('Video4').muted == true)
{
$("#imgcont24").show();
} else { 
$("#imgcont24").hide();
$("#imgcont244").show();
} };

if ($("#cont3").find("#Video1").length)
{
$('#Video1').hover(function() {
$("#fullscreenvid1").hide();
$("#blur1").hide();
$("#aud1").hide();
$fullcont.hide();
$("#fullc31").show();
$("#blurc31").show();
$("#aud31").show();
  }, function() {
$("#fullc31").hide();
$("#blurc31").hide();
$("#aud31").hide();
  });
if (document.getElementById('Video1').muted == true)
{
$("#imgcont31").show();
} else { 
$("#imgcont31").hide();
$("#imgcont311").show();
} };

if ($("#cont3").find("#Video2").length)
{
$('#Video2').hover(function() {
$("#fullscreenvid2").hide();
$("#blur2").hide();
$("#aud2").hide();
$fullcont.hide();
$("#fullc32").show();
$("#blurc32").show();
$("#aud32").show();
  }, function() {
$("#fullc32").hide();
$("#blurc32").hide();
$("#aud32").hide();
  });
if (document.getElementById('Video2').muted == true)
{
$("#imgcont32").show();
} else { 
$("#imgcont32").hide();
$("#imgcont322").show();
} };

if ($("#cont3").find("#Video3").length)
{
$('#Video3').hover(function() {
$("#fullscreenvid3").hide();
$("#blur3").hide();
$("#aud3").hide();
$fullcont.hide();
$("#fullc33").show();
$("#blurc33").show();
$("#aud33").show();
  }, function() {
$("#fullc33").hide();
$("#blurc33").hide();
$("#aud33").hide();
  });
if (document.getElementById('Video3').muted == true)
{
$("#imgcont33").show();
} else { 
$("#imgcont33").hide();
$("#imgcont333").show();
} };

if ($("#cont3").find("#Video4").length)
{
$('#Video4').hover(function() {
$("#fullscreenvid4").hide();
$("#blur4").hide();
$("#aud4").hide();
$fullcont.hide();
$("#fullc34").show();
$("#blurc34").show();
$("#aud34").show();
  }, function() {
$("#fullc34").hide();
$("#blurc34").hide();
$("#aud34").hide();
  });
if (document.getElementById('Video4').muted == true)
{
$("#imgcont34").show();
} else { 
$("#imgcont34").hide();
$("#imgcont344").show();
} };

if ($("#cont4").find("#Video1").length)
{
$('#Video1').hover(function() {
$("#fullscreenvid1").hide();
$("#blur1").hide();
$("#aud1").hide();
$fullcont.hide();
$("#fullc41").show();
$("#blurc41").show();
$("#aud41").show();
  }, function() {
$("#fullc41").hide();
$("#blurc41").hide();
$("#aud41").hide();
  });
if (document.getElementById('Video1').muted == true)
{
$("#imgcont41").show();
} else { 
$("#imgcont41").hide();
$("#imgcont411").show();
} }


if ($("#cont4").find("#Video2").length)
{
$('#Video2').hover(function() {
$("#fullscreenvid2").hide();
$("#blur2").hide();
$("#aud2").hide();
$fullcont.hide();
$("#fullc42").show();
$("#blurc42").show();
$("#aud42").show();
  }, function() {
$("#fullc42").hide();
$("#blurc42").hide();
$("#aud42").hide();
  });
if (document.getElementById('Video2').muted == true)
{
$("#imgcont42").show();
} else { 
$("#imgcont42").hide();
$("#imgcont422").show();
} }


if ($("#cont4").find("#Video3").length)
{
$('#Video3').hover(function() {
$("#fullscreenvid3").hide();
$("#blur3").hide();
$("#aud3").hide();
$fullcont.hide();
$("#fullc43").show();
$("#blurc43").show();
$("#aud43").show();
  }, function() {
$("#fullc43").hide();
$("#blurc43").hide();
$("#aud43").hide();
  });
if (document.getElementById('Video3').muted == true)
{
$("#imgcont43").show();
} else { 
$("#imgcont43").hide();
$("#imgcont433").show();
} };

if ($("#cont4").find("#Video4").length)
{
$('#Video4').hover(function() {
$("#fullscreenvid4").hide();
$("#blur4").hide();
$("#aud4").hide();
$fullcont.hide();
$("#fullc44").show();
$("#blurc44").show();
$("#aud44").show();
  }, function() {
$("#fullc44").hide();
$("#blurc44").hide();
$("#aud44").hide();
  });
if (document.getElementById('Video4').muted == true)
{
$("#imgcont44").show();
} else { 
$("#imgcont44").hide();
$("#imgcont444").show();
} };

}

});

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
