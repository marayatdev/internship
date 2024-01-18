
<?php
include 'connect.php';

// เริ่ม session
session_start();

// ตรวจสอบว่ามี session ที่กำหนดหรือไม่
if(isset($_SESSION['username'])){
    // ลบข้อมูล session ทั้งหมด
    $_SESSION = array();

    // ลบ session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // ทำลาย session
    session_destroy();

    // ส่งผู้ใช้ไปยังหน้าล็อกอินหรือหน้าหลัก
    header("location:../index.php");
    exit();
} else {
    // ถ้าไม่มี session กำหนด, ส่งผู้ใช้กลับไปยังหน้าหลักหรือหน้าที่เหมาะสม
    header("location:../index.php");
    exit();
}
?>