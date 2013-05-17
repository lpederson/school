<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Pointers");
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
								<h2 class="title center">Pointers</h2>
								<div class="entry">
									<p>
										There are two operators for pointers.
										<br /><br />
										The <i>&amp;</i> operator is the <i>Reference</i> operator. It is used for retrieving the <i>memory address</i> of a variable or object.
										<br /><br />
										
										The <i>*</i> operator is the <i>Dereference</i> operator. It is used for retrieving the <i>value</i> from a memory address. It is also used for <i>initializing</i> a pointer.
										<br /><br /><br />
										For example:
										<br /><br />
										We initialize an integer, and a pointer
										<br />
										<p class="code">int myInteger = 20;<br />int * myPointer; </p>
										<br />
										Lets say that the memory address of <i>myInteger</i> is <i>0x1000</i>, and its value is <i>20</i> and the memory address of <i>myPointer</i> is <i>0x2000</i>. 
										<br /><br />
										Next we assign the <i>memory address</i> of <i>myInteger</i> to the value of <i>myPointer</i> using the Reference operator <i>&amp;</i>.
										<br /><br />
										<p class="code">myPointer = &amp;myInteger;</p>
										<br />
										So now we have:
										<br /><br />
										<table class="compareTable">
											<tr>
												<td></td>
												<td>Memory Address</td>
												<td>Value</td>
											<tr>
											<tr>
												<td>myInteger</td>
												<td>0x1000</td>
												<td>20</td>
											</tr>
											<tr>
												<td>myPointer</td>
												<td>0x2000</td>
												<td>0x1000</td>
											</tr>
										</table>
										<br /><br />
										Now, to get the value from the address stored in myPointer, we use the Dereference operator <i>*</i>.
										<br /><br />
										<p class="code">int value = * myPointer;</p>
										<br /><br />
										
										<div id="container" style="background: white;"></div>
										<script src="js/pointer1.js"></script>
										<br /><br />
										One last time.
										<br /><br />
										Dereference:
										<br />
										<p class="code">* myPointer -> 20</p>
										Reference:
										<p class="code">& myPointer -> 0x2000</p>
										Value:
										<p class="code">myPointer -> 0x1000</p>
										<br /><br />
										Here are some examples of the usage of the pointer operators:
										<br /><br />
										<?php showInputTextArea(file_get_contents("./programs/pointer1.txt"),"input1",45); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",10); ?>
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
