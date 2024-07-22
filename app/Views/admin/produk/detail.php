<?= $this->extend('admin/layout/tamplate') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $title ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('daftar-produk'); ?>">Daftar Produk</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Detail Produk : <?= $data_produk->nama_produk ?>
                        </div>
                        <div class="card-body">
                         
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama </th>
                                    <td>: <?= $data_produk->nama_produk?></td>
                                </tr>
                                <tr>
                                    <th>Kategori </th>
                                    <td>: <?= $data_produk->kategori_slug?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi </th>
                                    <td>: <?= $data_produk->deskripsi?></td>
                                </tr>
                                <tr>
                                    <th width="50%">Gambar</th>
                                    <td>: <img src="<?= base_url('assets-admin/img/'. $data_produk->gambar_produk)?>" alt="" width="50%"></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Input</th>
                                    <td>: <?= date('d/m/Y | h:i:s', strtotime($data_produk->tanggal_input))?></td>
                                </tr>
                            </table>
                            <div class="justify-content-end d-flex">
                                <a href="<?= base_url('daftar-produk')?>" class="btn btn-secondary btn-sm mt-2">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
                               
    <?= $this->endSection() ?>