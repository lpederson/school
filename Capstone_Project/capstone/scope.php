<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Scope");
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
								<h2 class="title center">Scope</h2>
								<div class="entry">
									<p>
										Variables and Objects only exist when they are kept within the confines of their scope. When a code block ends, the variables that were created <i>inside</i> it are destroyed. These are called <i>local variables</i>, in this context. If a variable is initialized <i>outside</i> a block of code, it is a <i>global variable</i>. These are NOT destroyed when the block ends.
										<p class="code">
											inside -> local
											<br />
											outside -> global
										</p>		
										<br />
										Here is an example:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/scope1.txt"),"input1",26); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",2); ?>
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
