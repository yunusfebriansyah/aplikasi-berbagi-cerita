<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class User extends Server {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_Model","user_model",TRUE);
  }

  public function service_get($username)
  {
    $users = $this->user_model->getDetailUser($username);
    $this->response(
			[
				"status" => 200,
				"message" => 'Data berhasil ditampilkan',
				'count' => count($users),
				"data" => $users
			],200);
  }

}
