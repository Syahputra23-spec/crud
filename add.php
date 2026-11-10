<?php
include_once 'config.php'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
$nama_alat=trim($_POST['nama_alat']??''); $tahun=trim($_POST['tahun']??''); $merek=trim($_POST['merek']??''); $lokasi=trim($_POST['lokasi']??'');
if($nama_alat===''||$tahun===''||$merek===''||$lokasi==='') $error='Semua kolom wajib diisi.';
elseif(!filter_var($tahun,FILTER_VALIDATE_INT)||(int)$tahun<1901||(int)$tahun>2155) $error='Tahun harus berupa angka antara 1901 sampai 2155.';
else{$stmt=mysqli_prepare($mysqli,"INSERT INTO alat (nama_alat,tahun,merek,lokasi) VALUES (?,?,?,?)"); mysqli_stmt_bind_param($stmt,"ssss",$nama_alat,$tahun,$merek,$lokasi); if(mysqli_stmt_execute($stmt)){mysqli_stmt_close($stmt);header('Location: index.php?status=added');exit;} $error='Gagal menambahkan data.';mysqli_stmt_close($stmt);}
}
$pageTitle='Tambah Data Alat';$activePage='add';include 'header.php';
?>
<div class="breadcrumb"><a href="index.php">Dashboard</a> / Tambah Data Alat</div>
<div class="page-heading"><div><div class="eyebrow">Formulir inventaris</div><h1>Tambah Alat Elektromedis</h1><p>Masukkan informasi alat baru ke dalam inventaris SIM RS.</p></div><a class="btn btn-light" href="index.php">← Kembali</a></div>
<div class="panel form-panel"><div class="panel-head"><div><div class="panel-title">Informasi Alat</div><div class="panel-subtitle">Lengkapi seluruh informasi berikut</div></div></div><div class="form-body">
<?php if($error): ?><div class="notice notice-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="add.php"><div class="form-grid">
<div class="form-group full"><label for="nama_alat">Nama Alat</label><input class="form-control" id="nama_alat" name="nama_alat" placeholder="Contoh: Patient Monitor" value="<?= htmlspecialchars($_POST['nama_alat']??'') ?>" required></div>
<div class="form-group"><label for="tahun">Tahun</label><input class="form-control" id="tahun" type="number" name="tahun" min="1901" max="2155" placeholder="Contoh: 2024" value="<?= htmlspecialchars($_POST['tahun']??'') ?>" required><span class="form-hint">Tahun produksi atau pengadaan</span></div>
<div class="form-group"><label for="merek">Merek</label><input class="form-control" id="merek" name="merek" placeholder="Contoh: Mindray" value="<?= htmlspecialchars($_POST['merek']??'') ?>" required></div>
<div class="form-group full"><label for="lokasi">Lokasi</label><input class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Ruang ICU" value="<?= htmlspecialchars($_POST['lokasi']??'') ?>" required></div>
</div><div class="form-actions"><a class="btn btn-light" href="index.php">Batal</a><button class="btn btn-primary" type="submit">✓ Simpan Data</button></div></form>
</div></div><?php include 'footer.php'; ?>