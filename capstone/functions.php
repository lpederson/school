<?php
	$workingDir = '/home/lpederson/public_html/capstone/compile';

//Variable definitions
if(!defined('WEBSITE_URL'))
	if(__DIR__ == '/home/CLASSES/callandrews/capstone/html')
		define('WEBSITE_URL','http://hosting.csumb.edu/classes/callandrews/capstone/html');
	else if (__DIR__ == '/Applications/MAMP/htdocs/capstone/html')
		define('WEBSITE_URL','http://localhost:8888/capstone/html');

if(!defined('WEBSITE_PATH'))
	if(__DIR__ == '/home/CLASSES/callandrews/capstone/html')
		define('WEBSITE_PATH','/home/CLASSES/callandrews/capstone/html');
	else if (__DIR__ == '/Applications/MAMP/htdocs/capstone/html')
		define('WEBSITE_PATH','/Applications/MAMP/htdocs/capstone/html');


//Website Functions - Aesthetic
function startHeader($title = 'Capstone'){
	echo '
	<head>
		<title>'.$title.'</title>
		<meta charset="windows-1252">
		<meta name="Keywords" content="C,C++" />
		<meta name="Description" content="Free C/C++ tutorials, references, examples for Computer Science students." />
		
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/JavaScript" src="js/kinetic-v4.3.3.js"></script>
		<script type="text/JavaScript" src="js/tabCapture.js"></script>
		<script type="text/JavaScript" src="js/scrollLocationSave.js"></script>
		<script type="text/JavaScript" src="js/link.js"></script>';

}
function displayBanner(){
echo '
    <div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/csumb_logo.png" alt="Logo"></a>
			</div>
			<div id="banner">
				<a href="index.php"><img src="images/banner.png" alt="Logo"></a>
			</div>
		</div>
	</div>
';
}
function displayFooter(){
	echo '
	<div style="clear: both;">&nbsp;</div>
	<div id="footer">
		<p><strong>&copy; Copyright 2012 CSUMB</strong></p>
		<p>Drew Callan & Luke Pederson</p>
	</div>
	';
}

function leftColumnNav($depth = ""){
	echo '<div id="sidebar">
			<!-- <ul class="link"> -->
			<ul>
				<!--
				<li>
					<div id="search" >
						<form method="get" action="#">
							<div>
								<input type="text" name="s" id="search-text" value="" />
								<input type="submit" id="search-submit" value="GO" />
							</div>
						</form>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</li>
				-->
				<li><a href="'.$depth.'index.php">Home</a></li>
				<li><a href="lesson1.php">Lesson 1</a>
					<ul>
						<li><a href="'.$depth.'datatypes.php">Data Types</a></li>
						<li><a href="'.$depth.'operators.php">Operators</a></li>
						<li><a href="'.$depth.'relational-operators.php">Relational (Boolean) Operators</a></li>
						<li><a href="'.$depth.'strings.php">Strings</a></li>
					</ul>
				</li>
				<li><a href="lesson2.php">Lesson 2</a></li>
					<ul>
						<li><a href="'.$depth.'ifelse.php">If / Else</a></li>
						<li><a href="'.$depth.'switch.php">Switch</a></li>
						<li><a href="'.$depth.'arrays.php">Arrays</a></li>
						<li><a href="'.$depth.'loops.php">Loops</a></li>
					</ul>
				<li><a href="lesson3.php">Lesson 3</a></li>
					<ul>
						<li><a href="'.$depth.'scope.php">Scope</a></li>
						<li><a href="'.$depth.'function.php">Functions</a></li>
						<li><a href="'.$depth.'pointers.php">Pointers</a></li>
					</ul>
			</ul>
		<div style="clear: both;">&nbsp;</div>
	</div>';
}

// C/C++ Functions
function showInputTextarea($program, $fieldName = "input",$rows = "20",$columns = "75",$compiler = "C++"){
	if(!empty($_POST[$fieldName]) && $_POST[$fieldName] != $program)
		$program = $_POST[$fieldName];
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post" onsubmit="return saveScrollPositions(this);">
			<textarea id="'.$fieldName.'" name="'.$fieldName.'" rows="'.$rows.'" cols="'.$columns.'" onkeydown="captureTabPress(\''.$fieldName.'\')">'.$program.'</textarea>
			<!-- <p>Compiler:<br /></p> -->
			<!-- <input type="radio" name="compiler" value="C++" checked="checked" />  C++ -->
			<!-- <input type="radio" name="compiler" value="C"    />  C-->
			<input type="submit" name="compileSubmit" value="Build and Run"  />
			<input type="reset" name="reset" value="Reset Code" />
			
			<input type="hidden" name="scrollx" id="scrollx" value="0" />
			<input type="hidden" name="scrolly" id="scrolly" value="0" />
		</form>';
	$_POST['compiler'] = "C++";
}
function compileInput($inputField = "input"){
	if(!empty($_POST['compileSubmit']) && !empty($_POST[$inputField])){
		global $workingDir;
		$_POST[$inputField] = str_replace("\"","\\\"",$_POST[$inputField]);
		$output = '';
		logData(date("H:i:s-Ymd") . '\n');
		if(!function_exists('exec')) {
			echo "Unable to call 'exec' function";
			return;
		}
		exec('echo "'.$_POST[$inputField].'" >> '.$workingDir.'/input$$.c ; echo $$',$pid);
		$pid = $pid[0];
		$inputFile = $workingDir . '/input'.$pid.'.c';
		$execFile  = $workingDir . '/input'.$pid.'.exe';
		$errFile   = $workingDir . '/input'.$pid.'.err';
		$wildFile  = $workingDir . '/input'.$pid.'.*';
		
		exec(($_POST['compiler'] == 'C++' ? 'g++ ' : 'gcc ') .$inputFile.' -o '.$execFile.' 2> '.$errFile, $output);
		if( file_get_contents($errFile) == ''){
			exec($execFile,$output);
			$output = implode("\n",$output);
		}else{
			$lines = file($errFile);
			$output = '';
			foreach($lines as $line){
				$output .= trim(preg_replace('/.*?:/', '', $line, 1)) . "\n";
				//$output .= trim(nl2br($line));	
			}
		}
		//Clean up
		exec('rm -f '.$wildFile);
		exec('sleep 10 & ; kill $pid & ; rm -f '.$wildFile);
		//exec('kill ' . $pid );
		//$output = str_replace('\n','<br>',$output);
		return $output;
	}
}
function showOutputTextarea($output,$fieldName = "output",$rows = 10, $columns = 75){
	if(!empty($output)){
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
			<textarea id="'.$fieldName.'" rows="'.$rows.'" cols="'.$columns.'" readonly>'.$output.'</textarea><br>
		</form>';}
}
function restoreScrollLocation(){
	$scrollx = 0;
	$scrolly = 0;
	if(!empty($_REQUEST['scrollx'])) {
		$scrollx = $_REQUEST['scrollx'];
	}
	if(!empty($_REQUEST['scrolly'])) {
		$scrolly = $_REQUEST['scrolly'];
	}
	echo '
	<script type="text/javascript">
		window.scrollTo("'.$scrollx.'","'.$scrolly.'");
	</script>';
}
// Function to get the client ip address
function getClientIp() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
function logData($s){
	if(!empty($s)){
		if(substr($s,0,-1) != '\n')
			substr_replace($s ,'\n',-1);
		$myFile = "log/log" . date("YW");
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $s);
		fclose($fh);
	}
}