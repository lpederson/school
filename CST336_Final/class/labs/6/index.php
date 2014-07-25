<?php
	require_once "../../common/dbconfig.php";
	
	$query = "select FirstName,LastName,UNIX_TIMESTAMP(Born) as Born, UNIX_TIMESTAMP(Died) as Died, ClosenessDesc, CauseOfDeath  from absentfriends natural join closeness ";
	if(isset($_GET['sort']) && ($_GET['sort'] == 'Born')) {
		$query .= "order by Born, lastname,firstname";
	}
	elseif(isset($_GET['sort']) && ($_GET['sort'] == 'Died')){
		$query .= "order by Died, lastname,firstname";
	}
	elseif(isset($_GET['sort']) && ($_GET['sort'] == 'Closeness')){
		$query .= "order by ClosenessDesc, lastname,firstname";
	}
	elseif(isset($_GET['sort']) && ($_GET['sort'] == 'Cause')){
		$query .= "order by CauseofDeath, lastname,firstname";
	}
	elseif(isset($_GET['sort']) && ($_GET['sort'] == 'Name')){
		$query .= "order by lastname,firstname";
	}
	$result = mysql_query($query, $dblink) or die("Retrieve query failed: $query " . mysql_error());
	
	echo mysql_num_rows($result)." record".((mysql_num_rows($result) != 1) ? "s" : "")." returned.<br />\r\n";
	
	/* Firstname, Lastname, Born ,Died, ClosenessDesc, CauseOfDeath */
	echo '<table cellpadding="5"><thead><tr>
	<th><a href="'.$_SERVER['PHP_SELF'].'?sort=Name">Name</a></th>
	<th><a href="'.$_SERVER['PHP_SELF'].'?sort=Born">Born</a></th>
	<th><a href="'.$_SERVER['PHP_SELF'].'?sort=Died">Died</a></th>
	<th><a href="'.$_SERVER['PHP_SELF'].'?sort=Closeness">Closeness</a></th>
	<th><a href="'.$_SERVER['PHP_SELF'].'?sort=Cause">Cause</a></th>
	</tr></thead></tbody>';

	while($line = mysql_fetch_assoc($result)){
		echo '<tr><td>'.$line['LastName'].', '.$line['FirstName'].
		'</td><td>'.(($line['Born'] != 0) ? date('1, F jS, Y',$line['Born']) : '').
		'</td><td>'.(($line['Died'] != 0) ? date('1, F jS, Y',$line['Died']) : '').
		'</td><td>'.$line['ClosenessDesc'].
		'</td><td>'.$line['CauseOfDeath'].
		'</td></tr>';
	}
	echo '</tbody></table>';
	
