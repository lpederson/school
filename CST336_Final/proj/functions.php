<?php
if(!defined('WEBSITE_URL'))
	if(__DIR__ == '/home/CLASSES/pedersonlukeb/cst336/proj')
		define('WEBSITE_URL','http://hosting.csumb.edu/classes/pedersonlukeb/cst336/proj');
	else if (__DIR__ == '/Applications/MAMP/htdocs/cst336/proj')
		define('WEBSITE_URL','http://localhost:8888/cst336/proj');

if(!defined('WEBSITE_PATH'))
	if(__DIR__ == '/home/CLASSES/pedersonlukeb/cst336/proj')
		define('WEBSITE_PATH','/home/CLASSES/pedersonlukeb/cst336/proj');
	else if (__DIR__ == '/Applications/MAMP/htdocs/cst336/proj')
		define('WEBSITE_PATH','/Applications/MAMP/htdocs/cst336/proj');
	

function showHeader($title){
	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html  xmlns='http://www.w3.org/1999/xhtml'>
			<head>
				<meta name='description' content='This site is for CST 336 - Fall 2012' >
				<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
				<link rel='stylesheet' type='text/css' href='".WEBSITE_URL."/style.css'/>
				<title>$title</title>
				<script>
					function reloadPage(){ location.reload() }
				</script>
			</head>
	";
}
function showBanner(){
	
	
}

function ShowMainNav(){
	echo "<div id='nav_main'>
				<ul>
					<li><a href='".WEBSITE_URL."/browse.php'>Browse</a></li>
					<li>   |   </li>
					<li><a href='".WEBSITE_URL."/buy.php'>Buy</a></li>
					<li>   |   </li>
					<li><a href='".WEBSITE_URL."/sell.php'>Sell</a></li>
					<li>   |   </li>
					<li><a href='".WEBSITE_URL."/help.php'>Help</a></li>
				</ul>
			</div>";
}

function ShowFooter(){
	echo "
		<div class='footer'>
			<hr style='width:100%'>
			<p>Copyright &copy; 2012".(date('Y') != '2012' ? ('-'.date('Y')) : '')."<br />
			Luke Pederson & Drew Callan<br />
			All Rights Reserved</p><br />
		</div>";
}
function ShowBreadCrumbs($path){
	if(!empty($path) && $path != WEBSITE_PATH){
		$path .= '/';
		$path = str_replace(WEBSITE_PATH,'',$path);
		$crumbs = explode('/',$path);
		$crumbPath = '';
		echo "<div id=breadcrumbs><a href='".WEBSITE_URL."'>Home</a>";
		foreach($crumbs as $crumb){
			if(!empty($crumb)){
				echo " &gt; <a href='".WEBSITE_URL.'/'.$crumbPath.$crumb."'>".ucfirst($crumb)."</a>";
				$crumbPath .= $crumb.'/';
			}
		}
		echo '</div>';
	}
}


function validateUser($user,$pass) { 
	/* replace with appropriate username and password checking, 
	such as checking a database */ 
	if ( ($user == 'admin') && ($pass == 'password') )
		return true;
	else
		return false;
}


function SignInRequired() { 
	if(!empty($$_SERVER['PHP_AUTH_USER'])){
		echo "You need to enter a valid username and password.
			If you need a username or password, contact someone."; 
		exit; 
	}
	if (! validateUser($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) { 
		header('WWW-Authenticate: Basic realm="CST336 - Final Project"'); 
		header('HTTP/1.0 401 Unauthorized'); 
			echo "You need to enter a valid username and password.
			If you need a username or password, contact someone."; 
			exit; 
	} 
}


// Signing in - first time
function SignIn(){
	require_once 'dbconfig.php';
	global $dblink;
	if(!empty($_POST['username']) && !empty($_POST['password'])){ //Sign in
		$query = "SELECT username, password FROM accounts WHERE accounts.username='".
			$_POST['username']."' AND accounts.password='".$_POST['password']."'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$num_rows = mysql_num_rows($result);
		if($num_rows == 1){
			$line = mysql_fetch_assoc($result);
			if($_POST['username'] == $line['username'] && $_POST['password'] == $line['password']){
				$query = "UPDATE accounts SET lastlogin='".date("Y/m/d H.i.s")."' WHERE accounts.username='".$_POST['username']."'";
				mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
				setcookie("CST336_username",$_POST['username']);
				setcookie("CST336_password",$_POST['password']); //Add md5() later
				header("Location: ".basename($_SERVER['PHP_SELF']));
				return true;
			}
		}
	}
	return false;
}

//Check if already logged in
function SignedIn(){
	require_once 'dbconfig.php';
	global $dblink;
	if (!empty($_COOKIE['CST336_username']) && !empty($_COOKIE['CST336_password'])) {	
		$query = "SELECT username, password FROM accounts WHERE accounts.username='".
			$_COOKIE['CST336_username']."' AND accounts.password='".$_COOKIE['CST336_password']."'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$num_rows = mysql_num_rows($result);
		if($num_rows == 1){
			$line = mysql_fetch_assoc($result);
			if($_COOKIE['CST336_username'] == $line['username'] && $_COOKIE['CST336_password'] == $line['password']){
				return true;
			}
		}
	}
	return false;
}

//Create account
function CreateAccount(){
	require_once 'dbconfig.php';
	global $dblink;
	if (!empty($_POST['new_username']) && !empty($_POST['new_password']) && !empty($_POST['new_password_confirm'])) {
		if($_POST['new_password'] != $_POST['new_password_confirm'])
			return false;
		$query = "SELECT username, password FROM accounts WHERE accounts.username='".$_POST['new_username']."'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$line = mysql_fetch_assoc($result);
		echo $query;
		if(!empty($line))
			return false;
		$query = "INSERT INTO accounts (username, password) VALUES ('".$_POST['new_username']."', '".$_POST['new_password']."')";
		mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		setcookie("CST336_username",$_POST['new_username']);
		setcookie("CST336_password",$_POST['new_password']);
		return true;
	}
	return false;
}
function SignOut(){
	if(!empty($_GET['logout']) && $_GET['logout'] == 'true'){
		setcookie("CST336_username", "", time()-3600);
		setcookie("CST336_password", "", time()-3600);
		header("Location: ".basename($_SERVER['PHP_SELF']));
	}
}
function ShowPrevNext() {
	echo '<table width="100%"><tr><td>';
	if (empty($_GET['start'])) {
		echo '&nbsp;';
	}
	else {
		echo '<a href="' . $_SERVER['PHP_SELF'] . "?start=" .
		(($_GET['start'] < 25) ? 0 : (intval($_GET['start'])-25)) . '">&lt;&lt;PREV</a>';
	}
	echo '</td><td align="right">'; 
	if (!empty($_GET['start']) && (intval($_GET['start']+25)>$_SESSION['totalrows'])) {
		echo '&nbsp;';
	}
	else {
		echo '<a href="' . $_SERVER['PHP_SELF'] . "?start=" .
		((!empty($_GET['start']) ? intval($_GET['start']) : 0) + 25) . '">Next&gt;&gt;</a>';
	}
		echo '</td></tr></table>' . "\r\n";
}

function uploadPhoto(){
	//Upload Photos
	if (!empty($_FILES['photofile']['name'])) {
		if (!is_uploaded_file($_FILES['photofile']['tmp_name'])) {
			die($_FILES['photofile']['name'] . " is not a valid file.");
		}
	
		require 'dbconfig.php';
	
		$sourcefile = imagecreatefromstring(file_get_contents($_FILES['photofile']['tmp_name']));
		
		/********* PHOTO PROCESSING ***********/
		// Constrain to 1000x1000
		if ( (imagesx($sourcefile) < 1000) && (imagesy($sourcefile) < 1000) ) {
			$photofile = $sourcefile;
		}
		else { // we need to scale down the big image
		if (imagesx($sourcefile) > imagesy($sourcefile)) {
			// landscape orientation
			$newx = 1000;
			$newy = round(1000/imagesx($sourcefile)* imagesy($sourcefile));
		}
		else {
			// portrait orientation
			$newx = round(1000/imagesy($sourcefile)* imagesx($sourcefile));
			$newy = 1000;
		}
		$photofile = imagecreatetruecolor($newx,$newy);
		imagecopyresampled ($photofile, $sourcefile, 0,0,0,0, $newx, $newy, 
		imagesx($sourcefile), imagesy($sourcefile)); 
		echo "Photo sized down to $newx,$newy.<br />";
		}
		ob_start();
		imagejpeg($photofile);
		$photodata = ob_get_clean();
		/********* THUMBNAIL PROCESSING ***********/
		// Constrain to 200x200
		if (imagesx($sourcefile) > imagesy($sourcefile)) {
			// landscape orientation
			$newx = 200;
			$newy = round(200/imagesx($sourcefile)* imagesy($sourcefile));
		}
		else {
			// portrait orientation
			$newx = round(200/imagesy($sourcefile) * imagesx($sourcefile));
			$newy = 200;
		}
		$thumb = imagecreatetruecolor($newx,$newy);
		imagecopyresampled ($thumb, $sourcefile, 0,0,0,0, $newx, $newy, 
		imagesx($sourcefile), imagesy($sourcefile)); 
		ob_start();
		imagejpeg($thumb);
		$thumbdata = ob_get_clean();
		
		$query = "INSERT INTO uploadedphotos (photoname,phototype,
		photodata,thumbwidth,thumbheight,thumbdata,photodate) 
		VALUES ('" . 
		addslashes($_FILES['photofile']['name']) . "',
		'image/jpeg',
		'" . mysql_real_escape_string($photodata) . "',
		$newx,
		$newy,
		'" . mysql_real_escape_string($thumbdata) . "',Now())";
		// echo "Query: '$query'<br />"; // DEBUG!!
		mysql_query($query,$dblink) 
		or die("Update query failed: $query " . mysql_error());
		echo "<b>Photo upload of " . $_FILES['photofile']['name'] . 
		" succeeded.</b>";
		echo "Thumbnail created ($newx,$newy).<br />";
		exit();/*
		echo "
			<form action=".$_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
	Upload Photo File: <input type="file" name="photofile" />
	<input type="hidden" name="id" value="<?= $_REQUEST['id'] ?>" />
	<input type="submit" value="Upload" />
	</form>";*/
	}	
}

function browseAuto(){
	global $dblink;
	$query = '';
	if(!empty($_GET['autotype']))
		$query = "SELECT * FROM vehicles WHERE type='".$_GET['autotype']."'";
	else
		$query = "SELECT * FROM vehicles WHERE type='car' OR type='truck' OR type='van'";
	
	if(!empty($_GET['make']))
		$query .= " AND make='".$_GET['make']."'";
	if(!empty($_GET['model']))
		$query .= " AND model='".$_GET['model']."'";
	if(!empty($_GET['year']))
		$query .= " AND year='".$_GET['year']."'";
	if(!empty($_GET['pricemin']))
		$query .= " AND price>='".$_GET['pricemin']."'";
	if(!empty($_GET['pricemax']))
		$query .= " AND price<='".$_GET['pricemax']."'";
	if(!empty($_GET['condition']))
		$query .= " AND vcondition='".$_GET['condition']."'";
		
	$query_copy = $query;
		
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$_SESSION['query'] = $query;
		$query .= " LIMIT 25";
	} 
	else {
		$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
		$query .= " LIMIT " . intval($_GET['start']) . ",25";
	}
	
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$result_copy = $result;
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$fquery = "SELECT FOUND_ROWS() AS numrows";
		$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
		$fline = mysql_fetch_assoc($fresult);
		$_SESSION['totalrows'] = $fline['numrows'];
	}
	
	echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
	echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

	if($count > 25)
				ShowPrevNext();
				
	if($line = mysql_fetch_assoc($result)){
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">
			<table cellpadding="5">
				<tr><td>Type<select name="autotype">
							<option value="car">Car</option>
							<option value="truck">Truck</option>
							<option value="van">Van</option>
						</select>
					</td>';
		//Make
		$column = array();
		$query = "SELECT DISTINCT make FROM vehicles WHERE type='car' OR type='truck' OR type='van'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['make'];  
		}
		echo '<td>Make<select name="make"><option value=""></option>';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Model
		$column = array();
		$query = "SELECT DISTINCT model FROM vehicles WHERE type='car' OR type='truck' OR type='van'";
		$result =  mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['model'];  
		}
		echo '<td>Model<select name="model"><option value=""></option>';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Year
		echo '<td>Year<input type="text" name="year" value="" size="4" maxlength="4" /></td>';
		
		//Price
		echo '<td>Price (min)<input type="text" name="pricemin" value="" size="10" maxlength="12" /></td>';
		echo '<td>Price (max)<input type="text" name="pricemax" value="" size="10" maxlength="12"/></td>';
		
		//Condition
		$column = array();
		$query = "SELECT DISTINCT vcondition FROM vehicles WHERE type='car' OR type='truck' OR type='van'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['vcondition'];  
		}
		echo '<td>Condition<select name="condition"><option value=""></option>';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		echo '<td style="background-color:#3A6200;"><input type="submit" value="Search" /></td>';
		echo '<input type="hidden" name="type" value="auto" />';
		if(basename($_SERVER['PHP_SELF']) == 'buy.php')
			echo '<td></td></td></table></form><br><br>';
		else
			echo '</tr></table></form><br><br>';
		$query = $query_copy;
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$id = '';
		if($line = mysql_fetch_assoc($result)){
			do{
				echo '<table border="1" cellpadding="5"><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					if($key == 'vcondition'){
						echo '<td>condition</td>';
						continue;	
					}
					echo '<td>'.$key.'</td>';
				}
				echo '</tr><tr>';
				foreach($line as $key => $value){
					if($key == 'id'){ 
						continue;
						$id = $key;
					}
					if($key == 'accountid')
						continue;
					if($key == 'price'){
						echo '<td>$'.$value.'</td>';
						continue;
					}
					echo '<td>'.$value.'</td>';
				}
				if(basename($_SERVER['PHP_SELF']) == 'buy.php')
					echo '<td><a href="'.$_SERVER['PHP_SELF'].'?purchaseid='.$line['id'].'">Buy</a></td></tr></table><br><br>';
				echo '</tr></table><br><br>';
			}while($line = mysql_fetch_assoc($result));
		}
	}
}
function browseMotorcycle(){
	global $dblink;

	$query = "SELECT * FROM vehicles WHERE type='motorcycle'";
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$_SESSION['query'] = $query;
		$query .= " LIMIT 25";
	} 
	else {
		$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
		$query .= " LIMIT " . intval($_GET['start']) . ",25";
	}
	
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$result_copy = $result;
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$fquery = "SELECT FOUND_ROWS() AS numrows";
		$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
		$fline = mysql_fetch_assoc($fresult);
		$_SESSION['totalrows'] = $fline['numrows'];
	}
	
	echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
	echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

	if($count > 25)
				ShowPrevNext();
				
	if($line = mysql_fetch_assoc($result)){
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">
			<table cellpadding="5">
				<tr><td>Type<select name="autotype">
							<option value="car">Car</option>
							<option value="truck">Truck</option>
							<option value="van">Van</option>
						</select>
					</td>';
		//Make
		$column = array();
		$query = "SELECT DISTINCT make FROM vehicles WHERE type='motorcycle'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['make'];  
		}
		echo '<td>Make<select name="make">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Model
		$column = array();
		$query = "SELECT DISTINCT model FROM vehicles WHERE type='motorcycle'";
		$result =  mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['model'];  
		}
		echo '<td>Model<select name="model">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Year
		echo '<td>Year<input type="text" value="" size="4" maxlength="4" /></td>';
		
		//Price
		echo '<td>Price (min)<input type="text" name="pricemin" value="" size="10" maxlength="12" /></td>';
		echo '<td>Price (max)<input type="text" name="pricemax" value="" size="10" maxlength="12"/></td>';
		
		//Condition
		$column = array();
		$query = "SELECT DISTINCT vcondition FROM vehicles WHERE type='motorcycle'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['vcondition'];  
		}
		echo '<td>Condition<select name="condition">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		echo '<td style="background-color:#3A6200;"><input type="submit" value="Search" /></td>';
		echo '</tr></table></form><br><br>';
		$query = "SELECT * FROM vehicles WHERE type='motorcycle'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		if($line = mysql_fetch_assoc($result)){
			do{
				echo '<table border="1" cellpadding="5"><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					if($key == 'vcondition'){
						echo '<td>condition</td>';
						continue;	
					}
					echo '<td>'.$key.'</td>';
				}
				echo '</tr><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					echo '<td>'.$value.'</td>';
				}
				echo '</tr></table><br><br>';
			}while($line = mysql_fetch_assoc($result));
		}
	}
}
function browseBoat(){
		global $dblink;
	
	
	$query = "SELECT * FROM vehicles WHERE type='boat'";
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$_SESSION['query'] = $query;
		$query .= " LIMIT 25";
	} 
	else {
		$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
		$query .= " LIMIT " . intval($_GET['start']) . ",25";
	}
	
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$result_copy = $result;
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$fquery = "SELECT FOUND_ROWS() AS numrows";
		$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
		$fline = mysql_fetch_assoc($fresult);
		$_SESSION['totalrows'] = $fline['numrows'];
	}
	
	echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
	echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

	if($count > 25)
				ShowPrevNext();
				
	if($line = mysql_fetch_assoc($result)){
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">
			<table cellpadding="5">
				<tr><td>Type<select name="autotype">
							<option value="car">Car</option>
							<option value="truck">Truck</option>
							<option value="van">Van</option>
						</select>
					</td>';
		//Make
		$column = array();
		$query = "SELECT DISTINCT make FROM vehicles WHERE type='boat'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['make'];  
		}
		echo '<td>Make<select name="make">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Model
		$column = array();
		$query = "SELECT DISTINCT model FROM vehicles WHERE type='boat'";
		$result =  mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['model'];  
		}
		echo '<td>Model<select name="model">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Year
		echo '<td>Year<input type="text" value="" size="4" maxlength="4" /></td>';
		
		//Price
		echo '<td>Price (min)<input type="text" name="pricemin" value="" size="10" maxlength="12" /></td>';
		echo '<td>Price (max)<input type="text" name="pricemax" value="" size="10" maxlength="12"/></td>';
		
		//Condition
		$column = array();
		$query = "SELECT DISTINCT vcondition FROM vehicles WHERE type='boat'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['vcondition'];  
		}
		echo '<td>Condition<select name="condition">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
	
		echo '<td style="background-color:#3A6200;"><input type="submit" value="Search" /></td>';
		echo '</tr></table></form><br><br>';
		$query = "SELECT * FROM vehicles WHERE type='boat'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		if($line = mysql_fetch_assoc($result)){
			do{
				echo '<table border="1" cellpadding="5"><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					if($key == 'vcondition'){
						echo '<td>condition</td>';
						continue;	
					}
					echo '<td>'.$key.'</td>';
				}
				echo '</tr><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					echo '<td>'.$value.'</td>';
				}
				echo '</tr></table><br><br>';
			}while($line = mysql_fetch_assoc($result));
		}
	}
}
function browseAircraft(){
		global $dblink;
	
	
	$query = "SELECT * FROM vehicles WHERE type='aircraft'";
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$_SESSION['query'] = $query;
		$query .= " LIMIT 25";
	} 
	else {
		$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
		$query .= " LIMIT " . intval($_GET['start']) . ",25";
	}
	
	$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
	$result_copy = $result;
	$count = mysql_num_rows($result);
	
	if (!isset($_GET['start'])) {
		$fquery = "SELECT FOUND_ROWS() AS numrows";
		$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
		$fline = mysql_fetch_assoc($fresult);
		$_SESSION['totalrows'] = $fline['numrows'];
	}
	
	echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
	echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

	if($count > 25)
				ShowPrevNext();
				
	if($line = mysql_fetch_assoc($result)){
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">
			<table cellpadding="5">
				<tr><td>Type<select name="autotype">
							<option value="car">Car</option>
							<option value="truck">Truck</option>
							<option value="van">Van</option>
						</select>
					</td>';
		//Make
		$column = array();
		$query = "SELECT DISTINCT make FROM vehicles WHERE type='aircraft'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['make'];  
		}
		echo '<td>Make<select name="make">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Model
		$column = array();
		$query = "SELECT DISTINCT model FROM vehicles WHERE type='aircraft'";
		$result =  mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['model'];  
		}
		echo '<td>Model<select name="model">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
		
		//Year
		echo '<td>Year<input type="text" value="" size="4" maxlength="4" /></td>';
		
		//Price
		echo '<td>Price (min)<input type="text" name="pricemin" value="" size="10" maxlength="12" /></td>';
		echo '<td>Price (max)<input type="text" name="pricemax" value="" size="10" maxlength="12"/></td>';
		
		//Condition
		$column = array();
		$query = "SELECT DISTINCT vcondition FROM vehicles WHERE type='aircraft'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$column[] =  $row['vcondition'];  
		}
		echo '<td>Condition<select name="condition">';
		foreach($column as $value){
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		echo '</select></td>';
	
		echo '<td style="background-color:#3A6200;"><input type="submit" value="Search" /></td>';
		echo '</tr></table></form><br><br>';
		$query = "SELECT * FROM vehicles WHERE type='aircraft'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		if($line = mysql_fetch_assoc($result)){
			do{
				echo '<table border="1" cellpadding="5"><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					if($key == 'vcondition'){
						echo '<td>condition</td>';
						continue;	
					}
					echo '<td>'.$key.'</td>';
				}
				echo '</tr><tr>';
				foreach($line as $key => $value){
					if($key == 'id' || $key == 'accountid')
						continue;
					echo '<td>'.$value.'</td>';
				}
				echo '</tr></table><br><br>';
			}while($line = mysql_fetch_assoc($result));
		}
	}
}