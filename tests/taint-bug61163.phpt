--TEST--
Bug #61163 (Passing and using tainted data in specific way crashes)
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
function test($test)
{
	$data .= $test; // $data doesn't exist yet.
}

test($a);
--EXPECTF--
Notice: Undefined variable: data in %sbug61163.php on line %d
