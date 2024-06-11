<?php

// Nama file database SQLite
$databaseFile = 'd/Company_Profie/database.sqlite';

// Membuat koneksi ke database SQLite
$pdo = new PDO('sqlite:' . $databaseFile);

// Set mode error untuk menampilkan pesan kesalahan
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query untuk membuat tabel
$query = "
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        username TEXT,
        email TEXT
    )
";

// Eksekusi query untuk membuat tabel
$pdo->exec($query);

echo "Tabel berhasil dibuat!";
