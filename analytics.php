<?php

include "connection.php";


$sql = "SELECT * FROM analytics ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Analytics - DeepfakeGuard AI</title>


<link rel="stylesheet" href="style.css">


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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



.analytics-container{

display:flex;
gap:20px;

}



.analytics-card{

background:#102a4c;
padding:25px;
border-radius:15px;
width:200px;
text-align:center;

}



.chart-box{

margin-top:40px;
background:#102a4c;
padding:25px;
border-radius:20px;
text-align:center;

}



.chart-box h2{

color:#003366;

}



#deepfakeChart{

width:300px !important;
height:300px !important;
margin:auto;

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

<a href="reports.php">Reports</a>

<a class="active" href="analytics.php">Analytics</a>

<a href="profile.html">Profile</a>

<a href="settings.html">Settings</a>

<a href="login.html">Logout</a>


</div>






<div class="main">



<h1>AI Analytics Dashboard</h1>


<p>
Deepfake Detection Performance Overview
</p>





<div class="analytics-container">



<div class="analytics-card">

<h2>Total Files</h2>

<h1>

<?php echo $data['total_files']; ?>

</h1>

<p>Analysed Media</p>


</div>





<div class="analytics-card">


<h2>Deepfake</h2>

<h1>

<?php echo $data['deepfake_count']; ?>

</h1>

<p>Detected Files</p>


</div>





<div class="analytics-card">


<h2>Authentic</h2>

<h1>

<?php echo $data['authentic_count']; ?>

</h1>

<p>Verified Files</p>


</div>



</div>







<div class="chart-box">


<h2>Detection Statistics</h2>


<canvas id="deepfakeChart"></canvas>


</div>





</div>



</div>






<script>


const ctx = document.getElementById('deepfakeChart');



new Chart(ctx,{


type:'pie',



data:{


labels:[

'Deepfake Detected',

'Authentic Media'

],



datasets:[{


data:[

<?php echo $data['deepfake_count']; ?>,

<?php echo $data['authentic_count']; ?>

],



backgroundColor:[

'#0066ff',

'#ff0000'

]


}]

},



options:{


responsive:false,


plugins:{


legend:{


position:'bottom',


labels:{


color:'white'

}


}


}


}


});



</script>





</body>

</html>