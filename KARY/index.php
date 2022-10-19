<?php
  $conn = mysqli_connect("localhost","root","","Kary_DB");
  if($conn){
      // echo "SUCCESS";
  } 
?>
<!DOCTYPE html>
<html>
<head>
    <base target="_self">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARY SEARCH TRACK</title>
    <!-- <script src="jquery.js"></script>
    <script src="js/bootstrap.js"></script> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"/> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

    <div class="container">
            <br>
            <div class="row">
              <div class="col">
                  <center><form id="search-form" class="boxx" style="--clr:#ff22bb;--i:0.1;" onsubmit="handleFormSubmit(this)" method="GET">
                    <div class="form-group mb-2 boxt">
                      <center>
                        </center><br>
                      <h2 for="searchtext" style="margin-bottom: 15px;">KARY EXPRESS</h2>
                    </div>
                    <div class="form-group mx-sm-3 mb-1 inp">
                      <input type="text" class="form-control col-sm-6 sch text-white" name="track" placeholder="track number"><br>
                    </div>
                    <div class="containers">
                        <button  type="submit" class="btn"><a>SEARCH</a></button>
                    </div>
                    </form>       
              </div>
            
            </div>
            <br>
            <br>
            <div class="tb" style="margin-top: 20px;">
              <table class="table" style="box-shadow: 0 0 5px #2bd2ff,
              0 0 15px #2bd2ff,
              0 0 30px #2bd2ff,
              0 0 60px #2bd2ff;
              border: 1px solid rgba(255,255,255,0.1);">
                <thead style = "color: #FDDB3A; box-shadow: 0 0 5px #2bd2ff,
              0 0 15px #2bd2ff,
              0 0 30px #2bd2ff,
              0 0 20px #2bd2ff;
              border: 1px solid rgba(255,255,255,0.1);">
                  <tr></tr>
                    <th scope="col">track</th>
                    <th scope="col">date-send</th>
                    <th scope="col">name-send</th>
                    <th scope="col">view</th>
                  </tr>
                </thead>
                <tbody class="text-white" style="box-shadow: 0 0 5px #2bd2ff,
              0 0 15px #2bd2ff,
              0 0 30px #2bd2ff,
              0 0 20px #2bd2ff;
              border: 1px solid rgba(255,255,255,0.1);">
                  <?php
                  $track = $_GET['track'];
                  $spl =  "SELECT * FROM kary_scan_data WHERE track = '$track'";
                  $dpl =  "SELECT * FROM kary_regis_data WHERE track = '$track'";
                  $result=$conn->query($spl);
                  $regis=$conn->query($dpl);
                  if(mysqli_num_rows($result)>0){
                      $i=1;
                      while($row=mysqli_fetch_array($result)){
                  if(mysqli_num_rows($regis)>0){
                    $i=1;
                    while($rg=mysqli_fetch_array($regis)){ 
                  ?>
                  <tr>
                      <td><?=$row['track']?></td>
                      <td><?=$row['Time']?></td>
                      <td><?=$rg['send_name']?></td>
                      <td>
                        <a href="./view.php?track=<?=$row['track']?>" style="--clr:#ff22bb;--i:0.1; padding: 5px 0px;"><span>VIEW</span></a>
                      </td>     
                  </tr>
                  <?php
                       }  
                      }
                    }  
                  }
                  ?>
                </tbody>
              </table>
               
            </div>
                 
    </div>

</body>
</html>
