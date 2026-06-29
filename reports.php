<?php

include "connection.php";


$sql = "SELECT * FROM detection_history ORDER BY id DESC";

$result = mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Reports - DeepfakeGuard AI</title>


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




.report-box{

background:#102a4c;
padding:25px;
border-radius:20px;

}




.report-card{

background:#17395f;
padding:20px;
margin-top:20px;
border-radius:15px;

}



button{

background:#0066ff;
color:white;
border:none;
padding:10px 20px;
border-radius:10px;
cursor:pointer;

}



.fake{

color:#ff4d4d;

}



.safe{

color:#00ff99;

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

<a href="results.php">Results</a>


<a class="active" href="reports.php">
Reports
</a>


<a href="analytics.html">Analytics</a>

<a href="profile.html">Profile</a>

<a href="settings.html">Settings</a>

<a href="login.html">
Logout
</a>



</div>






<div class="main">



<h1>AI Detection Reports</h1>


<p>
Generated Deepfake Analysis History
</p>




<div class="report-box">


<h2>Recent Reports</h2>




<?php while($row = mysqli_fetch_assoc($result)){ ?>



<div class="report-card">



<h2>

<?php echo $row['file_name']; ?>

</h2>



<p>

Status :

<span class="<?php echo ($row['result']=="Deepfake Detected") ? 'fake':'safe'; ?>">

<?php echo $row['result']; ?>

</span>


</p>




<p>

Confidence :

<?php echo $row['confidence']; ?>%

</p>




<p>

Date :

<?php echo $row['analysis_date']; ?>

</p>




<button onclick="window.location='results.php'">

View Report

</button>




</div>



<?php } ?>





</div>


</div>


</div>





</body>

</html>