<?php
require_once 'config/database.php';

$sql = "ALTER TABLE users ADD COLUMN bulan VARCHAR(20) DEFAULT NULL, ADD COLUMN tahun INT(11) DEFAULT NULL";

if ($conn->query($sql) === TRUE) {
    echo "Columns 'bulan' and 'tahun' added successfully";
} else {
    echo "Error adding columns: " . $conn->error;
}
?>
