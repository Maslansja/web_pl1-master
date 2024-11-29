<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel; 
use CodeIgniter\HTTP\ResponseInterface;

class PelangganCopy extends BaseController
{
    protected $pelangganmodel;

    public function __construct()
    {
        $this->pelangganmodel = new PelangganModel();
    }

    // Menampilkan halaman utama pelanggan
    public function index()
    {
        return view('v_pelanggan');
    }

    // Mengambil dan menampilkan data pelanggan
    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganmodel->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    // Menyimpan data pelanggan baru
    public function simpan_pelanggan()
    {
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat'          => $this->request->getVar('alamat'),
            'nomor_telepon'         => $this->request->getVar('nomor_telepon'),  // pastikan menggunakan 'telepon' sesuai dengan model
        ];

        // Validasi data sebelum disimpan
        if (!$this->pelangganmodel->validate($data)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data pelanggan gagal disimpan',
                'errors'  => $this->pelangganmodel->errors(),
            ]);
        }

        if ($this->pelangganmodel->save($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data pelanggan berhasil disimpan',
            ]);
        }

        // Jika gagal disimpan
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal menyimpan data pelanggan',
        ]);
    }

    // Menghapus data pelanggan
    public function hapus_pelanggan($id)
    {
        $pelanggan = $this->pelangganmodel->find($id);
        if (!$pelanggan) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }

        if ($this->pelangganmodel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Pelanggan berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus pelanggan',
            ]);
        }
    }

    // Mengupdate data pelanggan
    public function update_pelanggan()
    {
        $id = $this->request->getVar('pelangganId'); // Ambil ID pelanggan dari request
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat'          => $this->request->getVar('alamat'),
            'nomor_telepon'  => $this->request->getVar('nomor_telepon'),  // pastikan menggunakan 'telepon' sesuai dengan model
        ];

        // Validasi data sebelum diperbarui
        if (!$this->pelangganmodel->validate($data)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data pelanggan gagal diperbarui',
                'errors'  => $this->pelangganmodel->errors(),
            ]);
        }

        if ($this->pelangganmodel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data pelanggan berhasil diperbarui',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Gagal memperbarui data pelanggan',
        ]);
    }

    // Menampilkan detail pelanggan berdasarkan ID
    public function detail($id)
    {
        $pelanggan = $this->pelangganmodel->find($id);
        if ($pelanggan) {
            return $this->response->setJSON([
                'status' => 'success',
                'pelanggan' => $pelanggan,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan',
            ]);
        }
    }

    // Fungsi untuk mengambil data pelanggan yang akan diedit
    public function edit_pelanggan()
    {
        $pelangganID = $this->request->getVar('id');
        $pelanggan = $this->pelangganmodel->find($pelangganID);

        if ($pelanggan) {
            return $this->response->setJSON([
                'status' => 'success',
                'pelanggan' => $pelanggan
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pelanggan Tidak Ditemukan'
            ], 404);
        }
    }
}
