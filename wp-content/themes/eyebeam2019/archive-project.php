<?php

// We actually want the PAGE of this, not the ARCHIVE of this. I know, it is
// super confusing, but the upshot is we don't need pagination, so we will go
// with the page-modular.php template. (20180303/dphiffer)

query_posts(array(
	'post_type' => 'page',
	'name' => 'projects'
));

include_once('page-modular.php');
