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
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Track Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Track Edit 
                            <?php
                                if(isset($_GET['id']))
                                {
                                $id = mysqli_real_escape_string($con, $_GET['id']);
                                $query = "SELECT * FROM kary_scan_receiver WHERE id='$id' ";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    $row = mysqli_fetch_array($query_run);
                            ?>
                            <a href="update-admin.php?track=<?= $row['track']; ?>" class="btn btn-danger float-end">BACK</a>
                            <?php
                                    }
                                    else
                                    {
                                        echo "<h4>No Such Id Found</h4>";
                                    }
                                }
                            ?>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM kary_scan_receiver WHERE id='$id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $row = mysqli_fetch_array($query_run);
                                ?>
                                <form class="myForm" action="code.php"  method="POST">
                                    <div class="mb-1">

                                    <div class="mb-3">
                                        <label>id</label>
                                        <h4 class="form-control"><?=$row['id']?><h4>
                                        <input type="hidden" name="id" class="form-control" value="<?=$row['id']?>">
                                    </div>  
                                    <div class="mb-3">
                                        <label>date-time</label>
                                        <h4 class="form-control"><?=$row['Time']?><h4>
                                        <input type="hidden" name="Time" class="form-control" value="<?=$row['Time']?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>track</label>
                                        <input type="text" name="text" class="form-control" value="<?=$row['track']?>">
                                    </div>
                                    <div class="mb-3" id="lat">
                                        <label>latitude</label>
                                        <input type="text" name="latitude" class="form-control" value="<?=$row['latitude']?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>longitude</label>
                                        <input type="text" name="longitude" class="form-control" value="<?=$row['longitude']?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>city</label>

                                        <input type="text" name="jw" class="form-control" value="<?=$row['city']?>" >

                                    </div>
                                    <div class="mb-3">
                                        <label>status</label>
                                        <select name="st" class="form-select"> 
                                            <option value="<?=$row['status']?>" selected><?=$row['status']?></option>       
                                            <option value="ลงทะเบียนสำเร็จ">ลงทะเบียนสำเร็จ</option> 
                                            <option value="อยู่ระหว่างการขนส่ง" >อยู่ระหว่างการขนส่ง</option>
                                            <option value="จัดส่งสำเร็จ">จัดส่งสำเร็จ</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>