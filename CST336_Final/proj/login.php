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
			if(SignedIn() === true){
				echo '<div id="middle"><h1>Welcome '.$_COOKIE['CST336_username'].'.</h1></div><br class="spacer" />';
				echo '<br>';
			}else{
				if(CreateAccount())
					echo 'Thanks for creating an account '.$_COOKIE['CST336_username'].'!';
				else{
					echo'
						<h2>Create an account</h2>
						<form name="register" action="'.$_SERVER['PHP_SELF'].'" method="post">
						<table cellpadding="5">
							<tr><td>Username</td><td><input type="text" name="new_username" value="" /></td></tr>
							<tr><td>Password</td><td><input type="password" name="new_password" value="" /></td></tr>
							<tr><td>Confirm Password</td><td><input type="password" name="new_password_confirm" value="" /></td></tr>
							<tr><td></td><td></td></tr>
							<tr><td><input type="reset" name="clear" value="Clear Form" /></td><td><input type="submit" name="submit" value="Submit" /></td></tr>
						</table>
						</form>
					</div>
					<!--right panel start -->
					<div id="right">
						<h2 class="mem">Member Login</h2>
						<form name="memberLogin" action="'.$_SERVER['PHP_SELF'].'" method="post">
							<input type="text" name="username" class="txtBox" value="" />
							<input type="password" name="password" class="txtBox" value="" />
							<input type="submit" name="login" value=" " class="login" />
							<br class="spacer" />
						</form>
						<p class="bottom2"></p>
						<br class="spacer" />
					</div>
					<!--right panel end -->
					';
				}
			} 
			?>
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
