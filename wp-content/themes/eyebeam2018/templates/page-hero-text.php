<?php

extract($GLOBALS['eyebeam2018']['curr_hero']);
?>
<div class="hero-text">
	<?php if ($show_page_title == 'show'){ ?>
			<h2><?php the_title(); ?></h2>
			<?php } ?>
	<div class="text"><?php echo $text; ?></div>
</div>
