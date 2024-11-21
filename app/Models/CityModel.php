<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model{

     protected $table = 'city';
     protected $primaryKey = 'id';
     protected $returnType = 'array';
     protected $allowedFields = ['PostCode','City','Territory','Region','Island'];

    //  public function __construct()
    //  {
    //      $this->load->database();
    //  }
     
    //  // Date
    //  public function getCity(string $code)
    // {
    //     $db = db_connect();
    //     $query = $db->query
    //         ->select('City,Island')
    //         ->from('city')
    //         ->where("PostCode LIKE '$code%'");
    //     return $query->result_array();
    // }

}