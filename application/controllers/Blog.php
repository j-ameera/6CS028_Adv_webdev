<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); // Ensure form helper is loaded for file upload

        // Manually load the RoleMiddleware class from the custom directory
        require_once(APPPATH . 'middleware/RoleMiddleware.php');
        $this->rolemiddleware = new RoleMiddleware();
    }

    public function create() {
        $this->rolemiddleware->checkRole(['admin']);
        $this->load->view('blog/create');
    }

    public function store() {
        $this->rolemiddleware->checkRole(['admin']);

        // Handle file upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB max file size
        $this->load->library('upload', $config);

        $image = null;
        if ($this->upload->do_upload('image')) {
            $fileData = $this->upload->data();
            $image = $fileData['file_name'];
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('blog/create');
            return;
        }

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'image' => $image,
            'video_url' => $this->input->post('video_url'),
            'author_id' => 1  // Assuming user id 1 for now, replace with actual logged-in user id
        );

        if ($this->Blog_model->insert_post($data)) {
            $this->session->set_flashdata('success', 'Post created successfully');
        } else {
            $this->session->set_flashdata('error', 'There was a problem creating the post');
        }

        $insert_id = $this->db->insert_id();
        redirect('/home/view/' . $insert_id);
    }

    public function delete($id) {
        $this->rolemiddleware->checkRole(['admin']);
        if ($this->Blog_model->delete_post($id)) {
            $this->session->set_flashdata('success', 'Post deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'There was a problem deleting the post');
        }
        redirect('/home');
    }

    public function view($id) {
        $post = $this->Blog_model->get_post($id);
        $this->load->view('blog/view', array('post' => $post));
    }

    public function index() {
        $posts = $this->Blog_model->get_all_posts();
        $this->load->view('blog/index', array('posts' => $posts));
    }
}
?>
