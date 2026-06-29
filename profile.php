<?php

include "connection.php";


$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";


$result = mysqli_query($conn,$sql);


$user = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Profile - DeepfakeGuard AI</title>


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



.profile-card{

background:#102a4c;
padding:35px;
border-radius:20px;
max-width:500px;

}



.profile-card h2{

font-size:30px;

}



.info{

background:#17395f;
padding:15px;
margin-top:15px;
border-radius:12px;

}


</style>



</head>


<body>




<div class="dashboard">





<div class="sidebar">


<h2>DeepfakeGuard AI</h2>


<a href="dashboard.php">Dashboard</a>

<a href="upload.html">Upload Media</a>

<a href="analysis.html">Analysis</a>

<a href="results.php">Results</a>

<a href="reports.php">Reports</a>

<a href="analytics.php">Analytics</a>


<a class="active" href="profile.php">

Profile

</a>


<a href="settings.php">Settings</a>


<a href="logout.php">

Logout

</a>



</div>







<div class="main">



<h1>User Profile</h1>



<div class="profile-card">



<h2>

<?php echo $user['name']; ?>

</h2>



<h3>

AI Security Analyst

</h3>




<div class="info">

Email :

<?php echo $user['email']; ?>

</div>




<div class="info">

Role :

<?php echo $user['role']; ?>

</div>




<div class="info">

Status :

<?php echo $user['status']; ?>

</div>




</div>





</div>




</div>





</body>

</html>