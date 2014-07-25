<?php
	include_once '../../common/common.php';
	ShowHeader('Other'); 
	ShowBreadCrumbs(__DIR__); ?>
	
<h1>Regular Expression Testing</h1>
<?php
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
<p>URL to retrieve: <input type="text" name="url" size="60" value="' . (!empty($_POST['url']) ? $_POST['url'] : '') . '"><br />';
echo 'Or text to scan: <textarea name="scantext" rows="10" cols="60">' . 
	(!empty($_POST['scantext']) ? htmlentities($_POST['scantext']) : '') .
   '</textarea></p>';
echo '<p>Pattern: <input type="text" name="pattern" size="60" value="' . 
	(!empty($_POST['pattern']) ? htmlentities($_POST['pattern']) : '') .
   '"><br />';
echo '<input type="checkbox" name="notcasesensitive" value="1" ' . (!empty($_POST['notcasesensitive']) ? 'checked' : '') . 
   '>Case-insensitive&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<input type="checkbox" name="multiline" value="1" ' . (!empty($_POST['multiline']) ? 'checked' : '') . 
   '>Match across multiple lines<br />';
echo '<input type="submit" name="action" value="Search Regular Expression"></form>' . "\r\n";

if (!empty($_POST['pattern'])) {
   if (!empty($_POST['url'])) {
	$intext = file_get_contents($_POST['url']);
	echo 'Retrieved ' . strlen($intext) . ' byte' . (strlen($intext) != 1 ? 's' : '') . ' from ' .
		$_POST['url'] . '...<br />';
   }
   else {
	$intext = $_POST['scantext'];
	echo 'Analyzing ' . strlen($intext) . ' byte' . (strlen($intext) != 1 ? 's' : '') . '...<br />';
   }
   $pattern = '|' . $_POST['pattern'] . '|U' . (!empty($_POST['notcasesensitive']) ? 'i' : '') .
       (!empty($_POST['multiline']) ? 's' : '');
   echo "Checking pattern '" . htmlentities($pattern) . "'...<br />";
   $count = preg_match_all($pattern,$intext,$matches);
   echo 'Found ' . $count . ' match' . ($count != 1 ? 'es' : '') . '...<br />';
   if ($count) {
   	echo '<pre>' . print_r($matches,true) . '</pre>';
    }
}
?>
<?php ShowFooter();