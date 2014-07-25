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
				<li class="hover">about us</li>
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
			<div id="left" style="width:95%;height:300px">
				<h2>About this site</h2>
				<p class="lftText">This site is a final project for CST 336 - Internet Programming with Professor Coile. It demonstrates the skills we have learned throughout the course to meet the outcomes defined by the CSIT curriculum.</p>
				<br>
				<p class="lftText">The site uses PHP and MYSQL to manage all the data required for functionality. Unfortunately, I didn't get to implementing any Javascript or Ajax for a more user friendly UI.</p>
				<br>
				<p class="lftText">We did NOT design this site. It was designed By : <a href="http://www.templateworld.com/" target="_blank" class="link">Template World</a></p>
				<br class="spacer" />
			</div>
			<!--left panel end -->
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
