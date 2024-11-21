<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    // protected $table = 'calculator';
    // protected $primarykey = 'Code';
    // protected $returntype = 'array';
    // protected $allowFields =['Name','Weight','isArchived','SellPriceLn','Region'];

     protected $DBGroup = 'default';
     protected $table = 'calculator';
     protected $primaryKey = 'Code';
    //  protected $useAutoIncrement = true;
     protected $insertID = 0;
     protected $returnType = 'array';
     protected $useSoftDeletes = false;
     protected $protectFields = true;
     protected $allowedFields = ['Name','Weight','isArchived','SellPriceLn','Region'];

     // Dates
     protected $useTimestamps = false;
     protected $dateFormat = 'datetime';
     protected $createdField = 'created_at';
     protected $updatedField = 'updated_at';
     protected $deletedField = 'deleted_at';

     // Validation
     protected $validationRules = [];
     protected $validationMessages = [];
     protected $skipValidation = false;
     protected $cleanValidationRules = true;

     // Callbacks
     protected $allowCallbacks = true;
     protected $beforeInsert = [];
     protected $afterInsert = [];
     protected $beforeUpdate = [];
     protected $afterUpdate = [];
     protected $beforeFind = [];
     protected $afterFind = [];
     protected $beforeDelete = [];
     protected $afterDelete = [];


}