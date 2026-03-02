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
    <title>Stock Barang - 28SpeedShop</title>
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
                        <a class="nav-link active" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-down text-success"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
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
                            <h1 class="mb-0 fw-bold"><i class="fas fa-boxes-stacked me-2 text-primary"></i>Stock Barang</h1>
                            <p class="text-muted mt-1 mb-0">Kelola semua data barang di toko</p>
                        </div>
                    </div>

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

                    <!-- Summary Cards -->
                    <?php
                    $totalBarang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM stock"))['total'];
                    $totalStock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(stock),0) as total FROM stock"))['total'];
                    $lowStock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM stock WHERE stock <= 5"))['total'];
                    ?>
                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card border-0 shadow-sm card-summary">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-circle bg-primary bg-opacity-10 me-3">
                                        <i class="fas fa-cubes fa-lg text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small text-uppercase">Total Jenis Barang</div>
                                        <div class="fs-3 fw-bold"><?php echo $totalBarang; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card border-0 shadow-sm card-summary">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-circle bg-success bg-opacity-10 me-3">
                                        <i class="fas fa-layer-group fa-lg text-success"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small text-uppercase">Total Semua Stock</div>
                                        <div class="fs-3 fw-bold"><?php echo $totalStock; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card border-0 shadow-sm card-summary">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon-circle bg-warning bg-opacity-10 me-3">
                                        <i class="fas fa-exclamation-triangle fa-lg text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small text-uppercase">Stock Menipis (&le; 5)</div>
                                        <div class="fs-3 fw-bold"><?php echo $lowStock; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                            <h5 class="mb-0 fw-semibold"><i class="fas fa-table me-2 text-muted"></i>Daftar Barang</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus me-1"></i> Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="60">No</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th width="120">Stock</th>
                                            <th width="140">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = mysqli_query($conn, "SELECT * FROM stock ORDER BY namabarang ASC");
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $stockBadge = $row['stock'] <= 5 ? 'bg-danger' : ($row['stock'] <= 20 ? 'bg-warning text-dark' : 'bg-success');
                                        ?>
                                        <tr>
                                            <td class="text-muted"><?php echo $no++; ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($row['namabarang']); ?></td>
                                            <td class="text-muted"><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                            <td>
                                                <span class="badge <?php echo $stockBadge; ?> rounded-pill px-3 py-2"><?php echo $row['stock']; ?></span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning me-1 btn-edit-barang"
                                                    data-id="<?php echo $row['idbarang']; ?>"
                                                    data-nama="<?php echo htmlspecialchars($row['namabarang'], ENT_QUOTES); ?>"
                                                    data-deskripsi="<?php echo htmlspecialchars($row['deskripsi'], ENT_QUOTES); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini? Semua data transaksi terkait juga akan terhapus.')">
                                                    <input type="hidden" name="idbarang" value="<?php echo $row['idbarang']; ?>">
                                                    <button type="submit" name="deletebarang" class="btn btn-sm btn-danger">
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

    <!-- Modal Edit Barang -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i>Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <div class="modal-body p-4">
                        <input type="hidden" name="idbarang" id="edit_idbarang">
                        <div class="mb-3">
                            <label for="edit_namabarang" class="form-label fw-semibold">Nama Barang</label>
                            <input id="edit_namabarang" type="text" name="namabarang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <input id="edit_deskripsi" type="text" name="deskripsi" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" name="updatebarang"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel"><i class="fas fa-plus-circle me-2"></i>Tambah Barang Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="post">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="namabarang" class="form-label fw-semibold">Nama Barang</label>
                            <input id="namabarang" type="text" name="namabarang" class="form-control" placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <input id="deskripsi" type="text" name="deskripsi" class="form-control" placeholder="Deskripsi singkat barang">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label fw-semibold">Stock Awal</label>
                            <input id="stock" type="number" name="stock" class="form-control" placeholder="0" required min="0">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="addnewbarang"><i class="fas fa-save me-1"></i>Simpan</button>
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
        document.querySelectorAll('.btn-edit-barang').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('edit_idbarang').value   = this.dataset.id;
                document.getElementById('edit_namabarang').value = this.dataset.nama;
                document.getElementById('edit_deskripsi').value  = this.dataset.deskripsi;
            });
        });
    </script>
</body>
</html>
