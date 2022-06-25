<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $BarangModel = new \App\Models\BarangModel();
        $BarangModel->select('id, nama_barang');
      
        $data['barang'] = $BarangModel->findAll();
        return view('home', $data);
    }
}
