<?php

include "connection.php";


$users = mysqli_query($conn,"SELECT COUNT(*) as total FROM users");
$userData = mysqli_fetch_assoc($users);


$files = mysqli_query($conn,"SELECT COUNT(*) as total FROM detection_history");
$fileData = mysqli_fetch_assoc($files);


$fake = mysqli_query($conn,"SELECT COUNT(*) as total FROM detection_history WHERE result='Deepfake Detected'");
$fakeData = mysqli_fetch_assoc($fake);


$real = mysqli_query($conn,"SELECT COUNT(*) as total FROM detection_history WHERE result='Authentic Media'");
$realData = mysqli_fetch_assoc($real);


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Dashboard - DeepfakeGuard AI</title>

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
border-radius:10px;

}



.sidebar a:hover,
.active{

background:#0066ff;

}



.main{

flex:1;
padding:30px;
color:white;

}



.cards{

display:flex;
gap:25px;
margin-top:30px;

}



.card{

background:#102a4c;
width:220px;
padding:25px;
border-radius:20px;
text-align:center;

}



.card h1{

font-size:40px;

}



.card p{

color:#b9c7dd;

}




.welcome{

margin-top:40px;
background:#102a4c;
padding:25px;
border-radius:20px;

}



</style>



</head>



<body>



<div class="dashboard">





<div class="sidebar">


<h2>DeepfakeGuard AI</h2>


<a class="active" href="dashboard.php">Dashboard</a>

<a href="upload.html">Upload Media</a>

<a href="analysis.html">Analysis</a>

<a href="results.php">Results</a>

<a href="reports.php">Reports</a>

<a href="analytics.php">Analytics</a>

<a href="profile.html">Profile</a>

<a href="settings.html">Settings</a>

<a href="login.html">Logout</a>



</div>







<div class="main">



<h1>AI Dashboard</h1>


<p>
AI Driven Deepfake Detection & Media Authentication
</p>





<div class="cards">



<div class="card">

<h2>Users</h2>

<h1>
<?php echo $userData['total']; ?>
</h1>

<p>Registered Users</p>


</div>





<div class="card">

<h2>Files</h2>

<h1>
<?php echo $fileData['total']; ?>
</h1>

<p>Analysed Media</p>


</div>





<div class="card">

<h2>Deepfake</h2>

<h1>
<?php echo $fakeData['total']; ?>
</h1>

<p>Detected</p>


</div>





<div class="card">

<h2>Authentic</h2>

<h1>
<?php echo $realData['total']; ?>
</h1>

<p>Verified</p>


</div>




</div>






<div class="welcome">


<h2>System Status</h2>

<p>

AI Detection Engine : Active ✅

</p>


<p>

Database Connection : Connected ✅

</p>


</div>





</div>


</div>





</body>


</html>