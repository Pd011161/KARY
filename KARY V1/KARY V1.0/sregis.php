<?php
  $conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
      // echo "SUCCESS";
  }
?>

<?php
$s_name = $_POST['send_name'];
$s_tel = $_POST['send_phonenumber'];
$s_address = $_POST['send_address'];
$r_name = $_POST['receive_name'];
$r_tel = $_POST['receive_phonenumber'];
$r_address = $_POST['receive_address'];
mysqli_query($conn, "INSERT INTO kary_regis_data (send_name, send_phonenumber, send_address, 
                      receive_name, receive_phonenumber, receive_address, send_time) 
                      VALUES ('$s_name', '$s_tel', '$s_address', '$r_name', '$r_tel', '$r_address', NOW())");
// print_r($_POST);
?>

<?php
$sql = "SELECT * FROM kary_regis_data  ORDER BY track DESC Limit 0,1";//เพิ่ม where
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style-sregis.css">
  <title>KARY||TRACK&QR||<?=$row['track']?></title>
</head>
<body>
  <div class="wrapper">
    <header>
        <h1>KARY TRACK&QR</h1>
    </header>
    <div class="form">
      <p>This is your track number.</p>
      <input type="text" value="<?=$row['track']?>">
      <button>Gennerate QR CODE</button>
    </div>
    <div class="qr-code">
        <img src="qe-code.png" alt="qr-code"> <br>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
