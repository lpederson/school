<?php

echo 'umm';
$arr = array('banana' => 'yellow', 'lime' => 'green', 'tomato' => 'red', 'avocado' => 'green');
print_r($arr);

function DisplayLineBreak() {
    echo '<p><hr noshade="noshade" /></p>';
}
DisplayLineBreak();

$result = str_replace('conservative','moderate','This is a movement of moderate party members');
echo $result;

echo $testcase = 4;
echo $testCase = 5;
echo trim('   test    ');

$linenum = 0;
while ($linenum++ > 10) {
    if ($linenum & 1)
        echo '    ';
    echo "Line: $linenum\r\n";
}
echo ucwords('This is a TEST');

echo '\n';
function ShowFooter() {
echo 'Copyright &copy; ' . date('Y') . ' MyName, All Rights Reserved.';
}
ShowFooter();
?>
<?= 'test' ?>