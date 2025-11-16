<?php
session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Inisialisasi data kontak di session jika belum ada
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

$contacts = $_SESSION['contacts'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Manajemen Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistem Manajemen Kontak</h1>
            <div class="user-info">
                <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | 
                   <a href="logout.php" class="btn btn-secondary">Logout</a></p>
            </div>
        </header>

        <div class="main-content">
            <div class="action-bar">
                <a href="add-contact.php" class="btn btn-primary">Tambah Kontak Baru</a>
            </div>

            <h2>Daftar Kontak</h2>
            
            <?php if (empty($contacts)): ?>
                <div class="no-data">
                    <p>Belum ada kontak. <a href="add-contact.php">Tambah kontak pertama</a></p>
                </div>
            <?php else: ?>
                <div class="contacts-list">
                    <?php foreach ($contacts as $id => $contact): ?>
                        <div class="contact-card">
                            <div class="contact-info">
                                <h3><?php echo htmlspecialchars($contact['name']); ?></h3>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?></p>
                                <p><strong>Telepon:</strong> <?php echo htmlspecialchars($contact['phone']); ?></p>
                                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($contact['address']); ?></p>
                            </div>
                            <div class="contact-actions">
                                <a href="edit-contact.php?id=<?php echo $id; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete-contact.php?id=<?php echo $id; ?>" class="btn btn-delete" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus kontak ini?')">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>