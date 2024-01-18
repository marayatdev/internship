<?php
// fetch_data.php
include '../components/connect.php';
$output = array();

$query = "SELECT * FROM form";
$result = $conn->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $output[] = $row;
}

echo json_encode($output);
$conn->close();
?>
