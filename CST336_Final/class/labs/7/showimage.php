d: showimage.php,v 1.1.1.1 2004/10/17 05:25:00 andrewcoile Exp $
$Log: showimage.php,v $
Revision 1.1.1.1  2004/10/17 05:25:00  andrewcoile
Version 0.9

*/

header('Content-type: image/jpeg');

if (!isset($_REQUEST['type']))
	$_REQUEST['type'] = 'T';
	
if (!isset($_REQUEST['ID'])) {
	readfile('images/notavailable.jpg');
	exit();
}
else {
	require_once('../../dbconfig.php');

	if ($_REQUEST['type'] == 'T')
		$query = 'select staffthumb as image';
	else
		$query = 'select staffphoto as image';
	$query .= ' from staff where staffid=' . $_REQUEST['ID'];
	$result = mysql_query($query,$dblink);
	if (!$result) {
		readfile('images/notavailable.jpg');
		exit();
	}
	if (mysql_num_rows($result) == 0) {
		readfile('images/notavailable.jpg');
		exit();
	}	
	$line = mysql_fetch_assoc($result);
	if (!$line) {
		readfile('images/notavailable.jpg');
		exit();
	}
	if ($line['image'] == "") {
		readfile('images/notavailable.jpg');
		exit();
	}

	echo $line['image'];
}
?>
