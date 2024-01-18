<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
   header('location:user_login.php');
};





if (isset($_POST['submit'])) {


   $prefix = $_POST['prefix'];
   $prefix = filter_var($prefix, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $branch = $_POST['branch'];
   $branch = filter_var($branch, FILTER_SANITIZE_STRING);
   $tel = $_POST['tel'];
   $tel = filter_var($tel, FILTER_SANITIZE_STRING);
   $year = $_POST['year'];
   $year = filter_var($year, FILTER_SANITIZE_STRING);
   $s_intern = $_POST['s_intern'];
   $s_intern = filter_var($s_intern, FILTER_SANITIZE_STRING);
   $e_intern = $_POST['e_intern'];
   $e_intern = filter_var($e_intern, FILTER_SANITIZE_STRING);
   $f_amount = $_POST['f_amount'];
   $f_amount = filter_var($f_amount, FILTER_SANITIZE_STRING);
   $f_name = $_POST['f_name'];
   $f_name = filter_var($f_name, FILTER_SANITIZE_STRING);
   $request = $_POST['request'];
   $request = filter_var($request, FILTER_SANITIZE_STRING);

   //company
   $n_company = $_POST['n_company'];
   $n_company = filter_var($n_company, FILTER_SANITIZE_STRING);
   $mentor = $_POST['mentor'];
   $mentor = filter_var($mentor, FILTER_SANITIZE_STRING);
   $department = $_POST['department'];
   $department = filter_var($department, FILTER_SANITIZE_STRING);
   $c_tel = $_POST['c_tel'];
   $c_tel = filter_var($c_tel, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $position = $_POST['position'];
   $position = filter_var($position, FILTER_SANITIZE_STRING);
   $style = $_POST['style'];
   $style = filter_var($style, FILTER_SANITIZE_STRING);
   $residence = $_POST['residence'];
   $residence = filter_var($residence, FILTER_SANITIZE_STRING);
   $myDate = $_POST["myDate"];
   $mysqlDate = date("Y-m-d", strtotime($myDate));
   

   $insert_form = $conn->prepare("INSERT INTO `form`(username,prefix,name,branch,tel, year, s_intern,e_intern,f_amount,f_name,request,n_company,mentor,department,c_tel, address, position,style,residence,myDate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert_form->execute([$username,$prefix, $name, $branch, $tel, $year, $s_intern, $e_intern,$f_amount, $f_name,$request,$n_company, $mentor, $department, $c_tel, $address, $position, $style, $residence,$mysqlDate]);

    if (empty($status)) {
      $status = "pending";
      $update_user = $conn->prepare("UPDATE `users` SET status = ? WHERE username = ?");
      $update_user->execute([$status, $username]);      
  }
echo '<script>alert("บันทึกข้อมูลสำเร็จ"); window.location.href = "index.php";</script>';


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>


<section class="container">
    <div class='title'>
    <h1>แบบฟอร์มขอให้คณะออกเอกสาร ฝ.1</h1>
      <p>การยื่นคำร้องขอความอนุเคราะห์ฝึกงาน (ฝ.1) โดยนักศึกษาแจ้งรายละเอียดข้อมูลที่ถูกต้อง 
        ตรวจสอบได้ จากนั้นคณะฯ จะออกหนังสือราชการสำหรับให้นักศึกษานำไปยื่นต่อหน่วยงาน/องค์กรที่ต้องการฝึกงาน</p>
    </div>

    <form method="post" enctype="multipart/form-data" class="form">
    <div class="input-box">
            <label>วันที่ส่งเอกสาร <span>()</span></label>
            <input type="date" id="myDate" name="myDate" placeholder="Enter name"   required />
          </div>
    <div class="input-box address">
          <label>คำนำหน้า</label>
          <div class="column">
            <div class="select-box">
              <select name="prefix">
                <option hidden>คำนำหน้า</option>
                <option value="นาย">นาย</option>
                <option value="นาง">นาง</option>
                <option value="นางสาว">นางสาว</option>
              </select>
            </div>
          </div>
          <div class="input-box">
            <label>ชื่อ-นามสกุล <span>(เช่น นาย นายกุ่ย ลุยทุ่งนา)</span></label>
            <input type="text" name="name" placeholder="Enter name"   required />
          </div>
        </div>


        <div class="input-box address">
          <label>สาขาวิชา</label>
          <div class="column">
            <div class="select-box">
              <select name="branch">
                <option hidden>สาขาวิชา</option>
                <option value="สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ" >สาขาวิชาเทคโนโลยีดิจิทัลเพื่อธุรกิจ</option>
                <option value="สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบอนิเมชั่น" >สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบอนิเมชั่น</option>
                <option value="สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบแอปพลิเคชั่น" >สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบแอปพลิเคชั่น</option>
                <option value="สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบเกม" >สาขาวิชาเทคโนโลยีดิจิทัลเพื่อการออกแบบเกม</option>
              </select>
            </div>
          </div>
          </div>


          <div class="column">
          <div class="input-box">
            <label>เบอร์มือถือของนักศึกษา</label>
            <input type="tel" placeholder="Enter phone number" name="tel" maxlength="10" required />
          </div>
          <div class="input-box">
            <label>ปีการศึกษาที่ฝึกงาน <span>(ใช้เป็นพุธศักราช)</span></label>
            <input type="text" name="year" placeholder="Enter phone number"   maxlength="4" required />
          </div>
        </div>


        <div class="input-box">
        <label>วันเริ่มฝึกงาน</label>
            <input type="date" name="s_intern" placeholder="Enter birth date" required />
        </div>
        <div class="input-box">
        <label>วันสิ้นสุดฝึกงาน</label>
            <input type="date" name="e_intern" placeholder="Enter birth date" required />
        </div>


        <div class="column">
        <div class="input-box">
            <label>จำนวนเพื่อนที่ไปฝึกงาน <span>(นับรวมตัวเอง)</span></label>
            <input type="number" name="f_amount" placeholder="Enter phone number"   maxlength="4" required />
          </div>
          <div class="input-box">
            <label>หากมีเพื่อนร่วมฝึกงานที่ไปด้วยกันให้แจ้งรหัสนักศึกษา ชื่อ-นามสกุล ของเพื่อนที่ไปด้วย</label><br>
            <textarea id="story" name="f_name" rows="5" cols="42" placeholder="ตัวย่าง*
1.นางสมร อ่าวเห้ย 631310025
2.นายสมใจ หมายปอง 631310025">
</textarea>
          </div>
        </div>

        
        <div class="column">
          <div class="input-box">
            <label>ยื่นขอความอนุเคราะห์ฝึกงานครั้งที่</label>
            <input type="text" placeholder="Enter phone number" name="request" maxlength="2" required />
          </div>
        </div>

        <div class="input-box address">
          <div class="input-box">
            <div class="column">
          <div class="input-box">
                <label>ชื่อบริษัท</label>
                <input type="text" name="n_company" placeholder="Enter phone number"   required />
          </div>
          <div class="input-box">
                <label>ชื่อ-นามสกุล ของผู้รับเอกสารของหน่วยงานที่ไปฝึก</label>
                <input type="text" name="mentor" placeholder="Enter phone number"   required />
          </div>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="input-box">
            <label>ตำแหน่งของผู้รับในหน่วยงานนั้น <span>(เช่น หัวหน้าฝ่ายดิจิทัล, ผู้จัดการฝ่ายวิเคราะห์ข้อมูล, ผู้จัดการฝ่ายบุคคล)</span></label>
            <input type="tel" name="department" placeholder="Enter phone number" required />
          </div>
          <div class="input-box">
            <label>เบอร์โทรหรืออีเมล์สำหรับติดต่อหน่วยงานหรือบุคคบที่รับผิดชอบ</label>
            <input type="text" name="c_tel" placeholder="Enter phone number"  maxlength="10" required />
          </div>
        </div>


        <div class="column">
          <div class="input-box">
            <label>สถานที่ฝึกงาน</label>
            <input type="tel" name="address" placeholder="Enter phone number"  maxlength="10" required />
          </div>
        </div>
        

        <div class="column">
          <div class="input-box">
            <label>สายงานที่นักศึกษาไปฝึก</label>
            <input type="text" name="position" placeholder="Enter phone number"  maxlength="10" required />
          </div>
        </div>

        <div class="input-box address">
          <label>รูปแบบการทำงาน</label>
          <div class="column">
            <div class="select-box">
              <select name="style">
                <option hidden>รูปแบบการทำงาน</option>
                <option value='Online' >Online</option>
                <option value='Onsite' >Onsite</option>
                <option value='Online และ Onsite' >Online และ Onsite</option>
              </select>
            </div>
          </div>
          </div>

          <div class="input-box address">
          <label>การวางแผนที่อยู่อาศัยระหว่างฝึกงาน</label>
          <div class="column">
            <div class="select-box">
              <select name="residence">
                <option hidden>ที่อยู่อาศัยระหว่างฝึกงาน</option>
                <option value="อยู่บ้าน">อยู่บ้าน</option>
                <option value="เช่าหอพัก">เช่าหอพัก</option>
              </select>
            </div>
          </div>
          </div>

    <a href="index.php"><button type="submit" name="submit">Submit</button></a>
      </form>
    
     
    </section>


</body>
</html>