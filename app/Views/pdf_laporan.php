<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        h3 {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3><?= $judul ?></h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">User</th>
                <th class="text-center">Pembayaran</th>
                <th class="text-center">Tanggal Bayar</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Metode</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($transaksi as $value) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $value['nama_user'] ?></td>
                    <td class="text-center"><?= $value['nama_siswa'] ?></td>
                    <td class="text-center"><?= date('d-m-Y', strtotime($value['tanggal_bayar'])) ?></td>
                    <td class="text-center"><?= 'Rp ' . number_format($value['jumlah_bayar'], 0, ',', '.') ?></td>
                    <td class="text-center">
                        <?php
                        if ($value['metode_bayar'] == 1) {
                            echo '<span class="badge bg-success">Transfer</span>';
                        } elseif ($value['metode_bayar'] == 2) {
                            echo '<span class="badge bg-danger">Tunai</span>';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>