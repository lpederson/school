<?php
	include_once('../../common/common.php');
	include_once('../../common/dbconfig.php');
	
	ShowHeader("Lab5");
	ShowMainNav();
	ShowBreadCrumbs(__DIR__);
	
	$query = "select b.title, a.lastname,a.firstname, g.genrename from books b left outer join authors a on b.author=a.authorid 
			  left outer join genre g on b.genre=g.genreid order by g.genrename,a.lastname,a.firstname,b.title";
	$results = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error() . "\n$query");
	
	echo mysql_num_rows($results) . " record". ((mysql_num_rows($results) != 1) ? "s" : "") . " returned.<br>";
	
	//Init table
	//echo '<div style="border:solid;border-color:white">';
	echo '<table cellpadding="10px"';
	echo '<thead><tr><th>Author </th><th>Title</th><th>Genre</th></tr></thead>';
	$alt = 0;
	
	while ($line = mysql_fetch_assoc($results)) {
		echo '<tr'.(($alt++ & 1) ? ' bgcolor="blue"' : '').'><td>' 
		. $line['title'].'</td><td>'.$line['lastname'].', '.$line['firstname'] . '</td><td>'.$line['genrename'].'</tr>';
	}
	
	//var_dump($alt);
	//echo '</div>';
	echo '</table>';
	//Table end
	
	ShowFooter();