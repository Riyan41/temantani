<?php namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{
    // Menu sewa
    public function sewa()
    {
        $builder = $this->db->table('sewa2');
        $builder->select('sewa2.kategori_id, sewa2.ringkasan, sewa2.foto, kategori.nama_kategori, kategori.slug_kategori');
        $builder->join('kategori', 'kategori.id_kategori = sewa2.kategori_id');
        $builder->where(array('status_alat'    => 'tersedia'));
        $builder->groupBy('sewa2.kategori_id');
        $builder->orderBy('kategori.urutan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Menu informasi
    public function informasi()
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.judul_sewa, sewa.icon, sewa.ringkasan, sewa.gambar, sewa.slug_sewa, sewa.id_sewa');
        $builder->where(array('status_sewa'    => 'Publish'));
        $query = $builder->get();
        return $query->getResultArray();
    }
}