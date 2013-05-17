<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Functions");
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
								<h2 class="title center">Functions</h2>
								<div class="entry">
									<p>
										Functions are modular sections of code that can be called multiple times throughout the execution of a program.
										<br /><br />
										Here is the syntax:
										<br /><br />
										<p class="code">return_type function_name ( arg1 , arg2 ) { statements; }</p>
										<br /><br />
										Here is an example:
										<br /><br />
										<p class="code">int sum ( int value1 , int value2 ) { return value1 + value2; }</p>
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/functions1.txt"),"input1",21); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",1); ?>
										<br /><br />
										<h3>Function Prototypes</h3>
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/functions2.txt"),"input2",20); ?>
										<?php showOutputTextArea(compileInput("input2"),"output2",1); ?>
										<br /><br />
										<h3>Overloading &amp; Overwriting</h3>
										<br /><br />
										Overloading is when you have multiple functions with the same name, but different arguments.
										<br /><br />
										For example:
										<br /><br />
										<p class="code">
											int sum ( int value1 , int value2 ) { return value1 + value2; }
											<br /r><br />
											int sum ( int value1 , int value2 , int value3 ) { return value1 + value2 + value3; }
										</p>
										<br /><br />
										Overloaded functions must be distinct by having: different number of arguments or different argument types. WARNING: Overloading a function by using a different return type produces an error.
										<br /><br />
										<p class="code red">
											int sum ( int value1 , int value2 ) { return value1 + value2; }
											<br /><br />
											double sum ( int value1 , int value2 ) { return (double) value1 + value2; }
										</p>
										<br /><br />
										Here is an example of overloading.
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/functions3.txt"),"input3",37); ?>
										<?php showOutputTextArea(compileInput("input3"),"output3",10); ?>
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
