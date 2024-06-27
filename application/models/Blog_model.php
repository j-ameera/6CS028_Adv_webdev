<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Retrieve all blog posts
    public function get_all_posts() {
        $this->db->select('id, title, content, image, hashtags, created_at'); // Explicitly select columns
        $query = $this->db->get('blog_posts');
        return $query->result();
    }

    // Retrieve a single blog post by its ID
    public function get_post($id) {
        $this->db->select('id, title, content, image, hashtags, video_url, gif_url, youtube_keywords, giphy_keywords, created_at'); // Explicitly select columns
        $query = $this->db->get_where('blog_posts', array('id' => $id));
        return $query->row();
    }

    // Insert a new blog post
    public function insert_post($data) {
        return $this->db->insert('blog_posts', $data);
    }

    // Update a blog post by its ID
    public function update_post($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('blog_posts', $data);
    }

    // Delete a blog post by its ID
    public function delete_post($id) {
        return $this->db->delete('blog_posts', array('id' => $id));
    }

    // Retrieve comments for a specific post
    public function get_comments($post_id) {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->where('post_id', $post_id);
        $this->db->order_by('created_at', 'ASC');
        $comments = $this->db->get()->result();

        // Fetch replies for each comment
        foreach ($comments as $comment) {
            $comment->replies = $this->get_replies($comment->id);
        }

        return $comments;
    }

    // Retrieve replies for a specific comment
    public function get_replies($comment_id) {
        $this->db->select('*');
        $this->db->from('replies');
        $this->db->where('comment_id', $comment_id);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get()->result();
    }

    // Insert a new comment
    public function add_comment($data) {
        return $this->db->insert('comments', $data);
    }

    // Insert a new reply
    public function add_reply($data) {
        return $this->db->insert('replies', $data);
    }

    // Retrieve post ID by comment ID
    public function get_post_id_by_comment($comment_id) {
        $this->db->select('post_id');
        $this->db->from('comments');
        $this->db->where('id', $comment_id);
        return $this->db->get()->row()->post_id;
    }

    // Enhanced: Retrieve posts by hashtag
    public function get_posts_by_hashtag($hashtag) {
        $this->db->like('hashtags', $hashtag);
        $query = $this->db->get('blog_posts');
        return $query->result_array();
    }

    // Additional methods can be added here
}
?>
