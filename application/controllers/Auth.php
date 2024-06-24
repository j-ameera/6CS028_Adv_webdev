<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->database(); 
    }

    public function index() {
        $this->load->view('auth/index');
    }

    public function signup() {
        $this->load->view('auth/registration');
    }

    public function register() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->load->view('auth/registration', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('Auth_model');
            $register = $this->Auth_model->register_user($username, $password);

            if ($register) {
                $this->session->set_flashdata('success', 'Account created! Welcome!');
            } else {
                $this->session->set_flashdata('error', 'Unknown error occurred');
            }
            redirect('auth');
        }
    }

    public function process_login() {
        $username = $this->input->post('username'); 
        $password = $this->input->post('password'); 

        if (empty($username)) {
            $this->session->set_flashdata('error', 'Username is required!'); 
            redirect('Auth'); 
        } elseif (empty($password)) {
            $this->session->set_flashdata('error', 'Password is required!'); 
            redirect('Auth'); 
        } elseif (strlen($username) < 5) {
            $this->session->set_flashdata('error', 'Username must be at least 5 characters long!');
            redirect('Auth');
        } elseif (strlen($password) < 8) {
            $this->session->set_flashdata('error', 'Password must be at least 8 characters long!');
            redirect('Auth');
        } else {
            $sql = "SELECT * FROM Users WHERE username=? AND password=?";
            $query = $this->db->query($sql, array($username, md5($password)));

            if ($query->num_rows() === 1) {
                $row = $query->row_array();
                $this->session->set_userdata('username', $row['username']); 
                $this->session->set_userdata('password', $row['password']); 
                $this->session->set_userdata('id', $row['id']); 
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Incorrect username or password!');
                redirect('Auth'); // Redirect back to login page
            }
        }
    }

    public function logout($value='') {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
