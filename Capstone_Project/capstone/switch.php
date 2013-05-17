<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Switch");
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
								<h2 class="title center">Switch</h2>
								<div class="entry">
									<p>
										Switches are a type of branching structure. The switch statement behaves like a group of if/else statements.
										<br /><br />
										Here is the syntax:
										<br /><br />
										<p class="code">
										switch ( variable / expression )
										<br />
										{
										<br /> 
										case const_1: statements...; break; 
										<br /><br />
										case const_2: statements; ...; break; 
										<br /><br />
										default: statements; ...; 
										<br />
										}</p>
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/switch1.txt"),"input1",23); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",1); ?>
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
