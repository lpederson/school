<?php
	include_once('../../common/common.php');
	include_once('../../common/dbconfig.php');
	
	ShowHeader("Lab5 - Books.php");
	ShowMainNav();
	ShowBreadCrumbs(__DIR__);
	
	$query = "select * from books as b,authors as a where b.author=a.authorid order by title";
	$results = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error() . "\n$query");
	
	echo mysql_num_rows($results) . " record". ((mysql_num_rows($results) != 1) ? "s" : "") . " returned.<br>";
	
	//Init table
	//echo '<div style="border:solid;border-color:white">';
	echo '<table cell-padding="10px"';
	echo '<thead><tr><th>Author </th><th>Title</th></tr></thead>';
	$alt = 0;
	
	while ($line = mysql_fetch_assoc($results)) {
		echo '<tr'.(($alt++ & 1) ? ' bgcolor="blue"' : '').'><td>' 
		. $line['lastname'].', '.$line['firstname'].'</td><td>'.$line['title'] . '</td></tr>';
	}
	
	//var_dump($alt);
	//echo '</div>';
	echo '</table>';
	//Table end
	
	ShowFooter();