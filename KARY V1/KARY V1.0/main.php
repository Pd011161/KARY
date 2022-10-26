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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>KARY ADMIN</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.css"/> -->
    </head>
    <body>
   
        <div class="container" style="margin-top: 200px;">
            <div>
                <h2 class="text-center">KARY ADMIN</h2>
                <br>
                <h5 class="text-center " style="background:#1eff45;
                box-shadow: 0 0 5px #1eff45,
                0 0 15px #1eff45,
                0 0 30px #1eff45,
                0 0 60px #1eff45;">
                HELLO <?= $_SESSION['name'].' '.$_SESSION['surname'];?>
                </h5>
            </div>
            <div class="list-group inp"  style="border: 1px solid rgba(255,255,255,0.1);">
                <h5 class="list-group-item list-group-item-action active text-center" aria-current="true"  style="box-shadow: 0 0 5px #2bd2ff,
                0 0 2px #2bd2ff,
                0 0 6px #2bd2ff,
                0 0 15px #2bd2ff;
                background: #2bd2ff;
                border: 1px solid rgba(255,255,255,0.1);
                margin-bottom: 3px;">
                    MENU
                </h5>
                <a href="scan_receiver.php" class="list-group-item list-group-item-action text-center" style="">scan</a>
                <a href="ind_admin.php" class="list-group-item list-group-item-action text-center">view&update-data</a>
                <a href="logout.php" class="list-group-item list-group-item-danger text-white text-center" onclick="return confirm('ยืนยันการออกจากระบบ');" style="box-shadow: 0 0 5px #ff1f71,
                0 0 2px #ff1f71,
                0 0 6px #ff1f71,
                0 0 15px #ff1f71;
                background: #ff1f71;
                border: 1px solid rgba(255,255,255,0.1);
                margin-top: 3px;">LOGOUT</a>
            </div>

        </div>


    </body>
</html>