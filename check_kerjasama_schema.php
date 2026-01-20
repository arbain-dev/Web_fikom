<?php
require_once 'config/database.php';

$table = 'kerjasama';
$result = $conn->query("DESCRIBE $table");

if ($result) {
    echo "Structure of table '$table':\n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
} else {
    echo "Error describing table: " . $conn->error;
}
?>
