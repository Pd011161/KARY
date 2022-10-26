<?php
  $conn = mysqli_connect("localhost","root","","Kary_DB");
?>

<!DOCTYPE html>
<html>
<head>
    <base target="_self">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style-regis.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARY SEARCH TRACK</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
            <br>
            <div class="row">
              <div class="col">
              
                  <center><form id="search-form" class="boxx" style="--clr:#ff22bb;--i:0.1; margin-top: -15px;" onsubmit="handleFormSubmit(this)" action="sregis.php" method="POST">
                    <div class="form-group mb-2 boxt">
                      <center>
                        </center><br>
                      <h1 for="searchtext" style="margin-bottom: -35px;">KARY REGISTER</h1>
                    </div>
                    <br>
                    <div class="post" style=""><!-- display:flex; flex-direction:row justify-content: center; margin: 10px 10px; gap: 550px;-->
                        <div class="form-group mx-sm-3 mb-1 inp"> 
                            <label for = "sender" style=""><h3>SENDER</h3></label> <br>
                            <input type="text" class="form-control col-sm-6 sch text-white" name="send_name" placeholder="Send-name" style="max-width: 20%;"><br>
                            <input type="tel" class="form-control col-sm-6 sch text-white" name="send_phonenumber" placeholder="Send-phonenumber" style="max-width: 20%;"><br>
                            <textarea name="send_address" class="form-control col-sm-6 sch text-white" placeholder="Send-Adress" cols="20" rows="5" style="max-width: 20%;"></textarea> <br>
                        </div>
        
                        <div class="form-group mx-sm-3 mb-1 inp" style="margin-top: 10px;"> 
                            <label for = "receiver" style=""><h3>RECEIVER</h3></label> <br>
                            <input type="text" class="form-control col-sm-6 sch text-white" name="receive_name" placeholder="Receive-name" style="max-width: 20%;"><br>
                            <input type="tel" class="form-control col-sm-6 sch text-white" name="receive_phonenumber" placeholder="Recieve-phonenumber" style="max-width: 20%;"><br>
                            <textarea name="receive_address" class="form-control col-sm-6 sch text-white" placeholder="Recieve-Adress" cols="20" rows="5" style="max-width: 20%;"></textarea> <br>
                        </div>
                    </div>
                    <div class="containers">
                        <button  type="submit" class="btn" name="submit"><a>SUBMIT</a></button>
                    </div>
                    </form>  
                    
              </div>
         
            </div>

    </div>
</body>
</html>

