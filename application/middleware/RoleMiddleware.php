<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleMiddleware {
    public function checkRole($roles) {
        $CI =& get_instance();
        $role = $CI->session->userdata('role');

        if (!in_array($role, $roles)) {
            redirect('auth/unauthorized');
        }
    }
}
