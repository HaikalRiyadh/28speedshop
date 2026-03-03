<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "28speedshop");
if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

/* ==========================
   UPDATE BARANG
========================== */
if (isset($_POST['updatebarang'])) {
    $idbarang   = $_POST['idbarang'] ?? '';
    $namabarang = $_POST['namabarang'] ?? '';
    $deskripsi  = $_POST['deskripsi'] ?? '';

    $stmt = $conn->prepare("UPDATE stock SET namabarang = ?, deskripsi = ? WHERE idbarang = ?");
    $stmt->bind_param("ssi", $namabarang, $deskripsi, $idbarang);
    $stmt->execute();

    $_SESSION['msg_success'] = "Data barang berhasil diperbarui.";
    header('Location: index.php');
    exit;
}

/* ==========================
   DELETE BARANG
========================== */
if (isset($_POST['deletebarang'])) {
    $idbarang = $_POST['idbarang'] ?? '';

    $stmt = $conn->prepare("DELETE FROM stock WHERE idbarang = ?");
    $stmt->bind_param("i", $idbarang);
    $stmt->execute();

    $_SESSION['msg_success'] = "Data barang berhasil dihapus.";
    header('Location: index.php');
    exit;
}

/* ==========================
   TAMBAH BARANG BARU
========================== */
if (isset($_POST['addnewbarang'])) {

    $namabarang = $_POST['namabarang'] ?? '';
    $deskripsi  = $_POST['deskripsi'] ?? '';
    $stock      = $_POST['stock'] ?? 0;

    $stmt = $conn->prepare("INSERT INTO stock (namabarang, deskripsi, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $namabarang, $deskripsi, $stock);

    $stmt->execute();
    header('Location: index.php');
    exit;
}


/* ==========================
   TAMBAH BARANG MASUK
========================== */
if (isset($_POST['addbarangmasuk'])) {

    $idbarang  = $_POST['idbarang'] ?? '';
    $qty       = $_POST['qty'] ?? 0;
    $keterangan = $_POST['keterangan'] ?? '';

    if ($idbarang == '' || $qty <= 0) {
        $_SESSION['msg_error'] = "Data tidak valid. Pastikan barang dan jumlah sudah benar.";
        header('Location: masuk.php');
        exit;
    }

    // simpan transaksi masuk
    $stmt1 = $conn->prepare("INSERT INTO masuk (idbarang, qty, keterangan) VALUES (?, ?, ?)");
    $stmt1->bind_param("iis", $idbarang, $qty, $keterangan);
    $stmt1->execute();

    // update total stok
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock + ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $qty, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang masuk berhasil ditambahkan.";
    header('Location: masuk.php');
    exit;
}


/* ==========================
   TAMBAH BARANG KELUAR
========================== */
if (isset($_POST['addbarangkeluar'])) {

    $idbarang   = $_POST['idbarang'] ?? '';
    $qty        = $_POST['qty'] ?? 0;
    $keterangan = $_POST['keterangan'] ?? '';

    if ($idbarang == '' || $qty <= 0) {
        $_SESSION['msg_error'] = "Data tidak valid. Pastikan barang dan jumlah sudah benar.";
        header('Location: keluar.php');
        exit;
    }

    // cek stok cukup atau tidak
    $cek = $conn->prepare("SELECT stock, namabarang FROM stock WHERE idbarang = ?");
    $cek->bind_param("i", $idbarang);
    $cek->execute();
    $result = $cek->get_result();
    $row = $result->fetch_assoc();

    if (!$row || $row['stock'] < $qty) {
        $namaBarang = $row ? $row['namabarang'] : 'Barang';
        $stokTersedia = $row ? $row['stock'] : 0;
        $_SESSION['msg_error'] = "Stok '$namaBarang' tidak mencukupi! Sisa stok: $stokTersedia, jumlah diminta: $qty.";
        header('Location: keluar.php');
        exit;
    }

    // simpan transaksi keluar
    $stmt1 = $conn->prepare("INSERT INTO keluar (idbarang, qty, keterangan) VALUES (?, ?, ?)");
    $stmt1->bind_param("iis", $idbarang, $qty, $keterangan);
    $stmt1->execute();

    // update total stok (kurangi)
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock - ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $qty, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang keluar berhasil ditambahkan.";
    header('Location: keluar.php');
    exit;
}

/* ==========================
   UPDATE BARANG MASUK
========================== */
if (isset($_POST['updatebarangmasuk'])) {
    $idmasuk    = (int)($_POST['idmasuk'] ?? 0);
    $idbarang   = (int)($_POST['idbarang'] ?? 0);
    $qty_lama   = (int)($_POST['qty_lama'] ?? 0);
    $qty_baru   = (int)($_POST['qty'] ?? 0);
    $keterangan = $_POST['keterangan'] ?? '';

    // Perbarui record transaksi
    $stmt = $conn->prepare("UPDATE masuk SET qty = ?, keterangan = ? WHERE idmasuk = ?");
    $stmt->bind_param("isi", $qty_baru, $keterangan, $idmasuk);
    $stmt->execute();

    // Sesuaikan stok: tambah selisih (qty_baru - qty_lama)
    $selisih = $qty_baru - $qty_lama;
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock + ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $selisih, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang masuk berhasil diperbarui.";
    header('Location: masuk.php');
    exit;
}

/* ==========================
   DELETE BARANG MASUK
========================== */
if (isset($_POST['deletebarangmasuk'])) {
    $idmasuk  = (int)($_POST['idmasuk'] ?? 0);
    $idbarang = (int)($_POST['idbarang'] ?? 0);
    $qty      = (int)($_POST['qty'] ?? 0);

    // Hapus record transaksi
    $stmt = $conn->prepare("DELETE FROM masuk WHERE idmasuk = ?");
    $stmt->bind_param("i", $idmasuk);
    $stmt->execute();

    // Kurangi stok kembali (batalkan efek masuk)
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock - ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $qty, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang masuk berhasil dihapus.";
    header('Location: masuk.php');
    exit;
}

/* ==========================
   UPDATE BARANG KELUAR
========================== */
if (isset($_POST['updatebarangkeluar'])) {
    $idkeluar   = (int)($_POST['idkeluar'] ?? 0);
    $idbarang   = (int)($_POST['idbarang'] ?? 0);
    $qty_lama   = (int)($_POST['qty_lama'] ?? 0);
    $qty_baru   = (int)($_POST['qty'] ?? 0);
    $keterangan = $_POST['keterangan'] ?? '';

    // Cek apakah stok mencukupi setelah penyesuaian
    $cek = $conn->prepare("SELECT stock FROM stock WHERE idbarang = ?");
    $cek->bind_param("i", $idbarang);
    $cek->execute();
    $result = $cek->get_result();
    $row = $result->fetch_assoc();
    $stok_sekarang = $row ? (int)$row['stock'] : 0;

    if (($stok_sekarang + $qty_lama - $qty_baru) < 0) {
        $_SESSION['msg_error'] = "Stok tidak mencukupi untuk memperbarui data keluar.";
        header('Location: keluar.php');
        exit;
    }

    // Perbarui record transaksi
    $stmt = $conn->prepare("UPDATE keluar SET qty = ?, keterangan = ? WHERE idkeluar = ?");
    $stmt->bind_param("isi", $qty_baru, $keterangan, $idkeluar);
    $stmt->execute();

    // Sesuaikan stok: kembalikan qty_lama, kurangi qty_baru
    $selisih = $qty_lama - $qty_baru;
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock + ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $selisih, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang keluar berhasil diperbarui.";
    header('Location: keluar.php');
    exit;
}

/* ==========================
   DELETE BARANG KELUAR
========================== */
if (isset($_POST['deletebarangkeluar'])) {
    $idkeluar = (int)($_POST['idkeluar'] ?? 0);
    $idbarang = (int)($_POST['idbarang'] ?? 0);
    $qty      = (int)($_POST['qty'] ?? 0);

    // Hapus record transaksi
    $stmt = $conn->prepare("DELETE FROM keluar WHERE idkeluar = ?");
    $stmt->bind_param("i", $idkeluar);
    $stmt->execute();

    // Kembalikan stok (batalkan efek keluar)
    $stmt2 = $conn->prepare("UPDATE stock SET stock = stock + ? WHERE idbarang = ?");
    $stmt2->bind_param("ii", $qty, $idbarang);
    $stmt2->execute();

    $_SESSION['msg_success'] = "Data barang keluar berhasil dihapus.";
    header('Location: keluar.php');
    exit;
}
?>