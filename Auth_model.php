<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {


 public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }
    public function register_user($username, $password) {

        $query = $this->db->get_where('Users', array('username' => $username));
        if ($query->num_rows() > 0) {
            return false; // Username already exists
        } else {
            $data = array(
                'username' => $username,
                'password' => md5($password) // Hashed password
            );
            $this->db->insert('Users', $data);
            return true;
        }
    }

}
?>
