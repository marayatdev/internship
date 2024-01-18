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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>
   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../css/dashboard.css">
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
   
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>A<span>dmin</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../img/profile.jpg)"></div>
                <h4><?= $fetch_profile["name"]; ?></h4>
                <small>Admin Contorl</small>
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="" class="active">
                            <span class="las la-home"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-user-alt"></span>
                            <small>Profile</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-envelope"></span>
                            <small>Mailbox</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-clipboard-list"></span>
                            <small>Projects</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-shopping-cart"></span>
                            <small>Orders</small>
                        </a>
                    </li>
                    <li>
                       <a href="">
                            <span class="las la-tasks"></span>
                            <small>Tasks</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                    <label for="">
                        <span class="las la-search"></span>
                    </label>
                    
                    <div class="notify-icon">
                        <span class="las la-envelope"></span>
                        <span class="notify">4</span>
                    </div>
                    
                    <div class="notify-icon">
                        <span class="las la-bell"></span>
                        <span class="notify">3</span>
                    </div>
                    
                    <div class="user">
                        <div class="bg-img" style="background-image: url(img/1.jpeg)"></div>
                        
                        <span class="las la-power-off"></span>
                        <span onclick="logout()" style="cursor: pointer;">Logout</span>
                    </div>
                </div>
            </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>
            
            <div class="page-content">
            
                <div class="analytics">

                    <div class="card">
                    <?php
            $select_user = $conn->prepare("SELECT * FROM `users`");
            $select_user->execute();
            $number_of_user = $select_user->rowCount()
         ?>
                        <div class="card-head">
                            <h2><?= $number_of_user; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>จำนวนผู้ใช้งานทั้งหมด</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                    <?php
$select_status = $conn->prepare("SELECT * FROM `users` WHERE `status` = 'success'");
$select_status->execute();
$number_of_status = $select_status->rowCount();
?>
                        <div class="card-head">
                            <h2><?= $number_of_status; ?></h2>
                            <span class="las  la-envelope"></span>
                        </div>
                        <div class="card-progress">
                            <small>ส่งแบบฟอร์มแล้วสำเร็จ</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                    <?php
$select_status = $conn->prepare("SELECT * FROM `users` WHERE `status` = 'pending'");
$select_status->execute();
$number_of_status = $select_status->rowCount();
?>
                        <div class="card-head">
                            <h2><?= $number_of_status; ?></h2>
                            <span class="las la-eye"></span>
                        </div>
                        <div class="card-progress">
                            <small>กำลังตรวจแบบฟอร์มแล้ว</small>
                            <div class="card-indicator">
                                <div class="indicator five" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                    <?php
$select_status_f = $conn->prepare("SELECT * FROM `users` WHERE `status` = ''");
$select_status_f->execute();
$number_of_status_f = $select_status_f->rowCount();
?>
                        <div class="card-head">
                            <h2><?= $number_of_status_f; ?></h2>
                            <span class="las la-ban"></span>
                        </div>
                        <div class="card-progress">
                            <small>ยังไม่ได้ส่งแบบฟอร์ม</small>
                            <div class="card-indicator">
                                <div class="indicator four" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                    <?php
$select_status_f = $conn->prepare("SELECT * FROM `users` WHERE `status` = 'repair'");
$select_status_f->execute();
$number_of_status_f = $select_status_f->rowCount();
?>
                        <div class="card-head">
                            <h2><?= $number_of_status_f; ?></h2>
                            <span class="fa-solid fa-right-left" style="font-size: 40px;"></span>
                        </div>
                        <div class="card-progress">
                            <small>นำกลับไปแก้ไข</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <div class="add">
                            <span>ปีการศึกษา</span>
                            <select id="year">
                                <option value="All">All</option>
                                <option value="2566">2566</option>
                                <option value="2567">2567</option>
                                <option value="2568">2568</option>
                            </select>
                        </div>

                        <div class="browse">
                            <input type="search" placeholder="Search" class="record-search" id="getName">
                            <select id="statusFilter" name="statusFilter" onchange="filterStatus(this.value)">
                                <option  hidden >Status</option>
                                <option value="All">All</option>
                                <option value="success">Success</option>
                                <option value="pending">Pending</option>
                                <option value="repair">Repair</option>
                            </select>
                            <i class="fa-solid fa-sync fa-spin" id="reloadButton" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div>

                    <table width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span ></span> CLIENT</th>
                                    <th><span ></span> BRANCH</th>
                                    <th><span ></span> YEAR</th>
                                    <th><span ></span> DATE</th>
                                    <th><span ></span> STATUS</th>
                                    <th><span ></span> PREVIEW</th>
                                    <th><span ></span> DOWLOAD</th>
                                </tr>
                            </thead>
                            <tbody id="showdata">
                               
                            <?php  
    $sql = "SELECT form.*, users.* FROM form
            INNER JOIN users ON form.username = users.username";
    $query = $conn->query($sql);
   
    // วนลูปแสดงผลลัพธ์
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        if ($row['status'] == 'repair') {
            echo '<td style="color: #f25656;">' . $row['username'] . '</td>';
        }else if ($row['status'] == 'pending') {
            echo '<td style="color: #ca00e0;">' . $row['username'] . '</td>';
        }else {
            echo '<td>' . $row['username'] . '</td>';
        }
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['myDate'] . "</td>";
        echo "<td>";
        echo "<select class='statusDropdown' data-username='" . $row['username'] . "'>";
        echo "<option value='success' " . ($row['status'] == 'success' ? 'selected' : '') . ">Success</option>";
        echo "<option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>";
        echo "<option value='repair' " . ($row['status'] == 'repair' ? 'selected' : '') . ">Repair</option>";
        echo "</select>";
        echo "</td>";
        echo "<td><a href='preview.php?username=" . $row['username'] . "'>Preview</a></td>";
        echo "<td><a href='pdf.php?username=" . $row['username'] . "' target='_blank'>Download</a></td>";
        echo "</tr>";
    }
?>

        </tbody>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            
            </div>
            
        </main>
        
    </div>


    <script src="../js/filter.js"></script>
<script>
function logout() {
        var confirmation = confirm('คุณต้องการที่จะออกจากระบบหรือไม่?');
        if (confirmation) {
            // OK ถูกกด
            window.location.href = '../components/admin_logout.php';
        } else {
            // Cancel ถูกกด
            // ทำอย่างอื่นๆ หรือไม่ทำอะไรเลยตามที่คุณต้องการ
        }
    }
</script>
</body>
</html>