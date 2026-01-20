<?php
require_once 'config/database.php';

$sql = "ALTER TABLE kerjasama ADD COLUMN bulan VARCHAR(20) DEFAULT NULL, ADD COLUMN tahun INT(11) DEFAULT NULL";

if ($conn->query($sql) === TRUE) {
    echo "Columns 'bulan' and 'tahun' added successfully to 'kerjasama' table";
} else {
    echo "Error adding columns: " . $conn->error;
}
?>
