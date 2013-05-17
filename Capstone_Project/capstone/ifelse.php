<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("If - Else");
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
								<h2 class="title center">If / Else</h2>
								<div class="entry">
									<p>The <i>if</i> keyword is used to execute a statement if and only a boolean condition is true. The syntax is:<br /><br /> 
										<p class="code">if (boolean condition) { statement }</p>
										<br /><br />
										If the boolean condition is <i>true</i>, the statement is executed. If it is <i>false</i>, it is not executed. Brackets <i>{ }</i> are used when executing <i>more than 1</i> statement.
										<br /><br />
										Here is an example.
										<?php showInputTextArea(file_get_contents("./programs/ifelse_1.txt"),"input2",12); ?>
										<?php showOutputTextArea(compileInput("input2"),"output2",1); ?>
										<br /><br />
										We can also specify statements to execute when the boolean condition evaluates <i>false</i>.
										<br /><br />
										For this we use the <i>else</i> keyword. The syntax is:
										<br /><br />
										<p class="code">if (boolean condition) { statement } else { statement }</p>
										<br /><br />
										Here is an example.
										<?php showInputTextArea(file_get_contents("./programs/ifelse_2.txt"),"input3",18); ?>
										<?php showOutputTextArea(compileInput("input3"),"output3",1); ?>
										<br /><br />
										We are also capable of using <i>Nested If/Else</i> statements. Nested if statements can be used for handling a range of evaluations. Remember to use <i>Proper Indentation</i>. Also remember to use brackets <i>{ }</i> when necessary.
										<br /><br />
										Here is an example:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/ifelse_3.txt"),"input4",27); ?>
										<?php showOutputTextArea(compileInput("input4"),"output4",1); ?>
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
