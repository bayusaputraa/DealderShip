<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    protected $KategoriModel; // Variabel untuk menyimpan instance model

    public function __construct()
    {
        // Load model saat constructor dipanggil
        $this->KategoriModel = new KategoriModel();
    }

    // Halaman daftar produk
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'daftar_produk' => $this->ProdukModel->orderBy('id_produk', 'DESC')->findAll()
        ];
        return view('admin/produk/index', $data);
    }

    //Halaman daftar produk
    public function form_create()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        $data = [
            'title' => 'Tambah Produk',
            'kategori_produk' => $this->KategoriModel->findAll(),
            'validation' => $validation
        ];

        return view('admin/produk/create', $data);
    }

    public function form_update($id_produk)
    {
        // Load validation service
        $validation = \Config\Services::validation();

        $data = [
            'title' => 'Ubah Produk',
            'data_produk' => $this->ProdukModel->find($id_produk),
            'kategori_produk' => $this->KategoriModel->findAll(),
            'validation' => $validation
        ];

        return view('admin/produk/update', $data);
    }

    public function update_produk($id_produk)
    {
        // Aturan validasi input
        $rules = $this->validate([
            'nama_produk' => 'required|min_length[3]',
            'kategori_slug' => 'required',
            'deskripsi' => 'required|min_length[10]',
            'gambar_produk' => 'if_exist|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]|max_size[gambar_produk,2048]',
        ]);

        // Jika Data Gagal
        if (!$rules) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('failed', 'Data Produk Gagal Diubah');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Pastikan input nama_produk adalah string
        $nama_produk = $this->request->getPost('nama_produk');
        if (is_array($nama_produk)) {
            $nama_produk = implode(' ', $nama_produk);
        }

        $slug_produk = url_title($nama_produk, '-', true);

        // gambar file
        $gambar = $this->request->getFile('gambar_produk');

        // Check gambar diubah atau tidak
        if ($gambar && !$gambar->getError() == 4) {
            $namaGambar = $gambar->getRandomName();

            // Pindahkan file
            $path = FCPATH . 'assets-admin/img/';
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $gambar->move($path, $namaGambar);

                // Hapus Gambar Lama Dari direktori
                $gambarLama = $this->request->getPost('gambarLama');
                if ($gambarLama && file_exists($path . $gambarLama)) {
                    unlink($path . $gambarLama);
                }
            } else {
                session()->setFlashdata('failed', 'Gagal mengunggah gambar.');
                return redirect()->back()->withInput();
            }
        } else {
            // Jika gambar tidak diubah, gunakan gambar lama
            $namaGambar = $this->request->getPost('gambarLama');
        }

        // Jika Data Valid
        $this->ProdukModel->update($id_produk, [
            'slug_produk'   => $slug_produk,
            'nama_produk'   => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar,
        ]);

        session()->setFlashdata('success', 'Data Produk Berhasil DiUbah');
        return redirect()->to(base_url('daftar-produk'));
    }

    //fungsi hapus produk
    public function delete_produk()
{
    if ($this->request->isAJAX()) {
        $id_produk = $this->request->getVar('id_produk');
        log_message('debug', 'ID Produk yang diterima: ' . $id_produk);

        $produk = $this->ProdukModel->find($id_produk);
        log_message('debug', 'Data produk yang ditemukan: ' . print_r($produk, true));

        if ($produk) {
            // Pastikan produk ditemukan sebelum mencoba menghapus
            $imagePath = WRITEPATH . '../public/assets-admin/img/' . $produk->gambar_produk;
            log_message('debug', 'Path gambar: ' . $imagePath);

            if (file_exists($imagePath)) {
                unlink($imagePath);
                log_message('debug', 'Gambar berhasil dihapus.');
            } else {
                log_message('error', 'Gambar tidak ditemukan.');
            }

            $this->ProdukModel->delete($id_produk);
            log_message('debug', 'Produk berhasil dihapus.');

            $result = [
                'success' => 'Data Produk Berhasil Dihapus'
            ];
        } else {
            log_message('error', 'Produk tidak ditemukan.');
            $result = [
                'success' => false,
                'error' => 'Produk tidak ditemukan'
            ];
        }
        
        echo json_encode($result);

    } else {
        log_message('error', 'Request bukan AJAX.');
        exit('404 Not Found');
    }
}


    //fungsi Detail Produk
    public function detail_produk($id_produk)
    {
        $data = [
            'title' => 'Detail Produk',
            'data_produk' => $this->ProdukModel->find($id_produk)
        ];
        return view('admin/produk/detail', $data);
    }

    public function create_produk()
    {
        // Aturan validasi input
        $rules = $this->validate([
            'nama_produk' => 'required|min_length[3]',
            'kategori_slug' => 'required',
            'deskripsi' => 'required|min_length[10]',
            'gambar_produk' => 'uploaded[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]|max_size[gambar_produk,2048]',
        ]);

        // Jika Data Gagal
        if (!$rules) {
            $validation = \Config\Services::validation();
            // Debug validasi
            //dd($validation->getErrors());
            session()->setFlashdata('failed', 'Data Produk Gagal Ditambahkan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Pastikan input nama_produk adalah string
        $nama_produk = $this->request->getPost('nama_produk');
        if (is_array($nama_produk)) {
            $nama_produk = implode(' ', $nama_produk); // Atau cara lain untuk mengubah array menjadi string
        }

        $slug_produk = url_title($nama_produk, '-', true);

        //gambar file
        $gambar = $this->request->getFile('gambar_produk');
        //ambil random nama file
        $namaGambar = $gambar->getRandomName();
        //pindahkan file
        $path = FCPATH . 'assets-admin/img/';
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambar->move($path, $namaGambar);
        } else {
            session()->setFlashdata('failed', 'Gagal mengunggah gambar.');
            return redirect()->back()->withInput();
        }

        // Jika Data Valid
        $this->ProdukModel->insert([
            'slug_produk'   => $slug_produk,
            'nama_produk'   => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar,
        ]);

        session()->setFlashdata('success', 'Data Produk Berhasil Ditambahkan');
        return redirect()->to(base_url('daftar-produk'));
    }


    // Halaman daftar kategori produk
    public function kategori()
    {
        $data = [
            'title' => 'Daftar Kategori Produk',
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori', 'DESC')->findAll()
        ];
        return view('admin/produk/kategori', $data);
    }

    // Aksi tambah kategori produk
    public function store()
    {
        // Ambil data nama kategori dari form
        $nama_kategori = $this->request->getPost('nama_kategori');

        // Pastikan nama_kategori selalu string
        if (is_array($nama_kategori)) {
            $nama_kategori = $nama_kategori[0];
        }

        // Ambil slug dari nama kategori
        $slug = url_title($nama_kategori, '-', TRUE);

        // Siapkan data untuk disimpan ke database
        $data = [
            'nama_kategori' => esc($nama_kategori),
            'slug_kategori' => $slug,
        ];

        // Pastikan data tidak kosong sebelum insert
        if (empty($data['nama_kategori'])) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori tidak boleh kosong.');
        }

        // Simpan data ke database menggunakan model
        try {
            $this->KategoriModel->insert($data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        // Redirect kembali ke halaman sebelumnya (biasanya halaman form) dengan notifikasi sukses
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Ubah Kategori Produk
    public function update($id_kategori)
    {
        // Ambil data nama kategori dari form
        $nama_kategori = $this->request->getPost('nama_kategori');

        // Pastikan nama_kategori selalu string
        if (is_array($nama_kategori)) {
            $nama_kategori = $nama_kategori[0];
        }

        // Ambil slug dari nama kategori
        $slug = url_title($nama_kategori, '-', TRUE);

        // Siapkan data untuk diupdate ke database
        $data = [
            'nama_kategori' => esc($nama_kategori),
            'slug_kategori' => $slug,
        ];

        // Pastikan data tidak kosong sebelum update
        if (empty($data['nama_kategori'])) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori tidak boleh kosong.');
        }

        // Update data ke database menggunakan model
        try {
            $this->KategoriModel->update($id_kategori, $data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        // Redirect kembali ke halaman sebelumnya (biasanya halaman form) dengan notifikasi sukses
        return redirect()->back()->with('success', 'Kategori berhasil diubah.');
    }

    //Hapus Kategori Produk
    public function destroy($id_kategori)
    {
        $this->KategoriModel->where('id_kategori', $id_kategori)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
