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

    <title>TRACK DATA</title>
</head>
<body>
  
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <center><h4>TRACK DATA
                        <a href="main.php" class="btn btn-danger float-end" >BACK</a>
                        </h4></center>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align:center;">
  
                                    <th>id</th>
                                    <th>track</th>
                                    <th>date-time</th>
                                    <th>city</th>
                                    <th>map</th>
                                    <th>status</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     $spl = "SELECT * FROM kary_scan_receiver GROUP BY track HAVING count(track) = 1 ORDER BY Time DESC";
                                     $result=$conn->query($spl);
                                     if(mysqli_num_rows($result)>0){
                                         $i=1;
                                         while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['track']; ?></td>
                                                <td><?= $row['Time']; ?></td>
                                                <td><?= $row['city']; ?></td>
                                                <td style="width: 450px; height: 250px;"> 
                                                    <iframe src="https://www.google.com/maps?q=<?=$row['latitude']?>,<?=$row['longitude']?>&h1=es;z=14&output=embed" 
                                                    style=" width: 95%; height: 100%; margin:10px;">
                                                    </iframe> 
                                                </td>
                                                <td><?= $row['status']; ?></td>
                                                <td style="padding: 10px 45px;">
                                                    <a href="last-view.php?track=<?= $row['track']; ?>" class="btn btn-info btn-sm">View Last</a>
                                                    <a href="update-admin.php?track=<?= $row['track']; ?>" class="btn btn-success btn-sm" style="margin-left: 10px;">Update</a>
                                                    <!-- <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete" value="<?=$row['track'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> -->
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                                 <?php 
                                     $spl = "SELECT * FROM kary_scan_receiver GROUP BY track ASC HAVING count(track) > 1 ORDER BY Time ASC ";
                                     $result=$conn->query($spl);
                                     if(mysqli_num_rows($result)>0){
                                         $i=1;
                                         while($row=mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?= $row['key']; ?></td>
                                                <td><?= $row['track']; ?></td>
                                                <td><?= $row['Time']; ?></td>
                                                <td><?= $row['city']; ?></td>
                                                <td style="width: 450px; height: 250px;"> 
                                                    <iframe src="https://www.google.com/maps?q=<?=$row['latitude']?>,<?=$row['longitude']?>&h1=es;z=14&output=embed" 
                                                    style=" width: 95%; height: 100%; margin:10px;">
                                                    </iframe> 
                                                </td>
                                                <td><?= $row['status']; ?></td>
                                                <td style="padding: 10px 45px;">
                                                    <a href="last-view.php?track=<?= $row['track']; ?>" class="btn btn-info btn-sm">View Last</a>
                                                    <a href="update-admin.php?track=<?= $row['track']; ?>" class="btn btn-success btn-sm" style="margin-left: 10px;">Update</a>
                                                    
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>