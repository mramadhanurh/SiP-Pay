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
                                <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#add-data">
                                    Tambah Pembayaran
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
                                        <th>Nama Siswa</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Tagihan</th>
                                        <th>Status</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Tagihan</th>
                                    <th>Status</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Aksi</th>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pembayaran as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $value['nama_siswa'] ?></td>
                                            <td class="text-center"><?= $value['tahun'] ?> <?= $value['semester'] ?></td>
                                            <td class="text-center"><?= 'Rp ' . number_format($value['jumlah_tagihan'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                            <?php
                                                if ($value['status'] == 1) {
                                                    echo '<span class="badge bg-success">Lunas</span>';
                                                } elseif ($value['status'] == 2) {
                                                    echo '<span class="badge bg-danger">Belum Lunas</span>';
                                                } else {
                                                    echo '-';
                                                }
                                            ?>
                                            </td>
                                            <td><?= $value['tgl_jatuh_tempo'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-icon btn-round btn-success" data-bs-toggle="modal" data-bs-target="#edit-data<?= $value['id_pembayaran'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-icon btn-round btn-danger" data-bs-toggle="modal" data-bs-target="#delete-data<?= $value['id_pembayaran'] ?>">
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
            <?php echo form_open('Pembayaran/InsertData') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <select name="id_siswa" class="form-control">
                            <option value="">--Pilih Nama Siswa--</option>
                            <?php foreach ($siswa as $key => $value) { ?>
                                <option value="<?= $value['id_siswa'] ?>"><?= $value['nama_siswa'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="id_tahun_ajaran" class="form-control">
                            <option value="">--Pilih Tahun Ajaran--</option>
                            <?php foreach ($tahun_ajaran as $key => $value) { ?>
                                <option value="<?= $value['id_tahun_ajaran'] ?>"><?= $value['tahun'] ?> <?= $value['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tagihan</label>
                        <input name="jumlah_tagihan" class="form-control" placeholder="Tagihan" required>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Lunas</option>
                            <option value="2" selected>Belum Lunas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Jatuh Tempo</label>
                        <input type="date" name="tgl_jatuh_tempo" class="form-control" required>
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
<?php foreach ($pembayaran as $key => $value) { ?>
<div class="modal fade" id="edit-data<?= $value['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Pembayaran/UpdateData/' . $value['id_pembayaran']) ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <select name="id_siswa" class="form-control">
                            <option value="">--Pilih Nama Siswa--</option>
                            <?php foreach ($siswa as $key => $s) { ?>
                                <option value="<?= $s['id_siswa'] ?>" <?= $value['id_siswa'] == $s['id_siswa'] ? 'Selected' : '' ?>><?= $s['nama_siswa'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tahun Ajaran</label>
                        <select name="id_tahun_ajaran" class="form-control">
                            <option value="">--Pilih Tahun Ajaran--</option>
                            <?php foreach ($tahun_ajaran as $key => $ta) { ?>
                                <option value="<?= $ta['id_tahun_ajaran'] ?>" <?= $value['id_tahun_ajaran'] == $ta['id_tahun_ajaran'] ? 'Selected' : '' ?>><?= $ta['tahun'] ?> <?= $ta['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tagihan</label>
                        <input name="jumlah_tagihan" class="form-control" value="<?= $value['jumlah_tagihan'] ?>" placeholder="Tagihan" required>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?= $value['status'] == 1 ? 'Selected' : '' ?>>Lunas</option>
                            <option value="2" <?= $value['status'] == 2 ? 'Selected' : '' ?>>Belum Lunas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Jatuh Tempo</label>
                        <input type="date" name="tgl_jatuh_tempo" value="<?= $value['tgl_jatuh_tempo'] ?>" class="form-control" required>
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
<?php foreach ($pembayaran as $key => $value) { ?>
<div class="modal fade" id="delete-data<?= $value['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Delete Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus <b><?= $value['nama_siswa'] ?> <?= $value['tahun'] ?> <?= $value['semester'] ?></b> ..?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="<?= base_url('Pembayaran/DeleteData/' . $value['id_pembayaran']) ?>" class="btn btn-danger">Delete</a>
                </div>
        </div>
    </div>
</div>
<?php } ?>