<?php

include "connection.php";


if(isset($_POST['upload'])){


    $fileName = $_FILES['media']['name'];

    $tmpName = $_FILES['media']['tmp_name'];

    $fileType = $_FILES['media']['type'];


    // upload folder

    $folder = "uploads/".$fileName;



    if(move_uploaded_file($tmpName,$folder)){



        $result = "Pending";

        $confidence = 0;



        $user = "user@gmail.com";



        $sql = "INSERT INTO detection_history

        (user_email,file_name,media_type,result,confidence)

        VALUES

        ('$user',
        '$fileName',
        '$fileType',
        '$result',
        '$confidence')";




        if(mysqli_query($conn,$sql)){



            echo "

            <script>

            alert('Media Uploaded Successfully');

            window.location='analysis.html';

            </script>

            ";


        }


        else{


            echo "Database Insert Failed";


        }



    }

    else{


        echo "File Upload Failed";


    }



}


?>