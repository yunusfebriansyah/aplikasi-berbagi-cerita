<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";
class Stories extends Server
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Stories_Model', 'stories_model', TRUE);
  }

  public function service_get()
  {
    $this->response(
      [
        "status" => 200,
        'message' => 'Data berhasil ditampilkan',
        "stories" => $this->stories_model->getAllStories(),
      ],
      200
    );
  }

  public function service_post()
  {
    $data = [
      'user_id' => $this->post('user_id'),
      'title' => $this->post('title'),
      'description' => $this->post('description')
    ];
    $result = $this->stories_model->addStories($data);
    if ($result) :
      $this->response(
        [
          "status" => 200,
          "message" => 'Buat cerita berhasil'
        ],
        200
      );
    else :
      $this->response(
        [
          "status" => 200,
          "message" => 'Buat cerita gagal!'
        ],
        200
      );
    endif;
  }

  public function service_put($id)
  {
    $data = [
      'user_id' => $this->put('user_id'),
      'title' => $this->put('title'),
      'description' => $this->put('description')
    ];
    $result = $this->stories_model->editStories($data, $id);
    if ($result) :
      $this->response(
        [
          "status" => 200,
          "message" => 'Ubah cerita berhasil'
        ],
        200
      );
    else :
      $this->response(
        [
          "status" => 200,
          "message" => 'Ubah cerita gagal!'
        ],
        200
      );
    endif;
  }

  public function service_delete($id)
  {
    $result = $this->stories_model->deleteStories($id);
    if ($result) :
      $this->response(
        [
          "status" => 200,
          "message" => 'Hapus cerita berhasil'
        ],
        200
      );
    else :
      $this->response(
        [
          "status" => 200,
          "message" => 'Hapus cerita gagal!'
        ],
        200
      );
    endif;
  }
}
