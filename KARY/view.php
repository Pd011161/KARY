<?php
  $conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
      // echo "SUCCESS";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style-view.css">
<?php
  $track = $_GET['track'];
  $spl = "SELECT * FROM kary_scan_data  WHERE track = '$track'";
  $result=$conn->query($spl);
  if(mysqli_num_rows($result)>0){
      $i=1;
      while($row=mysqli_fetch_array($result)){ 
?>
  <title>VIEW Track number : <?=$row['track']?></title>
<?php
    }  
}
?>
</head>
<body>

  <div class="container" style="width: 600px; display:flex; flex-direction:row; justify-content: space-between;  gap: 50px; margin:30px; margin-top: 10px; padding: 10px; 
    background: #ff22bb; 
    border: 1px solid #ff22bb;
    box-shadow: 0 0 5px #ff22bb,
    0 0 15px #ff22bb,
    0 0 30px #ff22bb,
    0 0 60px #ff22bb;">
    <?php
      $track = $_GET['track'];
      $spl = "SELECT * FROM kary_regis_data  WHERE track = '$track'";
      $result=$conn->query($spl);
      if(mysqli_num_rows($result)>0){
          $i=1;
          while($row=mysqli_fetch_array($result)){ 
    ?>

    <form class="labs">
      <label for = "sender" style="text-align: center;"><h3>SENDER</h3></label>
      <div>
        <label for = "sender">name:</label>
        <input type="text" value="<?=$row['send_name']?>"><br>
      </div>
      
      <div>
        <lable for = "phonenumber">phone:</lable>
        <input type="tel" value="<?=$row['send_phonenumber']?>"><br>
      </div>
     
      <div style=" display:flex; flex-direction:row;">
        <lable for = "phonenumber" >location: </lable> 
        <textarea type="text" cols="20" rows="5" style="max-width: 100%; margin-left: 2px;"><?=$row['send_address']?></textarea> <br>
      </div> 
      
    </form>

    <form class="labr">
      <lable for = "sender" style="text-align: center;"><h3>RECEIVE</h3></lable>
      <div>
        <lable for = "sender">name:</lable>
        <input type="text" value="<?=$row['receive_name']?>"><br>
      </div>
      
      <div>
        <lable for = "phonenumber">phone:</lable>
        <input type="tel" value="<?=$row['receive_phonenumber']?>"><br>
      </div>
     
      <div style=" display:flex; flex-direction:row;">
        <lable for = "phonenumber" >location: </lable> 
        <textarea type="text" cols="20" rows="5" style="max-width: 100%; margin-left: 2px;"><?=$row['receive_address']?></textarea> <br>
      </div> 
      
    </form>

      <?php
          }  
      }
      ?>        
  </div>
  <div class="finit" style="text-align: center; width: 630px;  margin: 10px; align-item: center; padding: 5px; padding-bottom: 20px;
      box-shadow: 0 0 5px #1eff45,
      0 0 15px #1eff45,
      0 0 30px #1eff45,
      0 0 60px #1eff45;">
      <h2 style=" color: red; backgroung:red; margin-top: 10px; margin-bottom: -5px">receive signature</h2>
      <?php
      $track = $_GET['track'];
      $spl = "SELECT * FROM kary_scan_data  WHERE track = '$track'";
      $result=$conn->query($spl);
      if(mysqli_num_rows($result)>0){
          $i=1;
          while($row=mysqli_fetch_array($result)){ 
      ?>
      <img src="<?=$row['signature']?>" style="margin:2px 5px; width:90%;">
      <?php
        }  
      }
      ?>
      <!-- <img src="x.png" style="margin:2px 5px; width:90%;"> -->
  </div>
 
  <div class="tb" style="margin-top: 20px; ">
      <table border = 7 cellspacing = 0 cellpadding = 10 class="table" 
      style="box-shadow: 0 0 5px #2bd2ff,
      0 0 15px #2bd2ff,
      0 0 30px #2bd2ff,
      0 0 60px #2bd2ff;
      /* border: 1px solid rgba(255,255,255,0.1); */
      width: 650px;">
      <thead style = "color: #FDDB3A; box-shadow: 0 0 5px #2bd2ff,
      0 0 15px #2bd2ff,
      0 0 30px #2bd2ff,
      0 0 20px #2bd2ff;
      border: 1px solid rgba(255,255,255,0.1);
      height: 40px;
      font-size: 20px;">
          <tr>
            <th scope="col"><h3 style="width: 70px">track</h3></th>
            <th scope="col"><h3 style="width: 130px">date-send</h3></th>
            <th scope="col"><h3>location</h3></th>
          </tr>
        </thead>
        <tbody class="text-white" style="box-shadow: 0 0 5px #2bd2ff,
      0 0 15px #2bd2ff,
      0 0 30px #2bd2ff,
      0 0 20px #2bd2ff;
      border: 1px solid rgba(255,255,255,0.1);">
          <?php
          $track = $_GET['track'];
          $spp =  "SELECT * FROM kary_scan_data WHERE track = '$track'";
          $regis=$conn->query($spp);
          if(mysqli_num_rows($result)>0){
              $i=1;
              while($rg=mysqli_fetch_array($regis)){
          ?>
          <tr style = "box-shadow: 0 0 5px #2bd2ff,
          0 0 15px #2bd2ff,
          0 0 30px #2bd2ff,
          0 0 20px #2bd2ff;
          border: 1px solid rgba(255,255,255,0.1);">
              <td><h3 style="margin:10px;"><?=$rg['track']?></h3></td>
              <td><h3 style="margin:10px;"><?=$rg['Time']?></h3></td>
              <td style="width: 450px; height: 450px;"> 
                <iframe src="https://www.google.com/maps?q=<?=$rg['latitude']?>,<?=$rg['longitude']?>&h1=es;z=14&output=embed" 
                  style=" width: 95%; height: 100%; margin:10px;">
                </iframe> 
              </td>
                          
          </tr>
          <?php
            }  
          }
          ?>
          <?php
          $track = $_GET['track'];
          $spl =  "SELECT * FROM scan_test WHERE track = '$track' ";
          $result=$conn->query($spl);
          if(mysqli_num_rows($result)>0){
              $i=1;
              while($row=mysqli_fetch_array($result)){
          ?>
          <tr style = "box-shadow: 0 0 5px #2bd2ff,
          0 0 15px #2bd2ff,
          0 0 30px #2bd2ff,
          0 0 20px #2bd2ff;
          border: 1px solid rgba(255,255,255,0.1);">
              <td><h3 style="margin:10px;"><?=$row['track']?></h3></td>
              <td><h3 style="margin:10px;"><?=$row['Time']?></h3></td>
              <td style="width: 450px; height: 450px;"> 
                <iframe src="https://www.google.com/maps?q=<?=$row['latitude']?>,<?=$row['longitude']?>&h1=es;z=14&output=embed" 
                  style=" width: 95%; height: 100%; margin:10px;">
                </iframe> 
              </td>
                             
          </tr>
          <?php
            }  
          }
          ?>
        </tbody>
      </table>
               
  </div>

</body>
</html>