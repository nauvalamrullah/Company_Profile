<?php
try {
    // Membuat koneksi ke database SQLite
    $pdo = new PDO('sqlite:komen.db');
    // Mengatur mode error ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Membuat tabel jika belum ada
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
         nama TEXT NOT NULL,
         email TEXT NOT NULL,
         komen TEXT NOT NULL
    )");

    echo "Koneksi ke database berhasil dan tabel berhasil dibuat.";
} catch (PDOException $e) {
    echo "Koneksi atau pembuatan tabel gagal: " . $e->getMessage();
}
?>
