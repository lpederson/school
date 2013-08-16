<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Arrays");
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
								<h2 class="title center">Arrays</h2>
								<div class="entry">
									<p>
										<div id="container"></div>
										<script src="js/arrayLesson.js"></script>
										Arrays are used for sets of data. Arrays hold <i>1 data type</i> for all 
										values. Arrays have an <i>index</i>. The index starts at <i>0 (zero)</i>
										<br /><br />
										For example:
										<br /><br />
										<p class="code">int myInts[] = { -100 , 0 , 1996 }</p>
										<br /><br />
										<p class="code">char myChars[] = { 'a' , 'b' ,'c' }</p>
										<br /><br />
										This is an error:
										<br /><br />
										<p class="code red">int myInts[] = { -100 , 'a' , "String" , 100 }</p>
										<br /><br />
										Here are some array uses:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/array1.txt"),"input1",15); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",4); ?>
										<br /><br />
										<h3>Multi-Dimensional Arrays</h3>
										<br /><br />
										Two Dimensional Arrays
										<br /><br />
										2-d arrays are can be through of as having x, y coordinates. Like a square grid.
										<br /><br />
										<div id="container2"></div>
										<script src="js/arrayLesson2.js"></script>
										
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
