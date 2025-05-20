<!DOCTYPE html>
<html>

<head>
    <title><?= $judul ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .judul {
            text-align: center;
            font-size: 18pt;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table td,
        .table th {
            border: 1px solid black;
            padding: 8px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="judul"><?= $judul ?></div>

    <table class="table">
        <tr>
            <th>Nama Siswa</th>
            <td><?= $transaksi['nama_siswa'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Bayar</th>
            <td><?= date('d-m-Y', strtotime($transaksi['tanggal_bayar'])) ?></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td><?= 'Rp ' . number_format($transaksi['jumlah_bayar'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Metode</th>
            <td>
                <?= $transaksi['metode_bayar'] == 1 ? 'Transfer' : 'Tunai' ?>
            </td>
        </tr>
    </table>

    <p class="text-center">Terima kasih atas pembayaran Anda.</p>
</body>

</html>