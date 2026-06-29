<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Settings - DeepfakeGuard AI</title>


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



.settings-box{

background:#102a4c;
padding:30px;
border-radius:20px;
max-width:600px;

}



.setting-item{

background:#17395f;
padding:20px;
margin-top:20px;
border-radius:15px;

}



button{

background:#0066ff;
color:white;
border:none;
padding:12px 25px;
border-radius:10px;

}


.logout{

background:#ff0033;

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

<a href="profile.html">Profile</a>


<a class="active" href="settings.php">

Settings

</a>


<a href="logout.php" class="logout">

Logout

</a>



</div>






<div class="main">



<h1>System Settings</h1>


<p>
Manage AI Detection System Preferences
</p>




<div class="settings-box">



<div class="setting-item">

<h3>AI Detection Engine</h3>

<p>Active</p>

</div>




<div class="setting-item">

<h3>Database Status</h3>

<p>Connected</p>

</div>




<div class="setting-item">

<h3>User Security</h3>

<p>Password Authentication Enabled</p>

</div>




<button>

Save Settings

</button>



</div>



</div>


</div>




</body>

</html>