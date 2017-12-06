$(document).ready(function() {
    
    
// * * * * * SlideShow * * * * * //
$('#slide1').hover(function(event){
    $("#slide_img").attr("src","images/aoc2.png");
},function(event){
    $("#slide_img").attr("src","images/aoc1.png");
                  
});   
    
$('#slide2').hover(function(event){
    $("#slide_img").attr("src","images/aoc3.jpg");
},function(event){
    $("#slide_img").attr("src","images/aoc1.png");
                  
});   
    
$('#slide3').hover(function(event){
    $("#slide_img").attr("src","images/aoc4.png");
},function(event){
    $("#slide_img").attr("src","images/aoc1.png");
                  
});    
    
    
$('#slide4').hover(function(event){
    $("#slide_img").attr("src","images/aoc5.png");
},function(event){
    $("#slide_img").attr("src","images/aoc1.png");
                  
});   
    
$('#slide5').hover(function(event){
    $("#slide_img2").attr("src","images/football1.png");
},function(event){
    $("#slide_img2").attr("src","images/football.png");
                  
});
    

$('#slide6').hover(function(event){
    $("#slide_img2").attr("src","images/football2.jpg");
},function(event){
    $("#slide_img2").attr("src","images/football.png");
                  
});
    

$('#slide7').hover(function(event){
    $("#slide_img2").attr("src","images/football3.jpg");
},function(event){
    $("#slide_img2").attr("src","images/football.png");
                  
});
    
    
$('#slide8').hover(function(event){
    $("#slide_img2").attr("src","images/football4.png");
},function(event){
    $("#slide_img2").attr("src","images/football.png");
                  
});    
    

$('#slide9').hover(function(event){
    $("#slide_img3").attr("src","images/darksoul1.jpg");
},function(event){
    $("#slide_img3").attr("src","images/darksoul.jpg");
                  
});        
    
$('#slide10').hover(function(event){
    $("#slide_img3").attr("src","images/darksoul2.jpg");
},function(event){
    $("#slide_img3").attr("src","images/darksoul.jpg");
                  
});      
    
    
$('#slide11').hover(function(event){
    $("#slide_img3").attr("src","images/darksoul3.jpg");
},function(event){
    $("#slide_img3").attr("src","images/darksoul.jpg");
                  
});      
    
    
$('#slide12').hover(function(event){
    $("#slide_img3").attr("src","images/darksoul4.png");
},function(event){
    $("#slide_img3").attr("src","images/darksoul.jpg");
                  
});
    
    
$('#slide13').hover(function(event){
    $("#slide_img4").attr("src","images/wdog1.jpg");
},function(event){
    $("#slide_img4").attr("src","images/wdog.png");
                  
});

    
$('#slide14').hover(function(event){
    $("#slide_img4").attr("src","images/wdog2.jpg");
},function(event){
    $("#slide_img4").attr("src","images/wdog.png");
                  
});
    
$('#slide15').hover(function(event){
    $("#slide_img4").attr("src","images/wdog3.jpg");
},function(event){
    $("#slide_img4").attr("src","images/wdog.png");
                  
});

$('#slide16').hover(function(event){
    $("#slide_img4").attr("src","images/wdog4.jpg");
},function(event){
    $("#slide_img4").attr("src","images/wdog.png");
                  
});
    
$('#slide17').hover(function(event){
    $("#slide_img5").attr("src","images/witcher2.jpg");
},function(event){
    $("#slide_img5").attr("src","images/witcher.png");
                  
});
    
// * * * * * * SlideSnow BAR * * * * * * //
    

$('#slidebarpoint1').hover(function(event){
    $("#slide_art1").show();
    $("#slide_art2").hide();
    $("#slide_art3").hide();
    $("#slide_art4").hide();
    $("#slide_art5").hide();
});    


$('#slidebarpoint2').hover(function(event){
    $("#slide_art2").show();
    $("#slide_art1").hide();
    $("#slide_art3").hide();
    $("#slide_art4").hide();
    $("#slide_art5").hide();
});  
    
$('#slidebarpoint3').hover(function(event){
    $("#slide_art3").show();
    $("#slide_art1").hide();
    $("#slide_art2").hide();
    $("#slide_art4").hide();
    $("#slide_art5").hide();
});   

$('#slidebarpoint4').hover(function(event){
    $("#slide_art4").show();
    $("#slide_art1").hide();
    $("#slide_art2").hide();
    $("#slide_art3").hide();
    $("#slide_art5").hide();
});
    

$('#slidebarpoint5').hover(function(event){
    $("#slide_art5").show();
    $("#slide_art1").hide();
    $("#slide_art2").hide();
    $("#slide_art3").hide();
    $("#slide_art4").hide();
});
    
    
setInterval(function(refresh) {
  var random = Math.floor(Math.random() * $('.slidetable').length);
$('.slidetable').hide().eq(random).show();
}, 8000);    
    
    
/*********************topbox(1)*************************/
    
$('#playtop').mouseover(function(event){
    $("#no1game").animate({width: "400px"});
    $('#nameno1').typeIt({
     strings: 'GRAND THEFT AUTO V',
     speed: 20,
     autoStart: true
});    
     $("#no2game").animate({width: "390px"});
    $('#nameno2').typeIt({
     strings: 'COUNTER-STRIKE: GO',
     speed: 20,
     autoStart: true
});
     $("#no3game").animate({width: "320px"});
$('#nameno3').typeIt({
     strings: 'FALLOUT 4',
     speed: 20,
     autoStart: true
});
     $("#no4game").animate({width: "310px"});
$('#nameno4').typeIt({
     strings: 'the division',
     speed: 20,
     autoStart: true
});
    $("#no5game").animate({width: "305px"});
$('#nameno5').typeIt({
     strings: 'NBA 2K17',
     speed: 20,
     autoStart: true
});
});
    
  
    
    

$("#no1game").mouseover(function(){
        $("#detailbox").css('background-image', 'url(images/top-gta5.jpg)');
        $("#buylink").attr("href", "item_detail.php?pro_id=81")
        $("#no1game").animate({width: "400px"});
$('#nameno1').typeIt({
     strings: 'GRAND THEFT AUTO V',
     speed: 20,
     autoStart: true
}); 
$('#topdetail').typeIt({
     strings: ["GRAND THEFT AUTO V", "USD$30","nearly 100K people purchased"],
     speed: 1,
     autoStart: true
});     
    });
    
    

    
$("#no2game").mouseover(function(){
        $("#detailbox").css('background-image', 'url(images/top-csgo.jpg)');
        $("#buylink").attr("href", "item_detail.php?pro_id=66")
        $("#no2game").animate({width: "390px"});
$('#nameno2').typeIt({
     strings: 'COUNTER-STRIKE: GO',
     speed: 20,
     autoStart: true
});
$('#topdetail').typeIt({
     strings: ["COUNTER-STRIKE: GO", "USD$9.9","nearly 95K people purchased"],
     speed: 1,
     autoStart: true
});     
    });
    
    
    
    
$("#no3game").mouseover(function(){
        $("#detailbox").css('background-image', 'url(images/top-fallout.png)');
        $("#buylink").attr("href", "item_detail.php?pro_id=13")
        $("#no3game").animate({width: "320px"});
$('#nameno3').typeIt({
     strings: 'FALLOUT 4',
     speed: 20,
     autoStart: true
});
$('#topdetail').typeIt({
     strings: ["FALLOUT 4", "USD$39.9","nearly 75K people purchased"],
     speed: 1,
     autoStart: true
});     
    });
    
    
    
    
$("#no4game").mouseover(function(){
        $("#detailbox").css('background-image', 'url(images/top-divison.jpg)');
        $("#buylink").attr("href", "item_detail.php?pro_id=12")
        $("#no4game").animate({width: "310px"});
$('#nameno4').typeIt({
     strings: 'the division',
     speed: 20,
     autoStart: true
});
$('#topdetail').typeIt({
     strings: ["the division", "USD$108.8","nearly 73K people purchased"],
     speed: 1,
     autoStart: true
});   
    });
    
$("#no5game").mouseover(function(){
        $("#detailbox").css('background-image', 'url(images/top-2k17.jpg)');
        $("#buylink").attr("href", "item_detail.php?pro_id=67")
        $("#no5game").animate({width: "305px"});
$('#nameno5').typeIt({
     strings: 'NBA 2K17',
     speed: 20,
     autoStart: true
});
$('#topdetail').typeIt({
     strings: ["NBA 2K17", "USD$43","nearly 71K people purchased"],
     speed: 1,
     autoStart: true
}); 
    });


    
    
    
    
    

    
    
    
/*********************topbox(2)*************************/
    
$('#playtop2').mouseover(function(event){
    $("#no6game").animate({width: "350px"});
    $('#nameno6').typeIt({
     strings: 'For Honor',
     speed: 20,
     autoStart: true
});    
     $("#no7game").animate({width: "300px"});
    $('#nameno7').typeIt({
     strings: 'Watch Dogs 2',
     speed: 20,
     autoStart: true
});
     $("#no8game").animate({width: "270px"});
$('#nameno8').typeIt({
     strings: 'call of duty infinite warfare',
     speed: 20,
     autoStart: true
});
     $("#no9game").animate({width: "260px"});
$('#nameno9').typeIt({
     strings: 'Portal Knights',
     speed: 20,
     autoStart: true
});
    $("#no10game").animate({width: "240px"});
$('#nameno10').typeIt({
     strings: 'Civilization® VI',
     speed: 20,
     autoStart: true
});
});
    
  
    
    

$("#no6game").mouseover(function(){
        $("#detailbox2").css('background-image', 'url(images/top-honor.jpg)');
        $("#buylink2").attr("href", "item_detail.php?pro_id=48")
        $("#no6game").animate({width: "350px"});
$('#nameno6').typeIt({
     strings: 'For Honor',
     speed: 20,
     autoStart: true
}); 
$('#topdetail2').typeIt({
     strings: ["For Honor", "USD$110","Released Day: 15/2/2017","Pre-purchase right now!"],
     speed: 1,
     autoStart: true
});     
    });
    
    

    
$("#no7game").mouseover(function(){
        $("#detailbox2").css('background-image', 'url(images/top-dog.jpg)');
        $("#buylink2").attr("href", "item_detail.php?pro_id=16")
        $("#no7game").animate({width: "300px"});
$('#nameno7').typeIt({
     strings: 'Watch Dogs 2',
     speed: 20,
     autoStart: true
});
$('#topdetail2').typeIt({
     strings: ["Watch Dogs 2", "USD$99","Released Day: 28/11/2016","Pre-purchase right now!"],
     speed: 1,
     autoStart: true
});     
    });
    
    
    
    
$("#no8game").mouseover(function(){
        $("#detailbox2").css('background-image', 'url(images/top-cod.png)');
        $("#buylink2").attr("href", "item_detail.php?pro_id=73")
        $("#no8game").animate({width: "270px"});
$('#nameno8').typeIt({
     strings: 'call of duty infinite warfare',
     speed: 20,
     autoStart: true
});
$('#topdetail2').typeIt({
     strings: ["call of duty infinite warfare", "USD$129","Released Day: 14/1/2017","Pre-purchase right now!"],
     speed: 1,
     autoStart: true
});     
    });
    
    
    
    
$("#no9game").mouseover(function(){
        $("#detailbox2").css('background-image', 'url(images/top-knight.jpg)');
        $("#buylink2").attr("href", "item_detail.php?pro_id=25")
        $("#no9game").animate({width: "260px"});
$('#nameno9').typeIt({
     strings: 'Portal Knights',
     speed: 20,
     autoStart: true
});
$('#topdetail2').typeIt({
     strings: ["Portal Knights", "USD$39.9","Released Day: 21/3/2017","Pre-purchase right now!"],
     speed: 1,
     autoStart: true
});     
    });
    
$("#no10game").mouseover(function(){
        $("#detailbox2").css('background-image', 'url(images/top-civil.jpg)');
        $("#buylink2").attr("href", "item_detail.php?pro_id=47")
        $("#no10game").animate({width: "240px"});
$('#nameno10').typeIt({
     strings: 'Civilization® VI',
     speed: 20,
     autoStart: true
});
$('#topdetail2').typeIt({
     strings: ["Civilization® VI", "USD$116","Released Day: 15/1/2017","Pre-purchase right now!"],
     speed: 1,
     autoStart: true
});     
    });

    
    /*********************singpart*************************/

$('#lastsay').typeIt({
     strings: "Looking for more games and information? join us now!",
     speed:50,
     autoStart: false,
     breakLines:false,
});  
  

    
 //********** jBox ************//
  new jBox('Tooltip', {
  attach: '.tooltip'
});   
    
    
 //********  GO BACK TOP ******** //
    
$('#backtotop').click(function(event){
   $('html, body').animate({ scrollTop: 0 }, 'slow');
});    
    
  
   
    
    
    
    
    
    
});

