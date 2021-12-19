<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
//Validating login
function __construct(){
	parent::__construct();
	$this->load->model('register_model');
}
public function index(){
	error_reporting(0);
	$data['result']  = $this->register_model->getuserslist();
	$this->load->view('welcome',$data);

}
}
