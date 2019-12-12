<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['email'])){
  header('location: index.php');
}
$email = $_SESSION['email'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="main.php"><i class="fas fa-home"></i> หน้าแรก</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="main.php?q=student"><i class="fas fa-address-book"></i> ข้อมูลนักศึกษา</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="main.php?q=profile"><i class="fas fa-user-alt"></i> บัญชีผู้ใช้</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="app.php?func=logout"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
          </li>
        </ul>
      </div>
    </nav>
    <br><br><br>

    <?php if(isset($_GET['q']) and $_GET['q'] == 'profile'){ ?>
    <!--profile-->
    <div class="container">
      <table class="table table-bordered">
        <tr>
          <td>
            <?php
            $q = "SELECT * FROM members WHERE m_email='$email'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
             ?>
            <p class="h4">บัญชีผู้ใช้</p>
            <form class="" action="app.php?func=updateprofile" method="post">
             <div class="form-row">
               <div class="col">
                 <label for="first">ชื่อ (ไทย)</label>
                 <input type="text" name="first" value="<?php echo $rowq['m_first']; ?>" class="form-control" maxlength="50" required placeholder="ชื่อ" />
               </div>
               <div class="col">
                 <label for="last">นามสกุล (ไทย)</label>
                 <input type="text" name="last" value="<?php echo $rowq['m_last']; ?>" class="form-control" maxlength="50" required placeholder="นามสกุล" />
               </div>
             </div>
             <label for="email">Email</label>
             <input type="email" class="form-control" placeholder="Email" value="<?php echo $rowq['m_email']; ?>" maxlength="50" value="" readonly>
             <label for="pass">รหัสผ่านใหม่</label>
             <input type="password" name="pass" class="form-control" maxlength="30" required placeholder="รหัสผ่านใหม่" />
             <input type="hidden" name="email" value="<?php echo $email; ?>">
             <br><p class="text-center"><input type="submit" class="btn btn-info " name="" value="อัปเดต"></p>
           </form>
          </td>
        </tr>
      </table>
    </div>
    <?php } ?>

    <?php if(!isset($_GET['q']) or $_GET['q'] == 'add' or $_GET['q'] == 'editdata' or $_GET['q'] == 'addstudata'){ ?>
    <!--classroom-->
    <div class="container">
         <table class="table table-bordered">
           <tr>
             <td>
               <p class="h4">ระบบห้องสอบ</p>
               <p class="text-center">
                 <a href="main.php?q=add"><button type="button" class="btn btn-warning" name="button">เพิ่มข้อมูล</button></a>
                 <a href="main.php"><button type="button" class="btn btn-info" name="button">แสดงข้อมูล</button></a>
               </p>
           </td>
         </tr>
       </table>
    </div>
    <?php } ?>

    <?php if(!isset($_GET['q'])){ ?>
    <div class="container">
         <table class="table table-sm table-bordered" align="center">
           <thead>
             <tr>
               <td align="center" valign="baseline"><strong> วันที่สอบ </strong></td>
               <td align="center" valign="baseline"><strong> เวลาสอบ </strong></td>
               <td align="center" valign="baseline"><strong> วิชา </strong></td>
               <td align="center" valign="baseline"><strong> สถานที่ </strong></td>
               <td align="center" valign="baseline"><strong> สถานะ </strong></td>
               <td align="center" valign="baseline" colspan="3"><strong> ตัวเลือก </strong></td>
             </tr>
           </thead>
           <tbody>
             <?php
             $q = "SELECT * FROM classroom WHERE class_email='$email' ORDER BY class_id DESC";
             $resq = mysqli_query($dbcon, $q);
             while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
             ?>
             <tr>
               <td align="center" valign="baseline"> <?php echo date("d/m/Y", strtotime($rowq['class_date'])); ?> </td>
               <td align="center" valign="baseline"> <?php echo date("H:i", strtotime($rowq['class_start']))." - ".date("H:i", strtotime($rowq['class_end'])); ?> </td>
               <td align="center" valign="baseline"> <?php echo $rowq['class_subjectid']." <b>".$rowq['class_subject']."</b>"; ?> </td>
               <td align="center" valign="baseline"> <?php echo "อาคาร ".$rowq['class_building']." ห้อง ".$rowq['class_room']; ?> </td>
               <?php
               if ($rowq['class_status'] == 'ยังไม่จัดสอบ'){
                 $sta = 'secondary';
               }else{
                 $sta = 'success';
               }
                ?>
               <td align="center" valign="baseline"> <span class="badge badge-pill badge-<?php echo $sta;?>"><?php echo $rowq['class_status']; ?></span> </td>
               <td align="center" valign="baseline"> <a href="main.php?q=addstudata&uid=<?php echo $rowq['class_id']; ?>"><i class="fas fa-user-plus"></i></a> </td>
               <td align="center" valign="baseline"> <a href="main.php?q=editdata&uid=<?php echo $rowq['class_id']; ?>"><i class="fas fa-edit"></i></a> </td>
               <td align="center" valign="baseline"> <a href="main.php?q=checked&uid=<?php echo $rowq['class_id']; ?>" class="badge badge-primary">check</a> </td>
             </tr>
             <?php } mysqli_free_result($resq); ?>
           </tbody>
       </table>
    </div>
    <?php } ?>

    <?php if(isset($_GET['q']) and $_GET['q'] == 'add'){ ?>
    <!--add classroom-->
    <div class="container ">
      <table class="table table-bordered">
        <tr>
          <td>
            <p class="h4">เพิ่มห้องสอบ</p>
            <form class="" action="app.php?func=addclassroom" method="post">
              <label for="date">สอบวันที่</label>
              <input type="date" class="form-control" name="date" placeholder="สอบวันที่" value=""value="" required>
              <label for="subjectid">รหัสวิชา</label>
              <input type="text" class="form-control" name="subjectid" placeholder="รหัสวิชา" value="" maxlength="8" value="" required>
              <label for="subject">ชื่อวิชา</label>
              <input type="text" class="form-control" name="subject" placeholder="ชื่อวิชา" value="" maxlength="100" value="" required>
              <label for="fac">คณะ</label>
              <select class="form-control" name="fac" required>
                <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                <option value="สถาปัตยกรรมศาสตร์">สถาปัตยกรรมศาสตร์</option>
                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี">ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                <option value="เทคโนโลยีการเกษตร">เทคโนโลยีการเกษตร</option>
                <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                <option value="อุตสาหกรรมเกษตร">อุตสาหกรรมเกษตร</option>
                <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                <option value="วิทยาลัยนานาชาติ">วิทยาลัยนานาชาติ</option>
                <option value="วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง">วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง</option>
                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง">วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                <option value="การบริหารและจัดการ">การบริหารและจัดการ</option>
                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ">วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                <option value="ศิลปศาสตร์">ศิลปศาสตร์</option>
                <option value="แพทยศาสตร์">แพทยศาสตร์</option>
                <option value="วิทยาลัยวิจัยนวัตกรรมทางการศึกษา">วิทยาลัยวิจัยนวัตกรรมทางการศึกษา</option>
                <option value="วิทยาลัยวิศวกรรมสังคีต">วิทยาลัยวิศวกรรมสังคีต</option>
                <option value="วิทยาเขตชุมพรเขตรอุดมศักดิ์">วิทยาเขตชุมพรเขตรอุดมศักดิ์</option>
                <option value="สำนักวิชาศึกษาทั่วไป">สำนักวิชาศึกษาทั่วไป</option>
              </select>
              <div class="form-row">
                <div class="col">
                  <label for="term">ประจำภาคเรียนที่</label>
                  <input type="text" name="term" value="" class="form-control" maxlength="2" required placeholder="ประจำภาคเรียนที่" />
                </div>
                <div class="col">
                  <label for="year">ปีการศึกษา</label>
                  <input type="text" name="year" value="" class="form-control" maxlength="4" required placeholder="ปีการศึกษา" />
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="building">อาคาร</label>
                  <input type="text" name="building" value="" class="form-control" maxlength="30" required placeholder="อาคาร" />
                </div>
                <div class="col">
                  <label for="room">ห้อง</label>
                  <input type="text" name="room" value="" class="form-control" maxlength="30" required placeholder="ห้อง" />
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="start">เวลาเริ่ม</label>
                  <input type="time" name="start" class="form-control" required />
                </div>
                <div class="col">
                  <label for="end">หมดเวลา</label>
                  <input type="time" name="end" class="form-control" required />
                </div>
              </div>
              <input type="hidden" name="email" value="<?php echo $email; ?>">
              <input type="hidden" name="status" value="ยังไม่จัดสอบ"> <br>
              <p class="text-center"> <input type="submit" class="btn btn-primary" name="" value="เพิ่มข้อมูลเดี๋ยวนี้"> </p>
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'editdata'){ ?>
    <!--editdata-->
    <div class="container ">
      <table class="table table-bordered">
        <tr>
          <td>
            <?php
            $uid = $_GET['uid'];
            $q = "SELECT * FROM classroom WHERE class_id='$uid'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
             ?>
            <p class="h4">แก้ไขห้องสอบ</p>
            <form class="" action="app.php?func=editclassroom" method="post">
              <label for="date">สอบวันที่</label>
              <input type="date" class="form-control" name="date" placeholder="สอบวันที่" value="<?php echo $rowq['class_date']; ?>" required>
              <label for="subjectid">รหัสวิชา</label>
              <input type="text" class="form-control" name="subjectid" placeholder="รหัสวิชา" value="<?php echo $rowq['class_subjectid']; ?>" maxlength="8" required>
              <label for="subject">ชื่อวิชา</label>
              <input type="text" class="form-control" name="subject" placeholder="ชื่อวิชา" value="<?php echo $rowq['class_subject']; ?>" maxlength="100" required>
              <label for="fac">คณะ</label>
              <select class="form-control" name="fac" required>
                <option value="วิศวกรรมศาสตร์" <?php if ($rowq['class_fac'] == 'วิศวกรรมศาสตร์'){echo "selected";} ?>>วิศวกรรมศาสตร์</option>
                <option value="สถาปัตยกรรมศาสตร์" <?php if ($rowq['class_fac'] == 'สถาปัตยกรรมศาสตร์'){echo "selected";} ?>>สถาปัตยกรรมศาสตร์</option>
                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี" <?php if ($rowq['class_fac'] == 'ครุศาสตร์อุตสาหกรรมและเทคโนโลยี'){echo "selected";} ?>>ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                <option value="เทคโนโลยีการเกษตร" <?php if ($rowq['class_fac'] == 'เทคโนโลยีการเกษตร'){echo "selected";} ?>>เทคโนโลยีการเกษตร</option>
                <option value="วิทยาศาสตร์" <?php if ($rowq['class_fac'] == 'วิทยาศาสตร์'){echo "selected";} ?>>วิทยาศาสตร์</option>
                <option value="อุตสาหกรรมเกษตร" <?php if ($rowq['class_fac'] == 'อุตสาหกรรมเกษตร'){echo "selected";} ?>>อุตสาหกรรมเกษตร</option>
                <option value="เทคโนโลยีสารสนเทศ" <?php if ($rowq['class_fac'] == 'เทคโนโลยีสารสนเทศ'){echo "selected";} ?>>เทคโนโลยีสารสนเทศ</option>
                <option value="วิทยาลัยนานาชาติ" <?php if ($rowq['class_fac'] == 'วิทยาลัยนานาชาติ'){echo "selected";} ?>>วิทยาลัยนานาชาติ</option>
                <option value="วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง" <?php if ($rowq['class_fac'] == 'วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง'){echo "selected";} ?>>วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง</option>
                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง" <?php if ($rowq['class_fac'] == 'วิทยาลัยนวัตกรรมการผลิตขั้นสูง'){echo "selected";} ?>>วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                <option value="การบริหารและจัดการ" <?php if ($rowq['class_fac'] == 'การบริหารและจัดการ'){echo "selected";} ?>>การบริหารและจัดการ</option>
                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ" <?php if ($rowq['class_fac'] == 'วิทยาลัยอุตสาหกรรมการบินนานาชาติ'){echo "selected";} ?>>วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                <option value="ศิลปศาสตร์" <?php if ($rowq['class_fac'] == 'ศิลปศาสตร์'){echo "selected";} ?>>ศิลปศาสตร์</option>
                <option value="แพทยศาสตร์" <?php if ($rowq['class_fac'] == 'แพทยศาสตร์'){echo "selected";} ?>>แพทยศาสตร์</option>
                <option value="วิทยาลัยวิจัยนวัตกรรมทางการศึกษา" <?php if ($rowq['class_fac'] == 'วิทยาลัยวิจัยนวัตกรรมทางการศึกษา'){echo "selected";} ?>>วิทยาลัยวิจัยนวัตกรรมทางการศึกษา</option>
                <option value="วิทยาลัยวิศวกรรมสังคีต" <?php if ($rowq['class_fac'] == 'วิทยาลัยวิศวกรรมสังคีต'){echo "selected";} ?>>วิทยาลัยวิศวกรรมสังคีต</option>
                <option value="วิทยาเขตชุมพรเขตรอุดมศักดิ์" <?php if ($rowq['class_fac'] == 'วิทยาเขตชุมพรเขตรอุดมศักดิ์'){echo "selected";} ?>>วิทยาเขตชุมพรเขตรอุดมศักดิ์</option>
                <option value="สำนักวิชาศึกษาทั่วไป" <?php if ($rowq['class_fac'] == 'สำนักวิชาศึกษาทั่วไป'){echo "selected";} ?>>สำนักวิชาศึกษาทั่วไป</option>
              </select>
              <div class="form-row">
                <div class="col">
                  <label for="term">ประจำภาคเรียนที่</label>
                  <input type="text" name="term" value="<?php echo $rowq['class_term']; ?>" class="form-control" maxlength="2" required placeholder="ประจำภาคเรียนที่" />
                </div>
                <div class="col">
                  <label for="year">ปีการศึกษา</label>
                  <input type="text" name="year" value="<?php echo $rowq['class_year']; ?>" class="form-control" maxlength="4" required placeholder="ปีการศึกษา" />
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="building">อาคาร</label>
                  <input type="text" name="building" value="<?php echo $rowq['class_building']; ?>" class="form-control" maxlength="30" required placeholder="อาคาร" />
                </div>
                <div class="col">
                  <label for="room">ห้อง</label>
                  <input type="text" name="room" value="<?php echo $rowq['class_room']; ?>" class="form-control" maxlength="30" required placeholder="ห้อง" />
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <label for="start">เวลาเริ่ม</label>
                  <input type="time" name="start" value="<?php echo $rowq['class_start']; ?>" class="form-control" required />
                </div>
                <div class="col">
                  <label for="end">หมดเวลา</label>
                  <input type="time" name="end" value="<?php echo $rowq['class_end']; ?>" class="form-control" required />
                </div>
              </div>
              <input type="hidden" name="email" value="<?php echo $rowq['class_email']; ?>">
              <input type="hidden" name="uid" value="<?php echo $rowq['class_id']; ?>">
              <label for="status">สถานะ</label>
              <select class="form-control" name="status" required>
                <option value="ยังไม่จัดสอบ" <?php if ($rowq['class_status'] == 'ยังไม่จัดสอบ'){echo "selected";} ?>>ยังไม่จัดสอบ</option>
                <option value="จัดสอบแล้ว"<?php if ($rowq['class_status'] == 'จัดสอบแล้ว'){echo "selected";} ?>>จัดสอบแล้ว</option>
              </select>
              <br>
              <p class="text-center"> <input type="submit" class="btn btn-primary" name="" value="อัปเดตห้องสอบ"> <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#exampleModal">ลบ</button></p>
            </form>
          </td>
        </tr>
      </table>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><span class="h5 text-capitalize"><?php echo $rowq['class_subjectid']." ".$rowq['class_subject']." <span class='badge badge-pill badge-primary'>".date("d/m/Y", strtotime($rowq['class_date'])); ?></span></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              การลบ จะทำการลบข้อมูลห้องสอบและรายชื่อนักศึกษาที่ได้ลงทะเบียนห้องนี้รวมทั้งหมด
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
              <a href="app.php?func=deldata&uid=<?php echo $rowq['class_id']; ?>"><button type="button" class="btn btn-outline-danger">ยืนยันลบ</button></a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <?php } ?>

    <?php if (isset($_GET['q']) and ($_GET['q'] == 'student' or $_GET['q'] == 'addstudent' or $_GET['q'] == 'editstudent')){ ?>
    <!--student-->
    <div class="container ">
      <table class="table table-bordered">
        <tr>
          <td>
            <p class="h4">ฐานข้อมูลนักศึกษา</p>
            <p class="text-center">
              <a href="main.php?q=addstudent"><button type="button" class="btn btn-warning" name="button">เพิ่มข้อมูล</button></a>
              <a href="main.php?q=student"><button type="button" class="btn btn-info" name="button">แสดงข้อมูล</button></a>
            </p>
          </td>
        </tr>
      </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'srcstudent'){ ?>
    <!--srcstudent-->

    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'student'){ ?>
    <!--srcstudent-->
    <div class="container">
      <p>
        <form class="form-inline" action="main.php" method="get">
          <input class="form-control mr-sm-2" name="srcstudent" type="text" placeholder="ค้นหา" aria-label="Search" required>
          <input type="hidden" name="q" value="student">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">ค้นหา</button>
        </form>
      </p>
    </div>
    <?php } ?>

    <?php if (isset($_GET['srcstudent'])){ ?>
    <!--scrstudentrow-->
    <div class="container">
         <table class="table table-sm table-bordered" align="center">
           <thead>
             <tr>
               <td align="center" valign="baseline"><strong> รหัสนักศึกษา </strong></td>
               <td align="center" valign="baseline"><strong> ชื่อ - นามสกุล </strong></td>
               <td align="center" valign="baseline"><strong> คณะ </strong></td>
               <td align="center" valign="baseline"><strong> ตัวเลือก </strong></td>
             </tr>
           </thead>
           <tbody>
             <?php
             $key = '%'.$_GET['srcstudent'].'%';
             $q = "SELECT * FROM student WHERE stu_sid LIKE '$key' OR stu_first LIKE '$key' OR stu_last LIKE '$key' ";
             $resq = mysqli_query($dbcon, $q);
             while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
             ?>
             <tr>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_sid']; ?> </td>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_pre'].$rowq['stu_first']." ".$rowq['stu_last']; ?> </td>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_fac']; ?> </td>
               <td align="center" valign="baseline"> <a href="main.php?q=editstudent&uid=<?php echo $rowq['stu_id']; ?>"><i class="fas fa-edit"></i></a> </td>
             </tr>
             <?php } mysqli_free_result($resq); ?>
           </tbody>
       </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'student' and !isset($_GET['srcstudent'])){ ?>
    <!--student-->
    <div class="container">
         <table class="table table-sm table-bordered" align="center">
           <thead>
             <tr>
               <td align="center" valign="baseline"><strong> รหัสนักศึกษา </strong></td>
               <td align="center" valign="baseline"><strong> ชื่อ - นามสกุล </strong></td>
               <td align="center" valign="baseline"><strong> คณะ </strong></td>
               <td align="center" valign="baseline"><strong> ตัวเลือก </strong></td>
             </tr>
           </thead>
           <tbody>
             <?php
             $q = "SELECT * FROM student ORDER BY stu_sid ASC";
             $resq = mysqli_query($dbcon, $q);
             while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
             ?>
             <tr>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_sid']; ?> </td>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_pre'].$rowq['stu_first']." ".$rowq['stu_last']; ?> </td>
               <td align="center" valign="baseline"> <?php echo $rowq['stu_fac']; ?> </td>
               <td align="center" valign="baseline"> <a href="main.php?q=editstudent&uid=<?php echo $rowq['stu_id']; ?>"><i class="fas fa-edit"></i></a> </td>
             </tr>
             <?php } mysqli_free_result($resq); ?>
           </tbody>
       </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'addstudent'){ ?>
    <!--addstudent-->
    <div class="container ">
      <table class="table table-bordered">
        <tr>
          <td>
            <p class="h4">เพิ่มข้อมูลนักศึกษา</p>
            <form class="" action="app.php?func=addstudent" method="post" enctype="multipart/form-data">
              <label for="sid">รหัสนักศักษา</label>
              <input type="text" class="form-control" name="sid" placeholder="รหัสนักศักษา" value="" maxlength="8" required>
              <label for="pre">คำนำหน้า</label>
              <select class="form-control" name="pre" required>
                <option value="นาย">นาย</option>
                <option value="นางสาว">นางสาว</option>
                <option value="นาง">นาง</option>
              </select>
              <div class="form-row">
                <div class="col">
                  <label for="first">ชื่อ</label>
                  <input type="text" name="first" value="" class="form-control" maxlength="30" required placeholder="ชื่อ" />
                </div>
                <div class="col">
                  <label for="last">นามสกุล</label>
                  <input type="text" name="last" value="" class="form-control" maxlength="30" required placeholder="นามสกุล" />
                </div>
              </div>
              <label for="fac">คณะ</label>
              <select class="form-control" name="fac" required>
                <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                <option value="สถาปัตยกรรมศาสตร์">สถาปัตยกรรมศาสตร์</option>
                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี">ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                <option value="เทคโนโลยีการเกษตร">เทคโนโลยีการเกษตร</option>
                <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                <option value="อุตสาหกรรมเกษตร">อุตสาหกรรมเกษตร</option>
                <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                <option value="วิทยาลัยนานาชาติ">วิทยาลัยนานาชาติ</option>
                <option value="วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง">วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง</option>
                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง">วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                <option value="การบริหารและจัดการ">การบริหารและจัดการ</option>
                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ">วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                <option value="ศิลปศาสตร์">ศิลปศาสตร์</option>
                <option value="แพทยศาสตร์">แพทยศาสตร์</option>
                <option value="วิทยาลัยวิจัยนวัตกรรมทางการศึกษา">วิทยาลัยวิจัยนวัตกรรมทางการศึกษา</option>
                <option value="วิทยาลัยวิศวกรรมสังคีต">วิทยาลัยวิศวกรรมสังคีต</option>
                <option value="วิทยาเขตชุมพรเขตรอุดมศักดิ์">วิทยาเขตชุมพรเขตรอุดมศักดิ์</option>
                <option value="สำนักวิชาศึกษาทั่วไป">สำนักวิชาศึกษาทั่วไป</option>
              </select>
              <script type='text/javascript'>
              function preview_image(event)
              {
                   var reader = new FileReader();
                   reader.onload = function()
                   {
                        var output = document.getElementById('showimg');
                        output.src = reader.result;
                   }
                   reader.readAsDataURL(event.target.files[0]);
              }
              </script>
              <script src="http://code.jquery.com/jquery-latest.js"></script>
              <script type="text/javascript">
              $(document).ready(function() {
              $('#myFile').bind('change', function() {
              if(this.files[0].size > 2 *1024*1024){
              alert('ขนาดภาพเกิน 2 MB, โปรดใช้ภาพอื่น');
              return false;
                  }
                });
              });
              </script>
              <label for="img">รูปนักศึกษา (.jpg & น้อยกว่า 2MB)</label><br>
              <input type="file" id="myFile" class="form-control-file" accept=".jpg" name="img" value="" required onchange="preview_image(event)">
              <p class="text-center"> <img id="showimg" src="pictures/exam.gif" width="300" height="400" onerror="this.src='pictures/exam.gif'"> </p>
              <p class="text-center"> <input type="submit" class="btn btn-primary" name="" value="เพิ่มข้อมูลเดี๋ยวนี้"> </p>
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'editstudent'){ ?>
    <!--editstudent-->
    <div class="container ">
      <table class="table table-bordered">
        <tr>
          <td>
            <?php
            $uid = $_GET['uid'];
            $q = "SELECT * FROM student WHERE stu_id='$uid'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
             ?>
            <p class="h4">แก้ไขมูลนักศึกษา : <span class="text-primary"><?php echo $rowq['stu_sid']; ?></span></p>
            <form class="" action="app.php?func=editstudent" method="post">
              <label for="sid">รหัสนักศักษา</label>
              <input type="text" class="form-control" name="sid" placeholder="รหัสนักศักษา" value="<?php echo $rowq['stu_sid']; ?>" maxlength="8" readonly>
              <label for="pre">คำนำหน้า</label>
              <select class="form-control" name="pre" required>
                <option value="นาย" <?php if ($rowq['stu_pre'] == 'นาย'){echo "selected";}; ?>>นาย</option>
                <option value="นางสาว" <?php if ($rowq['stu_pre'] == 'นางสาว'){echo "selected";}; ?>>นางสาว</option>
                <option value="นาง" <?php if ($rowq['stu_pre'] == 'นาง'){echo "selected";}; ?>>นาง</option>
              </select>
              <div class="form-row">
                <div class="col">
                  <label for="first">ชื่อ</label>
                  <input type="text" name="first" value="<?php echo $rowq['stu_first']; ?>" class="form-control" maxlength="30" required placeholder="ชื่อ" />
                </div>
                <div class="col">
                  <label for="last">นามสกุล</label>
                  <input type="text" name="last" value="<?php echo $rowq['stu_last']; ?>" class="form-control" maxlength="30" required placeholder="นามสกุล" />
                </div>
              </div>
              <label for="fac">คณะ</label>
              <select class="form-control" name="fac" required>
                <option value="วิศวกรรมศาสตร์" <?php if ($rowq['stu_fac'] == 'วิศวกรรมศาสตร์'){echo "selected";} ?>>วิศวกรรมศาสตร์</option>
                <option value="สถาปัตยกรรมศาสตร์" <?php if ($rowq['stu_fac'] == 'สถาปัตยกรรมศาสตร์'){echo "selected";} ?>>สถาปัตยกรรมศาสตร์</option>
                <option value="ครุศาสตร์อุตสาหกรรมและเทคโนโลยี" <?php if ($rowq['stu_fac'] == 'ครุศาสตร์อุตสาหกรรมและเทคโนโลยี'){echo "selected";} ?>>ครุศาสตร์อุตสาหกรรมและเทคโนโลยี</option>
                <option value="เทคโนโลยีการเกษตร" <?php if ($rowq['stu_fac'] == 'เทคโนโลยีการเกษตร'){echo "selected";} ?>>เทคโนโลยีการเกษตร</option>
                <option value="วิทยาศาสตร์" <?php if ($rowq['stu_fac'] == 'วิทยาศาสตร์'){echo "selected";} ?>>วิทยาศาสตร์</option>
                <option value="อุตสาหกรรมเกษตร" <?php if ($rowq['stu_fac'] == 'อุตสาหกรรมเกษตร'){echo "selected";} ?>>อุตสาหกรรมเกษตร</option>
                <option value="เทคโนโลยีสารสนเทศ" <?php if ($rowq['stu_fac'] == 'เทคโนโลยีสารสนเทศ'){echo "selected";} ?>>เทคโนโลยีสารสนเทศ</option>
                <option value="วิทยาลัยนานาชาติ" <?php if ($rowq['stu_fac'] == 'วิทยาลัยนานาชาติ'){echo "selected";} ?>>วิทยาลัยนานาชาติ</option>
                <option value="วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง" <?php if ($rowq['stu_fac'] == 'วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง'){echo "selected";} ?>>วิทยาลัยนาโนเทคโนโลยีพระจอมเกล้าลาดกระบัง</option>
                <option value="วิทยาลัยนวัตกรรมการผลิตขั้นสูง" <?php if ($rowq['stu_fac'] == 'วิทยาลัยนวัตกรรมการผลิตขั้นสูง'){echo "selected";} ?>>วิทยาลัยนวัตกรรมการผลิตขั้นสูง</option>
                <option value="การบริหารและจัดการ" <?php if ($rowq['stu_fac'] == 'การบริหารและจัดการ'){echo "selected";} ?>>การบริหารและจัดการ</option>
                <option value="วิทยาลัยอุตสาหกรรมการบินนานาชาติ" <?php if ($rowq['stu_fac'] == 'วิทยาลัยอุตสาหกรรมการบินนานาชาติ'){echo "selected";} ?>>วิทยาลัยอุตสาหกรรมการบินนานาชาติ</option>
                <option value="ศิลปศาสตร์" <?php if ($rowq['stu_fac'] == 'ศิลปศาสตร์'){echo "selected";} ?>>ศิลปศาสตร์</option>
                <option value="แพทยศาสตร์" <?php if ($rowq['stu_fac'] == 'แพทยศาสตร์'){echo "selected";} ?>>แพทยศาสตร์</option>
                <option value="วิทยาลัยวิจัยนวัตกรรมทางการศึกษา" <?php if ($rowq['stu_fac'] == 'วิทยาลัยวิจัยนวัตกรรมทางการศึกษา'){echo "selected";} ?>>วิทยาลัยวิจัยนวัตกรรมทางการศึกษา</option>
                <option value="วิทยาลัยวิศวกรรมสังคีต" <?php if ($rowq['stu_fac'] == 'วิทยาลัยวิศวกรรมสังคีต'){echo "selected";} ?>>วิทยาลัยวิศวกรรมสังคีต</option>
                <option value="วิทยาเขตชุมพรเขตรอุดมศักดิ์" <?php if ($rowq['stu_fac'] == 'วิทยาเขตชุมพรเขตรอุดมศักดิ์'){echo "selected";} ?>>วิทยาเขตชุมพรเขตรอุดมศักดิ์</option>
                <option value="สำนักวิชาศึกษาทั่วไป" <?php if ($rowq['stu_fac'] == 'สำนักวิชาศึกษาทั่วไป'){echo "selected";} ?>>สำนักวิชาศึกษาทั่วไป</option>
              </select>
              <input type="hidden" name="uid" value="<?php echo $rowq['stu_id']; ?>">
              <label for="img">รูปนักศึกษา</label><br>
              <p class="text-center"> <a href="student/<?php echo $rowq['stu_img']; ?>" target="_blank"><img src="student/<?php echo $rowq['stu_img']; ?>" width="300" height="400" alt=""></a> </p>
              <p class="text-center"> <input type="submit" class="btn btn-primary" name="" value="อัปเดต"> <a href="app.php?func=delstudent&uid=<?php echo $rowq['stu_id']; ?>"><button type="button" class="btn btn-outline-danger">ลบ</button></a> </p>
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'addstudata'){ ?>
    <!--addchecked-->
    <div class="container">
      <?php
      $uid = $_GET['uid'];
      $q = "SELECT * FROM classroom WHERE class_id='$uid'";
      $resq = mysqli_query($dbcon, $q);
      $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);

      $c = "SELECT COUNT(c_id) AS count FROM checked WHERE c_session='$uid'";
      $resc = mysqli_query($dbcon, $c);
      $rowc = mysqli_fetch_array($resc, MYSQLI_ASSOC);
       ?>
      <p class=""><span class="h4">เพิ่มรายชื่อนักศึกษาเข้าสอบห้อง : </span><span class="h5 text-capitalize"><?php echo $rowq['class_subjectid']." ".$rowq['class_subject']." <span class='badge badge-pill badge-primary'>".date("d/m/Y", strtotime($rowq['class_date'])); ?></span></span></p>
      <table class="table table-bordered">
        <tr>
          <td>
            <form class="form-inline" action="app.php?func=addchecked" method="post">
              <input class="form-control mr-sm-2" name="sid" type="text" placeholder="รหัสนักศึกษา" aria-label="Search" maxlength="8" required autocomplete="off">
              <input class="form-control mr-sm-2" name="seat" type="text" placeholder="ที่นั่ง" aria-label="Search" maxlength="8" required autocomplete="off">
              <input type="hidden" name="session" value="<?php echo $rowq['class_id']; ?>">
              <button class="btn btn-success my-2 my-sm-0" type="submit">เพิ่ม</button>
            </form>
          </td>
        </tr>
      </table>

      <p class="text-center h4">รายชื่อนักศึกษาห้องนี้ทั้งหมดจำนวน <span class="badge badge-primary"><?php echo $rowc['count']; ?></span> คน</p><br>
      <table class="table table-sm table-bordered" align="center">
        <thead>
          <tr>
            <td align="center" valign="baseline"><strong> ที่นั่ง </strong></td>
            <td align="center" valign="baseline"><strong> รหัสนักศึกษา </strong></td>
            <td align="center" valign="baseline"><strong> ชื่อ - นามสกุล </strong></td>
            <td align="center" valign="baseline"><strong> คณะ </strong></td>
            <td align="center" valign="baseline"><strong> ตัวเลือก </strong></td>
          </tr>
        </thead>
        <tbody>
          <?php
          $q = "SELECT * FROM checked WHERE c_session='$uid' ORDER BY c_sid ASC";
          $resq = mysqli_query($dbcon, $q);
          while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
          ?>
          <tr>
            <td align="center" valign="baseline"> <?php echo $rowq['c_seat']; ?> </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_sid']; ?> </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_pre'].$rowq['c_first']." ".$rowq['c_last']; ?> </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_fac']; ?> </td>
            <td align="center" valign="baseline"> <a href="app.php?func=delchecked&uid=<?php echo $rowq['c_id']; ?>&link=<?php echo $uid; ?>"> <button type="button" class="btn btn-sm btn-outline-danger">ลบ</button> </a> </td>
          </tr>
          <?php } mysqli_free_result($resq); ?>
        </tbody>
    </table>
    </div>
    <?php } ?>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'checked') { ?>
    <!--checked-->
    <div class="container">
      <?php
      $uid = $_GET['uid'];
      $q = "SELECT * FROM classroom WHERE class_id='$uid'";
      $resq = mysqli_query($dbcon, $q);
      $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);

      $ch = 'รอการเช็ค';
      $ched = 'เช็คแล้ว';
      $c = "SELECT COUNT(c_id) AS countcheck FROM checked WHERE c_session='$uid' AND c_checked='$ch'";
      $resc = mysqli_query($dbcon, $c);
      $rowc = mysqli_fetch_array($resc, MYSQLI_ASSOC);

      $c2 = "SELECT COUNT(c_id) AS countchecked FROM checked WHERE c_session='$uid' AND c_checked='$ched'";
      $resc2 = mysqli_query($dbcon, $c2);
      $rowc2 = mysqli_fetch_array($resc2, MYSQLI_ASSOC);

      $c3 = "SELECT COUNT(c_id) AS countall FROM checked WHERE c_session='$uid'";
      $resc3 = mysqli_query($dbcon, $c3);
      $rowc3 = mysqli_fetch_array($resc3, MYSQLI_ASSOC);
       ?>
      <p class="h5"><span class="h5 text-capitalize"><?php echo $rowq['class_subjectid']." ".$rowq['class_subject']." <span class='badge badge-pill badge-primary'>".date("d/m/Y", strtotime($rowq['class_date'])); ?></span></span></p><br>
      <p>
        <button type="button" class="btn btn-primary btn-sm"> จำนวนนักศึกษาทั้งหมด <span class="badge badge-light"><?php echo $rowc3['countall'] ?></span> คน</button>
        <button type="button" class="btn btn-success btn-sm"> เช็คสำเร็จแล้ว <span class="badge badge-light"><?php echo $rowc['countcheck']; ?></span> คน</button>
        <button type="button" class="btn btn-secondary btn-sm"> รอการเช็ค <span class="badge badge-light"><?php echo $rowc2['countchecked']; ?></span> คน</button>
      </p>
      <p>

      </p>
      <table class="table table-hover table-sm" align="center">
        <thead>
          <tr>
            <td align="center" valign="baseline"><strong> ที่นั่ง </strong></td>
            <td align="center" valign="baseline"><strong> รหัสนักศึกษา </strong></td>
            <td align="center" valign="baseline"><strong> ชื่อ - นามสกุล </strong></td>
            <td align="center" valign="baseline"><strong> คณะ </strong></td>
            <td align="center" valign="baseline"><strong> เช็คชื่อ </strong></td>
          </tr>
        </thead>
        <tbody>
          <?php
          $q = "SELECT * FROM checked INNER JOIN student ON checked.c_sid=student.stu_sid WHERE c_session='$uid' ORDER BY c_sid ASC";
          $resq = mysqli_query($dbcon, $q);
          while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
          ?>
          <tr>
            <td align="center" valign="baseline"> <?php echo $rowq['c_seat']; ?> </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_sid']; ?> </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_pre'].$rowq['c_first']." ".$rowq['c_last']; ?>
            </td>
            <td align="center" valign="baseline"> <?php echo $rowq['c_fac']; ?> </td>
            <td align="center" valign="baseline">
              <a href="student/<?php echo $rowq['stu_img']; ?>" target="_blank">
              <button type="button" class="btn btn-sm btn-info">
                <i class="far fa-images"></i>
              </button>
              </a>
               <a href="app.php?func=checking&uid=<?php echo $rowq['c_id']; ?>&check=<?php echo $rowq['c_checked']; ?>&room=<?php echo $uid; ?>">
              <?php
              if ($rowq['c_checked'] == 'รอการเช็ค'){
               ?>
              <button class="btn btn-info btn-sm" type="button">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                check
              </button>
            <?php }else{ ?>
              <button class="btn btn-success btn-sm" type="button">
                checked
              </button>
            <?php } ?>
              </a></td>

          </tr>

          <?php } mysqli_free_result($resq); ?>
        </tbody>
      </table>
    </div>
    <?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>$(function () {$('[data-toggle="popover"]').popover()})</script>
  </body>
</html>
