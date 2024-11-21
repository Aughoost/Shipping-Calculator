<?php 
namespace App\Models;

use CodeIgniter\Model;
class CityModel extends Model{
    
    /**
     * __construct
     */
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Get Employees
     * 
     * @return array $employeees | null
     */
    public function getEmployees($id)
    {
        $db = db_connect();
        $query = $db->query
            ->select('employees.*, designations.name as designationsName, departments.dept_name as deptName')
            ->from('employees')
            ->join('departments', 'departments.id = employees.department_id')
            ->join('designations', 'designations.id = employees.designation_id')
            ->where("employees.id LIKE '$id%'")
            ->limit(25)
            ->get();


        return $query->result_array();
    }
}