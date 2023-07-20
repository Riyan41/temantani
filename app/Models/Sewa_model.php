<?php 
namespace App\Models;

use CodeIgniter\Model;

class Sewa_model extends Model
{

    protected $table = 'sewa';
    protected $primaryKey = 'id_sewa';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, users.nama');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    
    public function listingalat($id_user)
    {
        $builder = $this->db->table('sewa2');
        $builder->select('*');
        $builder->where('id_user2', $id_user);
        $builder->orderBy('id_sewa2','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function listingalat2()
    {
        $builder = $this->db->table('sewa2');
        $builder->select('*');
        $builder->orderBy('id_sewa2','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function beranda()
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'status_sewa' => 'Publish',
                            'jenis_sewa'  => 'Sewa']);
        $builder->orderBy('sewa.tanggal_publish','DESC');
        $builder->limit(3);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // home
    public function sidebar()
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'status_sewa' => 'Publish',
                            'jenis_sewa'  => 'Sewa']);
        $builder->orderBy('sewa.tanggal_publish','DESC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResultArray();
    }


    // home
    public function home()
    {
        $builder = $this->db->table('sewa2');
        $builder->select('sewa2.*, kategori.nama_kategori, users.*');
        $builder->join('kategori','kategori.id_kategori = sewa2.kategori_id','LEFT');
        $builder->join('users','users.id_user = sewa2.id_user2','LEFT');
        // $builder->where( [  'status_alat' => 'tersedia']);
        // $builder->where( [  'status_alat' => 'Publish',
        //                     'jenis_sewa'  => 'Sewa']);
        $builder->orderBy('sewa2.id_sewa2','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // kategori
    public function kategori($id_kategori)
    {
        $builder = $this->db->table('sewa2');
        $builder->select('sewa2.*, kategori.nama_kategori, kategori.slug_kategori, users.*');
        $builder->join('kategori','kategori.id_kategori = sewa2.kategori_id','LEFT');
        $builder->join('users','users.id_user = sewa2.id_user2','LEFT');
        $builder->where( [  'status_alat'         => 'tersedia',
                            'sewa2.kategori_id'    => $id_kategori]);
        $builder->orderBy('sewa2.id_sewa2','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // kategori
    public function kategori_all($id_kategori)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'sewa.id_kategori'    => $id_kategori]);
        $builder->orderBy('sewa.tanggal_publish','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_kategori($id_kategori)
    {
        $builder = $this->db->table('sewa')->where('id_kategori',$id_kategori);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // author
    public function author_all($id_user)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'sewa.id_user'    => $id_user]);
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_author($id_user)
    {
        $builder = $this->db->table('sewa')->where('id_user',$id_user);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // kategori
    public function jenis_sewa_all($jenis_sewa)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'sewa.jenis_sewa'    => $jenis_sewa]);
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total_jenis_sewa($jenis_sewa)
    {
        $builder = $this->db->table('sewa')->where('jenis_sewa',$jenis_sewa);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // status_sewa
    public function status_sewa_all($status_sewa)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, kategori.nama_kategori, kategori.slug_kategori, users.nama');
        $builder->join('kategori','kategori.id_kategori = sewa.id_kategori','LEFT');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where( [  'sewa.status_sewa'    => $status_sewa]);
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // status_sewa
    public function total_status_sewa($status_sewa)
    {
        $builder = $this->db->table('sewa')->where('status_sewa',$status_sewa);
        $query = $builder->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('sewa');
        $query = $builder->get();
        return $query->getNumRows();
    }
    
    public function totalalat($id_user)
    {
        $builder = $this->db->table('sewa2');
        $builder->where('id_user2', $id_user);
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function totalalat2()
    {
        $builder = $this->db->table('sewa2');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_sewa)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, users.nama');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where('sewa.id_sewa',$id_sewa);
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function detailalat($id_sewa)
    {
        $builder = $this->db->table('sewa2');
        $builder->select('*');
        $builder->where('id_sewa2',$id_sewa);
        $builder->orderBy('id_sewa2','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // read
    public function read($slug_sewa)
    {
        $builder = $this->db->table('sewa');
        $builder->select('sewa.*, users.nama');
        $builder->join('users','users.id_user = sewa.id_user','LEFT');
        $builder->where('sewa.slug_sewa',$slug_sewa);
        $builder->where('sewa.status_sewa','Publish');
        $builder->orderBy('sewa.id_sewa','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function pesan($slug_sewa)
    {
        $builder = $this->db->table('sewa2');
        $builder->select('sewa2.*, users.*');
        $builder->join('users','users.id_user = sewa2.id_user2','LEFT');
        $builder->where('sewa2.id_sewa2',$slug_sewa);
        $builder->orderBy('sewa2.id_sewa2','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function cektgl($idsewa, $tanggal)
    {
        $builder = $this->db->table('orders');
        $builder->select('*');
        $builder->where('id_sewa2', $idsewa);
        $builder->where('tgl_sewa', $tanggal);
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('sewa');
        $builder->insert($data);
    }
    
    public function tambahalat($data)
    {
        $builder = $this->db->table('sewa2');
        $builder->insert($data);
    }

    public function tambahorder($data)
    {
        $builder = $this->db->table('orders');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('sewa');
        $builder->where('id_sewa',$data['id_sewa']);
        $builder->update($data);
    }
    
    public function editalat($data)
    {
        $builder = $this->db->table('sewa2');
        $builder->where('id_sewa2',$data['id_sewa2']);
        $builder->update($data);
    }

    public function listhistory($id_user)
    {
        $builder = $this->db->table('orders');
        $builder->select('orders.*, users.*, sewa2.*');
        $builder->join('users','users.id_user = orders.id_user','LEFT');
        $builder->join('sewa2','sewa2.id_sewa2 = orders.id_sewa2','LEFT');
        $builder->where('orders.id_user', $id_user);
        $builder->orderBy('orders.tgl_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function totalhistory($id_user)
    {
        $builder = $this->db->table('orders');
        $builder->where('id_user', $id_user);
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function listhistory2()
    {
        $builder = $this->db->table('orders');
        $builder->select('orders.*, users.*, sewa2.*');
        $builder->join('users','users.id_user = orders.id_user','LEFT');
        $builder->join('sewa2','sewa2.id_sewa2 = orders.id_sewa2','LEFT');
        $builder->orderBy('orders.tgl_sewa','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function totalhistory2()
    {
        $builder = $this->db->table('orders');
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function konfirmHist($data)
    {
        $builder = $this->db->table('orders');
        $builder->where('id_order',$data['id_order']);
        $builder->update($data);
    }

}