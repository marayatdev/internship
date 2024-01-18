<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/pdf.css">
</head>
<body>

<?php          
            $username = $_GET['username'];
            $select_form = $conn->prepare("SELECT * FROM `form` WHERE username = ?");
            $select_form->execute([$username]);
            if($select_form->rowCount() > 0){
            $fetch_form = $select_form->fetch(PDO::FETCH_ASSOC);
         ?>
<div class="form">
        <?php
if (isset($_POST['submit'])) {
   if(isset($_POST['av'])) {
      $av = $_POST['av'];
      $update_user = $conn->prepare("UPDATE `form` SET av = ? WHERE username = ?");
      $update_user->execute([$av, $username]);
   }
   if (empty($status)) {
    $status = "success";
    $update_user = $conn->prepare("UPDATE `users` SET status = ? WHERE username = ?");
    $update_user->execute([$status, $username]);      
}
   
}
if (isset($_POST['submitUpdate'])) {
   if(isset($_POST['note'])) {
    $note = $_POST['note'];
      $update_user = $conn->prepare("UPDATE `form` SET note = ? WHERE username = ?");
      $update_user->execute([$note, $username]);
   }
   if (empty($status)) {
    $status = "repair";
    $update_user = $conn->prepare("UPDATE `users` SET status = ? WHERE username = ?");
    $update_user->execute([$status, $username]);      
}
}
?>
<div class="hello">
<form method="post" enctype="multipart/form-data">
    
        <span>ใส่เลขที่ อว :</span>
        <input type="text" name="av">
        <button type="submit" name="submit" onclick="submitForm()">Submit</button><br>
    
</form><br>

<form method="post" enctype="multipart/form-data">
    <span>หมายเหตุ :</span>
   <input type="text" name="note">
   <button type="submit" name="submitUpdate" onclick="submitForm()">Submit</button><br>
</form><br>
หมายเหตุ : <?= $fetch_form["note"]; ?>
</div>
</div><br><br>
<div class="bg"> 
<div class="wrap">

            <div class="logo">
                <img src="../img/su-pre.png" alt="">
            </div>
            <div class="head">
        <div class="av">
        <p>ที่ <?= $fetch_form["av"]; ?></p><br>
        <!-- <p>ที่ อว 8619(พบ)/398</p> -->
    </div>

    <div class="addres">
        <p>คณะเทคโนโลยีสารสนเทศและการสื่อสาร <br>
            มหาวิทยาลัยศิลปากร วิทยาเขตสารสนเทศฯ<br>
            เลขที่ 1 หมู่ 3 ถ.ชะอำ-ปราณบุรี<br>
            อ.ชะอำ จังหวัดเพชรบุรี 76120</p>
    </div>
    </div><br>
    <div class="date">

            

            <?php
$mysqlDate = $fetch_form["myDate"];

// แปลงรูปแบบวันที่
$timestamp = strtotime($mysqlDate);

// แปลงปีเป็น พ.ศ.
$thaiYear = date("Y", $timestamp + 543);

// แปลงวันที่และเดือนเป็นภาษาไทย
$thaiDateFormatter = new IntlDateFormatter('th', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Bangkok', IntlDateFormatter::TRADITIONAL, 'dd MMMM y');
$thaiDate = $thaiDateFormatter->format($timestamp);

// ลบเลข 0 นำหน้าวันที่
$thaiDate = ltrim($thaiDate, '0');

// แสดงผล
echo $thaiDate;
?>


        </div><br>
        <div class="company">
            <p>เรื่อง ขอความอนุเคราะห์ให้นักศึกษาเข้ารับการฝึกงาน<br>
            เรียน <?= $fetch_form["mentor"]; ?> (<?= $fetch_form["department"]; ?>)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; บริษัท <?= $fetch_form["n_company"]; ?><br>
               สิ่งที่ส่งมาด้วย แบบตอบรับนักศึกษาเข้าฝึกประสบการณ์วิชาชีพ</p><br>
        </div>
        <div class="detail">
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยคณะเทคโนโลยีสารสนเทศและการสื่อสาร มหาวิทยาลัยศิลปากร ได้เปิดสอนนักศึกษา
           <?= $fetch_form["branch"]; ?> ระดับปริญญาตรี เพื่อให้นักศึกษาสำเร็จการศึกษาครบตามหลักสูตรจึง
                    จำเป็นต้องฝึกงานตามสาขาวิชาเอก ทั้งนี้ นักศึกษาทุกคนต้องออกฝึกงานตามสถานประกอบการที่เกี่ยวข้อง
                    กับสาขาวิชาที่เรียนเพื่อเพิ่มความรู้และทักษะก่อนสำเร็จการศึกษา<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; คณะเทคโนโลยีสารสนเทศและการสื่อสาร ได้พิจารณาแล้วเห็นว่าหน่วยงานของท่านเป็นแหล่ง
                    วิทยาการที่สามารถให้ความรู้ ความชำนาญและประสบการณ์ ตลอดจนให้ข้อเสนอแนะต่าง ๆ เป็นอย่างดี จึง
                    ใคร่ขอความอนุเคราะห์รับนักศึกษาสาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ ระดับปริญญาตรี ชั้นปีที่ 3 เข้า
                    ฝึกงานในหน่วยงานของท่าน ตั้งแต่วันที่ <?php
// ดึงวันที่จาก MySQL
$mysqlDate = $fetch_form["s_intern"];

// แปลงรูปแบบวันที่
$timestamp = strtotime($mysqlDate);

// แปลงวันที่และเดือนเป็นภาษาไทย (ไม่รวมปี)
$thaiDateFormatter = new IntlDateFormatter('th', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Bangkok', IntlDateFormatter::TRADITIONAL, 'dd MMMM');
$thaiDate = $thaiDateFormatter->format($timestamp);

// ลบเลข 0 นำหน้าวันที่
$thaiDate = ltrim($thaiDate, '0');

// แสดงผล
echo $thaiDate;
?>- <?php
$mysqlDate = $fetch_form["e_intern"];

// แปลงรูปแบบวันที่
$timestamp = strtotime($mysqlDate);

// แปลงปีเป็น พ.ศ.
$thaiYear = date("Y", $timestamp + 543);

// แปลงวันที่และเดือนเป็นภาษาไทย
$thaiDateFormatter = new IntlDateFormatter('th', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Bangkok', IntlDateFormatter::TRADITIONAL, 'dd MMMM y');
$thaiDate = $thaiDateFormatter->format($timestamp);

// ลบเลข 0 นำหน้าวันที่
$thaiDate = ltrim($thaiDate, '0');

// แสดงผล
echo $thaiDate;
?> โดยมีเวลารวมไม่น้อยกว่า 320 ชั่วโมง
                    จำนวน <?= $fetch_form["f_amount"]; ?> คน คือ <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $fetch_form["f_name"]; ?><br>
                </p>       <br>
                <p style="text-align: center;">จึงเรียนมาเพื่อโปรดพิจารณาอนุเคราะห์และขอบพระคุณเป็นอย่างยิ่งมา ณ โอกาสนี้</p><br>
        <div class="tank">
                    <p >ขอแสดงความนับถือ<br><br><br>
            
            
                    (ผู้ช่วยศาสตราจารย์ ดร.ณัฐพร กาญจนภูมิ) <br>
                    คณบดีคณะเทคโนโลยีสารสนเทศและการสื่อสาร
                    </p> 
                    </div><br><br>
                    <p>คณะเทคโนโลยีสารสนเทศและการสื่อสาร <br>
                        โทร. 032-594033</p>
        </div>
        </div>
        </div>
        



<?php
            }
         ?>
         <script>
        function submitForm() {
    
    window.location.href = 'dashboard.php';
}
    </script>
</body>
</html>