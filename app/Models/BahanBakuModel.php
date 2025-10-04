<?php
namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table      = 'bahan_baku';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama', 'kategori', 'jumlah', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa',
        'status', 'created_at'
    ];
    protected $useTimestamps = false;

    // Compute status for one row given today's date and jumlah
    public function computeStatus(array $row)
    {
        $today = date('Y-m-d');
        $jumlah = (int)$row['jumlah'];
        $tgl_kadaluarsa = $row['tanggal_kadaluarsa'];

        if ($jumlah <= 0) {
            return 'habis';
        }

        if (!$tgl_kadaluarsa || $tgl_kadaluarsa === '0000-00-00') {
            return 'tersedia';
        }

        $diff = (strtotime($tgl_kadaluarsa) - strtotime($today)) / 86400; // days

        if (strtotime($today) >= strtotime($tgl_kadaluarsa)) {
            return 'kadaluarsa';
        }

        if ($diff <= 3) {
            return 'segera_kadaluarsa';
        }

        return 'tersedia';
    }
}
