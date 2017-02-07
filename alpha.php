
<?php
$strings = array('AbCd1zyZ9', 'foo!#$bar', 'poop 1');

foreach ($strings as $testcase) {
    if (preg_match('/^[a-zA-Z0-9 .]+$/', $testcase)) {
        echo "$testcase is YES.\n";
    } else {
        echo "$testcase is NO.\n";
    }
}
?>
~             
