--TEST--
Fixed bug that tainted info lost if a string is parsed by htmlspecialchars
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php


$a = "tainted string";
zmark($a); //must use concat to make the string not a internal string(introduced in 5.4)

$b = htmlspecialchars($a);
var_dump(zcheck($b));
var_dump(zcheck($a));


?>
--EXPECTF--
bool(false)
bool(true)
