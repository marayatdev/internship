<?php
// filter_status.php
include '../components/connect.php';

if (isset($_POST['status'])) {
    $selectedStatus = $_POST['status'];

    // สร้าง query สำหรับดึงข้อมูลที่ต้องการ
    if ($selectedStatus === 'All') {
        $query = "SELECT form.*, users.* FROM form
                  INNER JOIN users ON form.username = users.username";
    } else {
        $query = "SELECT form.*, users.* FROM form
                  INNER JOIN users ON form.username = users.username
                  WHERE users.status = :status";
    }

    try {
        $stmt = $conn->prepare($query);

        if ($selectedStatus !== 'All') {
            $stmt->bindParam(':status', $selectedStatus, PDO::PARAM_STR);
        }

        $stmt->execute();

        $data = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data .= "<tr>";
    
            $usernameCell = ($row['status'] == 'repair') ? '<td style="color: #f25656;">' : (($row['status'] == 'pending') ? '<td style="color: #ca00e0;">' : '<td>');
            $data .= $usernameCell . htmlspecialchars($row['username']) . '</td>';
    
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
    
        echo $data;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
