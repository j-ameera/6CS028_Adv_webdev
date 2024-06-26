<?php
class RoleMiddleware {
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function checkRole($roles) {
        $userRole = $this->CI->session->userdata('role');
        if (!in_array($userRole, $roles)) {
            $this->CI->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('/');
        }
    }
}
