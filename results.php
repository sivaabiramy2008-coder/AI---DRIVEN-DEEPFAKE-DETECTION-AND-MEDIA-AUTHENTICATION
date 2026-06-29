<?php

include "connection.php";


$sql = "SELECT * FROM detection_history ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>AI Detection Result - DeepfakeGuard AI</title>


<link rel="stylesheet" href="style.css">


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">


<style>


body{

margin:0;
font-family:Poppins,sans-serif;
background:#081b33;

}



.dashboard{

display:flex;
height:100vh;

}



.sidebar{

width:230px;
background:#102a4c;
padding:20px;
color:white;

}



.sidebar h2{

text-align:center;

}



.sidebar a{

display:block;
color:white;
padding:12px;
text-decoration:none;

}



.active{

background:#0066ff;
border-radius:10px;

}



.main{

flex:1;
padding:30px;
color:white;

}



.result-box{

background:#102a4c;
padding:30px;
border-radius:20px;
margin-top:30px;

}



.status{

padding:15px;
border-radius:10px;
margin:20px 0;
background:#8b0000;

}



.confidence-bar{

height:20px;
background:#333;
border-radius:20px;

}



.confidence-fill{

height:100%;
width:87%;
background:#ff0000;
border-radius:20px;

}



.heatmap{

margin-top:25px;
padding:25px;
background:#003366;
border-radius:15px;
text-align:center;

}



button{

margin-top:25px;
padding:12px 25px;
border:none;
border-radius:10px;
background:#0066ff;
color:white;
cursor:pointer;

}


.white-text{

color:white;

}


</style>


</head>


<body>



<div class="dashboard">



<div class="sidebar">


<h2>DeepfakeGuard AI</h2>


<a href="dashboard.html">Dashboard</a>

<a href="upload.html">Upload Media</a>

<a href="analysis.html">Analysis</a>

<a class="active" href="results.php">Results</a>

<a href="reports.html">Reports</a>

<a href="analytics.html">Analytics</a>

<a href="profile.html">Profile</a>

<a href="settings.html">Settings</a>

<a href="login.html">Logout</a>


</div>





<div class="main">



<h1>AI Detection Result</h1>


<p>
AI Driven Deepfake Detection & Media Authentication
</p>



<div class="result-box">



<h2>

Media File :

<?php echo $data['file_name']; ?>

</h2>




<div class="status">


⚠

<?php echo $data['result']; ?>


</div>




<h3>Confidence Score</h3>



<div class="confidence-bar">

<div class="confidence-fill"></div>

</div>



<h2 class="white-text">

Detected Probability:

<?php echo $data['confidence']; ?>%

</h2>




<div class="heatmap">


📊 Facial Manipulation Heatmap (AI Visual)


<br><br>


AI Analysis Completed Successfully


</div>




<button onclick="downloadReport()">

Download AI Report PDF

</button>




</div>


</div>



</div>





<script>


function downloadReport(){

alert("Report Download Started");

}


</script>




</body>

</html>