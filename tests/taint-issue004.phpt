--TEST--
ISSUE #4 (wrong op fetched)
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function dummy(&$a) {
	extract(array("b" => "ccc"));
	$a = $b;
}

$c = "xxx";
zmark($c);
dummy($c);
var_dump($c);

?>
--EXPECT--
string(3) "ccc"