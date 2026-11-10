<?php
include_once 'config.php';
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
if (!$result) die('Gagal mengambil data alat.');
$totalAlat = (int) mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM alat"))['total'];
$totalMerek = (int) mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(DISTINCT merek) AS total FROM alat"))['total'];
$totalLokasi = (int) mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(DISTINCT lokasi) AS total FROM alat"))['total'];
$pageTitle='Dashboard'; $activePage='dashboard'; include 'header.php';
?>
<div class="page-heading"><div><div class="eyebrow">Ringkasan inventaris</div><h1>Dashboard Alat Elektromedis</h1><p>Kelola dan pantau data inventaris alat elektromedis rumah sakit.</p></div><a class="btn btn-primary" href="add.php">＋ Tambah Alat</a></div>
<div class="stats-grid">
<div class="stat-card"><div><div class="stat-label">Total Alat Terdaftar</div><div class="stat-value"><?= number_format($totalAlat) ?></div><div class="stat-note">Seluruh data inventaris</div></div><div class="stat-icon">⚕</div></div>
<div class="stat-card"><div><div class="stat-label">Merek Alat</div><div class="stat-value"><?= number_format($totalMerek) ?></div><div class="stat-note">Merek berbeda terdata</div></div><div class="stat-icon">▣</div></div>
<div class="stat-card"><div><div class="stat-label">Lokasi Penempatan</div><div class="stat-value"><?= number_format($totalLokasi) ?></div><div class="stat-note">Lokasi berbeda terdata</div></div><div class="stat-icon">⌖</div></div>
</div>
<div class="panel"><div class="panel-head"><div><div class="panel-title">Data Inventaris Alat</div><div class="panel-subtitle">Daftar alat elektromedis yang tersimpan di sistem</div></div><label class="search-box"><span>⌕</span><input type="search" id="tableSearch" placeholder="Cari nama, merek, lokasi..."></label></div>
<div class="table-wrap"><table id="alatTable"><thead><tr><th>No.</th><th>Nama Alat</th><th>Tahun</th><th>Merek</th><th>Lokasi</th><th>Aksi</th></tr></thead><tbody>
<?php if(mysqli_num_rows($result)>0): $i=1; while($row=mysqli_fetch_assoc($result)): ?>
<tr data-row><td class="number-cell"><?= $i++ ?></td><td><span class="device-name"><?= htmlspecialchars($row['nama_alat']) ?></span></td><td><?= htmlspecialchars($row['tahun']) ?></td><td><span class="device-tag"><?= htmlspecialchars($row['merek']) ?></span></td><td><?= htmlspecialchars($row['lokasi']) ?></td><td><div class="action-group"><a class="action-btn action-edit" href="edit.php?id=<?= (int)$row['id'] ?>">✎ Edit</a><a class="action-btn action-delete" href="delete.php?id=<?= (int)$row['id'] ?>" data-confirm="Yakin ingin menghapus data alat ini?">Hapus</a></div></td></tr>
<?php endwhile; else: ?><tr><td colspan="6"><div class="empty-state"><div class="empty-icon">▤</div><strong>Belum ada data alat</strong>Mulai dengan menambahkan data alat elektromedis pertama.</div></td></tr><?php endif; ?>
</tbody></table></div><div class="panel-foot">Menampilkan <?= number_format($totalAlat) ?> data alat elektromedis</div></div>
<?php include 'footer.php'; ?>