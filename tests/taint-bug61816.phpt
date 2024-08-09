--TEST--
Bug #61816 (Segmentation fault)
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$a = "tainted string" . ".\n";
zmark($a);
$b = array("");
$b[0] .= $a;
var_dump(zcheck($b[0]));
$c = new stdClass();
$c->foo = "this is";
$c->foo .= $b[0];
echo $b[0];  // Segmentation fault
var_dump(zcheck($c->foo));

?>
--EXPECT--
bool(true)
echo_handler:zmark: 'tainted string.\n' 1
tainted string.
bool(true)