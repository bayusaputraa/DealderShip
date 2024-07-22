<?= $this->extend('admin/layout/tamplate') ?>

<?= $this->section('style'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?= $this->endSection() ?>

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
                            Daftar Produk
                        </div>
                        <div class="card-body">
                            <!-- Button trigger modal -->
                            <a href="<?= base_url('daftar-produk/tambah') ?>" type="button" class="btn btn-primary btn-sm mb-2">
                                <i class="fas fa-plus"></i> Tambah
                            </a>

                            <!-- Notifikasi Berhasil Tambah Data -->
                            <div class="swal" data-swal="<?= session('success') ?>"></div>


                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Input</th>
                                        <th>Fungsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($daftar_produk as $produk) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $produk->nama_produk ?></td>
                                            <td><?= $produk->kategori_slug ?></td>
                                            <td><?= date('d/m/Y H:i:s', strtotime($produk->tanggal_input)) ?></td>
                                            <td width="20%" class="text-center">
                                                <a href="<?= base_url('daftar-produk/detail-produk/' . $produk->id_produk) ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>Detail</a>

                                                <a href="<?= base_url('daftar-produk/ubah/' . $produk->id_produk) ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?= $produk->id_produk; ?>)"><i class="fas fa-trash"></i> Hapus</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <?= $this->endSection() ?>

    <?= $this->Section('script') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: swal,
                showConfirmButton: false,
                timer: 2000
            });
        }

        function hapus(id_produk) {
            Swal.fire({
                title: "Hapus?",
                text: "Yakin data Produk Akan Dihapus!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url("daftar-produk/delete-produk/"); ?>',
                        data: {
                            _method: 'DELETE',
                            <?= csrf_token() ?>: '<?= csrf_hash(); ?>',
                            id_produk: id_produk
                        },
                        dataType: 'json',
                        success: function(respons) {
                            console.log('Respons: ', respons); // Tambahkan log untuk debugging
                            if (respons.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: respons.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    window.location.href = "<?= base_url('daftar-produk'); ?>"; // Kembali ke halaman daftar produk
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: respons.error || "Data produk gagal dihapus.",
                                    showConfirmButton: true,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error: ', error); // Tambahkan log untuk debugging
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan: " + error,
                                showConfirmButton: true,
                            });
                        }
                    });
                }
            });
        }
    </script>

    <?= $this->endSection('') ?>