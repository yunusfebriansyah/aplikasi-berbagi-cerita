<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class ChangePassword extends Server {

  public function service_put($username)
  {
    $this->load->model('User_Model', 'user_model', TRUE);
    $users = $this->user_model->getDetailUser($username);

    $oldPassword = $this->put('old_password');
    $newPassword = $this->put('new_password');
    $passwordRepeat = $this->put('password_repeat');

    $errors = [
      'old_password' => null,
      'new_password' => null,
      'password_repeat' => null
    ];

    if( $oldPassword == null ) :
      $oldPassword = '';
    endif;

    if( !password_verify($oldPassword, $users[0]['password']) or ($oldPassword == '' or $oldPassword == null) or ($newPassword == '' or $newPassword == null) or ($passwordRepeat !== $newPassword) ):
      if( !password_verify($oldPassword, $users[0]['password']) ) :
        $errors['old_password'] = 'Password lama salah.';
      endif;
      if( $oldPassword == '' or $oldPassword == null ) :
        $errors['old_password'] = 'Password lama harus diisi.';
      endif;
      if( $newPassword == '' or $newPassword == null ) :
        $errors['new_password'] = 'Password baru harus diisi.';
      endif;
      if( $passwordRepeat !== $newPassword ) :
        $errors['password_repeat'] = 'Konfirmasi password salah.';
      endif;
      $this->response([
          "status" => 301,
          "message" => 'Ubah Password Gagal',
          'errors' => $errors
        ],200);
    else:
      $this->user_model->changePassword($newPassword, $username);
      $this->response([
        "status" => 200,
        "message" => 'Ubah Password Berhasil',
        'errors' => $errors
      ],200);
    endif;

  }

}
