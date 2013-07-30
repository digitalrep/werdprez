  <div id="contents">
	<div class="main">
  	  <h1>Latest Articles</h1>
	  <ul class="news">
	  <?php foreach ($news as $news_item): ?>
		<li>
		  <div class="date">
			<p><span><?php echo $news_item['day'] . "/" . $news_item['month']; ?></span><?php echo $news_item['year']; ?></p>
		  </div>
		  <h2><?php echo $news_item['title'] ?><span>By <?php echo $news_item['author'] ?></span></h2>
		  <?php $string = '/news/view/' . $news_item['slug']; ?>
		  <p><?php echo $news_item['intro'] ?><span><a href="<?php echo site_url($string); ?>" class="more">Read More</a></span></p>
		</li>
      <?php endforeach ?>
	</ul>
  </div>
  <div class="sidebar">
    <h1>Articles by:</h1>
	<ul class="posts">
	  <li>
	    <h4 class="title">Tags</h4>
		<p class='tags'>
		<?php  
		  foreach($tags as $tag):
		    $blah = $tag['tags'];
			$b = explode(", ", $blah);
			for($i=0;$i<sizeof($b);$i++)
			{
		      echo " <a href='" . site_url() . "news/tag/" . $b[$i] . "'>" . $b[$i] . "</a> ";
			}
		  endforeach
		?>
		</p>
	  </li>
	  <li>
	    <h4 class="title">Search</h4>
		<?php $attributes = array('class' => 'message'); echo form_open('news/search/', $attributes); ?>
		  <input type="text" name="term" onmouseout="javascript:return false;" onfocus="this.select();" value="Search"><br>
		  <input type="submit" value="Search">
		<?php echo form_close(); ?><br>
	  </li>
	  <li>
	    <h4 class="title">Archives</h4>
	    <p class="archives">
		<?php 
		  for($i=0;$i<sizeof($archives);$i++)
		  {
		    echo $archives[$i];
		  }
		?>
		</p>
	  </li>	  
	</ul>
  </div>
</div>