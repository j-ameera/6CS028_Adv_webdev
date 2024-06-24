<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('id');

        if (!isset($is_logged_in) || $is_logged_in != true) {
           redirect('auth');
        }

        // Load the Blog model
        $this->load->model('Blog_model');
    }
    
    public function index() {
        // Fetch all blog posts
        $data['posts'] = $this->Blog_model->get_all_posts();
        
        // Load the home view with posts data
        $this->load->view('home/home', $data);
    }

    public function view($id) {
        // Fetch the post by id
        $data['post'] = $this->Blog_model->get_post($id);
        
        // Load the post view
        $this->load->view('blog/post', $data);
    }

    public function article_read_more($article='') {
        $article_number = $_GET['article'];
        $article_to_show = 'article'.$article_number;
        $this->load->view('home/'.$article_to_show);
    }
}
?>
