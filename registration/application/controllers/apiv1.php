<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class APIV1  extends CI_Controller{

public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
}

public function list_all_users()
{
	if($_SERVER['REQUEST_METHOD'] == "GET" ){
		$all_data = $this->register_model->getalluserslist();
		header("Content-Type: application/json");
		echo(json_encode($all_data));
	}
	else{

		echo json_encode("Invalid request method");exit;
	}
}

public function list_user_by_id()
{	
	if($_SERVER['REQUEST_METHOD'] == "GET" ){
		$user_data = $this->input->get();
		$user_details = array();
		if(!empty($user_data) && isset($user_data['user_id'])){
			if(is_numeric($user_data['user_id'])){
				$user_details = $this->register_model->getuserdata($user_data['user_id']);
			}
			else{
				echo json_encode("Invalid request parameters");exit;
			}
		}
		else{
			echo json_encode("Insufficient request parameters");exit;
		}
		header("Content-Type: application/json");
		if(!empty($user_details)){
			echo(json_encode($user_details));
		}
		else{
			echo(json_encode("No details found"));
		}
	}
	else{
		echo json_encode("Invalid request method");exit;
	}	
}

public function create_user()
{
	if($_SERVER['REQUEST_METHOD'] == "POST" ){

		$details = file_get_contents('php://input');
        $details = json_decode($details,true);
        if(!empty($details)){
        	if(!empty($details['user_name']) && !empty($details['email_id']) && !empty($details['password'])){
        			$user_data = array("user_name" => $details['user_name'],
						"email_id" => $details['email_id'],
						"password" => $details['password'],
						"created_on" => time());
        			$this->register_model->insert_user($user_data);
        			echo (json_encode("User details saved"));exit;
        	}
        	else{
        		echo json_encode("Insufficient request parameters");exit;
        	}
        }
		else{
			echo json_encode("Insufficient request parameters");exit;
		}

	}
	else{
		echo json_encode("Invalid request method");exit;
	}
}

public function update_user()
{
	if($_SERVER['REQUEST_METHOD'] == "POST" ){
		$details = file_get_contents('php://input');
        $details = json_decode($details,true);
        if(!empty($details)){
        	if(!empty($details['id'])){
        		if(!empty($details['user_name']) || !empty($details['email_id']) || !empty($details['password'])){
        			$details['updated_on'] = time();
					$this->register_model->updateTable(array($details),'users','id');
					echo (json_encode("User details saved"));exit;
				}
				else{
					echo json_encode("Insufficient request parameters");exit;
				}
        	}
        	else{
        		echo json_encode("Insufficient request parameters Id is required");exit;
        	}

		}
		else{
			echo json_encode("Insufficient request parameters");exit;
		}	
	}
	else{
		echo json_encode("Invalid request method");exit;
	}
}

public function delete_user()
{
	if($_SERVER['REQUEST_METHOD'] == "POST" ){
		$details = file_get_contents('php://input');
        $details = json_decode($details,true);
        if(!empty($details)){
        	if(!empty($details['id'])){
				$this->register_model->delete_user($details['id']);
				echo (json_encode("User has been deleted"));
			}
			else{
				echo json_encode("Insufficient request parameters Id is required");exit;
			}
		}
		else{
			echo json_encode("Insufficient request parameters");exit;
		}
	}
	else{
		echo json_encode("Invalid request method");exit;
	}
}	

}