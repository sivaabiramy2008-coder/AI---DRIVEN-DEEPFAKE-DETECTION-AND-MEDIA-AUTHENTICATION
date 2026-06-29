<?php

include "connection.php";


$email = "user@gmail.com";


$result = "Deepfake Detected";

$confidence = 87;



$sql = "UPDATE detection_history

SET result='$result',
confidence='$confidence'

WHERE user_email='$email'

ORDER BY id DESC

LIMIT 1";



if(mysqli_query($conn,$sql)){


echo "

<script>

alert('AI Analysis Completed');

window.location='results.html';

</script>

";


}
else{

echo "Analysis Failed";

}


?>