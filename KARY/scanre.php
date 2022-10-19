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
  if(isset($_POST['save'])){
    $text = $_POST['text'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $folderPath = "upload/";
    $image_parts = explode(";base64,", $_POST['signed']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]); 
    $file = $folderPath . uniqid() . '.'.$image_type;
    file_put_contents($file, $image_base64);
    $query = mysqli_query($conn, "INSERT INTO kary_scan_data (track, Time, latitude, longitude, signature) 
                         VALUES ('$text', NOW(), '$latitude', '$longitude', '$file')");
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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.signature.css">

    <style>
        .kbw-signature { width: 400px; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
</head>
<body onload = "getLocation();" style="background: black;">

    <div class="wrapper" style=" margin-top:-70px; height:80%; width:98%; ">
        <header>
            <h1>KARY SCAN</h1>
        </header>
        <div class="scan" style="margin-top: -10px;">
            <video width="100%" id="MyCameraOpen" ></video>
        </div>
        <form class="myForm" action="" method="POST" autocomplete="off">
            <input type="text" id="text" name="text" style="margin-top: -20px;">
            <input type="hidden" name="latitude" value=""> <br>
            <input type="hidden" name="longitude" value="">
   
            <div class="col-md-12" pa style="margin-top: 20px; text-align: center;">
                <label class="text-white" for="">Signature</label>
                <br/>
                <div id="sig"style="width:100%; height: 150px; " ></div>
                <br/>
                <button id="clear">Clear Signature</button>
                <textarea id="signature64" name="signed" style="display: none; width:98%; "></textarea>
            </div>

            <button class="btn btn-success" name="save" style="margin-top: 10px;" >Submit</button>
        </form>
    </div>
    <!-- signpad -->
    <!-- <div class="container">
 
        <form method="POST" action="upload.php">
    
            <h1>PHP + MySQL Signature Pad Example - Laratutorials.com</h1>
    
            <div class="col-md-12">
                <label class="" for="">Signature:</label>
                <br/>
                <div id="sig" ></div>
                <br/>
                <button id="clear">Clear Signature</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea>
            </div>
    
            <br/>
            <button class="btn btn-success">Submit</button>
        </form>
  
    </div> -->

    <!-- signpad -->
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    
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
            // document.forms[0].submit();
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