<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<link rel="shortcut icon" href="https://files.sirclocdn.xyz/rock/files/Fav-Icon.jpg">
</head>
<body>
<?php

session_destroy();
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='login_admin.php';</script>";
?>
</body>
</html>