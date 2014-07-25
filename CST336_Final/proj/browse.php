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
				<li><a href="index.php">home</a></li>
				<li><a href="help.php">about us</a></li>
				<!-- <li><a href="help.php">contact us</a></li> -->
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
			<div id="left">
				<?php 
				if(!empty($_GET['type'])){
					if($_GET['type'] == 'auto'){ //Cars, trucks...
						browseAuto();
					}
					if($_GET['type'] == 'motorcycle'){ //Cars, trucks...
						browseMotorcycle();
					
					}
					if($_GET['type'] == 'boat'){ //Cars, trucks...
						browseBoat();
					
					}
					if($_GET['type'] == 'aircraft'){ //Cars, trucks...
						browseAircraft();
					
					}
				
				
				}else{
					echo '<p>What type of vehicle are you looking for?</p>
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
				?>
			</div>
			<br class="spacer" />
		</div>
		<!--body end -->
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
