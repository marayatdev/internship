<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
};

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    // Check if the username already exists
    $select_username = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
    $select_username->execute([$username]);

    if($select_username->rowCount() > 0){
        echo "<script>alert('รหัสนักศึกษานี้ถูกใช้แล้ว!!!');</script>";
    }else{
        // Check if the email already exists
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
        $select_user->execute([$username]);

        if($select_user->rowCount() > 0){
            echo "<script>alert('มีผู้ใช้อีเมลนี้แล้ว โปรดใส่ใหม่นะ!!!');</script>";
        }else{
            if($pass != $cpass){
                echo "<script>alert('รหัสผ่านไม่ตรงกัน!!!');</script>";
            }else{
                // Insert new user into the database
                $insert_user = $conn->prepare("INSERT INTO `users` (username, email, password) VALUES (?, ?, ?)");
                $insert_user->execute([$username, $email, $cpass]);
                echo "<script>alert('สมัคสมาชิคสำเร็จ');</script>";
            }
        }
    }
}


 
 if(isset($_POST['submitL'])){

    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
    $select_user->execute([$username, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $_SESSION['username'] = $row['username'];
       header('location:index.php');
    }else{
       echo "<script>alert('username หรือ password ไม่ถูกต้องกรุณากรอกใหม่ !!!');</script>";
    }
 
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>


<main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
             <form action="" autocomplete="off" class="sign-in-form"  method="post"> <!-- autocomplete="off" -->
              <div class="logo">
                <img src="./img/su-pre.png" alt="easyclass" />
                <h4>InternShip</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    name="username"
                    required
                  />
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    class="input-field"
                    name="pass"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" value="Sign In" class="sign-btn" name="submitL"/>

            
              </div>
            </form>

            <form action="" autocomplete="off" class="sign-up-form" method="post" enctype="multipart/form-data">
              <div class="logo">
                <img src="./img/su-pre.png" alt="easyclass" />
                <h4>InternShip</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                <input
  type="text"
  minlength="9"
  class="input-field"
  name="username"
  id="numericInput"
  pattern="[0-9]*"
  title="กรุณากรอกเฉพาะตัวเลข"
  required
/>
                  <label>StudentID</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    name="pass"
                    required
                  />
                  <label>Password</label>
                </div>
                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    name="cpass"
                    required
                  />
                  <label>confirm-password</label>
                </div>

                <input type="submit" value="Sign Up" class="sign-btn" name="submit"/>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="./img/image1.png" class="image img-1 show" alt="" />
              <img src="./img/image2.png" class="image img-2" alt="" />
              <img src="./img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

   

<!-- <section class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="text" name="username" required placeholder="StudentID" maxlength="50"   oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"   oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now"  name="submit">
      <a href="user_register.php" class="option-btn">register now</a>
   </form>

</section> -->



<script src="js/app.js"></script>
<script>
  document.getElementById('numericInput').addEventListener('input', function() {
    var numericInput = this.value;
    var isValid = /^\d+$/.test(numericInput);

    if (!isValid) {
      document.getElementById('errorNumericInput').textContent = 'กรุณากรอกเฉพาะตัวเลข';
    } else {
      document.getElementById('errorNumericInput').textContent = '';
    }
  });
</script>
</body>
</html>