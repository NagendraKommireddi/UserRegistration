<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{

public function insert_user($data){

	$query=$this->db->insert('users',$data);
	if($query){
		return true;
	}
	else {
		return false;
	}

}

public function getuserslist()
{
	$data = $this->db->select('id,user_name,email_id')
					->from('users')
					->where('is_deleted',0)
					->get()
					->result_array();

	if(!empty($data)){
		return $data;
	}
	else{
		return false;
	}
}

public function getalluserslist()
{
	$data = $this->db->select('id,user_name,email_id')
					->from('users')
					->get()
					->result_array();

	if(!empty($data)){
		return $data;
	}
	else{
		return false;
	}
}

public function getuserdata($id)
{
	$data = $this->db->select('id,user_name,email_id')
					->from('users')
					->where('id',$id)
					->get()
					->result_array();

	if(!empty($data)){
		return $data;
	}
	else{
		return false;
	}
}

  public function updateTable($data,$table_name,$update_key){
    if($data && !empty($data)){
        $data_chunks = array_chunk($data, 1000);

        foreach ($data_chunks as $key => $update_array) {
            if(count($update_array) >= 1){
                $this->db->update_batch($table_name,$update_array,$update_key);
            }
        }
    }
}

public function delete_user($id)
{
	$this->db->set('is_deleted',1);
	$this->db->set('updated_on',time());
	$this->db->where('id',$id);
	$this->db->update('users');
}

}