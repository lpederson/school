<?php
require_once '../../common/common.php';
ShowHeader('Lab 3');

include 'statecountry.php';

echo '<h1>Lab 3</h1>';

$ErrorFields = Array();

if (!empty($_POST)) {
	$errortext = '';
	if (empty($_POST['zip'])) {
		$errortext .= '<li>Your zip code is blank.</li>';
		$ErrorFields[] = 'zip';
	}
	if (empty($_POST['password'])) {
		$errortext .= '<li>Your password is blank.</li>';
		$ErrorFields[] = 'password';
	}
	if (empty($errortext)) {
        	echo '<pre>';
        	print_r($_POST);
        	echo '</pre>';
        	mail('acoile@csumb.edu','Lab 1',
        	"Lab 1:\r\n\r\n" . print_r($_POST,true),
        	'From: acoile@csumb.edu');
        	echo "<h2>Form received and emailed. Thank you!</h2>";
        	exit();
	}
	else {
		echo '<h2>There are problems:</h2><ul style="color: red;">' . $errortext . '</ul>';
	}
}
?>

<p></p>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
<?php

ShowTextField('Your zip code','zip', 10, 5);
ShowTextField('Your password','password', 10, 32, TRUE);

?>
<label>What is your political party?<br />
<input type="radio" name="party" value="NR"  checked="checked" />Not registered<br />
<input type="radio" name="party" value="DTS" />Decline to State<br />
<input type="radio" name="party" value="DEM" />Democratic<br />
<input type="radio" name="party" value="REP" />Republican<br />
<input type="radio" name="party" value="REF" />Reform<br />
<input type="radio" name="party" value="AI"  />American Independent<br />
<input type="radio" name="party" value="PAF" />Peace &amp; Freedom<br />
<input type="radio" name="party" value="LIB" />Libertarian<br />
<input type="radio" name="party" value="GRN" />Green</label><br />
<label>Do you have a phone: <input type="checkbox" name="homephone" value="Y" />Home
<input type="checkbox" name="workphone" value="Y" />Work
<input type="checkbox" name="cellphone" value="Y" />Cell</label><br />
<label for="contact[]">Do you prefer to be contacted: </label><input type="checkbox" name="contact[]" value="Home" />Home
<input type="checkbox" name="contact[]" value="Work" />Work
<input type="checkbox" name="contact[]" value="Cell" />Cell<br />
Where were you born? <?php ShowCountryDropDown(); ?>
State you are located: <?php ShowStateDropDown(); ?>
What areas to you go to to eat? <select name="eating[]" multiple=multiple size="5">
<option>Marina</option>
<option>Seaside</option>
<option>Monterey</option>
<option>Pacific Grove</option>
<option>Carmel</option>
<option>Salinas</option>
</select><br />
How do you think California should resolve its budget problems?<br />
<textarea name="fixproblems" rows="20" cols="80">Please type your answer here...</textarea><br />
<input type="submit" name="Action" value="Submit Survey" />
<input type="reset" value="Clear Form" />
</form>

<?php

ShowFooter();

