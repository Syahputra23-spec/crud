<?php
$pageTitle = $pageTitle ?? 'Dashboard';
$activePage = $activePage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | SIM RS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="index.php">
            <div class="brand-mark">✚</div>
            <div><strong>SIM RS</strong><small>Manajemen Alat Elektromedis</small></div>
        </a>
        <nav>
            <div class="nav-label">MENU UTAMA</div>
            <a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="index.php"><span class="nav-icon">▦</span>Dashboard</a>
            <a class="nav-link <?= $activePage === 'add' ? 'active' : '' ?>" href="add.php"><span class="nav-icon">＋</span>Tambah Data Alat</a>
            <div class="nav-label" style="margin-top:27px">SISTEM</div>
            <a class="nav-link" href="index.php"><span class="nav-icon">▤</span>Data Inventaris</a>
        </nav>
        <div class="sidebar-bottom">Sistem Informasi Manajemen Rumah Sakit<br>© <?= date('Y') ?> SIM RS</div>
    </aside>
    <main class="main">
        <header class="topbar">
            <div><div class="topbar-title"><?= htmlspecialchars($pageTitle) ?></div><div class="topbar-sub">Sistem Informasi Manajemen Rumah Sakit</div></div>
            <div class="profile"><div class="avatar">RS</div><div><div class="profile-name">Administrator</div><div class="profile-role">Pengelola Inventaris</div></div></div>
        </header>
        <section class="content">
