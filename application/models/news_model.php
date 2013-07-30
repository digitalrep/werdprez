<?php

  class News_model extends CI_Model
  {
    public function __construct()
	{
	  $this->load->database();
	}
	
	public function get_news($slug = FALSE)
	{
	  if($slug === FALSE)
	  {
	    $query = $this->db->query('SELECT * FROM news ORDER BY id DESC LIMIT 6');
		return $query->result_array();
	  }
	  $query = $this->db->get_where('news', array('slug' => $slug));
	  return $query->row_array();
	}
	
	public function get_tags()
	{
	  $query = $this->db->query('SELECT tags FROM news');
	  return $query->result_array();  
	}
	
	public function get_archives()
	{
	  $query = $this->db->query('SELECT DISTINCT year FROM news');
	  $years = $query->result_array();
	  foreach($years as $year)
	  {
	    $newarray[] = $year['year'] . "<br>";
	    $query = $this->db->query("SELECT DISTINCT month FROM news WHERE year = " . $year['year']);
		$months = $query->result_array();
		foreach($months as $mth)
		{
		  $newarray[] = "&nbsp;&nbsp&nbsp;&nbsp;<a href='" . site_url() . "news/archives/" .  $year['year'] . "/" . $mth['month'] . "'>" . $this->convert($mth['month']) . "</a><br>";
		}
	  }
	  return $newarray; 
	}
	
	private function convert($month)
	{
	  switch($month)
	  {
	    case 1: return "January"; break;
		case 2: return "February"; break;
		case 3: return "March"; break;
		case 4: return "April"; break;
		case 5: return "May"; break;
		case 6: return "June"; break;
		case 7: return "July"; break;
		case 8: return "August"; break;
		case 9: return "September"; break;
		case 10: return "October"; break;
		case 11: return "November"; break;
		case 12: return "December"; break;
	  }
	}
	
	public function get_news_by_archive($year, $month)
	{
	  $query = $this->db->query("SELECT * FROM news WHERE year=" . $year . " AND month=" . $month);
	  return $query->result_array(); 
	}
	
	public function search($term)
	{
	  $query = $this->db->query("SELECT * FROM news WHERE MATCH(title, intro, text) AGAINST('$term')");
      return $query->result_array();
    }
	
	public function get_news_by_tag($tag)
	{
	  if($tag === FALSE)
	  {
	    echo "no tag";
	  }
	  $new = str_replace('%20', ' ', $tag);
	  $tag = '%' . $new . '%';
	  $query = $this->db->query("SELECT * FROM news WHERE tags LIKE '$tag'");
	  return $query->result_array();
	}
	
	public function get_latest()
	{
	  $query = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 6");
	  return $query->result_array();
	}
	
  }

?>