<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class Login extends Server {

  public function service_post()
  {
    $this->load->model('User_Model', 'user_model', TRUE);
    $data = $this->user_model->loginUser( $this->input->post('username'), $this->input->post('password') );
    if( !$data ) :
      $this->response(
        [
          "status" => 200,
          "message" => 'Login Gagal'
        ],200);
    else :
      $this->response(
        [
          "status" => 200,
          "message" => 'Login Berhasil',
          "count" => count($data),
          "data" => $data
        ],200);
    endif;
  }

}
