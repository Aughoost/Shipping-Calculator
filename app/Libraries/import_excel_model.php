<?php
error_reporting(E_ALL ^ E_DEPRECATED);	
//include_once('class.phpmailer.php');	
//require ('PHPMailerAutoload.php');

//include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

class import_excel_model extends CI_Model 
{    
	//--- Insert Data 
	function save_entry()
	{	
		include_once('excel_reader2.php');
		include_once('SpreadsheetReader.php');
		$mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		
		//echo $_FILES["excel_file"]["type"];
		//exit;
		
		if(in_array($_FILES["excel_file"]["type"],$mimes)){
			$uploadFilePath = 'uploads/'.basename($_FILES['excel_file']['name']);
			move_uploaded_file($_FILES['excel_file']['tmp_name'], $uploadFilePath);
			$Reader = new SpreadsheetReader($uploadFilePath);
			$totalSheet = count($Reader->sheets());

			/* For Loop for all sheets */
			for($i=0;$i<$totalSheet;$i++){
			  $Reader->ChangeSheet($i);
			  $row_count=0;
			  foreach ($Reader as $Row)
			  {
				if($row_count!=0)
				{
					$EMP_NO = isset($Row[0]) ? $Row[0] : '';
					$EMP_NAME = isset($Row[1]) ? $Row[1] : '';
					$ADDRESS = isset($Row[2]) ? $Row[2] : '';
					
					$data = array(
							'EMP_NO'      => 	$EMP_NO,
							'EMP_NAME'      => 	$EMP_NAME,
							'ADDRESS'      => 	$ADDRESS
							);
					$this->db->insert('EMPLOYEE_MASTER_DATA', $data);
				}
				$row_count++;
				
			  }
			}
			$row_count=$row_count-1;
			
			echo "<script>alert('".$row_count." Record(s) has been inserted! Thank you.') </script>";  	
			echo "<script language=\"javascript\">window.open('https://app.shinerweb.com/index.php/import_excel/', '_self');  </script>";
			
		}
		else
		{
			echo "<script>alert('Please select valid excel file!.') </script>";  	
			echo "<script language=\"javascript\">window.open('https://app.shinerweb.com/index.php/import_excel/', '_self');  </script>";
		}
		
	}
}
?>