<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class Register extends Server {

  public function service_post()
  {
    $this->load->model('User_Model', 'user_model', TRUE);
    $name = $this->post('name');
    $username = $this->post('username');
    $password = $this->post('password');
    $passwordRepeat = $this->post('password_repeat');

    $errors = [
      'name' => null,
      'username' => null,
      'password' => null,
      'password_repeat' => null
    ];

    if( ($name == null or $name == null) or ($username == null or $username == null) or ($password == null or $password == null) or count( $this->user_model->getDetailUser($username) ) > 0 or $password !== $passwordRepeat ) :
      if( count( $this->user_model->getDetailUser($username) ) > 0 ) :
        $errors['username'] = 'Username tidak tersedia.';
      endif;
      if( $name == null or $name == null ) :
        $errors['name'] = 'Nama harus diisi.';
      endif;
      if( $username == null or $username == null ) :
        $errors['username'] = 'Username harus diisi.';
      endif;
      if( $password == null or $password == null ) :
        $errors['password'] = 'Password harus diisi.';
      endif;
      if( $password !== $passwordRepeat ) :
        $errors['password_repeat'] = 'Konfirmasi password salah.';
      endif;
      $this->response(
        [
          "status" => 301,
          "message" => 'Registrasi Gagal',
          'errors' => $errors
        ],200);
    else:
      $this->user_model->registerUser([
        'name' => $name,
        'username' => $username,
        'password' 	=> $password
      ]);
      $this->response(
        [
          "status" => 200,
          "message" => 'Registrasi Berhasil',
          'errors' => $errors
        ],200);
    endif;

  }

}