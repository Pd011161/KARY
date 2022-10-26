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
session_start();
$conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
      // echo "SUCCESS";
  }
if(isset($_POST['ip'])){
    $ip = $_POST['ip'];
    $isp = $_POST['isp'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $query = mysqli_query($conn, "INSERT INTO location (ip, isp, country, city, Time) 
                        VALUES ('$ip', '$isp', '$country', '$city', NOW())");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>track Add </title>
  </head>
  <body onload = "getLocation();">
  
  <div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>track Add   
                        <?php 
                            $track = $_GET['track']; 
                            // $spl = "SELECT * FROM kary_scan_receiver  ORDER BY Time DESC";
                            $spl = "SELECT * FROM kary_scan_receiver WHERE track = '$track' ORDER BY Time DESC Limit 0,1";
                            $result=$conn->query($spl);
                            if(mysqli_num_rows($result)>0){
                                $i=1;
                                while($row=mysqli_fetch_array($result)){
                        ?>
                        <a href="update-admin.php?track=<?= $row['track']; ?>" class="btn btn-danger float-end">BACK</a>
                        <?php
                            }
                        }
                        ?>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="myForm" action="code.php"  method="POST">
                        <div class="mb-1">
                        <div class="mb-3">
                            <label>track</label>
                            <?php
                            $track = $_GET['track']; 
                            // $spl = "SELECT * FROM kary_scan_receiver  ORDER BY Time DESC";
                            $spl = "SELECT * FROM kary_scan_receiver WHERE track = '$track' ORDER BY Time DESC Limit 0,1";
                            $result=$conn->query($spl);
                            if(mysqli_num_rows($result)>0){
                                $i=1;
                                while($row=mysqli_fetch_array($result)){
                                ?>           
                            <input type="text" name="text" class="form-control" value="<?=$row['track']?>">
                            <?php
                                    }  
                                }
                            ?>                     
                        </div>
                        <div class="mb-3" id="lat">
                            <label>latitude</label>
                            <input type="text" name="latitude" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label>longitude</label>
                            <input type="text" name="longitude" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label>city</label>
                            <?php
                            $spl = "SELECT * FROM location ORDER BY Time DESC Limit 0,1";
                            $result=$conn->query($spl);
                            if(mysqli_num_rows($result)>0){
                                $i=1;
                                while($row=mysqli_fetch_array($result)){
                                ?>
                            <input type="text" name="jw" class="form-control" value="<?=$row['city']?>" >
                            <?php
                                    }  
                                }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label>status</label>
                            <select name="st" class="form-select" >              
                                <option value="ลงทะเบียนสำเร็จ">ลงทะเบียนสำเร็จ</option> 
                                <option value="อยู่ระหว่างการขนส่ง" selected>อยู่ระหว่างการขนส่ง</option>
                                <option value="จัดส่งสำเร็จ">จัดส่งสำเร็จ</option>
                            </select>
                        </div>
                        </div>
                            <button type="submit" class="btn btn-primary" name="save">เพิ่มข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
         


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

    <script type="text/javascript">
        $.getJSON('http://ip-api.com/json', function(ip){
            var data = {
                ip: ip.query,
                isp: ip.isp,
                country: ip.country,
                city: ip.regionName
            };
            $.ajax({
                url: 'add-admin.php',
                type: 'POST',
                data: data
            })
        })
    </script>
      </body>
    </html>