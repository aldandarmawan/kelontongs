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
    
    private function sanitize_sentence($str){
        $str = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $str = preg_replace('/[^a-z 0-9_-]+/i', '', $str);
        
        return $str;
    }
    
    private function SendJSON($data = []){
        $array = [
            'request_time' => time(),
            'data' => $data
        ];
        return $this->response->setJSON($array);
    }

    public function ReadPenjualan() {
        $sort = $this->request->getPost('sort');
        
        $PenjualanModel = new \App\Models\PenjualanModel();
        $PenjualanModel->select('barang.nama_barang, penjualan.stok, penjualan.terjual, penjualan.tgl_transaksi, DATE_FORMAT(penjualan.tgl_transaksi, "%d %b %Y") as tgl_disp, jenis_barang.jenis_barang');
        $PenjualanModel->join('barang', 'barang.id = penjualan.id_barang');
        $PenjualanModel->join('jenis_barang', 'jenis_barang.id = barang.id_jenis_barang');
        
        if(empty($this->request->getPost('search')) == false){
            $PenjualanModel->like('barang.nama_barang', $this->request->getPost('search'));
        }
        if(empty($sort) == false && isset($sort['by']) && isset($sort['order'])){
            $order = ($sort['order'] == 'true') ? 'ASC' : 'DESC';
            
            switch($sort['by']){
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

}
