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
				<li class="hover">home</li>
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
		<div id="header">
			<h2><span>CST 336 - Final Project</span></h2>
			<p>Welcome to our website for CST 336 - Internet Programming</p>
			<p>It demonstrates the skills we have gained from the class</p>
			<p>-Luke Pederson and Drew Callan</p>
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
				<h2>Purpose of the site</h2>
				<p class="lftText">This is our attempt to make a website that allows users to browse, buy, and sell any kind of vehicle on the market.</p>
				<br>
				<p class="lftText">These types of vehicles include <span>Cars</span>, <span>Motorcycles</span>, <span>Boats</span>, <span>Aircraft</span>, etc.</p>
				<br>
				<p class="lftText">Click "View More" to learn more about the site</p>
				<p class="viewMore"><a href="help.php"></a></p>
			</div>
			<!--left panel end -->
			<!--mid panel start 
			<div id="mid">
				<h2>whats' new</h2>
				<img src="images/mid_panel_pic.gif" alt="pic" width="252" height="109" />
				<h3>ipsum dolor sit amet,</h3>
				<p class="midText">consectetuer adipiscingelit. Duis interdum porttitor sapien. Vivamus variu enim sed dictum bibendum, libero   ante fermentum augue, vel pharetra leo mi nec velit. Mauris semper semper ura. Aliquam erat</p>
				<p class="midText2">venenatis dignissimnullamssa lorem, suscipit</p>
				<br class="spacer" />
			</div> -->
			<!--mid panel end -->
			<!--right panel start -->
			<div id="right">
				<h2 class="mem">Member Login</h2>
				<form name="memberLogin" action="login.php" method="post">
					<input type="text" name="username" class="txtBox" value="" />
					<input type="password" name="password" class="txtBox" value="" />
					<a href="login.php">Register here</a>
					<input type="submit" name="login" value="" class="login" />
					<br class="spacer" />
				</form>
				<p class="bottom2"></p>
				<br class="spacer" />
			</div>
			<!--right panel end -->

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
