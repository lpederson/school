<html>
	<?php 
		include_once 'functions.php'; 
		startHeader("Data Types");
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
								<h2 class="title center">Data Types</h2>
								<div class="entry">
								<!--
								<div id="container"></div>
								<script src="js/datatype.js"></script>
								-->
									<p>
										The values that the program needs to save and use are stored as 
										<i>variables</i>. A <i>data type</i> defines what specific type 
										of data a variable will hold; the format of the variable's value 
										or range of values.
									</p>
									<p>
										Variable names can only contain letters, numbers, and/or the underscore 
										character('_'). When naming variables, there are several requirements 
										that need to be met. First, they cannot begin with digits; there can 
										be a number in the variable name, but it cannot be the first character. 
										Second, variables cannot be one of the keywords that C++ reserves; 
										<i> new, break, continue, return, </i> etc... Third, it cannot contain a
										white-space (' ') or an operator (+, -, !, %, *, etc...). Lastly, it is 
										very important to remember that variable names are case-sensitive; the 
										variable <b>NUM</b> and the variable <b>num</b> are completely independant 
										of each other.
									</p>
									
									<p>
										Valid Variable Names
									</p>
									  <p class="code">var</p>
									  <p class="code">Var2</p>
									  <p class="code">num_var</p>
									</br></br>
									<p>
										Invalid Variable Names
									</p>
									  <p class="code red">2var</p>
									  <p class="code red">Var two</p>
									  <p class="code red">namespace</p>
									  <p class="code red">var+</p>
									</br></br>
									<p>
										The proper format for declaring a variable:
									</p>
									  <p class="code">data_type <i>variable_name</i>;</p> 
									 </br>
									<p>
										When a variable is declared, it already contains irrelevant garbage 
										data; whatever data is already in that memory location. It does not 
										overwrite the contents of the memory location, it simply allocates 
										it and prepares it to be overwritten. While it is not necessarily 
										required, it's good to get into the habit of assigning all variables 
										with a value. By default, the value of the variable should be set to 
										<i>null</i> or assigned a specific value when it's initialized.										
									</p>
									 </br>
									<p>
										The proper format for declaring a variable and assigning it a value:
									</p>
									  <p class="code">data_type <i>variable_name</i> = value;</p>
									</br></br>
									<h3 class="title">Integers</h3>
									<p>
										Integers are used whenever the variable will be holding a 
										whole numerical value. Integers can be positive or negative 
										values, but they can not contain decimal points; whole numbers only.
									</p>
									<p>Examples:</p>
									  <p class="code">int var = 0;</p>
									  <p class="code">int var = -89;</p>
									</br>
									<p>Error:</p>
									  <p class="code red">int var = P;</p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/integer.txt"),"input1",18); ?>
									<?php showOutputTextArea(compileInput("input1"),"output1",2); ?>
									</br> </br>
									<h3 class="title">Characters</h3>
									<p>
										Essentially, a Character is anything that can be typed on a 
										keyboard; a letter, a number, a space, a symbol, etc... For example, 
										the word "program" consists of 7 characters (9 if you count the 
										quotation marks). "4jfn 2,%@" contains 9 characters (11 if you count 
										the quotation marks). A <i>char</i> can contain any value, but the 
										variable can only contain 1 character.
									</p> 
									<p>A complete list of all characters can be found/defined with the ASCII table</p>
									<p>Examples:</p>
									  <p class="code">char var = 'f';</p>
									  <p class="code">char var = '@';</p>
									</br>
									<p>Error:</p>
									  <p class="code red">char var = 'cst';</p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/character.txt"),"input2",18); ?>
									<?php showOutputTextArea(compileInput("input2"),"output2",2); ?>
									</br> </br>
									<h3 class="title">Boolean</h3>
									<p>
										Boolean values can either be true(1) or false(0). A programmer
										would only want to use a boolean variable if the value should
										have one of two possible states; yes/no, on/off, true/false, etc...
										For example, a light-switch has only two possible states: on or off.
										While we use the keywords "true" and "false" when writing our code, during
										the execution of the program, the computer translates and reads
										those values as 1 or 0. This is why when the below code is executed
										the output will not print "true" or "false" but rather, the value will be 
										represented as a 1 or 0.
									</p>
									<p>Examples:</p>
									  <p class="code">bool var = 0;</p>
									  <p class="code">bool var = 1;</p>
									  <p class="code">bool var = true;</p>
									  <p class="code">bool var = false;</p>
									</br>
									<p>Error:</p>
									  <p class="code red">bool var = c;</p>
									  <p class="code red">bool var = "cst";</p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/boolean.txt"),"input3",18); ?>
									<?php showOutputTextArea(compileInput("input3"),"output3",2); ?>
									</br> </br>
									<h3 class="title">Double</h3>
									<p>
										Doubles are essentially integers that can have decimal points.
									</p>
									<p>Examples:</p>
									  <p class="code">double var = 0;</p>
									  <p class="code">double var = -23;</p>
									  <p class="code">double var = 3.18462;</p>
									</br>
									<p>Error:</p>
									  <p class="code red">double var = c;</p>
									  <p class="code red">double var = "cst";</p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/double.txt"),"input4",18); ?>
									<?php showOutputTextArea(compileInput("input4"),"output4",2); ?>
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
