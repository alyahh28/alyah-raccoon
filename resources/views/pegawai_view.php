<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Data Pegawai</h1>
    <p><b>Nama:</b> <?= $name ?></p>
    <p><b>Umur:</b> <?= $my_age ?> tahun</p>
    <p><b>Hobi:</b></p>
    <ul>
        <?php foreach ($hobbies as $hobi): ?>
            <li><?= $hobi ?></li>
        <?php endforeach; ?>
    </ul>
    <p><b>Tanggal Harus Wisuda:</b> <?= $tgl_harus_wisuda ?></p>
    <p><b>Waktu tersisa:</b> <?= $time_to_study_left ?> hari</p>
    <p><b>Semester Saat Ini:</b> <?= $current_semester ?> (<?= $semester_message ?>)</p>
    <p><b>Cita-cita:</b> <?= $future_goal ?></p>
</body>
</html>
