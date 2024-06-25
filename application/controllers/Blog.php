<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('RoleMiddleware'); // Load the RoleMiddleware
    }

    public function create() {
        $this->rolemiddleware->checkRole(['admin']);
        // Existing create post code
    }

    public function delete($id) {
        $this->rolemiddleware->checkRole(['admin']);
        // Existing delete post code
    }

    public function view($id) {
        // Existing view post code
    }
}
