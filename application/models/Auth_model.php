<?php
class Auth_model extends CI_Model {
    public function register_user($username, $password) {
        $data = array(
            'username' => $username,
            'password' => md5($password),
            'role' => 'visitor' // Default role
        );

        return $this->db->insert('users', $data);
    }
}
