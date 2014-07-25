<?php

print_r($_FILES);

if (isset($_FILES['uploadfile'])){
	require '../../../common/dbconfig.php';
	$query = "INSERT INTO  uploadfiles (filename,filesize,filtype,filedate,filedata)
VALUES ('".mysql_real_escape_string($FILES['uploadfile']['name']."',".
intval($_FILE['uploadfile']['size']).",'".mysql_real_escape_string($_FILES['uploadfile']['type']).
"',Now(),'".mysql_real_escape_string(file_get_contents($_FILES['uploadfile']['tmp_name']))."')";
echo "Query: $query<br />\r\n";
mysql_query($query,$dblink) or die("insert query failed: $query ".mysql_error();
break;
}


echo '<html><head><title>Upload Test</title></head><body>
<form action="'.$_SERVER['PHP_SELF'].'" enctype-"multipart/form-data" method="post">
<label>File to upload: <input type="file" name"uploadfile" /></label>
<input type="submit" value="Upload your file"/></form>
</body></html>';
