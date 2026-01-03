<?php
session_start();
session_unset();
session_destroy();

// Redirect to the main website index (outside admin folder)
header("Location: ../index.php");
exit;
?>
