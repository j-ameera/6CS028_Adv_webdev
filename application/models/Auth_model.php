<?php
class Auth_model extends CI_Model {
    public function register_user($username, $hashed_password) { // Changed parameter to hashed_password
        $data = array(
            'username' => $username,
            'password' => $hashed_password, // Use hashed password directly
            'role' => 'visitor' // Default role
        );

        return $this->db->insert('users', $data);
    }
}
?>
