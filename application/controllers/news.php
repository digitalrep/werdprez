<?php

  class News extends CI_Controller
  {
    private $header = 'templates/header';
	
    public function __construct()
	{
	  parent::__construct();
	  $this->load->model('news_model');
	  $this->load->library("session");
	  $this->load->helper(array('form', 'url'));
	  if($this->session->userdata('level'))
	  {
	    $this->header = 'templates/header2';
	  }
	}
	
	public function index()
	{
	  $data['news'] = $this->news_model->get_news();
	  $data['title'] = 'News';
	  $data['tags'] = $this->news_model->get_tags();
	  $data['archives'] = $this->news_model->get_archives();
	  $this->load->view($this->header, $data);
	  $this->load->view('news/index', $data);
	  $this->load->view('templates/footer');
	}

	public function view($slug)
	{
	  $data['news_item'] = $this->news_model->get_news($slug);
	  if(empty($data['news_item']))
	  {
	    echo "Empty";
	    show_404();
	  }
	  $data['title'] = $data['news_item']['title'];
	  $this->load->view($this->header, $data);
	  $this->load->view('news/view', $data);
	  $this->load->view('templates/footer');
	}
	
	public function tag($tag)
	{
	  $data['news'] = $this->news_model->get_news_by_tag($tag);
	  $data['latest'] = $this->news_model->get_latest();
	  $data['title'] = 'News';
	  $data['tag'] = $tag;
	  $this->load->view($this->header, $data);
	  $this->load->view('news/tag', $data);
	  $this->load->view('templates/footer');
	}
	
	public function archives()
	{
	  $year = $this->uri->segment(3);
	  $month = $this->uri->segment(4);
	  $data['news'] = $this->news_model->get_news_by_archive($year, $month);
	  $data['tags'] = $this->news_model->get_tags();
	  $data['latest'] = $this->news_model->get_latest();
	  $data['title'] = 'News';
	  $this->load->view($this->header, $data);
	  $this->load->view('news/archive', $data);
	  $this->load->view('templates/footer');
	}
	
	public function search()
	{
      $data['news'] = $this->news_model->search($this->input->post('term'));
	  $data['latest'] = $this->news_model->get_latest();
	  $data['title'] = 'Search Results';
	  $data['tags'] = $this->news_model->get_tags();
	  $this->load->view($this->header, $data);
	  $this->load->view('news/search', $data);
	  $this->load->view('templates/footer');
	}
	
	public function create()
	{
	  if(!$this->session->userdata('level'))
	  {
	    redirect(site_url());
	  }
	  $this->load->library('form_validation');
	  $data['title'] = "Create a New Article";
	  $this->form_validation->set_rules('title', 'Article Title', 'required');
	  $this->form_validation->set_rules('author', 'Article Author', 'required');
	  $this->form_validation->set_rules('text', 'Article Body', 'required');
	  $this->form_validation->set_rules('intro', 'Introduction', 'required|max_length[420]');
	  if($this->form_validation->run() === FALSE)
	  {
	    $this->load->view($this->header, $data);
	    $this->load->view('news/create');
	    $this->load->view('templates/footer');
	  }
	  else
	  {
		$this->news_model->set_news();
	    $this->load->view($this->header);
		$this->load->view('news/success');
	    $this->load->view('templates/footer');
	  }
	}
  }

?>