<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Pembayaran</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="/home">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Pembayaran</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Pembayaran</div>
                            <div class="card-tools">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (session()->getFlashdata('pesan')) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <h5><i class="icon fas fa-check"></i> ';
                            echo session()->getFlashdata('pesan');
                            echo '</h5></div>';
                        }
                        ?>

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Pembayaran</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Cetak Pembayaran</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <th>No.</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Cetak Pembayaran</th>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($transaksi as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
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
                                            <td class="text-center">
                                                <a href="<?= base_url('Transaksipembayaran/CetakTransaksi/' . $value['id_transaksi_pembayaran']) ?>" target="_blank" class="btn btn-success btn-sm">
                                                    <i class="fas fa-print"></i> Cetak
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>