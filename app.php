<?php
function node(){
  if ($_GET['func'] == 'register'){
    register();
  }elseif ($_GET['func'] == 'login') {
    login();
  }elseif ($_GET['func'] == 'logout') {
    logout();
  }elseif ($_GET['func'] == 'updateprofile') {
    updateprofile();
  }elseif ($_GET['func'] == 'addclassroom') {
    addclassroom();
  }elseif ($_GET['func'] == 'editclassroom') {
    editclassroom();
  }elseif ($_GET['func'] == 'addstudent') {
    addstudent();
  }elseif ($_GET['func'] == 'editstudent') {
    editstudent();
  }elseif ($_GET['func'] == 'addchecked') {
    addchecked();
  }elseif ($_GET['func'] == 'checking') {
    checking();
  }elseif ($_GET['func'] == 'deldata'){
    deldata();
  }elseif ($_GET['func'] == 'delstudent') {
    delstudent();
  }elseif ($_GET['func'] == 'delchecked') {
    delchecked();
  }
}

function register(){
  require 'connection.php';
  if ($_POST['pass'] != $_POST['repass']){
    echo "<script>";
    echo "alert('ยืนยันรหัสผ่านไม่ตรงกัน, ลองอีกครั้ง');";
    echo "window.location.href='index.php?q=regis';";
    echo "</script>";
  }else {
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $q = "SELECT * FROM members WHERE m_email='$email'";
    $resq = mysqli_query($dbcon, $q);
    $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
    if ($rowq){
      echo "<script>";
      echo "alert('Email ถูกใช้งานแล้ว, โปรดลองอีกครั้ง');";
      echo "window.location.href='index.php?q=regis';";
      echo "</script>";
    }else{
      $d = "INSERT INTO members (m_first, m_last, m_email, m_pass) VALUES ('$first', '$last', '$email', '$pass')";
      $resd = mysqli_query($dbcon, $d);
      if ($resd){
        echo "<script>";
        echo "alert('ดำเนินการสำเร็จ');";
        echo "window.location.href='index.php';";
        echo "</script>";
      }else{
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในขณะนี้, โปรดลองอีกครั้ง');";
        echo "window.location.href='index.php?q=regis';";
        echo "</script>";
      }
    }
  }
}

function login(){
  require 'connection.php';
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $q = "SELECT * FROM members WHERE m_email='$email' AND m_pass='$pass'";
  $resq = mysqli_query($dbcon, $q);
  $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
  if (!$rowq) {
    echo "<script>";
    echo "alert('Email หรือ รหัสผ่านผิด! โปรดลองอีกครั้ง');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }else{
    session_start();
    $_SESSION['email'] = $rowq['m_email'];
    $_SESSION['user'] = $rowq['m_first'];
    $_SESSION['level'] = $rowq['m_level'];
    header('location: main.php');
  }
}

function logout(){
  require 'connection.php';
  session_start();
  if(session_destroy()){
    echo "<script>";
    echo "alert('ลงชื่อออก');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function updateprofile(){
  require 'connection.php';
  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $newpass = $_POST['pass'];
  $q = "UPDATE members SET m_first='$first', m_last='$last', m_pass='$newpass' WHERE m_email='$email'";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "alert('ดำเนินการสำเร็จ');";
    echo "window.location.href='main.php?q=profile';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้, โปรดลองอีกครั้ง');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function addclassroom(){
  require 'connection.php';
  $date = $_POST['date'];
  $subjectid = $_POST['subjectid'];
  $subject = $_POST['subject'];
  $fac = $_POST['fac'];
  $term = $_POST['term'];
  $year = $_POST['year'];
  $building = $_POST['building'];
  $room = $_POST['room'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $status = $_POST['status'];
  $email = $_POST['email'];
  $q = "INSERT INTO classroom (class_date, class_subjectid, class_subject, class_fac, class_term, class_year, class_building, class_room, class_start, class_end,
     class_status, class_email) VALUES ('$date', '$subjectid', '$subject', '$fac', '$term', '$year', '$building', '$room', '$start', '$end', '$status', '$email')";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "alert('ดำเนินการสำเร็จ');";
    echo "window.location.href='main.php';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้, โปรดลองอีกครั้ง');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function editclassroom(){
  require 'connection.php';
  $date = $_POST['date'];
  $subjectid = $_POST['subjectid'];
  $subject = $_POST['subject'];
  $fac = $_POST['fac'];
  $term = $_POST['term'];
  $year = $_POST['year'];
  $building = $_POST['building'];
  $room = $_POST['room'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $status = $_POST['status'];
  $email = $_POST['email'];
  $uid = $_POST['uid'];
  $q = "UPDATE classroom SET class_date='$date', class_subjectid='$subjectid', class_subject='$subject', class_fac='$fac', class_term='$term', class_year='$year',
   class_building='$building', class_room='$room', class_start='$start', class_end='$end', class_status='$status', class_email='$email' WHERE class_id='$uid'";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "alert('ดำเนินการสำเร็จ');";
    echo "window.location.href='main.php?q=editdata&uid=$uid';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้, โปรดลองอีกครั้ง');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function addstudent(){
  require 'connection.php';
  $sid = $_POST['sid'];
  $pre = $_POST['pre'];
  $first = $_POST['first'];
  $last = $_POST['last'];
  $fac = $_POST['fac'];
  $ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
  $new_img_name = 'stu_'.uniqid().'.'.$ext;
  $imgpath = "student/";
  $uploadpath = $imgpath.$new_img_name;

  $success = move_uploaded_file($_FILES['img']['tmp_name'], $uploadpath);
  if ($success==FALSE) {
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
    exit();
  }
  $proname = $new_img_name;
  $q = "INSERT INTO student (stu_sid, stu_pre, stu_first, stu_last, stu_fac, stu_img) VALUES ('$sid', '$pre', '$first', '$last', '$fac', '$proname')";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "alert('ดำเนินการสำเร็จ');";
    echo "window.location.href='main.php?q=addstudent';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function editstudent(){
  require 'connection.php';
  $uid = $_POST['uid'];
  $pre = $_POST['pre'];
  $first = $_POST['first'];
  $last = $_POST['last'];
  $fac = $_POST['fac'];
  $q = "UPDATE student SET stu_pre='$pre', stu_first='$first', stu_last='$last', stu_fac='$fac' WHERE stu_id='$uid'";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "alert('ดำเนินการสำเร็จ');";
    echo "window.location.href='main.php?q=editstudent&uid=$uid';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function addchecked(){
  require 'connection.php';
  $sid = $_POST['sid'];
  $seat = $_POST['seat'];
  $session = $_POST['session'];
  $q = "SELECT * FROM student WHERE stu_sid='$sid'";
  $resq = mysqli_query($dbcon, $q);
  $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
  if (!$rowq){
    echo "<script>";
    echo "alert('ไม่พบรายชื่อนักศึกษาบนฐานข้อมูล, โปรดลองอีกครั้ง');";
    echo "window.location.href='main.php?q=addstudata&uid=$session';";
    echo "</script>";
  }else{
    $pre = $rowq['stu_pre'];
    $first = $rowq['stu_first'];
    $last = $rowq['stu_last'];
    $fac = $rowq['stu_fac'];

    $raw = "SELECT * FROM checked WHERE c_session='$session' AND (c_sid='$sid' OR c_seat='$seat')";
    $resraw = mysqli_query($dbcon, $raw);
    $rowraw = mysqli_fetch_array($resraw, MYSQLI_ASSOC);
    if ($rowraw){
      echo "<script>";
      echo "alert('รายชื่อนักศึกษาหรือที่นั่งซ้ำในระบบ, โปรดลองอีกครั้ง');";
      echo "window.location.href='main.php?q=addstudata&uid=$session';";
      echo "</script>";
    }else{
      $add = "INSERT INTO checked (c_sid, c_pre, c_first, c_last, c_fac, c_seat, c_session) VALUES ('$sid', '$pre', '$first', '$last', '$fac', '$seat', '$session')";
      $resadd = mysqli_query($dbcon, $add);
      if ($resadd){
        echo "<script>";
        echo "window.location.href='main.php?q=addstudata&uid=$session';";
        echo "</script>";
      }else{
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
        echo "window.location.href='index.php';";
        echo "</script>";
      }
    }
  }
}

function checking(){
  require 'connection.php';
  $uid = $_GET['uid'];
  $check = $_GET['check'];
  if ($check == 'รอการเช็ค'){
    $pass = 'เช็คแล้ว';
  }else{
    $pass = 'รอการเช็ค';
  }
  $room = $_GET['room'];
  $q = "UPDATE checked SET c_checked='$pass' WHERE c_id='$uid'";
  $resq = mysqli_query($dbcon, $q);
  if ($resq){
    echo "<script>";
    echo "window.location.href='main.php?q=checked&uid=$room';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function deldata(){
  require 'connection.php';
  $uid = $_GET['uid'];
  $q = "DELETE FROM classroom WHERE class_id='$uid'";
  $resq = mysqli_query($dbcon, $q);
  $w = "DELETE FROM checked WHERE c_session='$uid'";
  $resw = mysqli_query($dbcon, $w);
  if ($resw){
    echo "<script>";
    echo "alert('ลบข้อมูลห้องสอบแล้ว');";
    echo "window.location.href='main.php';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function delstudent(){
  require 'connection.php';
  $uid = $_GET['uid'];
  $w = "DELETE FROM student WHERE stu_id='$uid'";
  $resw = mysqli_query($dbcon, $w);
  if ($resw){
    echo "<script>";
    echo "alert('ลบรายชื่อแล้ว');";
    echo "window.location.href='main.php?q=student';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

function delchecked(){
  require 'connection.php';
  $uid = $_GET['uid'];
  $link = $_GET['link'];
  $w = "DELETE FROM checked WHERE c_id='$uid'";
  $resw = mysqli_query($dbcon, $w);
  if ($resw){
    echo "<script>";
    echo "alert('ลบรายชื่อแล้ว');";
    echo "window.location.href='main.php?q=addstudata&uid=$link';";
    echo "</script>";
  }else{
    echo "<script>";
    echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
    echo "window.location.href='index.php';";
    echo "</script>";
  }
}

node();

?>
