<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValidationController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function validate_register() {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->load->view('auth/registration', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $this->load->model('Auth_model');
            $register = $this->Auth_model->register_user($username, $hashed_password);

            if ($register) {
                $this->session->set_flashdata('success', 'Account created! Welcome!');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Unknown error occurred');
                redirect('auth/signup');
            }
        }
    }
}
?>
