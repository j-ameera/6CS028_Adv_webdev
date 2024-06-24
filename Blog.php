<?php
class Blog extends CI_Controller {

    public function create() {
        $this->load->view('blog/create');
    }

    public function store() {
        $this->load->model('Blog_model');
        
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'image_url' => $this->input->post('image_url'),
            'video_url' => $this->input->post('video_url'),
            'author_id' => 1  // Assuming user id 1 for now, replace with actual logged-in user id
        );
        
        $this->Blog_model->insert_post($data);
        $insert_id = $this->db->insert_id();
        redirect('/home/view/' . $insert_id);
    }

    public function delete($id) {
        $this->load->model('Blog_model');
        $this->Blog_model->delete_post($id);
        redirect('/home');
    }
}
?>
