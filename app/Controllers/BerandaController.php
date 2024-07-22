<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class BerandaController extends BaseController
{
    protected $ProdukModel;
    protected $KategoriModel;

    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        $kategoriSlug = $this->request->getVar('kategori');
        $currentPage = $this->request->getVar('page_products') ? $this->request->getVar('page_products') : 1;

        if ($kategoriSlug) {
            $products = $this->ProdukModel->where('kategori_slug', $kategoriSlug)->paginate(10, 'products');
        } else {
            $products = $this->ProdukModel->paginate(10, 'products');
        }

        $data = [
            'title' => 'Beranda',
            'products' => $products,
            'kategori' => $this->KategoriModel->findAll(),
            'pager' => $this->ProdukModel->pager,
            'currentPage' => $currentPage,
            'selectedKategori' => $kategoriSlug
        ];

        return view('users/beranda/index', $data);
    }
}
