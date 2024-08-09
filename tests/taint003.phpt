--TEST--
Check Taint with ternary
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$a = "tainted string";
zmark($a);

$b = isset($a)? $a : 0;
echo $b;
echo "\n";

$b .= isset($a)? "xxxx" : 0; //a knew mem leak
var_dump(zcheck($b));
exit($b);

?>
--EXPECT--
echo_handler:zmark: 'tainted string' 1
tainted string
bool(true)
exit_handler:zmark: 'tainted stringxxxx' 1
tainted stringxxxx