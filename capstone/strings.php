<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Strings");
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
								<h2 class="title center">Strings</h2>
								<div class="entry">
									<p>
										A string is an array of characters. When using string, always encapsulate the string with <i>double quotes</i>. Single quotes are used for characters, NOT strings.
									</p>
									<p>Examples:</p>
									  <p class="code">string var = "";</p>
									  <p class="code">string var = "hello world";</p>
									  <p class="code">string var = "123_aBc XyZ_789";</p>
									</br>
									<p>Error:</p>
									  <p class="code red">string var = hello world; </p>
									  <p class="code red">string var = '123_aBc';   </p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/string.txt"),"input1",21); ?>
									<?php showOutputTextArea(compileInput("input1"),"output1",4); ?>
									</br> </br>
									
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



