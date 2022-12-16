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

  public function service_put($username)
  {
    $name = $this->put('name');
    $newUsername = $this->put('username');

    $errors = [
      'name' => null,
      'username' => null
    ];

    $users = $this->user_model->getDetailUser($newUsername);

    if( ($name == null or $name == null) or ($newUsername == null or $newUsername == null) or (count( $users ) > 0 and $newUsername != $username) ) :
      if( count( $users ) > 0 and $newUsername != $username) :
        $errors['username'] = 'Username tidak tersedia.';
      endif;
      if( $name == null or $name == null ) :
        $errors['name'] = 'Nama harus diisi.';
      endif;
      if( $newUsername == null or $newUsername == null ) :
        $errors['username'] = 'Username harus diisi.';
      endif;
      $this->response(
        [
          "status" => 301,
          "message" => 'Edit Profil Gagal',
          'errors' => $errors
        ],200);
    else:
      if( $newUsername != $username ) :
        $this->user_model->editUser($name, $username, $newUsername);
      else :
        $this->user_model->editUser($name, $username);
      endif;
      $this->response(
        [
          "status" => 200,
          "message" => 'Edit Profil Berhasil',
          'errors' => $errors
        ],200);
    endif;

  }

}
