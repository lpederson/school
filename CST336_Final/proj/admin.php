<?php
	include_once 'functions.php';
	require_once 'dbconfig.php';
	SignInRequired();
	showHeader('CST 336 - Final Project'); 
	session_start();
	
	echo '<body><div id="body">';
	echo '<a href="'.WEBSITE_URL.'">Main Site</a><br>';
	echo '<a href="'. $_SERVER['PHP_SELF'] .'">Admin Home</a><br><br>';
	if(isset($_SESSION['table'])){
		if(isset($_POST['table']))
			$_SESSION['table'] = $_POST['table'];
		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
				Accounts <input type="radio" name="table" value="accounts" '.($_SESSION['table'] == 'accounts' ? ' checked="checked"' : ''). '/><br>
				Vehicles <input type="radio" name="table" value="vehicles" '.($_SESSION['table'] == 'vehicles' ? ' checked="checked"' : ''). '/><br>
				Transactions <input type="radio" name="table" value="transactions" '.($_SESSION['table'] == 'transactions' ? ' checked="checked"' : ''). '/><br>
				<input type="submit" name="tablechoice" value="Update" />
			</form><br>
		';
		if(isset($_POST['submit']) && $_POST['submit'] == 'Add Record')
			addRecord();
		if(isset($_POST['submit']) && $_POST['submit'] == 'Add'){
			$query = "INSERT INTO ".$_SESSION['table']. " (";
			foreach($_POST['add'] as $key => $value){
				if($key == 'id')
					continue;
				$query .= " ".$key . ",";
			}
			$query = substr($query, 0, -1);
			$query .= ") VALUES (";
			foreach($_POST['add'] as $key => $value){
				if($key == 'id')
					continue;
				$query .= " '".$value . "',";
			}
			$query = substr($query, 0, -1);
			$query .= ")";
			mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
			echo "Record Add Successful<br><br>";
			exit();
		
		}
		
		if(isset($_POST['update'])){
			if(isset($_POST['submit']) && $_POST['submit'] == 'Nuke'){
				$query = "DELETE FROM ".$_SESSION['table']." WHERE id=".$_POST['updateid'];
				mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
				echo "Record Nuke Successful<br><br>";
				exit();
			
			}else{
				$query = "UPDATE ".$_SESSION['table']. " SET ";
				foreach($_POST['update'] as $key => $value){
					if($key == 'id')
						continue;
					$query .= " ".$key . "='" . $value ."',";
				}
				$query = substr($query, 0, -1);
				$query .= " WHERE id=".$_POST['updateid'];
				mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
				echo "Record Update Successful<br><br>";
				exit();
		 	}
		}
		
		if(isset($_GET['edit'])){
			editRecord($_GET['edit']);
		}
		else
			fetchTableData($_SESSION['table']);
	}else{
		if(isset($_POST['table']))
			$_SESSION['table'] = $_POST['table'];
		else
			echo '
				<h3>Choose table to edit</h3>
				<form action="'.$_SERVER['PHP_SELF'].'" method="post">
					Accounts <input type="radio" name="table" value="accounts" /><br>
					Vehicles <input type="radio" name="table" value="vehicles" /><br>
					Transactions <input type="radio" name="table" value="transactions" /><br>
					<input type="submit" name="tablechoice" value="Update" />
				</form><br>
			';
			$_SESSION['table'] = 'accounts';
			fetchTableData('accounts');
	}

	
	//Print table data	
	function fetchTableData($table){
		global $dblink;
		// List records
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$_SESSION['table']." ";
		
		
		if (isset($_GET['sort'])){
			if(strpos($_GET['sort'],'_desc') !== false){
				$_GET['sort'] = str_replace('_desc','',$_GET['sort']);
				$query .= "ORDER BY ".$_GET['sort'] ." DESC";
			}
			else
				$query .= "ORDER BY ".$_GET['sort'];
		}
				
		if (!isset($_GET['start'])) {
			$_SESSION['query'] = $query;
			$query .= " LIMIT 25";
		} 
		else {
			$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
			$query .= " LIMIT " . intval($_GET['start']) . ",25";
		}
		
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$count = mysql_num_rows($result);
		if (!isset($_GET['start'])) {
			$fquery = "SELECT FOUND_ROWS() AS numrows";
			$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
			$fline = mysql_fetch_assoc($fresult);
			$_SESSION['totalrows'] = $fline['numrows'];
		}
		
		echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
		echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
				<input type="submit" name="submit" value="Add Record" />
			</form><br>';
		
		$line = mysql_fetch_assoc($result);
		if(count($line) > 0 && !empty($line)){
			if($count > 25)
				ShowPrevNext();
			echo '<table cellpadding="5"><thead><tr><th></th>';
			foreach($line as $key => $value){
				echo '<th><a href="' . $_SERVER['PHP_SELF'] . '?sort='.$key.'">'.$key.'</a>
					<a href="' . $_SERVER['PHP_SELF'] . '?sort='.$key.'_desc"> (desc)</a></th>';
			}
			echo '</tr></thead><tbody';
			$rowbg = 0;
			do{
				echo '<tr '.($rowbg & 1 ? ' style="background-color:#C0C0C0"' : '') .'>
					<td><a href="' . $_SERVER['PHP_SELF'] . '?edit='. $line['id'] .'">Edit</a></td>';
					
				foreach($line as $key => $value){
					echo '<td>' . $value . '</td>';
				}
				
				echo '</tr>';
				$rowbg++;
			}while ($line = mysql_fetch_assoc($result));
			
			echo '</tbody></table>';
			if($count > 25)
				ShowPrevNext();
		}
		else{
			echo 'Table is empty';
		}
	}
	
	function editRecord($id){
		global $dblink;
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$_SESSION['table']." WHERE ".$_SESSION['table'].".id=".$id;
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		if($line = mysql_fetch_assoc($result)){
			$rowbg = 0;
			echo '
			<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table cellpadding="5">
				<thead>
					<tr><th>Key</th><th>Value</th></tr>	
				</thead><tbody>';
			foreach($line as $key => $value){
				if($key == 'id')
					echo '<tr '.($rowbg & 1 ? ' style="background-color:#C0C0C0"' : '') .'>
						<td>'.$key.'</td><td>'.$value.'</td>
						</tr>';
				else
					echo '<tr '.($rowbg & 1 ? ' style="background-color:#C0C0C0"' : '') .'>
						<td>'.$key.'</td><td><input type="text"   name="update['.$key.']" value="'. $value .'"></td>
						</tr>';
			}
			echo '</tbody></table>
			<input type="hidden" name="updateid" value="'.$id.'" />
			<input type="submit" value="Update" />
			<br><br><br><br>
			<p>Be careful.</p><br>
			<input type="submit" name="submit" value="Nuke" />
			</form>';
		}
	}
	function addRecord(){
		global $dblink;
		$query = "SELECT * FROM ".$_SESSION['table']." LIMIT 1";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		if($line = mysql_fetch_assoc($result)){
			$rowbg = 0;
			echo '
			<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
			<table cellpadding="5">
				<thead>
					<tr><th>Key</th><th>Value</th></tr>	
				</thead><tbody>';
			foreach($line as $key => $value){
				if($key == 'id')
					continue;
				else
					echo '<tr '.($rowbg & 1 ? ' style="background-color:#C0C0C0"' : '') .'>
						<td>'.$key.'</td><td><input type="text"   name="add['.$key.']" value=""></td>
						</tr>';
			}
			echo '</tbody></table>
			<input type="submit" name="submit" value="Add" />
			</form>';
		}
		exit();
	}
	
	echo "</body>";
	echo '</div></html>';