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
                                        <th>Konfirmasi Bukti Bayar</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <th>No.</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Konfirmasi Bukti Bayar</th>
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
                                                <?php if (empty($value['bukti_bayar'])) { ?>
                                                    <button class="btn btn-icon btn-round btn-primary" data-bs-toggle="modal" data-bs-target="#edit-data<?= $value['id_transaksi_pembayaran'] ?>">
                                                        <i class="fas fa-image fa-2x"></i>
                                                    </button>
                                                <?php } else { ?>
                                                    <span class="text-muted">Sudah Upload</span>
                                                <?php } ?>
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

<!-- Modal Edit Data -->
<?php foreach ($transaksi as $key => $value) { ?>
<div class="modal fade" id="edit-data<?= $value['id_transaksi_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Bukti Bayar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Transaksipembayaran/UpdateDataPembayaranOrangtua/' . $value['id_transaksi_pembayaran']) ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Bukti</label>
                        <input type="file" name="bukti_bayar" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php } ?>