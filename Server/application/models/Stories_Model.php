<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories_Model extends CI_Model{

  public function getAllStories()
  {
    $this->db->order_by('story_id', 'DESC');
    return $this->db->get('vw_stories')->result_array();
  }

  public function getDetailStory($id)
  {
    return $this->db->get_where('vw_stories', ['story_id' => $id])->row();
  }
  
  public function getStoriesByUser($userId)
  {
    $this->db->order_by('story_id', 'DESC');
    return $this->db->get_where('vw_stories', ['user_id' => $userId])->result_array();
  }

  public function addStories($data)
  {
    $this->db->insert('stories', $data);
    return $this->db->affected_rows();
  }

  public function editStories($data, $id)
  {

    $userId = $this->db->get_where('stories', ['id' => $id])->row()->user_id;

    if( $userId != $data['user_id'] ) :
      return false;
    endif;

    $this->db->set('title', $data['title']);
    $this->db->set('description', $data['description']);
    $this->db->where('id', $id);
    $this->db->update('stories');
    return $this->db->affected_rows();
  }

  public function deleteStories($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('stories');
    return $this->db->affected_rows();
  }

}