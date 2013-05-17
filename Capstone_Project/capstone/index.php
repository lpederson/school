<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("CSITschools");
		?>
	</head>
	<body onLoad="linkInit()">
		<div id="wrapper">
			<?php displayBanner(); ?>
			<div id="page">
				<div id="page-bgtop">
					<div id="page-bgbtm">
					<div style="clear: both;">&nbsp;</div>
						<div id="content">
							<div class="post">
								<h2 class="title center">Welcome</h2>
								<div class="entry">
									<p style="line-height: 200%;">
									Welcome to CSITschools.
									<br /><br />
									This website is the final deliverable for the Capstone project of Luke Pederson and Drew Callan for Spring 2013 at California State University Monterey Bay. It is designed to teach students in the Computer Science and Information Technology (<i>CSIT</i>) department the fundamentals of programming in <i>C++</i>. The site provides students with explanations, tutorials, and live code examples about the fundamental concepts of computer science.
									</p>
								</div>
							</div>
							<div style="clear: both;">&nbsp;</div>
						</div>
					</div>
				</div>
			</div>
			<?php leftColumnNav(); ?>
			<?php displayFooter(); ?>
		</div>		
		<?php restoreScrollLocation(); ?>
	</body>
</html>
