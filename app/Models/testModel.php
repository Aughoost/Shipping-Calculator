<?php 

namespace App\Models;

use CodeIgniter\Model;
// use CodeIgniterDatabase\ConnectionInterface;

class UserModel extends Model {

    // protected $db;
    // public function __construct(ConnectionInterface &$db) {
    //     $this->db =& $db;
    //     $this->table_name = 'user_info';
    // }
    protected $table_name = 'calculator';
    public function addUser($data) {
        
        $this->db
                        ->table($this->table_name)
                        ->insert($data);
        return $this->db->insertID();
    }

    public function getUserList() {
        return $this->db
                        ->table($this->table_name)
                        ->get()
                        ->getResult();
    }

    public function getUser($where) {
        return $this->db
                        ->table($this->table_name)
                        ->where($where)
                        ->get()
                        ->getRow();
    }

    public function updateUser($where, $data) {
        return $this->db
                        ->table($this->table_name)
                        ->where($where)
                        ->set($data)
                        ->update();
    }

    public function deleteUser($where) {
        return $this->db
                        ->table($this->table_name)
                        ->where($where)
                        ->delete();
    }

    public function bulkInsert($data) {
        return $this->db
                        ->table($this->table_name)
                        ->insertBatch($data);
    }
}