// application/controllers/ValidationController.php
<?php
class ValidationController extends CI_Controller {

    public function validate_username() {
        $username = $this->input->post('username');
        if (strlen($username) < 5) {
            echo json_encode(['status' => 'error', 'message' => 'Username must be at least 5 characters long.']);
        } else {
            echo json_encode(['status' => 'success']);
        }
    }

    public function validate_password() {
        $password = $this->input->post('password');
        if (strlen($password) < 8) {
            echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters long.']);
        } else {
            echo json_encode(['status' => 'success']);
        }
    }
}
?>
