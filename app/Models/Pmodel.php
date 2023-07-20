<?php 
namespace App\Models;

use CodeIgniter\Model;

class Pmodel extends Model
{
    protected $table      = 'sewa';
    protected $primaryKey = 'id_sewa';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['judul_sewa'];

    protected $useTimestamps = false;
    protected $createdField  = 'tanggal';
    protected $updatedField  = 'tanggal';
    protected $deletedField  = 'tanggal';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}