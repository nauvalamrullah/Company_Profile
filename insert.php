<?php
try {
    $pdo = new PDO('sqlite:databases.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Menyisipkan data ke dalam tabel
    $stmt = $pdo->prepare("INSERT INTO nama (name, price) VALUES (:name, :price)");
    $stmt->execute([
        ':name' => 'Produk 1',
        ':email' => 'nauvalamrullah0202',
        ':komen' => 'saya suka anda'
    ]);

    echo "Data berhasil disisipkan.";
} catch (PDOException $e) {
    echo "Gagal menyisipkan data: " . $e->getMessage();
}
?>
