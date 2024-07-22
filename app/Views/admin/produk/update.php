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
                            Ubah Produk
                        </div>
                        <div class="card-body">
                            <!-- Notifikasi Berhasil Ubah Data -->
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <!-- Notifikasi Gagal Ubah Data -->
                            <?php if (session()->getFlashdata('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('failed') ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('daftar-produk/update-produk/' . $data_produk->id_produk); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="gambarLama" value="<?= $data_produk->gambar_produk ?>">

                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control <?= $validation->hasError('nama_produk') ? 'is-invalid' : '' ?>" value="<?= old('nama_produk', $data_produk->nama_produk) ?>">
                                        <?php if ($validation->hasError('nama_produk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_produk') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="kategori_slug">Kategori Produk</label>
                                        <select name="kategori_slug" id="kategori_slug" class="form-control <?= $validation->hasError('kategori_slug') ? 'is-invalid' : '' ?>">
                                            <option value="" hidden>Pilih</option>
                                            <?php foreach ($kategori_produk as $kategori) : ?>
                                                <option value="<?= $kategori->slug_kategori; ?>" <?= old('kategori_slug', $data_produk->kategori_slug) == $kategori->slug_kategori ? 'selected' : '' ?>><?= $kategori->nama_kategori; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ($validation->hasError('kategori_slug')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('kategori_slug') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi">Deskripsi Produk</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>"><?= old('deskripsi', $data_produk->deskripsi) ?></textarea>
                                    <?php if ($validation->hasError('deskripsi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_produk">Gambar Produk</label>
                                    <input type="file" name="gambar_produk" id="gambar_produk" class="form-control <?= $validation->hasError('gambar_produk') ? 'is-invalid' : '' ?>" onchange="previewImg()">
                                    <?php if ($validation->hasError('gambar_produk')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gambar_produk') ?>
                                        </div>
                                    <?php endif; ?>
                                    <img src="<?= base_url('assets-admin/img/' . $data_produk->gambar_produk) ?>" alt="" class="preview-img mt-2" width="100px">
                                </div>
                                <div class="justify-content-end d-flex">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script>
        function previewImg() {
            const gambar = document.querySelector('#gambar_produk');
            const imgPreview = document.querySelector('.preview-img');

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <?= $this->endSection() ?>
