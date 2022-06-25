<?php

namespace App\Controllers;

class Api extends BaseController {

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
        header('Content-Type: application/json');
        date_default_timezone_set("Asia/Jakarta");
    }

    private function sanitize_sentence($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $str = preg_replace('/[^a-z 0-9_-]+/i', '', $str);

        return $str;
    }

    private function SendJSON($data = []) {
        $array = [
            'request_time' => time(),
            'data' => $data
        ];
        return $this->response->setJSON($array);
    }

    public function ReadPenjualan($id = 0) {

        $PenjualanModel = new \App\Models\PenjualanModel();
        $PenjualanModel->select('penjualan.id as id_penjualan, barang.nama_barang, penjualan.id_barang, penjualan.stok, penjualan.terjual, penjualan.tgl_transaksi, DATE_FORMAT(penjualan.tgl_transaksi, "%d %b %Y") as tgl_disp, jenis_barang.jenis_barang');
        $PenjualanModel->join('barang', 'barang.id = penjualan.id_barang');
        $PenjualanModel->join('jenis_barang', 'jenis_barang.id = barang.id_jenis_barang');

        if ($id != 0) {
            return $this->SendJSON($PenjualanModel->find($id));
        }
        if (empty($this->request->getPost('search')) == false) {
            $PenjualanModel->like('barang.nama_barang', $this->request->getPost('search'));
        }

        $sort = $this->request->getPost('sort');
        if (empty($sort) == false && isset($sort['by']) && isset($sort['order'])) {
            $order = ($sort['order'] == 'true') ? 'ASC' : 'DESC';

            switch ($sort['by']) {
                case 0:
                    $PenjualanModel->orderBy('barang.nama_barang', $order);
                    break;
                case 1:
                    $PenjualanModel->orderBy('penjualan.stok', $order);
                    break;
                case 2:
                    $PenjualanModel->orderBy('penjualan.terjual', $order);
                    break;
                case 3:
                    $PenjualanModel->orderBy('penjualan.tgl_transaksi', $order);
                    break;
                case 4:
                    $PenjualanModel->orderBy('jenis_barang.jenis_barang', $order);
                    break;
            }
        }

        return $this->SendJSON($PenjualanModel->findAll());
    }

    public function SavePenjualan() {
        if (empty($this->request->getPost('barang')) || empty($this->request->getPost('stok')) || empty($this->request->getPost('terjual')) || empty($this->request->getPost('tgl_trans'))
        ) {
            return $this->SendJSON(['status' => 0, 'errors' => 'Semua kolom harus diisi']);
        }

        if (empty($this->request->getPost('id')) == false && $this->request->getPost('id') != 0) {
            $data['id'] = $this->request->getPost('id');
        }

        $data['id_barang'] = $this->request->getPost('barang');
        $data['stok'] = $this->request->getPost('stok');
        $data['terjual'] = $this->request->getPost('terjual');
        $data['tgl_transaksi'] = $this->request->getPost('tgl_trans');

        $PenjualanModel = new \App\Models\PenjualanModel();
        if ($PenjualanModel->save($data)) {

            return $this->SendJSON(['status' => 1]);
        } else {
            return $this->SendJSON(['status' => 0, 'errors' => 'Terjadi Kesalahan']);
        }
    }

    public function DeletePenjualan($id) {
        $PenjualanModel = new \App\Models\PenjualanModel();

        if ($PenjualanModel->delete($id)) {
            return $this->SendJSON(['status' => 1]);
        } else {
            return $this->SendJSON(['status' => 0, 'errors' => 'Terjadi Kesalahan']);
        }
    }
    
    public function GetTotalTerjual(){
        $from = $this->request->getPost('from');
        $to= $this->request->getPost('to');
        
        $PenjualanModel = new \App\Models\PenjualanModel();
        $PenjualanModel->select('jenis_barang.jenis_barang, SUM(penjualan.terjual) as total_terjual')
                ->join('barang', 'barang.id = penjualan.id_barang')
                ->join('jenis_barang', 'jenis_barang.id = barang.id_jenis_barang')
                ->groupBy('jenis_barang.id');
        if(empty($from) == false){
         $PenjualanModel->where('penjualan.tgl_transaksi >=', $from);   
        }
        if(empty($to) == false){
         $PenjualanModel->where('penjualan.tgl_transaksi <=', $to);   
        }
        
        $PenjualanModel2 = new \App\Models\PenjualanModel();
        $PenjualanModel2->select('jenis_barang.jenis_barang, MAX(penjualan.terjual) as total_terjual')
                ->join('barang', 'barang.id = penjualan.id_barang')
                ->join('jenis_barang', 'jenis_barang.id = barang.id_jenis_barang')
                ->groupBy('jenis_barang.id');
        if(empty($from) == false){
         $PenjualanModel2->where('penjualan.tgl_transaksi >=', $from);   
        }
        if(empty($to) == false){
         $PenjualanModel2->where('penjualan.tgl_transaksi <=', $to);   
        }
        
        $PenjualanModel3 = new \App\Models\PenjualanModel();
        $PenjualanModel3->select('jenis_barang.jenis_barang, MIN(penjualan.terjual) as total_terjual')
                ->join('barang', 'barang.id = penjualan.id_barang')
                ->join('jenis_barang', 'jenis_barang.id = barang.id_jenis_barang')
                ->groupBy('jenis_barang.id');
        if(empty($from) == false){
         $PenjualanModel3->where('penjualan.tgl_transaksi >=', $from);   
        }
        if(empty($to) == false){
         $PenjualanModel3->where('penjualan.tgl_transaksi <=', $to);   
        }
       
        
        $data = [
            'total_terjual' => $PenjualanModel->findAll(),
            'max_terjual' => $PenjualanModel2->findAll(),
            'min_terjual' => $PenjualanModel3->findAll()
        ];
        
        return $this->SendJSON($data);
    }

}
