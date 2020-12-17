<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?> | Excel</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 10px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $filename . ".xls");
    ?>

    <h3><?= $title ?> | Excel</h3>

    <table border="1">
        <thead>
            <tr>
                <th bgcolor="green">No</th>
                <th bgcolor="green">Username</th>
                <th bgcolor="green">Nama</th>
                <th bgcolor="green">Alamat</th>
                <th bgcolor="green">Nomor HP</th>
                <th bgcolor="green">Status Aktif</th>
                <th bgcolor="green">Prodi</th>
                <th bgcolor="green">Status User</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($list_user as $u) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= $u['nama'] ?></td>
                    <td><?= $u['alamat'] ?></td>
                    <td><?= $u['no_hp'] ?></td>
                    <?= ($u['status_aktif'] == 1) ? '<td>Aktif</td>' : '<td>Tidak Aktif</td>'; ?>
                    <td><?= $u['nama_prodi'] ?></td>
                    <td><?= $u['role_nama'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>