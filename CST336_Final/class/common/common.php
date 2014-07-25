<?php
if(!defined('WEBSITE_URL'))
	if(__DIR__ == '/home/CLASSES/pedersonlukeb/cst336/class/common')
		define('WEBSITE_URL','http://hosting.csumb.edu/classes/pedersonlukeb/cst336/class/');
	else if (__DIR__ == '/Applications/MAMP/htdocs/cst336/class/common')
		define('WEBSITE_URL','http://localhost:8888/cst336/class');

if(!defined('WEBSITE_PATH'))
	if(__DIR__ == '/home/CLASSES/pedersonlukeb/cst336/class/common')
		define('WEBSITE_PATH','/home/CLASSES/pedersonlukeb/cst336/class/');
	else if (__DIR__ == '/Applications/MAMP/htdocs/cst336/class/common')
		define('WEBSITE_PATH','/Applications/MAMP/htdocs/cst336/class/');
	

function ShowHeader($title){
echo "<!DOCTYPE html>
		<html>
			<head>
				<title>$title</title>
				<meta name='description' content='This site is for CST 336 - Fall 2012'; charset='utf-8' >
				<link rel='stylesheet' type='text/css' href='".WEBSITE_URL."css/style.css'/>
			</head>
			<body>
			
			<div id='header'>
				<h1><a href='".WEBSITE_URL."'>CST 336 - Luke Pederson</a></h1>
			</div>
	";
}

function ShowMainNav(){
	echo "<div id='nav_main'>
				<ul>
					<li><a href='".WEBSITE_URL."'>Main</a></li>
					<li><a href='".WEBSITE_URL."assignments/'>Assignments</a></li>
					<li><a href='".WEBSITE_URL."labs/'>Labs</a></li>
					<li><a href='".WEBSITE_URL."other/'>Other</a></li>
				</ul>
			</div>";
}

function ShowFooter(){
	echo "<hr style='width:100%'>
		<p>Copyright &copy; 2012".(date('Y') != '2012' ? ('-'.date('Y')) : '')."<br />
		Luke Pederson<br />
		All Rights Reserved</p><br />
		
		</body></html>";
}
function ShowBreadCrumbs($path){
	$path .= '/';
	if(!empty($path) && $path != WEBSITE_PATH){
		$path = str_replace(WEBSITE_PATH,'',$path);
		$crumbs = explode('/',$path);
		echo "<div id=breadcrumbs><a href='".WEBSITE_URL."'>Home</a>";
		$crumbPath = '';
		foreach($crumbs as $crumb){
			if(!empty($crumb)){
				echo " &gt; <a href='".WEBSITE_URL.$crumbPath.$crumb."'>".ucfirst($crumb)."</a>";
				$crumbPath .= $crumb.'/';
			}
		}
		echo '</div>';
	}
}

function ShowTextField($description, $name, $size, $maxlength = 0, $passwordfield = FALSE) {
    global $ErrorFields;

    if (array_search($name,$ErrorFields) !== FALSE) {
	echo '<div class="error">';
    }
    echo '<label for="' . $name . '">' . $description . ': </label>
	<input type="' . ($passwordfield ? 'password' : 'text') . '" 
	name="' . $name . '" size="' . $size . '" ' .
	($maxlength ? ('maxlength="' . $maxlength . '"') : '') . ' />';
    if (array_search($name,$ErrorFields) !== FALSE) {
	echo '</div>';
    }
    echo '<br />';
}
