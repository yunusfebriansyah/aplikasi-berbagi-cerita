<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{

  public function getDetailUser($username)
  {
    return $this->db->get_where('users', ['username' => $username])->result_array();
  }


}