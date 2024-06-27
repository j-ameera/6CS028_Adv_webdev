<?php
class Auth_model extends CI_Model {
    public function register_user($username, $hashed_password) {
        $data = array(
            'username' => $username,
            'password' => $hashed_password,
            'role' => 'visitor'
        );

        return $this->db->insert('users', $data);
    }

    public function is_username_taken($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }
}
?>
