<?php
// filter_data.php
include '../components/connect.php';

if (isset($_POST['name'])) {
    $getName = $_POST['name'];

    // กำหนดคำสั่ง SQL
    $sql = "SELECT form.*, users.* FROM form
            INNER JOIN users ON form.username = users.username
            WHERE form.username LIKE :name OR users.username LIKE :name";

    $stmt = $conn->prepare($sql);

    // กำหนดค่าพารามิเตอร์และทำการ execute
    $nameParam = '%' . $getName . '%';
    $stmt->bindParam(':name', $nameParam, PDO::PARAM_STR);
    $stmt->execute();

    // ดึงข้อมูลและสร้าง HTML
    $data = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data .= "<tr>";
        
        if ($row['status'] == 'repair') {
            $data .= '<td style="color: #f25656;">' . htmlspecialchars($row['username']) . '</td>';
        } else if ($row['status'] == 'pending') {
            $data .= '<td style="color: #ca00e0;">' . htmlspecialchars($row['username']) . '</td>';
        } else {
            $data .= '<td>' . htmlspecialchars($row['username']) . '</td>';
        }
    
        $data .= "<td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['branch']) . "</td>
            <td>" . htmlspecialchars($row['year']) . "</td>
            <td>" . htmlspecialchars($row['myDate']) . "</td>
            <td>
                <select class='statusDropdown' 
                        data-username='" . $row['username'] . "' 
                        onchange='updateStatus(\"" . $row['username'] . "\", this.value)'>
                        <option value='success' " . ($row['status'] == 'success' ? 'selected' : '') . ">Success</option>
                    <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                    <option value='repair' " . ($row['status'] == 'repair' ? 'selected' : '') . ">Repair</option>
                </select>
            </td>
            <td><a href='preview.php?username=" . $row['username'] . "'>" . htmlspecialchars("Preview") . "</a></td>
            <td><a href='pdf.php?username=" . $row['username'] . "'>" . htmlspecialchars("Download") . "</a></td>
        </tr>";
    }
    
    // เพิ่มส่วนนี้เพื่อตรวจสอบจำนวนแถวที่คืนมา
    if ($stmt->rowCount() == 0) {
        $data = "<tr><td colspan='8'>ไม่มีข้อมูลของนักศึกษา</td></tr>";
    }
    
    // ส่งผลลัพธ์กลับไปยัง AJAX
    echo $data;
    ;
}
?>
