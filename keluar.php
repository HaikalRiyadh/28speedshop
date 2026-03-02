<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Barang Keluar - 28SpeedShop</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3 fw-bold" href="index.php">
            <i class="fas fa-motorcycle me-2"></i>28SpeedShop
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Utama</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-down text-success"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link active" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-up text-danger"></i></div>
                            Barang Keluar
                        </a>
                        <div class="sb-sidenav-menu-heading">Akun</div>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                   
                    <i class="fas fa-user-shield me-1"></i>Admin
                    <div class="small text-muted mt-1"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?></div>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="mb-0 fw-bold"><i class="fas fa-arrow-up me-2 text-danger"></i>Barang Keluar</h1>
                            <p class="text-muted mt-1 mb-0">Riwayat barang yang keluar dari toko</p>
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    <?php if (isset($_SESSION['msg_error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $_SESSION['msg_error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['msg_error']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['msg_success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo $_SESSION['msg_success']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['msg_success']); ?>
                    <?php endif; ?>

                    <!-- Summary -->
                    <?php
                    $totalKeluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM keluar"))['total'];
                    $totalQtyKeluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(qty),0) as total FROM keluar"))['total'];
                    ?>
                    <div class="row mb-4">
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card border-0 shadow-sm card-summary">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-circle bg-danger bg-opacity-10 me-3">
                                        <i class="fas fa-clipboard-list fa-lg text-danger"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small text-uppercase">Total Transaksi Keluar</div>
                                        <div class="fs-3 fw-bold"><?php echo $totalKeluar; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="card border-0 shadow-sm card-summary">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-circle bg-warning bg-opacity-10 me-3">
                                        <i class="fas fa-boxes-packing fa-lg text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small text-uppercase">Total Qty Keluar</div>
                                        <div class="fs-3 fw-bold"><?php echo $totalQtyKeluar; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0 fw-semibold"><i class="fas fa-table me-2 text-muted"></i>Riwayat Barang Keluar</h5>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus me-1"></i> Tambah Barang Keluar
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="60">No</th>
                                            <th>Nama Barang</th>
                                            <th width="100">Qty</th>
                                            <th>Keterangan</th>
                                            <th width="170">Tanggal</th>
                                            <th width="140">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = mysqli_query($conn, "SELECT k.*, s.namabarang FROM keluar k JOIN stock s ON k.idbarang = s.idbarang ORDER BY k.tanggal DESC");
                                        while ($row = mysqli_fetch_assoc($data)) {
                                        ?>
                                        <tr>
                                            <td class="text-muted"><?php echo $no++; ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($row['namabarang']); ?></td>
                                            <td><span class="badge bg-danger rounded-pill px-3 py-2">-<?php echo $row['qty']; ?></span></td>
                                            <td class="text-muted"><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                            <td>
                                                <i class="fas fa-calendar-alt text-muted me-1"></i>
                                                <?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning me-1 btn-edit-keluar"
                                                    data-id="<?php echo $row['idkeluar']; ?>"
                                                    data-idbarang="<?php echo $row['idbarang']; ?>"
                                                    data-qty="<?php echo $row['qty']; ?>"
                                                    data-keterangan="<?php echo htmlspecialchars($row['keterangan'], ENT_QUOTES); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editKeluarModal">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini? Stok akan dikembalikan.')">
                                                    <input type="hidden" name="idkeluar" value="<?php echo $row['idkeluar']; ?>">
                                                    <input type="hidden" name="idbarang" value="<?php echo $row['idbarang']; ?>">
                                                    <input type="hidden" name="qty"      value="<?php echo $row['qty']; ?>">
                                                    <button type="submit" name="deletebarangkeluar" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                     <div class="text-center small text-muted">28SpeedShop</div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Edit Barang Keluar -->
    <div class="modal fade" id="editKeluarModal" tabindex="-1" aria-labelledby="editKeluarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editKeluarModalLabel"><i class="fas fa-edit me-2"></i>Edit Barang Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <div class="modal-body p-4">
                        <input type="hidden" name="idkeluar" id="edit_idkeluar">
                        <input type="hidden" name="idbarang" id="edit_keluar_idbarang">
                        <input type="hidden" name="qty_lama" id="edit_keluar_qty_lama">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Keluar</label>
                            <input id="edit_keluar_qty" type="number" name="qty" class="form-control" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <input id="edit_keluar_keterangan" type="text" name="keterangan" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" name="updatebarangkeluar"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang Keluar -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="myModalLabel"><i class="fas fa-arrow-up me-2"></i>Tambah Barang Keluar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="idbarang" class="form-label fw-semibold">Pilih Barang</label>
                            <select name="idbarang" id="idbarang" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Barang --</option>
                                <?php
                                $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stock ORDER BY namabarang ASC");
                                while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                ?>
                                    <option value="<?php echo $fetcharray['idbarang']; ?>"><?php echo htmlspecialchars($fetcharray['namabarang']); ?> (Stok: <?php echo $fetcharray['stock']; ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label fw-semibold">Jumlah Keluar</label>
                            <input id="qty" type="number" name="qty" class="form-control" placeholder="Masukkan jumlah" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <input id="keterangan" type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" name="addbarangkeluar"><i class="fas fa-save me-1"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        document.querySelectorAll('.btn-edit-keluar').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('edit_idkeluar').value           = this.dataset.id;
                document.getElementById('edit_keluar_idbarang').value    = this.dataset.idbarang;
                document.getElementById('edit_keluar_qty_lama').value    = this.dataset.qty;
                document.getElementById('edit_keluar_qty').value         = this.dataset.qty;
                document.getElementById('edit_keluar_keterangan').value  = this.dataset.keterangan;
            });
        });
    </script>
</body>
</html>
