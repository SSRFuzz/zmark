--TEST--
Check Taint with dim assign contact
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
$b = array("this is");
$b[0] .= $a;
var_dump(zcheck($b[0]));

$c = new stdClass();
$c->foo = "this is";
$c->foo .= $a;

var_dump(zcheck($c->foo));

?>
--EXPECT--
bool(true)
bool(true)