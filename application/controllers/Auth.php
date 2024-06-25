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

            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Pass the hashed password to the model
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
            $sql = "SELECT * FROM users WHERE username=?";
            $query = $this->db->query($sql, array($username));

            if ($query->num_rows() === 1) {
                $row = $query->row_array();
                if (password_verify($password, $row['password'])) {
                    $this->session->set_userdata('username', $row['username']); 
                    $this->session->set_userdata('id', $row['id']); 
                    $this->session->set_userdata('role', $row['role']); // Store role in session
                    redirect('home');
                } else {
                    $this->session->set_flashdata('error', 'Incorrect username or password!');
                    redirect('Auth'); // Redirect back to login page
                }
            } else {
                $this->session->set_flashdata('error', 'Incorrect username or password!');
                redirect('Auth'); // Redirect back to login page
            }
        }
    }

    public function unauthorized() {
        echo "Unauthorized Access";
    }

    public function logout($value='') {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
?>
