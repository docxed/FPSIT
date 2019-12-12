<?php
require 'connection.php';
session_start();
if (isset($_SESSION['email'])){
  header('location: main.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/logo.jpg" />

    <title>CheckIT</title>
  </head>
  <body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <a class="navbar-brand" href="index.php">
        <img src="pictures/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        CheckIT
      </a>
    </nav>

    <!--Login-->
    <br><br><br>
     <div class="container">
        <table class="table table-bordered">
          <tr>
            <td>
              <p class="h4">เข้าใช้งาน</p>
              <form class="" action="app.php?func=login" method="post">
               <label for="email">Email</label>
               <input type="email" class="form-control" placeholder="Email" name="email" maxlength="50" value="" required>
               <label for="pass">รหัสผ่าน</label>
               <input type="password" class="form-control" placeholder="รหัสผ่าน" name="pass" maxlength="20" value="" required>
              <br> <center> <input type="submit" class="btn btn-primary " name="" value="เข้าใช้งาน"> <a href="index.php?q=regis"><button type="button" name="button" class="btn btn-light">สมัครใช้งาน</button></a> </center>
             </form>
           </td>
         </tr>
       </table>
     </div>

    <!--Register-->
    <?php if(isset($_GET['q']) and $_GET['q'] == 'regis'){ ?>
    <p></p>
     <div class="container">
        <table class="table table-bordered">
          <tr>
            <td>
              <p class="h4">ลงทะเบียนใช้งาน</p>
              <form class="" action="app.php?func=register" method="post">
               <div class="form-row">
                 <div class="col">
                   <label for="first">ชื่อ (ไทย)</label>
                   <input type="text" name="first" class="form-control" maxlength="50" required placeholder="ชื่อ" />
                 </div>
                 <div class="col">
                   <label for="last">นามสกุล (ไทย)</label>
                   <input type="text" name="last" class="form-control" maxlength="50" required placeholder="นามสกุล" />
                 </div>
               </div>
               <label for="email">Email</label>
               <input type="email" class="form-control" placeholder="Email" name="email" maxlength="50" value="" required>
               <label for="pass">รหัสผ่าน</label>
               <input type="password" name="pass" class="form-control" maxlength="30" required placeholder="รหัสผ่าน" />
               <label for="repass">ยืนยันรหัสผ่าน</label>
               <input type="password" name="repass" class="form-control" maxlength="30" required placeholder="ยืนยันรหัสผ่าน" />
               <br><p class="text-center"><input type="submit" class="btn btn-success " name="" value="สมัครใช้งาน"></p>
             </form>
           </td>
         </tr>
       </table>
     </div>
    <?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
