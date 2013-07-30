<?php

  class News extends CI_Controller
  {
	
    public function __construct()
	{
	  parent::__construct();
	  $this->load->model('news_model');
	  $this->load->helper(array('form', 'url'));
	}
	
	public function index()
	{
	  $data['news'] = $this->news_model->get_news();
	  $data['title'] = 'News';
	  $data['tags'] = $this->news_model->get_tags();
	  $data['archives'] = $this->news_model->get_archives();
	  $this->load->view('templates/header' $data);
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
	  $this->load->view('templates/header' $data);
	  $this->load->view('news/view', $data);
	  $this->load->view('templates/footer');
	}
	
	public function tag($tag)
	{
	  $data['news'] = $this->news_model->get_news_by_tag($tag);
	  if(empty($data['news_item']))
	  {
	    echo "Empty";
	    show_404();
	  }
	  $data['latest'] = $this->news_model->get_latest();
	  $data['title'] = 'News';
	  $data['tag'] = $tag;
	  $this->load->view('templates/header' $data);
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
	  $this->load->view('templates/header' $data);
	  $this->load->view('news/archive', $data);
	  $this->load->view('templates/footer');
	}
	
	public function search()
	{
      $data['news'] = $this->news_model->search($this->input->post('term'));
	  $data['latest'] = $this->news_model->get_latest();
	  $data['title'] = 'Search Results';
	  $data['tags'] = $this->news_model->get_tags();
	  $this->load->view('templates/header' $data);
	  $this->load->view('news/search', $data);
	  $this->load->view('templates/footer');
	}
  }

?>