--TEST--
Check Taint with separation
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$a = "tainted string\n";
zmark($a); //must use concat to make the string not a internal string(introduced in 5.4)

$b = $a;
$c = &$b; //separation
echo $b;
print $c;

$e = $a; //separation
echo $e;
print $a;

?>
--EXPECT--
echo_handler:zmark: 'tainted string\n' 1
tainted string
echo_handler:zmark: 'tainted string\n' 1
tainted string
echo_handler:zmark: 'tainted string\n' 1
tainted string
echo_handler:zmark: 'tainted string\n' 1
tainted string