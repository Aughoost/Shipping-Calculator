<?php



namespace App\Controllers;


use mysqli;
use App\Models\ProductModel;

use App\Models\CityModel;

use App\Models\Users;

use App\Models\UserModel;





use PhpOffice\PhpSpreadsheetSpreadsheet;

use PhpOffice\PhpSpreadsheetWriterXlsx;

use SpreadsheetReader_XLSX;



class Demo extends BaseController

{



    public function __construct()

    {

        helper(['url']);

        // $this->load->model('excel_import_modelsasdasdas');

		// $this->load->library('excel');

    }

    public function index(): string

    {

        return view('demo/index');

    }



    // public function ajax()

    // {

    //     $term  = $this->request->getVar('term');

    //     $productModel = new ProductModel();

    //     // $names = $productModel->like('Code',$term,'both')->findColumn('Code');

    //     $ProductList = $productModel->select('Code,Weight')

    //             //   $userlist = $Users->select('Code,Weight,Name')

    //             //  ->where('Code', $search)

    //             ->like('Code', $term)

    //             ->orderBy('Code')

    //             ->findAll(5); 

        



    //     foreach ($ProductList as $user) {

    //             $data[] = array(

    //                 "value" => $user['Weight'],

    //                 "label" => $user['Code'],

    //             );

    //         }



    //         $response['data'] = $data;

    //         return $this->response->setJSON($response);

    // }



    // public function Weight()

    // {

    //     $term  = $this->request->getVar('term');

    //     $productModel = new ProductModel();

    //     $names = $productModel->like('Weight',$term,'both')->select('Weight')->findall();

    //     return $this->response->setJSON($names);

    // }


    public function ajax()
    {
        
        //August Desktop COnnection
        // $servername = "localhost"; 
        // $username = "tsbcentr_ShippingCalc";
        // $password = ")}ig5nCQSHT,";
        // $dbname = "tsbcentr_TSBLivingShippingCalculator";
        // $conn = new mysqli($servername, $username, $password, $dbname);
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
        // echo "Connected successfully";
        // // $servername = "localhost"; 
        // // $username = "August55";
        // // $password = "Zaf40888";
        // // $dbname = "tsbliving";
        // // $conn = new mysqli($servername, $username, $password, $dbname);
        // $request = service('request');
        // $postData = $request->getPost();
        $servername = "localhost"; 
        $username = "tsbcentr_ShippingCalc";
        $password = ")}ig5nCQSHT,";
        $dbname = "tsbcentr_TSBLivingShippingCalculator";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $response = array();
        $response['token'] = csrf_hash();
        $data = array();
        $term  = $this->request->getVar('search');
            if (trim( $term ) != "") 
            {
                $red = "select Code,Weight from Calculator where Code like '%$term%' order by Code LIMIT 8";
                $userlist = mysqli_query( $conn, $red);
                     if (mysqli_num_rows($userlist)>0){
                           foreach ($userlist as $user) {
                                  $data[] = array(
                                "value" => $user['Weight'],
                                  "label" => $user['Code'],
                             );
        
                         }
                        $response['data'] = $data;
                        $conn->close();
                        return $this->response->setJSON($response);
                    }
                    else
                    {
                    $red = "select Code,Weight,Name from Calculator where Name like '%$term%' order by Name LIMIT 8";
                    $userlist = mysqli_query( $conn, $red);
                    foreach ($userlist as $user) {
                    $data[] = array(
                        "value" => $user['Weight'],
                        "label" => $user['Name'],
                    );
                    }
                    $response['data'] = $data;
                    $conn->close();
                    return $this->response->setJSON($response);
                    }
                
            }
        // return $this->response->setJSON($response);
    }



    public function GetCity()

    {
        $servername = "localhost"; 
        $username = "tsbcentr_ShippingCalc";
        $password = ")}ig5nCQSHT,";
        $dbname = "tsbcentr_TSBLivingShippingCalculator";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        $code = $this->request->getVar('code');

        $city = $this->request->getVar('City');

        if (trim($code) != "" || trim($city) !="" ) {
            $red = "select City,Island,PostCode from City where PostCode = '$code'";

            $userlist = mysqli_query( $conn, $red);
            foreach ($userlist as $user) {

                $data[] = array(

                    "value" => $user['City'],

                    "label" => $user['Island'],

                );

            }

            if(empty($data)) {

                $data[] = array(

                    "value" => "Please check zipcode and city",

                    "label" => "Please check zipcode and city",

                );

                $response['data'] = $data;
                $conn->close();
                return $this->response->setJSON($response);

            }else{

                $response['data'] = $data;
                $conn->close();
                return $this->response->setJSON($response);

            }

        }

        else{

            $data[] = array(

                "value" => "",

                "label" => "",

            );

            $response['data'] = $data;
            $conn->close();
            return $this->response->setJSON($response);

        }

    }



    public function GetFinal()

    {
        $DispatchLocation = $this->request->getVar('DispatchLocation');

        $City = $this->request->getVar('City');

        $Island = $this->request->getVar('Island');

        $Subtotal = $this->request->getVar('Subtotal');



        //Auckland

        if ($DispatchLocation == "Auckland" and $City == "Auckland" and $Island == "North Island") {

            if ($Subtotal <= 1 || $Subtotal < 9.99) {

                //model.FinalShippingCost = "6.00"; //ok

                //model.WeightRange = "1kg–9.9kg";



                // model.WeightRange = "1kg–9.9kg";

                // model.FinalShippingCost = "6.00";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '6.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {





                // model.WeightRange = "10kg–15.99kg";

                // model.FinalShippingCost = "12.00";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '6.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "20.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '20.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "25.00"; //ok

                // model.WeightRange = "22kg–25.99kg";







                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "25.00";

                // model.WeightRange = "26kg–29.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "33.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '33.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "75kg–84.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '33.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }



            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '80.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "95kg–149.99kg";

                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "42.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '42.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

        }

        //Wellington

        if ($DispatchLocation == "Auckland" and $City != "Auckland" and $Island == "North Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "12.00"; //ok

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '12.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "24.00"; //ok

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99k',

                    "FinalShippingCost" => '24.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "40.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '40.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "50.00"; //ok

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '50.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "30.00";

                // model.WeightRange = "26kg–29.99kg"; //ok





                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '30.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "65.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '65.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "110.00";

                // model.WeightRange = "75kg–84.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "120.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '120.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "150.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '150.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "245.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '245.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "85.00";

                // model.WeightRange = "50kg–74.99kg";





                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '85.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";

                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

        }

        //South Island

        if ($DispatchLocation == "Auckland" and $City != "Auckland" and $Island == "South Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "25.00";

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "52.00";

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '52.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "88.00";

                // model.WeightRange = "16kg–21.99kg";





                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '88.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "110.00";

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "35.00";

                // model.WeightRange = "26kg–29.99kg";



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '35.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "82.00";

                // model.WeightRange = "30kg–49.99kg";





                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '82.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "75kg–84.99kg";



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "195.00";

                // model.WeightRange = "85kg–94.99kg";





                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '195.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "400.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '400.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "425.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '425.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);







            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

        }



        //wlg to South Island

        if ($DispatchLocation == "Wellington" and $City != "Wellington" and $Island == "South Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "25.00";

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "52.00";

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '52.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "88.00";

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '88.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "110.00";

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "35.00";

                // model.WeightRange = "26kg–29.99kg";



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '35.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "82.00";

                // model.WeightRange = "30kg–49.99kg";

                // needs to be check

                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '82.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "75kg–84.99kg";



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "195.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '195.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "400.00";

                // model.WeightRange = "95kg–149.99kg";





                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '400.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "425.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '425.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

        }

        //wlg to North Island

        if ($DispatchLocation == "Wellington" and $City != "Wellington" and $Island == "North Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "12.00"; //ok

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '12.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "24.00"; //ok

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '24.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "40.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '40.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "50.00"; //ok

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '50.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "30.00";

                // model.WeightRange = "26kg–29.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '30.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "65.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '65.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "110.00";

                // model.WeightRange = "75kg–84.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }



            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "120.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '120.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "150.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '150.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "245.00";

                // model.WeightRange = "150kg–800kg";

                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '245.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "85.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '85.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";

                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }



        }

        //wlg to wlg

        if ($DispatchLocation == "Wellington" and $City == "Wellington" and $Island == "North Island") {



            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "6.00"; //ok

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '6.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "12.00"; //ok

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '12.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "20.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '20.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "25.00"; //ok

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "25.00";

                // model.WeightRange = "26kg–29.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "33.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '33.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "75kg–84.99kg"; //ok





                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '80.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }



            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "85kg–94.99kg";





                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '80.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "42.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '42.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

        }



        //chc to south island

        if ($DispatchLocation == "Christchurch" and $City != "Christchurch City" and $Island == "South Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "12.00";

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '12.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "24.00";

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '24.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "40.00";

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '40.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "50.00";

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '50.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "30.00";

                // model.WeightRange = "26kg–29.99kg";



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '30.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "65.00";

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '65.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "110.00";

                // model.WeightRange = "75kg–84.99kg";



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 85 && $Subtotal < 94) {

                // model.FinalShippingCost = "120.00";

                // model.WeightRange = "85kg–94.99kg";

                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '120.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }





            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "85.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '85.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "150.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '150.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "245.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '245.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

        }

        // chc to north island

        if ($DispatchLocation == "Christchurch" and $City != "Christchurch City" and $Island == "North Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "25.00"; //ok

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "52.00"; //ok

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '52.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "88.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '88.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "110.00"; //ok

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '110.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "35.00";

                // model.WeightRange = "26kg–29.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '35.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "82.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '82.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "75kg–84.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }



            if ($Subtotal >= 85 && $Subtotal < 94.99) {

                // model.FinalShippingCost = "195.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '195.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "400.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '400.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "425.00";

                // model.WeightRange = "150kg–800kg";



                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '425.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

        }

        //chc to chc

        if ($DispatchLocation == "Christchurch" and $City == "Christchurch City" and $Island == "North Island") {

            if ($Subtotal <= 1 && $Subtotal < 9.99) {

                // model.FinalShippingCost = "6.00"; //ok

                // model.WeightRange = "1kg–9.9kg";



                $data[] = array(

                    "WeightRange" => '1kg–9.9kg',

                    "FinalShippingCost" => '6.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 10 && $Subtotal < 15.99) {

                // model.FinalShippingCost = "12.00"; //ok

                // model.WeightRange = "10kg–15.99kg";



                $data[] = array(

                    "WeightRange" => '10kg–15.99kg',

                    "FinalShippingCost" => '12.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 16 && $Subtotal < 21.99) {

                // model.FinalShippingCost = "20.00"; //ok

                // model.WeightRange = "16kg–21.99kg";



                $data[] = array(

                    "WeightRange" => '16kg–21.99kg',

                    "FinalShippingCost" => '20.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 22 && $Subtotal < 25.99) {

                // model.FinalShippingCost = "25.00"; //ok

                // model.WeightRange = "22kg–25.99kg";



                $data[] = array(

                    "WeightRange" => '22kg–25.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 26 && $Subtotal < 29.99) {

                // model.FinalShippingCost = "25.00";

                // model.WeightRange = "26kg–29.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '26kg–29.99kg',

                    "FinalShippingCost" => '25.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }



            if ($Subtotal >= 30 && $Subtotal < 49.99) {

                // model.FinalShippingCost = "33.00"; //ok

                // model.WeightRange = "30kg–49.99kg";



                $data[] = array(

                    "WeightRange" => '30kg–49.99kg',

                    "FinalShippingCost" => '33.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }

            if ($Subtotal >= 75 && $Subtotal < 84.99) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "75kg–84.99kg"; //ok



                $data[] = array(

                    "WeightRange" => '75kg–84.99kg',

                    "FinalShippingCost" => '80.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);





            }



            if ($Subtotal >= 85 && $Subtotal < 94.99) {

                // model.FinalShippingCost = "80.00";

                // model.WeightRange = "85kg–94.99kg";



                $data[] = array(

                    "WeightRange" => '85kg–94.99kg',

                    "FinalShippingCost" => '80.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 95 && $Subtotal < 149.99) {

                // model.FinalShippingCost = "100.00";

                // model.WeightRange = "95kg–149.99kg";



                $data[] = array(

                    "WeightRange" => '95kg–149.99kg',

                    "FinalShippingCost" => '100.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 150 && $Subtotal < 800) {

                // model.FinalShippingCost = "175.00";

                // model.WeightRange = "150kg–800kg";

                $data[] = array(

                    "WeightRange" => '150kg–800kg',

                    "FinalShippingCost" => '175.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);

            }

            if ($Subtotal >= 50 && $Subtotal < 74.99) {

                // model.FinalShippingCost = "42.00";

                // model.WeightRange = "50kg–74.99kg";



                $data[] = array(

                    "WeightRange" => '50kg–74.99kg',

                    "FinalShippingCost" => '42.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

            if ($Subtotal >= 2000 && $Subtotal > 2000) {

                // model.FinalShippingCost = "200.00";

                // model.WeightRange = "2000kg–2000kg";



                $data[] = array(

                    "WeightRange" => '2000kg–2000kg',

                    "FinalShippingCost" => '200.00',

                );

                $response['data'] = $data;

                return $this->response->setJSON($response);



            }

        }





    }



    

}



