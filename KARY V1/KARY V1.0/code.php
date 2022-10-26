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
    //   echo "SUCCESS";
  }




if(isset($_POST['delete']))
{
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $query = "DELETE FROM kary_scan_receiver WHERE id = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "item Deleted Successfully";
        header("Location: ind_admin.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "item Not Deleted";
        header("Location: ind_admin.php");
        exit(0);
    }
}

if(isset($_POST['update']))
{
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $time = mysqli_real_escape_string($conn, $_POST['Time']);
    $track = mysqli_real_escape_string($conn, $_POST['text']);
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);
    $city = mysqli_real_escape_string($conn, $_POST['jw']);
    $status = mysqli_real_escape_string($conn, $_POST['st']);

    $query = "UPDATE kary_scan_receiver SET track='$track',Time='$time', latitude='$latitude', longitude='$longitude', city='$city', status='$status' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "item Updated Successfully";
        header("Location: ind_admin.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "item Not Updated";
        header("Location: ind_admin.php");
        exit(0);
    }

}


if(isset($_POST['save']))
{
    $track = mysqli_real_escape_string($conn, $_POST['text']);
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);
    $city = mysqli_real_escape_string($conn, $_POST['jw']);
    $status = mysqli_real_escape_string($conn, $_POST['st']);

    $query = "INSERT INTO kary_scan_receiver (track,Time,latitude,longitude,city,status) VALUES ('$track',NOW(),'$latitude','$longitude','$city','$status')";

    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Track Created Successfully";
        header("Location: ind_admin.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Track Not Created";
        header("Location: ind_admin.php");
        exit(0);
    }
}

?>

