<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->library(['session', 'upload']);
        $this->load->helper(['url', 'form']);

        require_once(APPPATH . 'middleware/RoleMiddleware.php');
        $this->rolemiddleware = new RoleMiddleware();
    }

    private function get_youtube_videos($query) {
        $apiKey = 'AIzaSyBNwAiTYbQpWhpLlhSPKlZ4NOvMjWPlEiM';
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&q={$query}&key={$apiKey}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    private function get_gifs($query) {
        $apiKey = 'O7evqnnVOuut7li5Tcf9QPJOhLZLTSZF';
        $url = "https://api.giphy.com/v1/gifs/search?api_key={$apiKey}&q={$query}&limit=5";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function create() {
        $this->rolemiddleware->checkRole(['admin']);
        $this->load->view('blog/create');
    }

    public function store() {
        $this->rolemiddleware->checkRole(['admin']);

        // Handle file upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB max file size
        $this->upload->initialize($config);

        $image = null;
        if ($this->upload->do_upload('image')) {
            $fileData = $this->upload->data();
            $image = $fileData['file_name'];
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('blog/create');
            return;
        }

        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'image' => $image,
            'video_url' => $this->input->post('video_url'),
            'gif_url' => $this->input->post('gif_url'),
            'youtube_keywords' => $this->input->post('youtube_keywords'),
            'giphy_keywords' => $this->input->post('giphy_keywords'),
            'hashtags' => $this->input->post('hashtags'),
            'author_id' => $this->session->userdata('user_id') ?? 1  // Use logged-in user id or 1 as default
        );

        if ($this->Blog_model->insert_post($data)) {
            $this->session->set_flashdata('success', 'Post created successfully');
        } else {
            $this->session->set_flashdata('error', 'There was a problem creating the post');
        }

        $insert_id = $this->db->insert_id();
        redirect('/home/view/' . $insert_id);
    }

    public function view($id) {
        $post = $this->Blog_model->get_post($id);
        $videos = $this->get_youtube_videos($post->youtube_keywords);
        $gifs = $this->get_gifs($post->giphy_keywords);
        $comments = $this->Blog_model->get_comments($id);

        $data = array(
            'post' => $post,
            'videos' => $videos['items'],
            'gifs' => $gifs['data'],
            'comments' => $comments
        );

        $this->load->view('blog/view', $data);
    }

    public function delete($id) {
        $this->rolemiddleware->checkRole(['admin']);
        if ($this->Blog_model->delete_post($id)) {
            $this->session->set_flashdata('success', 'Post deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'There was a problem deleting the post');
        }
        redirect('/home');
    }

    public function index() {
        $posts = $this->Blog_model->get_all_posts();
        $this->load->view('blog/index', array('posts' => $posts));
    }

    // Add Comment
    public function add_comment($post_id) {
        $data = array(
            'post_id' => $post_id,
            'content' => $this->input->post('content'),
            'author' => $this->session->userdata('username') ?? 'Visitor',
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->Blog_model->add_comment($data);
        redirect('home/view/' . $post_id);
    }

    // Add Reply
    public function add_reply($comment_id) {
        $data = array(
            'comment_id' => $comment_id,
            'content' => $this->input->post('content'),
            'author' => $this->session->userdata('username') ?? 'Visitor',
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->Blog_model->add_reply($data);
        $post_id = $this->Blog_model->get_post_id_by_comment($comment_id);
        redirect('home/view/' . $post_id);
    }

    // Enhanced: Add search functionality
    public function search() {
        $hashtag = $this->input->get('hashtag');
        $data['posts'] = $this->Blog_model->get_posts_by_hashtag($hashtag);
        $this->load->view('blog/index', $data);
    }
}
?>
