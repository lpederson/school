<html>
	<?php 
		include_once 'functions.php'; 
		startHeader("Operators");
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
								<h2 class="title center">Operators</h2>
								<div class="entry">
									<p>
										Once we know what variables we will need and what data types that should be,
										how do we manipulate those variables if we need to change there values?  The answer: 
										assignment statements. We can modify the values of the variables by using the <i> +, -, *, /, %</i>
										operators. The first 4 symbols are nothing that should seem to unfamiliar. Addition(+), Subtraction(-),
										multiplication(*), and division(/) are fairly straight forward.
									</p>
									  <p class="code">total = num1 + num2;</p>
									  </br>
									<p>
										This is the proper syntax for adding two numerical values (num1 and num2) and then storing the result
										in another variable (total).
									</p>
									<p>
										As the need for more complex calculations arises, the rules for writing the expressions follows the left-to-right 
										format while honoring the mathmatical order of operations (PEMDAS).  So for example, lets say we needed to calculate
										the grade point average of a student based on there test scores.
									</p>
									  <p class="code">gpa = (test1 + test2 + test3) / 3;</p>
									  </br>
									<p>
										When calculating the average, the total score of all three tests needs to be added up; <i>(test1 + test2 + test3)</i>.
										Since we that total added first - before we divide it by 3 - we need to put parenthesis around the addition section.
										Once that is completed, that value is then divided by 3; <i>/3</i>. Once that value has been calculated, it is then
										assigned to the variable <i>gpa</i>.
									</p>
									<p>
										The <i>%</i> symbol does refer to percentages. It is actually a very important sign that comes up more often than you
										might think. It is called the <i>modulus</i> operator. It works the same way division works, with one very key difference:
										it calculates the remainder rather than the quotient.
									</p>
									   <p class="code">remainder = 10 % 3;</p>
									   </br>
									<p>
										In the above problem, the compiler is dividing the two numbers which would come out to 3.  However, since we used the modulus
										operator instead the value that will assigned to 'remainder' is actually 1. 3 goes into 10 three times which comes out to 9. 10-9=1
										
									</p>
									</br>
									<?php showInputTextArea(file_get_contents("./programs/datatypes/assign_state.txt"),"input5",39); ?>
									<?php showOutputTextArea(compileInput("input5"),"output5",5); ?>
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
