<?php
    $nama = htmlspecialchars($d['nama'] ?? '');
    $foto = $d['foto'];
    // Use local placeholder if no photo
    $foto_url = (!empty($foto) && file_exists('uploads/dosen/' . $foto)) 
        ? 'uploads/dosen/' . $foto 
        : 'assets/img/pp.png';
    
    // JSON encode to pass safely to JS
    $dataJson = htmlspecialchars(json_encode([
        'nama' => $nama,
        'foto' => $foto_url,
        'jabatan' => $d['jabatan'] ?? '-',
        'nidn' => $d['nidn'] ?? '-',
        'program_studi' => $d['program_studi'] ?? '-',
        'keahlian' => $d['keahlian'] ?? '-',
        'pendidikan' => $d['pendidikan'] ?? '-',
        'status' => $d['status'] ?? '-',
        'email' => $d['email'] ?? '#'
    ]), ENT_QUOTES, 'UTF-8');
?>
<div class="profile-card stagger-item" onclick="showDosen(<?= $dataJson ?>)">
    <img src="<?= $foto_url ?>" alt="<?= $nama ?>" class="profile-image" onerror="this.src='assets/img/pp.png'">
    <div class="profile-body">
        <h4 class="profile-name"><?= $nama ?></h4>
        <p class="profile-role"><?= htmlspecialchars($d['jabatan']) ?></p>
        <div class="profile-meta">
            <span><?= htmlspecialchars($d['nidn']) ?></span>
        </div>
    </div>
</div>
