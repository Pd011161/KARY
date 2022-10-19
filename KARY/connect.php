<?php
$servername = "localhost";
$username = "root";
$password = ""; //ไม่ได้ตั้งรหัสผ่านก็ลบ  yourpassword ออก

try {
  $conn = new PDO("mysql:host=$servername;dbname=Kary_DB;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
?>