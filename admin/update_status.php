<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


$username = $_POST['username'];
$newStatus = $_POST['newStatus'];

try {
    // ทำการอัพเดตค่า 'status' ในฐานข้อมูล
    $updateSql = "UPDATE users SET status = :newStatus WHERE username = :username";
    $stmt = $conn->prepare($updateSql);
    $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    echo "อัพเดตสถานะเรียบร้อยแล้ว";
} catch (PDOException $e) {
    echo "ผิดพลาด: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$conn = null;
?>
