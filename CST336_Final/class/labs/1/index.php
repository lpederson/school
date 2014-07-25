<!DOCTYPE html>
<html>
<head>
<title>Lab 1</title>
</head>
<body>
<h1>Favorite Beers</h1>

<?php
if (!empty($_POST)) {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        mail('lpederson@csumb.edu','Lab 1',
        "Lab 1:\r\n\r\n" . print_r($_POST,true),
        'From: lpederson@csumb.edu');
        echo "<h2>Form received and emailed. Thank you!</h2>";
        exit();
}
?>

<p>What is your favorite beer</p>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
Your zip code: <input type="text" size="10" maxlength="5"><br />
Your password: <input type="password" size="10" maxlength="32"><br />
What is your favorite type of beer?<br />
<input type="radio" name="beertype" value="NA"  checked="checked" /><br />
<input type="radio" name="beertype" value="IPA" />IPA<br />
<input type="radio" name="beertype" value="Stout" />Stout<br />
Do you have a phone: <input type="checkbox" name="homephone" value="Y" />Home
<input type="checkbox" name="workphone" value="Y" />Work
<input type="checkbox" name="cellphone" value="Y" />Cell<br />
Do you prefer to be contacted: <input type="checkbox" name="contact[]" value="Home" />Home
<input type="checkbox" name="contact[]" value="Work" />Work
<input type="checkbox" name="contact[]" value="Cell" />Cell<br />
Where were you born? <select name="country">
<option value="--">--Please select--</option>
<option value="US">United States</option>
<option value="--">-------------</option>
<option value="CA">California</option>
</select><br />
State you are located: <select name="state">
<option value="  "></option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
<option value="--">------------</option>
<option value="AS">American Samoa</option>
<option value="FM">Federated States of Micronesia</option>
<option value="GU">Guam</option>
<option value="MH">Marshall Islands</option>
<option value="MP">Northern Mariana Islands</option>
<option value="PW">Palau</option>
<option value="PR">Puerto Rico</option>
<option value="VI">Virgin Islands</option>
<option value="--">------------</option>
<option value="AE">Armed Forces Canada, Africa, Europe, Middle East</option>
<option value="AA">Armed Forces Americas (except Canada)</option>
<option value="AP">Armed Forces Pacific</option>
<option value="--">------------</option>
<option value="AB">Alberta</option>
<option value="BC">British Columbia</option>
<option value="MB">Manitoba</option>
<option value="NB">New Brunswick</option>
<option value="NL">Newfoundland and Labrador</option>
<option value="NS">Nova Scotia</option>
<option value="NT">Northwest Territories</option>
<option value="NU">Nunavut</option>
<option value="ON">Ontario</option>
<option value="PE">Prince Edward Island</option>
<option value="QC">Qu&eacute;bec</option>
<option value="SK">Saskatchewan</option>
<option value="YT">Yukon</option>
</select><br />
What areas to you go to to beer? <select name="drinking[]" multiple=multiple size="5">
<option>Marina</option>
<option>Seaside</option>
<option>Monterey</option>
<option>Pacific Grove</option>
<option>Carmel</option>
<option>Salinas</option>
</select><br />
What would be your dream beer?<br />
<textarea name="dreambeer" rows="20" cols="80">Please type your answer here...</textarea><br />
<input type="submit" name="Action" value="Submit Survey" />
<input type="reset" value="Clear Form" />
</form>
</body>
</html>