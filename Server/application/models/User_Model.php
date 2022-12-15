<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_Model","user_model",TRUE);
  }


}