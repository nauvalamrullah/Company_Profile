<?php
try {
    // Koneksi ke database SQLite
    $pdo = new PDO('sqlite:database.sqlite'); // Pastikan jalur database benar
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat tabel contacts jika belum ada
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS contacts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        firstname TEXT NOT NULL,
        email TEXT NOT NULL,
        subject TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($createTableSQL);

    // Periksa apakah data dikirim melalui POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari formulir, periksa apakah kunci ada dalam array POST
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';

        // Periksa apakah semua data telah diisi
        if (!empty($firstname) && !empty($email) && !empty($subject)) {
            // Siapkan statement SQL untuk menyimpan data ke dalam database
            $sql = "INSERT INTO contacts (firstname, email, subject) VALUES (:firstname, :email, :subject)";
            
            // Persiapkan pernyataan SQL untuk dimasukkan ke dalam database
            $stmt = $pdo->prepare($sql);
            
            // Eksekusi pernyataan SQL dengan menggunakan nilai yang diberikan
            $stmt->execute(['firstname' => $firstname, 'email' => $email, 'subject' => $subject]);
            
            // Tampilkan pesan berhasil jika pernyataan SQL berhasil dieksekusi
            echo "Pesan Anda telah berhasil dikirim!";
        } else {
            echo "Error: Semua kolom harus diisi.";
        }
    }
} catch (PDOException $e) {
    // Tangani kesalahan jika pernyataan SQL gagal dieksekusi
    echo "Error: " . $e->getMessage();

    // Lakukan proses penyimpanan formulir ke database atau operasi lainnya di sini...

    // Tampilkan notifikasi pesan terkirim menggunakan JavaScript
    echo "<script>alert('Pesan Anda telah berhasil terkirim!');</script>";
} catch (PDOException $e) {
    // Tangani kesalahan jika pernyataan SQL gagal dieksekusi
    echo "Error: " . $e->getMessage();
}

// Setelah formulir berhasil diproses, arahkan pengguna kembali ke halaman utama
header("Location: index.php");
exit; // Pastikan untuk keluar setelah mengarahkan
?>
