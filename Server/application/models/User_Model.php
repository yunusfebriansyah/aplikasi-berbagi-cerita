<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model{

  public function getDetailUser($username)
  {
    return $this->db->get_where('users', ['username' => $username])->result_array();
  }
  
  public function loginUser($username, $password)
  {
    $users = $this->db->get_where('users', ['username' => $username])->result_array();
    if( count($users) === 1 ) :
      if( password_verify($password, $users[0]['password']) ) :
        return $users;
      else:
        return false;
      endif;
    else :
      return false;
    endif;
    
  }

  public function registerUser($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $this->db->insert('users', $data);
  }

  public function editUser($name, $username, $newUsername = null)
  {
    $this->db->set('name', $name);
    if( $newUsername != null ) :
      $this->db->set('username', $newUsername);
    endif;
    $this->db->where('username', $username);
    $this->db->update('users');
  }

  public function changePassword($password, $username)
  {
    $this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
    $this->db->where('username', $username);
    $this->db->update('users');
  }


}