<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Loops - While, Do While, For");
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
								<h2 class="title center">Loops</h2>
								<div class="entry">
									<p>
									Loops are used to <i>repeat</i> statements while a boolean condition is <i>true</i>.
									<br /><br />										
									<h3 class="title">While</h2>
									<p>While loops are used to repeat statements <i>while the boolean condition is true</i>.
										<br /><br />
										Here is the syntax:
										<br /><br />
										<p class="code">while (boolean condition) { statements }</p>
										<br /><br />
										Here is an example:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/while1.txt"),"input1",14); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",1); ?>
										<br /><br />
										Beware of <i>Infinite loops</i>.
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/while2.txt"),"input2",15); ?>
										<?php showOutputTextArea(compileInput("input2"),"output2",1); ?>
										<br /><br />
									</p>
									<h3 class="title">Do While</h3>
									<p>
										Do while loops are very similar to while loops. But Do While loops are guaranteed <i>one iteration of the loop</i>.
										Syntax is also different.
										<br /><br />
										<p class="code">do { statements } while (boolean condition)</p>
										<br /><br />
										Here is an example:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/dowhile1.txt"),"input3",20); ?>
										<?php showOutputTextArea(compileInput("input3"),"output3",1); ?>
									</p>
									<h3 class="title">For</h3>
									<p>
										For loops are similar to the other loops because the <i>repeat while boolean condition</i> is true. However, For loops are generally used for when iteration for a <i>Fixed Amount</i> eg. 20, or 2000. They are used very closely with <a href="arrays.php">Arrays</a>.
										<br /><br />
										Here is the syntax:
										<br /><br />
										<p class="code">for ( initialize ; boolean condition ; incrementor ) { statements }</p>
										<br /><br />
										Here is an example:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/for1.txt"),"input4",20); ?>
										<?php showOutputTextArea(compileInput("input4"),"output4",1); ?>
									</p>
									<p>
										<h3>Loop modifiers</h3>
										<br /><br />
										When running a loop, individual iterations can be skipped by using the <i>continue</i> keyword.
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/continue1.txt"),"input5",16); ?>
										<?php showOutputTextArea(compileInput("input5"),"output5",1); ?>
										<br /><br />
										If you want to exit a loop early, you can use the <i>break</i> keyword.
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/break1.txt"),"input6",14); ?>
										<?php showOutputTextArea(compileInput("input6"),"output6",1); ?>
									</p>
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
