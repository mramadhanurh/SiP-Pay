<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Siswa</h3>
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
                    <a href="#">Siswa</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Siswa</div>
                            <div class="card-tools">
                                <?php if (session('level') == 1) : ?>
                                    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#add-data">
                                        Tambah Siswa
                                    </button>
                                <?php endif; ?>
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
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <?php if (session('level') == 1) : ?>
                                            <th>Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <?php if (session('level') == 1) : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($siswa as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $value['nisn'] ?></td>
                                            <td><?= $value['nama_siswa'] ?></td>
                                            <td><?= $value['nama_kelas'] ?></td>
                                            <td><?= $value['tahun'] ?></td>
                                            <?php if (session('level') == 1) : ?>
                                                <td class="text-center">
                                                    <button class="btn btn-icon btn-round btn-success" data-bs-toggle="modal" data-bs-target="#edit-data<?= $value['id_siswa'] ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-icon btn-round btn-danger" data-bs-toggle="modal" data-bs-target="#delete-data<?= $value['id_siswa'] ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            <?php endif; ?>
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
            <?php echo form_open('Siswa/InsertData') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NISN</label>
                        <input name="nisn" class="form-control" placeholder="NISN" required>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input name="nama_siswa" class="form-control" placeholder="Nama Siswa" required>
                    </div>

                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <option value="">--Pilih Kelas--</option>
                            <?php foreach ($kelas as $key => $value) { ?>
                                <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
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

                    <hr>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input name="password" class="form-control" placeholder="Password" required>
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
<?php foreach ($siswa as $key => $value) { ?>
<div class="modal fade" id="edit-data<?= $value['id_siswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Siswa/UpdateData/' . $value['id_siswa']) ?>
                <div class="modal-body">

                <div class="form-group">
                        <label for="">NISN</label>
                        <input name="nisn" class="form-control" value="<?= $value['nisn'] ?>" placeholder="NISN" required>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input name="nama_siswa" class="form-control" value="<?= $value['nama_siswa'] ?>" placeholder="Nama Siswa" required>
                    </div>

                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <option value="">--Pilih Kelas--</option>
                            <?php foreach ($kelas as $key => $k) { ?>
                                <option value="<?= $k['id_kelas'] ?>" <?= $value['id_kelas'] == $k['id_kelas'] ? 'Selected' : '' ?>><?= $k['nama_kelas'] ?></option>
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

                    <hr>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input name="password" class="form-control" placeholder="Password">
                        <small class="text-danger">*Kosongkan jika tidak ada pembaruan.</small>
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
<?php foreach ($siswa as $key => $value) { ?>
<div class="modal fade" id="delete-data<?= $value['id_siswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Delete Data <?= $subjudul ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    Apakah Anda Yakin Hapus <b><?= $value['nama_siswa'] ?></b> ..?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="<?= base_url('Siswa/DeleteData/' . $value['id_siswa']) ?>" class="btn btn-danger">Delete</a>
                </div>
        </div>
    </div>
</div>
<?php } ?>