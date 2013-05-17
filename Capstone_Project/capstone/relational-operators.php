<html>
	<head>
		<?php 
		include_once 'functions.php'; 
		startHeader("Relational Operators");
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
								<h2 class="title center">Relational Operators</h2>
								<div class="entry">
									<p>
										So far we have already learned about the assignment operator (<i>=</i>) and the 
										arithmetic operators (<i>+, -, *, /, %</i>). There are however, many more 										
									</p>
									<p>
										First, let's examine the Relational operators. They include <i>Equal (==),
										Not Equal (!=), Greater Than (&gt;), Less Than (&lt;), Greater Than or Equal To (&gt;=),
										</i>and<i> Less Than or Equal To (&lt;=).</i>
									</p>
									<h4><i>Equals (==)</i></h4>
									<p>
										The Equals operator is used when the values of two variables need to be compared. If the two values
										being compared are the same, the condition statement returns true. If the two values being compared are different,
										the condition statement returns false. This is the most basic conditional expression.
									</p>
										<p class="code">(var1 == var2)</p>
										</br>
									<p>
										To get a better understanding of this, lets examine how passwords work. When a
										user creates a new account, they will be asked to protect that account by entering
										a password to go with it. Let's say the user enters "otter" as there password. Now,
										the letters "otter" are copied to a variable that will store that word. When the user
										goes to login to the account, they will be prompted to enter their password. If the
										entry does not match "otter" exactly, the conditional will return false and the login will fail.
									</p>
										<p class="code">("otter" == "otter")</p>
										<p class="code red">("otter" == "csumb")</p>
										</br>
									<h4><i>Not Equal (!=)</i></h4>
									<p>
										The Not Equal operator is used when the values of two variables need to be compared. If the two values
										being compared are the same, the condition statement returns false. If the two values being compared are different,
										the condition statement returns true. It is essentially the inverse of Equal To (==).
									</p>
										<p class="code">(var1 != var2)</p>
										</br>
									<p>
										A good example of when this would be better to use would be deciding what video game to play.  Let's say you've been trying to complete one of
										the twenty video games you own for a month. After awhile, you decide you want to start playing a video game,
										but you're sick of the one you've been playing all month. Instead of listing off all twenty games you have available 
										to play in your collection, it's much easier & simpler to just say, "I'll play any game as long as it's NOT the 
										one I've been playing."
									</p>
										<p class="code">(choice != same_game)</p>
									</br>
									<h4><i>Greater Than (&gt;)</i></h4>
									<p>
										The Greater Than operator is used when you wish to see if the first variable's value is larger than the second variable's value.
										If the first value is larger than the second value, the condition statement returns true. If the first value
										is smaller than the second value, the condition statement returns false.
									</p>
										<p class="code">(var1 &gt; var2)</p>
										</br>
									<p>
										For example, lets say we have two people of different ages. person1 is 35yrs old and
										person2 is 21yrs old. If we want to see who is older, we just need to plug the variables
										into the conditional statement.
									</p>
										<p class="code">(person1 &gt; person2)</p>
										<p class="code red">(person2 &gt; person1)</p>
										</br>
									<h4><i>Greater Than or Equal To (&gt;=)</i></h4>
									<p>
										The Greater Than or Equal To operator is used when you wish to see if the first variable's 
										value is larger than or equal tothe second variable's value.
										If the first value is larger or equal to than the second value, the condition statement returns true. If the first value
										is smaller than the second value, the condition statement returns false.
									</p>
										<p class="code">(var1 &gt;= var2)</p>
										</br>
									<p>
										As an example, lets imagine the age requirement for registering to vote. A person legally
										becomes old enough to vote, the day they turn 18yrs old. This means, if the a person's age
										is 18yrs. old or greater, they will always have the right to vote.
									</p>
										<p class="code">(age &gt;= 18)</p>
										</br>
									<h4><i>Less Than (&lt;)</i></h4>
									<p>
										The Less Than operator is used when you wish to see if the first variable's value is smaller than the second variable's value.
										If the first value is smaller than the second value, the condition statement returns true. If the first value
										is larger than the second value, the condition statement returns false.
									</p>
										<p class="code">(var1 &lt; var2)</p>
										</br>
									<p>
										For example, lets say we have two people of different ages. person1 is 35yrs old and
										person2 is 21yrs old. If we want to see who is younger, we just need to plug the variables
										into the conditional statement.
									</p>
										<p class="code">(person2 &lt; person1)</p>
										<p class="code red">(person1 &lt; person2)</p>
										</br>
									<h4><i>Less Than or Equal To (&lt;=)</i></h4>
									<p>
										The Less Than or Equal To operator is used when you wish to see if the first variable's value is smaller or equal to than the second variable's value.
										If the first value is smaller than or equal to the second value, the condition statement returns true. If the first value
										is larger than the second value, the condition statement returns false.
									</p>
										<p class="code">(var1 &lt;= var2)</p>
										</br>
									<p>
										As an example, lets use a pitcher of water that can hold 4 cups of water. The pitcher can hold
										anywhere from 0 cups of water, to 4 cups of water.  If we were to describe the contents at any given
										time, the range would be empty, less than 4 cups, or equal to 4 cups.
									</p>
										<p class="code">(0 &lt;= 4)</p>
										<p class="code">(2 &lt;= 4)</p>
										<p class="code">(4 &lt;= 4)</p>
										<p class="code red">(4.1 &lt;= 4)</p>
										</br>
										<?php showInputTextArea(file_get_contents("./programs/if-else/operator1.txt"),"input5",40); ?>
										<?php showOutputTextArea(compileInput("input5"),"output5",4); ?>
										<br /><br />
									<p>
										Next, lets take a look at the Logical operators. They include
										<i>AND (&&), OR (||), NOT (!)</i>.
									</p>
									<h4><i>AND (&&)</i></h4>
									<p>
										The AND operator is used when a minimum of two conditions must both be true for the result to be true.
									</p>
									<p class="code">((condition 1) && (condition 2))</p>
									</br>
									<p>
										For example, let's say a person is applying for their driver's license. In order to ultimately obtain
										that license, there are several conditions that must all be met. First, the applicant must be atleast 15.5yrs
										old. Second, they must have a registered vehicle with valid insurance. Third, they must be a US citizen with all
										the verifying documentation. Forth, they must pass both a written test and a driving test. While there are several 
										other requirements, the point is that all these conditions must be met in order to get the license. If the applicant
										has three of the four mentioned conditions satisfied, they are still ineligable for a driver's license.
									</p>
										<p class="code">((+15.5yrs old) && (Insurance) && (US Citizen) && (Pass Tests))</p>
										</br>
									<h4><i>OR ( || )</i></h4>
									<p>
										The OR operator is similar to the AND operator except for one key difference: with a minimum of two conditions
										only one of the conditions must be met for the result to be true. If both conditions are met, the result is still
										true, but it is not a requirement.
									</p>
										<p class="code">((condition 1) || (condition 2))</p>
										</br>
									<p>
										For example, when a person goes to a resteraunt, there is usually a discount for both children and senior citizens.
										To be considered a child, the age of the individual should be 12yrs old or below. To be considered a senior citizen,
										the age of the individual should be 65yrs old or above.  It is impossible for bothof these conditions to be true, 
										but since we are using an OR operator only one of the conditions needs to be true in order to get the discount.										
									</p>
										<p class="code">((-12yrs old) || (+65yrs old))</p>
									</br>
									<h4><i>NOT (!)</i></h4>
									<p>
										The NOT operator is used to invert a variable's value. In
										the case of a boolean variable, it would change the comparison from a <i>true</i>
										value into a <i>false</i> value - and vice versa. In the case of an integer value,
										it would validate any numerical value except the original. In the
										case of Character and Double values, it would follow the same logical constraints as integers.
										It is mostly used in the case where, instead of searching/waiting for a specific value, it does
										not matter what the value is, as long as it is not the originally defined value.
									</p>
										<p class="code">(!variable)</p>
										<p class="code">(!condition)</p>
										</br>
									<p>
										For example, let's say you and a few friends want to go to the theatre and see a movie. The theatre is showing
										four movies; a romance movie, an action movie, a comedy movie, and a documentary. One of
										your friends points out that they already saw the romance movie thats out and doesn't want to
										see it again. Based on this, you and your friends can go see any movie you want as long as its
										<i>NOT romance movie</i>. Therefore, when selecting a film to see, the action movie, comedy movie,
										and the documentary are valid choices.
									</p>
										<p class="code">(!romance_movie)</p>
										</br>

										<?php showInputTextArea(file_get_contents("./programs/if-else/operator.txt"),"input1",52); ?>
										<?php showOutputTextArea(compileInput("input1"),"output1",4); ?>
										<br /><br />
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
