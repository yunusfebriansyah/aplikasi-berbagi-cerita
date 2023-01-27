<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";
class DetailStory extends Server
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Stories_Model', 'stories_model', TRUE);
  }

  public function service_get($id)
  {
    $this->response(
      [
        "status" => 200,
        'message' => 'Data berhasil ditampilkan',
        "story" => $this->stories_model->getDetailStory($id),
      ], 200);
  }
}