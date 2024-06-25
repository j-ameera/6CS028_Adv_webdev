<?php
class Blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_posts() {
        $query = $this->db->get('blog_posts');
        return $query->result();
    }

    public function get_post($id) {
        $query = $this->db->get_where('blog_posts', array('id' => $id));
        return $query->row();
    }

    public function insert_post($data) {
        return $this->db->insert('blog_posts', $data);
    }

    public function delete_post($id) {
        return $this->db->delete('blog_posts', array('id' => $id));
    }
}
?>
