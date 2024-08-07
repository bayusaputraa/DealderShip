<?= $this->extend('admin/layout/tamplate') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Kategori Produk
                        </div>
                        <div class="card-body">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#TambahModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>

                            <!-- Notifikasi Berhasil Tambah Data -->
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kategori</th>
                                        <th>Tanggal Input</th>
                                        <th>Fungsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_kategori as $kategori) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $kategori->nama_kategori ?></td>
                                            <td><?= date('d/m/Y H:i:s', strtotime($kategori->tanggal_input)) ?></td>
                                            <td width="15%" class="text-center">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#UbahModal<?= $kategori->id_kategori; ?>"><i class="fas fa-edit"></i>Edit</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#HapusModal<?= $kategori->id_kategori; ?>"><i class="fas fa-trash"></i>Hapus</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <!-- Loop untuk modals ubah data -->
                                <?php foreach ($daftar_kategori as $kategori) : ?>
                                    <!-- Modal Ubah Data -->
                                    <div class="modal fade" id="UbahModal<?= $kategori->id_kategori; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ubah Kategori </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('daftar-kategori/ubah/' . $kategori->id_kategori) ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="mb-3">
                                                            <label for="nama_kategori">Nama Kategori</label>
                                                            <input type="text" name="nama_kategori" id="nama_kategori_<?= $kategori->id_kategori; ?>" class="form-control" value="<?= $kategori->nama_kategori; ?>" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Loop untuk modals Hapus data -->
                                <?php foreach ($daftar_kategori as $kategori) : ?>
                                    <!-- Modal Hapus Data -->
                                    <div class="modal fade" id="HapusModal<?= $kategori->id_kategori; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> Hapus Kategori </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('daftar-kategori/hapus/' . $kategori->id_kategori) ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <div class="mb-3">
                                                            <p>
                                                                Yakin Data Kategori Produk : <?= $kategori->nama_kategori; ?>
                                                            </p>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Modal Tambah Data -->
                                <div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Tambah Kategori </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('daftar-kategori/tambah') ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <div class="mb-3">
                                                        <label for="nama_kategori">Nama Kategori</label>
                                                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->endSection() ?>