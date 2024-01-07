<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
}else{
   $username = '';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<?php          
            $select_form = $conn->prepare("SELECT * FROM `form` WHERE username = ?");
            $select_form->execute([$username]);
            if($select_form->rowCount() > 0){
            $fetch_form = $select_form->fetch(PDO::FETCH_ASSOC);
         ?>

<?= $fetch_form["branch"]; ?>

<?php
            }else
         ?>
    
</body>
</html>