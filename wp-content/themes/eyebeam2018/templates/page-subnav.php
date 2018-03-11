<?php

if (empty($GLOBALS['eyebeam2018']['has_toc'])) {
	return;
}

echo "<div class=\"subnav\">\n";
echo "<ul>\n";

foreach ($GLOBALS['eyebeam2018']['modules'] as $module) {
	extract($module);
	if ($type == 'toc') {
		continue;
	}
	if (! empty($toc_title)) {
		$title = $toc_title;
		$hash = sanitize_title($title);
	}
	echo "<li><a href=\"#$hash\">$title</a></li>\n";
}

echo "</ul>\n";
echo "</div>\n";
