<?php
	include_once 'functions.php';
	require_once 'dbconfig.php';
	ob_start();
	showHeader('CST 336 - Final Project'); 
	if(!SignedIn())
		SignIn();
	else
		SignOut();
	ob_flush();
?>
	<body>
		<!--top part start -->
		<div id="top">
			<ul>
				<li class="hover"><a href="index.php">home</a></li>
				<li><a href="help.php">about us</a></li>
			</ul>
			<?php 
			if(SignedIn()) 
				echo '<p class="account">Hi <a href="account.php">'.$_COOKIE['CST336_username'].'</a>. <a href="'.$_SERVER['PHP_SELF'].'?logout=true">[ Sign Out ]</a></p>';
			else
				echo '<p class="account"><a href="login.php">Login</a></p>';
			?>
		</div>
		<!--top part end -->
		<!--header start -->
		<div id="header" style="height:60px">
			<h2><span>CST 336 - Final Project</span></h2>
		</div>
		<!--header end -->
		<!--body start -->
		<div id="body">
			<br class="spacer" />
			<ul class="nav">
				<li class="navLink"><a href="browse.php" class="service">Browse</a></li>
				<li class="navLink"><a href="buy.php" class="testimonial">Buy</a></li>
				<li class="navLink"><a href="sell.php" class="project">Sell</a></li>
			</ul>
			<!--left panel start -->
			<div id="left">
				<?php
				if(SignedIn()){
					if(purchaseVehicle() === true){
						echo "Transaction Pending - Approval Required from Seller<br>";
						echo "Thank you for using this awesome site!<br><br><br>";
					}else
					if(!empty($_POST['update'])){
						$query = "UPDATE vehicles SET ";
						foreach($_POST['update'] as $key => $value){
							$query .= " ".$key."='".$value."',";	
						}
						$query = substr($query, 0, -1);
						$query .= " WHERE id='".$_POST['updateid']."'";
						mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
						echo "Update Successful<br><br><br><br>";
					}
					if(!empty($_GET['edit'])){
						editVehicle();
					}else{
						echo '<h2>Account</h2>';
						
						echo '
						<form action="'.$_SERVER['PHP_SELF'].'" method="post">
						<table cellpadding="5">
							<tr><td>New Username</td><td><input type="text" name="username" value="'.$_COOKIE['CST336_username'].'" /></td></tr>
							<tr><td>New Password</td><td><input type="password" name="password" value="" /></td></tr>
							<tr><td>Confirm New Password</td><td><input type="password" name="passwordconfirm" value="" /></td></tr>
							<tr><td><input type="reset" value="Reset" />    <input type="submit" name="accountinfo" value="Submit" /></td><td></td></tr>
						</table>
						</form>'; 
						updateAccountInfo();
						echo '<br class="spacer" />
						<br><br><br>
						
						<h2>Your Pending Transactions</h2>';
						$query = "SELECT id FROM accounts WHERE username='".$_COOKIE['CST336_username']."'";
						$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
						$myline = mysql_fetch_assoc($result);
						$query = "SELECT * FROM transactions WHERE buyerid='".$myline['id']."' OR sellerid='".$myline['id']."'";
						$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
						while($line = mysql_fetch_assoc($result)){
							if($line['pending'] == '1'){
								if($myline['id'] == $line['buyerid']){
									echo "You are Buying From<br>";
									$query = "SELECT username,email FROM accounts WHERE id='".$line['sellerid']."'";
									$sellerresult = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
									$sellerline = mysql_fetch_assoc($sellerresult);
									echo '<table cellpadding="5" border="1"><tr>';
									foreach($sellerline as $key => $value){
										echo '<th>'.$key.'</th>';
									}
									echo '</tr><tr style="background-color:#C0C0C0">';
									foreach($sellerline as $key => $value){
										echo '<td>'.$value.'</td>';
									}
									echo '</tr></table>';
									
								}else
								if($myline['id'] == $line['sellerid']){
									echo "You are Selling To<br>";
									$query = "SELECT username,email FROM accounts WHERE id='".$buyerid."'";
									$buyerresult = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
									$buyerline = mysql_fetch_assoc($buyerresult);
									echo '<table cellpadding="5" border="1"><tr>';
									foreach($buyerline as $key => $value){
										echo '<th>'.$key.'</th>';
									}
									echo '</tr><tr style="background-color:#C0C0C0">';
									foreach($buyerline as $key => $value){
										echo '<td>'.$value.'</td>';
									}
									echo '</tr></table>';
								}
								$query = "SELECT * FROM vehicles WHERE id='".$line['vehicleid']."'";
								$vehicleresult = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
								$vehicleline = mysql_fetch_assoc($vehicleresult);
								echo '<table cellpadding="5" border="1"><tr>';
								foreach($vehicleline as $key => $value){
									if($key == 'id' || $key == 'accountid')
										continue;
									echo '<th>'.$key.'</th>';
								}
								echo '</tr><tr style="background-color:#C0C0C0">';
								foreach($vehicleline as $key => $value){
									if($key == 'id' || $key == 'accountid')
										continue;
									if($key == 'price'){
										echo '<td >'.$line['price'].'</td>';
										continue;
									}
									echo '<td>'.$value.'</td>';
								}
								echo '</tr></table>';
							}
						}
						echo '<br><br>';
						echo '<h2>Your Vehicles</h2>';
						
						$id = '';
						$query = "SELECT id FROM accounts WHERE username='".$_COOKIE['CST336_username']."'";
						$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
						if($line = mysql_fetch_assoc($result))
							$id = $line['id'];
						else
							echo "Unable to locate your username in DB";
							
						$query = "SELECT DISTINCT vehicles.id, vehicles.make, vehicles.model, vehicles.year, vehicles.price, vcondition FROM vehicles INNER JOIN accounts ON vehicles.accountid='".$id."'";
						$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
						$count = mysql_num_rows($result);
						if($count > 0){
							while($line = mysql_fetch_assoc($result)){
								echo '<table cellpadding="5" border="1">';
								echo '<tr><th><a href="'.$_SERVER['PHP_SELF'].'?edit='.$line['id'].'">Edit</a></th><th></th></tr>';
								$rowbg = 0;
								foreach($line as $key => $value){
									if($key == 'id' || $key == 'accountid')
										continue;
									echo '<tr'.(($rowbg++) & 1 ? ' style="background-color:#C0C0C0"' : '') .'><td>'.$key.'</td><td>'.$value.'</td></tr>';
								}
								echo '</table><br><br>';
							}
						}else{
							echo "You have no vehicles";
						}
					}
				}else{
					echo "<p>You are not signed in.</p>";
				
				}
				?>
			</div>
			<!--left panel end -->
			<br class="spacer" />
		</div>
		<!--body end -->
		<br class="spacer" />
		<!--footer start -->
		<div id="footerMain">
			<div id="footer">
				<ul>
					<li><a href="index.php">Home</a>|</li>
					<li><a href="browse.php">Browse</a>|</li>
					<li><a href="buy.php">Buy</a>|</li>
					<li><a href="sell.php">Sell</a></li>
				</ul>
				<p class="copyright">&copy; Luke Pederson and Drew Callan. All rights reserved.</p>
				<a href="http://validator.w3.org/check?uri=referer" target="_blank" class="xht"></a>
				<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="cs"></a>
			</div>
		</div>
	<!--footer end -->
	</body>
</html>
<?php 
function updateAccountInfo(){
	global $dblink;
	if(SignedIn()){
		if(!empty($_POST['accountinfo']) && $_POST['accountinfo'] == 'Submit'){
			if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordconfirm'])){
				if($_POST['password'] == $_POST['passwordconfirm']){
					$query = "UPDATE accounts SET username='".$_POST['username']."', password='".$_POST['password']."' WHERE username='".$_COOKIE['CST336_username']."'";			
					mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
					setcookie("CST336_username",$_POST['username']);
					setcookie("CST336_password",$_POST['password']); //Add md5() later
					echo 'Update Username and Password Successful';
				}
				else{
					echo "Passwords do not match!";
				}
			}
		}
	}
}
function editVehicle(){
	global $dblink;
	if(SignedIn()){
		if(!empty($_GET['edit'])){
			$query = "SELECT * FROM accounts WHERE username='".$_COOKIE['CST336_username']."'";
			$acctresult = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
			if($acctline = mysql_fetch_assoc($acctresult)){
				$query = "SELECT * FROM vehicles WHERE id='".$_GET['edit']."'";			
				$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
				$count = mysql_num_rows($result);
				if($count > 0){
					echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
					echo '<table cellpadding="5">';
					$id = '';
					while($line = mysql_fetch_assoc($result)){
						if($line['accountid'] != $acctline['id']){
							echo "Nice try dickhead";
							return false;
						}
						foreach($line as $key => $value){
							if($key == 'accountid')
								continue;
							if($key == 'id'){
								$id = $value;
								continue;
							}
							echo '<tr><td>'.$key.'</td><td><input type="text" name="update['.$key.']" value="'.$value.'" /></td></tr>';
						}
					}
					echo '</table>
					<input type="hidden" name="updateid" value="'.$id.'" />
					<input type="submit" name="Update" value="Submit" />
					</form>';
				}
			}
		}
	}
}
function purchaseVehicle(){
	global $dblink;
	if(!empty($_POST['purchaseid']) && $_POST['confirmpurchase'] =='Yes'){
		$query = "SELECT id, price, accountid FROM vehicles WHERE id='".$_POST['purchaseid']."'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$line = mysql_fetch_assoc($result);
		
		$vehicleid = $line['id'];
		$price = $line['price'];
		$sellerid = $line['accountid'];
		
		$query = "SELECT id FROM accounts WHERE username='".$_COOKIE['CST336_username']."'";
		$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		$line = mysql_fetch_assoc($result);
		
		$buyerid = $line['id'];
		
		$query = "INSERT INTO transactions (sellerid, buyerid, vehicleid, price, pending) VALUES ('".$sellerid."','".$buyerid."', '".$vehicleid."', '".$price."','1')";
		mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
		return true;
	}
	return false;
}
