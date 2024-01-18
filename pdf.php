<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
   header('location:user_login.php');
};



?>

<?php


require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'I' => 'THSarabunNew Italic.ttf',
        ]
    ],
    'default_font' => 'sarabun'
]);
$mpdf->SetDisplayMode('fullpage');
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
   body{
    width: 8.27in;
  height: 11.69in;
  margin: 0;
  padding: 0;
      font-family: 'Sarabun', sans-serif;
      font-size: 16pt; 
      transition: background-color 0.5s ease;
            background-color: #fff;
   }
   .left {
            float: left;
            width: 60%; /* ให้ div ชิดฝั่งซ้ายเท่ากับ 50% ของพื้นที่ */
            margin-top:-20px;
        }

        .right {
            float: right;
            width: 40%; /* ให้ div ชิดฝั่งขวาเท่ากับ 50% ของพื้นที่ */
            margin-top:-10px;
        }
        .right-img{
            float: right;
            width: 40%;
        }
        
  .detail{
    text-align: justify; /* ปรับค่าตามที่คุณต้องการ */
    margin-top:-45px;
  }
  .date{
    clear: both;
    text-align: center;
    margin-top:-30px;
  }
  .logo {
      text-align: center; /* ปรับตำแหน่งของรูปภาพให้อยู่ตรงกลาง */
      margin-top:-40px;
    }
.company{
    margin-top:-20px;
}
.fade-out {
            background-color: rgba(255, 255, 255, 0);
        }
</style>

</head>
<body onload="onPageLoad()">
<?php          
            $select_form = $conn->prepare("SELECT * FROM `form` WHERE username = ?");
            $select_form->execute([$username]);
            if($select_form->rowCount() > 0){
            $fetch_form = $select_form->fetch(PDO::FETCH_ASSOC);
         ?>


<div class="container">

            <div class="logo">
                <img src="img/su.png" alt="">
            </div>

        <div class="left">
        <p>ที่ อว 8619(พบ)/398</p>
    </div>

    <div class="right">
        <p>คณะเทคโนโลยีสารสนเทศและการสื่อสาร <br>
            มหาวิทยาลัยศิลปากร วิทยาเขตสารสนเทศฯ<br>
            เลขที่ 1 หมู่ 3 ถ.ชะอำ-ปราณบุรี<br>
            อ.ชะอำ จังหวัดเพชรบุรี 76120</p>
    </div>
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


        </div>
        <div class="company">
            <p>เรื่อง ขอความอนุเคราะห์ให้นักศึกษาเข้ารับการฝึกงาน<br>
            เรียน <?= $fetch_form["mentor"]; ?> (<?= $fetch_form["department"]; ?>)<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; บริษัท <?= $fetch_form["n_company"]; ?><br>
               สิ่งที่ส่งมาด้วย แบบตอบรับนักศึกษาเข้าฝึกประสบการณ์วิชาชีพ</p>
        </div>
        <div class="detail">
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยคณะเทคโนโลยีสารสนเทศและการสื่อสาร มหาวิทยาลัยศิลปากร ได้เปิดสอนนักศึกษา
                    สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ ระดับปริญญาตรี เพื่อให้นักศึกษาสำเร็จการศึกษาครบตามหลักสูตรจึง
                    จำเป็นต้องฝึกงานตามสาขาวิชาเอก ทั้งนี้ นักศึกษาทุกคนต้องออกฝึกงานตามสถานประกอบการที่เกี่ยวข้อง
                    กับสาขาวิชาที่เรียนเพื่อเพิ่มความรู้และทักษะก่อนสำเร็จการศึกษา<br>
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
                </p>       
        </div>
        <div class="right-img">
        <p style="text-align: center;">ขอแสดงความนับถือ<br><br>


        (ผู้ช่วยศาสตราจารย์ ดร.ณัฐพร กาญจนภูมิ)
        คณบดีคณะเทคโนโลยีสารสนเทศและการสื่อสาร
        </p> 
        </div>
    </div>
    คณะเทคโนโลยีสารสนเทศและการสื่อสาร <br>
โทร. 032-594033







    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
$mpdf->Output("report.pdf");
        ob_end_flush()
?>
<?php
            }else
         ?>
<script>
        function showAlertDialog() {
            Swal.fire({
                title: 'ยินดีต้อนรับ!',
                text: 'คลิก "ตกลง" เพื่อไปยังหน้าเว็บอื่น',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'report.pdf';
                } else {
                    // เรียกใช้ตนเอง (recursion) เพื่อแสดง alert อีกครั้ง
                    showAlertDialog();
                }
            });
        }

        function onPageLoad() {
            setTimeout(() => {
                document.body.classList.add('fade-out');
            }, 0);

            // เรียกใช้ฟังก์ชันแสดง alert ทันที
            showAlertDialog();
        }
    </script>
</body>
</html>