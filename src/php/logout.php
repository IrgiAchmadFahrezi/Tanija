<?php
session_start();

// Hancurkan semua variabel sesi
session_destroy();

// Redirect kembali ke halaman login
header("Location: ../html/login.html");
exit;
?>
