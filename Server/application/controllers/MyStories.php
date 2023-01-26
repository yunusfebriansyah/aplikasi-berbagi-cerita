<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class MyStories extends Server {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Stories_Model', 'stories_model', TRUE);
  }

  public function service_get($userId)
  {
    $this->response(
			[
				"status" => 200,
        'message' => 'Data berhasil ditampilkan',
        "stories" => $this->stories_model->getStoriesByUser($userId),
			],200);
  }

}