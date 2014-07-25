<?php

	//Database Settings
	$dbhost     = 'localhost';
	$dbuser     = 'pede9786';
	$dbpassword = '194f7ec00d1063bb53c8';
	$dbdatabase = 'pede9786';
	
	//Connection settings
	$dblink = mysql_pconnect($dbhost,$dbuser,$dbpassword)
		or die("Could not connect to database at $dbhost");
	mysql_select_db($dbdatabase,$dblink)
		or die("Could not select database $dbdatabase " . mysql_error());
