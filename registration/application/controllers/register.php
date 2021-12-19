<?php
require_once 'vendor/autoload.php';

defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->library('unit_test');
    }

public function index(){
	$this->load->view('register');
}


public function verify_email($email = false)
{
  if($email == false){
	 $email = $this->input->post('email');
  }

  if(!empty($email)){
	 $client   = new Kickbox\Client('KICKBOX CLIENT SECRET HERE');
	 $kickbox  = $client->kickbox();

	 try {
    		$response = $kickbox->verify($email);
    		echo json_encode(array('message' => $response->body['result']));
	 }
	 catch (Exception $e) {
    		echo "Code: " . $e->getCode() . " Message: " . $e->getMessage();
	 }	
  }
}

public function verify_captcha()
{		
	  $token = $this->input->post('token');
	  if(!empty($token))
  	  {
        $secret = 'GOOGLE SERVER SIDE SECRET HERE';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$token);
        $responseData = json_decode($verifyResponse);
        if($responseData->success){
            $message = "g-recaptcha verified successfully";
        	echo json_encode(array('status'=>200));
        }
        else{
            $message = "Some error in verifying g-recaptcha";
        	echo json_encode(array('status'=>400));
        }	
   	}
}

public function insert_user(){
	$data = $this->input->post();

	$user_data = array("user_name" => $data['user_name'],
						"email_id" => $data['email_id'],
						"password" => $data['password'],
						"created_on" => time());

	$data = $this->register_model->insert_user($data);

}


public function unit_test_cases()
{

  $fields = array(
    'email' => 'test@gmail.com',
  );
  $postdata = http_build_query($fields);
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, 'http://localhost/register/verify_email');
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  $test = curl_exec($ch);

  $expected_result = json_encode( array('message' => 'deliverable'));
  echo $this->unit->run($test,$expected_result,'Testing verify Email');


  $fields = array("user_name" => "test_user","password" => "Default123!@#","email_id"=>"test@gmai.com");
  $postdata = http_build_query($fields);
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, 'http://localhost/register/insert_user');
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);

  $expected_result = $this->db->select('id')->from('users')->where('user_name','test_user')->get()->row_array();
  $test = true;
  echo $this->unit->run($test,is_numeric($expected_result['id']),'Testing insert_user');
}

}