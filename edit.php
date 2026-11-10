<?php
include_once 'config.php';$error='';$id=isset($_POST['id'])?(int)$_POST['id']:(int)($_GET['id']??0);
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['update'])){
$nama_alat=trim($_POST['nama_alat']??'');$tahun=trim($_POST['tahun']??'');$merek=trim($_POST['merek']??'');$lokasi=trim($_POST['lokasi']??'');
if($nama_alat===''||$tahun===''||$merek===''||$lokasi==='')$error='Semua kolom wajib diisi.';
elseif(!filter_var($tahun,FILTER_VALIDATE_INT)||(int)$tahun<1901||(int)$tahun>2155)$error='Tahun harus berupa angka antara 1901 sampai 2155.';
else{$stmt=mysqli_prepare($mysqli,"UPDATE alat SET nama_alat=?,tahun=?,merek=?,lokasi=? WHERE id=?");mysqli_stmt_bind_param($stmt,"ssssi",$nama_alat,$tahun,$merek,$lokasi,$id);if(mysqli_stmt_execute($stmt)){mysqli_stmt_close($stmt);header('Location: index.php?status=updated');exit;}$error='Gagal memperbarui data.';mysqli_stmt_close($stmt);}
}
$stmt=mysqli_prepare($mysqli,"SELECT * FROM alat WHERE id=?");mysqli_stmt_bind_param($stmt,"i",$id);mysqli_stmt_execute($stmt);$result=mysqli_stmt_get_result($stmt);$user_data=mysqli_fetch_assoc($result);mysqli_stmt_close($stmt);
if(!$user_data){http_response_code(404);die('Data alat tidak ditemukan. <a href="index.php">Kembali ke dashboard</a>');}
$pageTitle='Edit Data Alat';$activePage='dashboard';include 'header.php';
?>
<div class="breadcrumb"><a href="index.php">Dashboard</a> / Edit Data Alat</div>
<div class="page-heading"><div><div class="eyebrow">Pembaruan inventaris</div><h1>Edit Data Alat</h1><p>Perbarui informasi alat elektromedis yang sudah terdaftar.</p></div><a class="btn btn-light" href="index.php">← Kembali</a></div>
<div class="panel form-panel"><div class="panel-head"><div><div class="panel-title">Informasi Alat</div><div class="panel-subtitle">ID data: #<?= (int)$user_data['id'] ?></div></div></div><div class="form-body">
<?php if($error): ?><div class="notice notice-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="edit.php"><input type="hidden" name="id" value="<?= (int)$user_data['id'] ?>"><div class="form-grid">
<div class="form-group full"><label for="nama_alat">Nama Alat</label><input class="form-control" id="nama_alat" name="nama_alat" value="<?= htmlspecialchars($_POST['nama_alat']??$user_data['nama_alat']) ?>" required></div>
<div class="form-group"><label for="tahun">Tahun</label><input class="form-control" id="tahun" type="number" name="tahun" min="1901" max="2155" value="<?= htmlspecialchars($_POST['tahun']??$user_data['tahun']) ?>" required></div>
<div class="form-group"><label for="merek">Merek</label><input class="form-control" id="merek" name="merek" value="<?= htmlspecialchars($_POST['merek']??$user_data['merek']) ?>" required></div>
<div class="form-group full"><label for="lokasi">Lokasi</label><input class="form-control" id="lokasi" name="lokasi" value="<?= htmlspecialchars($_POST['lokasi']??$user_data['lokasi']) ?>" required></div>
</div><div class="form-actions"><a class="btn btn-light" href="index.php">Batal</a><button class="btn btn-primary" type="submit" name="update">✓ Simpan Perubahan</button></div></form>
</div></div><?php include 'footer.php'; ?>