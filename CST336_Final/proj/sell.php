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
					if(!empty($_POST['vehicletype']) && $_POST['vehicletype'] == 'auto'){
						if(!empty($_POST['type']) && !empty($_POST['make']) && !empty($_POST['model']) && !empty($_POST['year']) && !empty($_POST['price']) && !empty($_POST['condition'])){
							$query = "SELECT id FROM accounts WHERE username='".$_COOKIE['CST336_username']."'";
							$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
							$line = mysql_fetch_assoc($result);
							$query = "INSERT INTO vehicles (type,make,model,year,price,vcondition,accountid) VALUES ('".$_POST['type']."','".$_POST['make']."','".$_POST['model']."','".$_POST['year']."','".$_POST['price']."','".$_POST['condition']."','".$line['id']."')";
							mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());
							echo 'Your vehicle was successfully added!<br><br>';
						}
					}
					else
					if(!empty($_GET['type'])){
						if($_GET['type'] == 'auto'){ //Cars, trucks...
							sellAuto();
						}
						if($_GET['type'] == 'motorcycle'){ //Cars, trucks...
							sellMotorcycle();
						}
						if($_GET['type'] == 'boat'){ //Cars, trucks...
							sellBoat();
						}
						if($_GET['type'] == 'aircraft'){ //Cars, trucks...
							sellAircraft();
						}
					}else{
						echo '<p>What type of vehicle are you Selling?</p>
							<form action="'.$_SERVER['PHP_SELF'].'" method="get">
							<table cellpadding="5">
							<tr><td><select name="type">
								<option value="auto">Auto</option>
								<option value="motorcycle">Motorcycle</option>
								<option value="boat">Boat</option>
								<option value="aircraft">Aircraft</option>
							</select></td></tr>
							<br>
							<tr><td><input type="submit" value="Go" /></td></tr>
							</table>
							</form>
							';	
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
function sellAuto(){
	echo '<h2>Enter your vehicles information</h2>';
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
	echo '<table cellpadding="5" border="1">
			<tr><td>Type</td><td><select name="type">
				<option value="car">Car</option>
				<option value="truck">Truck</option>
				<option value="van">Van</option>
				<option value="other">Other</option>
			</select></td></tr>
			<tr><td>Make</td><td><input type="text" name="make" value="" /></td></tr>
			<tr><td>Model</td><td><input type="text" name="model" value="" /></td></tr>
			<tr><td>Year</td><td><input type="text" name="year" value="" /></td></tr>
			<tr><td>Asking Price</td><td><input type="text" name="price" value="" /></td></tr>
			<tr><td>Condition</td><td><select name="condition">
				<option value="new">New</option>
				<option value="used">Used</option>
			</select></td></tr>
		</table>
		<br>
		<input type="hidden" name="vehicletype" value="auto" />
		<input type="reset" value="Clear Form" />        <input type="submit" value="Submit" />
		</form>
	';
}
function sellMotorcycle(){

}
function sellBoat(){


}
function sellAircraft(){


}