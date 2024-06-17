<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<h2>Selamat Datang</h2>

<?php if (isset($_SESSION['admin']) && is_array($_SESSION['admin'])): ?>
    <h4><?php echo htmlspecialchars($_SESSION['admin']['nama_admin']); ?>! Anda telah login.</h4>
    <img src="assets/images/welcome.gif" alt="" class="welcome">
<?php else: ?>
    <h4>Anda belum login.</h4>
<?php endif; ?>
</body>
</html>
