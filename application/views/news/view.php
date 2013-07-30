<div id="contents">
  <div class="post">
    <div class="date"><p><span><?php echo $news_item['day'] . "/" . $news_item['month']; ?></span><?php echo $news_item['year']; ?></p></div>
      <h1><?php echo $news_item['title'] ?><span class="author">By <?php echo $news_item['author'] ?></span></h1>
	  <div class="article">
        <?php echo "<p>" . $news_item['intro'] . "</p>"; ?>
        <?php echo $news_item['text'] ?>
	  </div>
	<span><a href="<?php echo site_url('/news'); ?>" class='more'>Articles</a></span>
  </div>
</div>