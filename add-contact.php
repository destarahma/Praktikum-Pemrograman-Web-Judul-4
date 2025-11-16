<?php
session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

$errors = [];
$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    if (empty($_POST["name"])) {
        $errors[] = "Nama harus diisi";
    } else {
        $data['name'] = trim($_POST["name"]);
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['name'])) {
            $errors[] = "Nama hanya boleh mengandung huruf dan spasi";
        }
    }

    // Validasi email
    if (empty($_POST["email"])) {
        $errors[] = "Email harus diisi";
    } else {
        $data['email'] = trim($_POST["email"]);
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak valid";
        }
    }

    // Validasi telepon
    if (empty($_POST["phone"])) {
        $errors[] = "Telepon harus diisi";
    } else {
        $data['phone'] = trim($_POST["phone"]);
        if (!preg_match("/^[0-9+\-\s]+$/", $data['phone'])) {
            $errors[] = "Format telepon tidak valid";
        }
    }

    // Validasi alamat
    if (empty($_POST["address"])) {
        $errors[] = "Alamat harus diisi";
    } else {
        $data['address'] = trim($_POST["address"]);
    }

    // Jika tidak ada error, simpan kontak
    if (empty($errors)) {
        // Inisialisasi kontak jika belum ada
        if (!isset($_SESSION['contacts'])) {
            $_SESSION['contacts'] = [];
        }
        
        // Generate ID unik
        $id = uniqid();
        $_SESSION['contacts'][$id] = $data;
        
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kontak - Sistem Manajemen Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Kontak Baru</h1>
            <div class="user-info">
                <a href="index.php" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
        </header>

        <div class="main-content">
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <h3>Error:</h3>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" 
                           value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>" 
                           required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>" 
                           required>
                </div>
                <div class="form-group">
                    <label for="phone">Telepon:</label>
                    <input type="tel" id="phone" name="phone" 
                           value="<?php echo isset($data['phone']) ? htmlspecialchars($data['phone']) : ''; ?>" 
                           required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <textarea id="address" name="address" rows="4" required><?php echo isset($data['address']) ? htmlspecialchars($data['address']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Simpan Kontak" class="btn btn-primary">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>