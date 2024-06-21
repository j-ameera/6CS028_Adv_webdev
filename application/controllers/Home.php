<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct() {
        parent::__construct();
$is_logged_in = $this->session->userdata('id');

        if (!isset($is_logged_in) || $is_logged_in != true)
        {
           redirect('auth');
        }
    }
	
	public function index()
	{
		$this->load->view('home/home');
	}

	public function article_read_more($article=''){

	$article_number = $_GET['article'];

	$article_to_show = 'article'.$article_number;


$this->load->view('home/'.$article_to_show);
	}
}
