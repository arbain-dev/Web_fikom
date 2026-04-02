<?php
require_once 'config/database.php';
$stmt = $conn->query("SHOW TABLES");
$tables = [];
while($row = $stmt->fetch_row()) {
    $tables[] = $row[0];
}

foreach($tables as $table) {
    echo "TABLE: $table\n";
    $result = $conn->query("DESCRIBE $table");
    while($row = $result->fetch_assoc()) {
        echo "  " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }
}
?>
