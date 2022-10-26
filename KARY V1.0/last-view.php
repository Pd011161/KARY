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
  $conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
      // echo "SUCCESS";
  } 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Last Status</title>
</head>
<body>

    <div class="container mt-5" >

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: -25px;">
                    <div class="card-header" >
                        <h4>Last Status
                            <a href="ind_admin.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>

                    <?php
                        $track = $_GET['track'];
                        $spl = "SELECT * FROM kary_scan_receiver WHERE track = '$track' ORDER BY Time DESC Limit 0,1";
                        $result=$conn->query($spl);
                        if(mysqli_num_rows($result)>0){
                            $i=1;
                            while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="card-body">
                                    <div class="mb-3">
                                        <label>status</label>
                                        <p class="form-control">
                                            <?= $row['status']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>date-time</label>
                                        <p class="form-control">
                                            <?= $row['Time']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>key</label>
                                        <p class="form-control">
                                            <?= $row['id']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>track</label>
                                        <p class="form-control">
                                            <?= $row['track']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>city</label>
                                        <p class="form-control">
                                            <?= $row['city']; ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>map</label>
                                        <p class="form-control" style="width: 450px; height: 250px;"> 
                                            <iframe src="https://www.google.com/maps?q=<?=$row['latitude']?>,<?=$row['longitude']?>&h1=es;z=14&output=embed" 
                                            style=" width: 95%; height: 100%; margin:2px;">
                                            </iframe> 
                                        </p>
                                    </div>
                                    
                 
                    </div>
                    <?php
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>