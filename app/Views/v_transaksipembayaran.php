<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Transaksi Pembayaran</h3>
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
                    <a href="#">Transaksi Pembayaran</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Transaksi Pembayaran</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#add-data">
                                    Tambah Transaksi Pembayaran
                                </button>
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
                                        <th>User</th>
                                        <th>Pembayaran</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($transaksi as $key => $value) { ?>
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
                                            <td class="text-center">
                                            <?php
                                                if ($value['status_notif'] == 1) {
                                                    echo '<span class="badge bg-success">Sudah Notifikasi</span>';
                                                } elseif ($value['status_notif'] == 0) {
                                                    echo '<span class="badge bg-danger">Belum Notifikasi</span>';
                                                } else {
                                                    echo '-';
                                                }
                                            ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('bukti_bayar/' . $value['bukti_bayar']) ?>" target="_blank" title="Lihat Bukti Bayar">
                                                    <i class="fas fa-image fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-icon btn-round btn-success" data-bs-toggle="modal" data-bs-target="#edit-data<?= $value['id_transaksi_pembayaran'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-icon btn-round btn-danger" data-bs-toggle="modal" data-bs-target="#delete-data<?= $value['id_transaksi_pembayaran'] ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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

<!-- Modal Add Data -->
<div class="modal fade" id="add-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Add Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Transaksipembayaran/InsertData') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama User</label>
                        <select name="id_user" class="form-control">
                            <option value="">--Pilih Nama User--</option>
                            <?php foreach ($user as $key => $value) { ?>
                                <option value="<?= $value['id_user'] ?>"><?= $value['nama_user'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pembayaran</label>
                        <select name="id_pembayaran" class="form-control">
                            <option value="">--Pilih Pembayaran--</option>
                            <?php foreach ($pembayaran as $key => $value) { ?>
                                <option value="<?= $value['id_pembayaran'] ?>"><?= $value['nama_siswa'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input name="jumlah_bayar" class="form-control" placeholder="Jumlah" required>
                    </div>

                    <div class="form-group">
                        <label for="">Metode</label>
                        <select name="metode_bayar" class="form-control">
                            <option value="1">Transfer</option>
                            <option value="2" selected>Tunai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status_notif" class="form-control">
                            <option value="1">Sudah Notifikasi</option>
                            <option value="0" selected>Belum Notifikasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Bukti</label>
                        <input type="file" name="bukti_bayar" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($transaksi as $key => $value) { ?>
<div class="modal fade" id="edit-data<?= $value['id_transaksi_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Transaksipembayaran/UpdateData/' . $value['id_transaksi_pembayaran']) ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Nama User</label>
                        <select name="id_user" class="form-control">
                            <option value="">--Pilih Nama User--</option>
                            <?php foreach ($user as $key => $u) { ?>
                                <option value="<?= $u['id_user'] ?>" <?= $value['id_user'] == $u['id_user'] ? 'Selected' : '' ?>><?= $u['nama_user'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pembayaran</label>
                        <select name="id_pembayaran" class="form-control">
                            <option value="">--Pilih Pembayaran--</option>
                            <?php foreach ($pembayaran as $key => $p) { ?>
                                <option value="<?= $p['id_pembayaran'] ?>" <?= $value['id_pembayaran'] == $p['id_pembayaran'] ? 'Selected' : '' ?>><?= $p['nama_siswa'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" value="<?= $value['tanggal_bayar'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input name="jumlah_bayar" class="form-control" value="<?= $value['jumlah_bayar'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="">Metode</label>
                        <select name="metode_bayar" class="form-control">
                            <option value="1" <?= $value['metode_bayar'] == 1 ? 'Selected' : '' ?>>Transfer</option>
                            <option value="2" <?= $value['metode_bayar'] == 2 ? 'Selected' : '' ?>>Tunai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status_notif" class="form-control">
                            <option value="1" <?= $value['status_notif'] == 1 ? 'Selected' : '' ?>>Sudah Notifikasi</option>
                            <option value="0" <?= $value['status_notif'] == 0 ? 'Selected' : '' ?>>Belum Notifikasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Bukti</label>
                        <input type="file" name="bukti_bayar" class="form-control">
                        <small class="text-danger">Kosongkan jika tidak ingin mengganti.</small>
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

<!-- Modal Delete Data -->
<?php foreach ($transaksi as $key => $value) { ?>
<div class="modal fade" id="delete-data<?= $value['id_transaksi_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Delete Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus <b><?= $value['nama_siswa'] ?> <?= 'Rp ' . number_format($value['jumlah_bayar'], 0, ',', '.') ?></b> ..?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="<?= base_url('Transaksipembayaran/DeleteData/' . $value['id_transaksi_pembayaran']) ?>" class="btn btn-danger">Delete</a>
                </div>
        </div>
    </div>
</div>
<?php } ?>