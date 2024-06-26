<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('id');

        if (!isset($is_logged_in) || $is_logged_in != true) {
           redirect('auth');
        }

        // Load the Blog model
        $this->load->model('Blog_model');
    }
    
    public function index() {
        // Fetch all blog posts
        $data['posts'] = $this->Blog_model->get_all_posts();
        
        // Load the home view with posts data
        $this->load->view('home/home', $data);
    }

    public function view($id) {
        // Fetch the post by id
        $post = $this->Blog_model->get_post($id);

        // Check if post is found
        if (!$post) {
            show_404();
        }

        // Fetch related videos and gifs
        $videos = $this->get_youtube_videos($post->title);
        $gifs = $this->get_gifs($post->title);

        // Pass data to the view
        $data = [
            'post' => $post,
            'title' => $post->title, // Ensure title is passed
            'content' => $post->content, // Ensure content is passed
            'videos' => isset($videos['items']) ? $videos['items'] : [],
            'gifs' => isset($gifs['data']) ? $gifs['data'] : []
        ];

        // Load the post view
        $this->load->view('blog/post', $data);
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

    public function article_read_more($article='') {
        $article_number = $_GET['article'];
        $article_to_show = 'article'.$article_number;
        $this->load->view('home/'.$article_to_show);
    }
}
?>
