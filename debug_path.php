<?php
// File: debug_path.php
// Place this in the project root or admin folder to debug

require_once 'config/constants.php';

echo "<h1>Debug Path Configuration</h1>";
echo "<p><strong>Current Script:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p><strong>HTTP Host:</strong> " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<hr>";
echo "<p><strong>Calculated BASE_URL:</strong> " . BASE_URL . "</p>";
echo "<p><strong>Calculated ASSETS_URL:</strong> " . ASSETS_URL . "</p>";
echo "<hr>";
echo "<h3>Asset Test</h3>";
echo "<p>Trying to link: " . BASE_URL . "/assets/css/admin.css</p>";
echo "<link rel='stylesheet' href='" . BASE_URL . "/assets/css/admin.css'>";
echo "<p>If the text below is styled (e.g. font changes), CSS is working.</p>";
echo "<div class='test-box' style='padding:20px; border:1px solid #ccc;'>Test Box</div>";
?>
