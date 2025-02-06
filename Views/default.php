<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ARCHIVE SONAPIE</title>
  <link rel="shortcut icon" type="images/x-icon" href="/img/logo.jpg">
  <link rel="stylesheet" href="/css/charge.css"/>
  <style type="text/css">
    body{
      background-image: url("/img/arch1.jpg");
      background-repeat:repeat-y;
      background-size: cover;
    }
    .contain{
      width: 80%;
      height: 300px;
      padding-bottom: 5%;
      background-color: white;
      position: relative;
      margin:auto;
      border-radius: 5px;
      opacity: 0.9;

    }
    h1.sogepie{
      font-size: 250%;
      font-family: elephant,comis sans-serif;
      color: orange;
      text-align: center;
      text-transform: uppercase;
      margin-top:20%;
      width: 80%;
      height: auto;
      line-height: 2.5cm;
      margin-left: auto;
      margin-right: auto; background:;
    }
  </style><script>
        $(function(){
             function timeChecker(){
  setInterval(function(){
var storedTimeStamp =sessionStorage.getItem("lastTimeStamp"); 
timeCompare(storedTimeStamp);
  },3000);
             }
function timeCompare(timeString){
 var currentTime = new Date();
 var pastTime = new Date(timeString);
var timeDiff = currentTime - pastTime;
 var minPast = Math.floor( (timeDiff/60000) );

    if(minPast > 5) {
       sessionStorage.removeItem('lastTimeStamp');
    window.location = "/session_killer.php";
                    return false; 
                }else{
                    console.log(currentTime  +" - "+ pastTime+" - "+minPast+" min past");
                }
             }

            $(document).mousemove(function(){
                var timestamp = new Date();
                sessionStorage.setItem("lastTimeStamp",timestamp);
            });

            timeChecker();
        });
    </script>
  <script>
        $(function(){
             function timeChecker(){
  setInterval(function(){
var storedTimeStamp =sessionStorage.getItem("lastTimeStamp"); 
timeCompare(storedTimeStamp);
  },3000);
             }
function timeCompare(timeString){
 var currentTime = new Date();
 var pastTime = new Date(timeString);
var timeDiff = currentTime - pastTime;
 var minPast = Math.floor( (timeDiff/60000) );

    if(minPast > 5) {
       sessionStorage.removeItem('lastTimeStamp');
    window.location = "/session_killer.php";
                    return false; 
                }else{
                    console.log(currentTime  +" - "+ pastTime+" - "+minPast+" min past");
                }
             }

            $(document).mousemove(function(){
                var timestamp = new Date();
                sessionStorage.setItem("lastTimeStamp",timestamp);
            });

            timeChecker();
        });
    </script>
</head>
<body style='background-image: url("/img/arch1.jpg");
      background-repeat:;
      background-size: cover; margin:0;'>
  
      
	<?= $contenu ?>
<!--
  <div class="loader">
    <span class="lettre">C</span>
    <span class="lettre">H</span>
    <span class="lettre">A</span>
    <span class="lettre">R</span>
    <span class="lettre">G</span>
    <span class="lettre">E</span>
    <span class="lettre">M</span>
    <span class="lettre">E</span>
    <span class="lettre">N</span>
    <span class="lettre">T</span>
  </div> 
-->

<script src="/js/app.js"></script>
<!--

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

</body>
</html>