<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
// print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
// print_r($_SESSION);
if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
    echo '<script>
        setTimeout(function() {
        swal({
        title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
        type: "error"
        }, function() {
        window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
        });
        }, 1000);
        </script>';
    exit();
}
?>

<?php
  $conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
    //   echo "SUCCESS";
  }
  if(isset($_POST['text'])){
    $text = $_POST['text'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $query = mysqli_query($conn, "INSERT INTO scan_test (track, Time, latitude, longitude) 
                         VALUES ('$text', NOW(), '$latitude', '$longitude')");
        if($query){
            echo" <script>alert('send data success')</script>";
        }else{
            echo" <script>alert('send data failed')</script>";
        }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="style-scan.css">
    <title>KARY SCAN</title>
</head>
<body onload = "getLocation();">

    <div class="wrapper">
        <header>
            <h1>KARY SCAN</h1>
        </header>
        <div class="scan">
            <video width="100%" id="MyCameraOpen" ></video>
        </div>
        <form class="myForm" action="" method="POST" autocomplete="off">
            <input type="text" id="text" name="text">
            <input type="hidden" name="latitude" value=""> <br>
            <input type="hidden" name="longitude" value="">
        </form>
    </div>

    <script>     
        //step 1

        var video = document.getElementById("MyCameraOpen");
        var text = document.getElementById("text");

        var scanner = new Instascan.Scanner({
            video : video
        });
        Instascan.Camera.getCameras()
        .then(function(Our_Camera){
            if(Our_Camera.length > 0){
                scanner.start(Our_Camera[0]);
            }else{
                alert("camera failed");
            }
        })
        .catch(function(error){
            console.log("error please try agein!!")
        })
        
        //input text section step2
        
        scanner.addListener('scan',function(input_value){
            text.value=input_value;
            document.forms[0].submit();
        })
    </script>

    <script type="text/javascript">
        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }
        function showPosition(position){
            document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
        }
    </script>
</body>
</html>