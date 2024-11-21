<?php
class import_excel extends CI_Controller { 
	public function __construct() {
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			
	}
   
	function index()
    {
        $this->load->view('import_excel_view');
    }
	function save_entry()
    {
        $this->load->model('import_excel_model');
		$this->import_excel_model->save_entry();
    }
}
?>