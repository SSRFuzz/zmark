--TEST--
Check file, file_get_contents
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=file_get_contents:my_file_get_contents, file:my_file
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function file($filename, ...$args) {
    if (zcheck($filename)) {
        echo "file:zcheck: ".zcheck($filename)."\n";
    }

    return my_file($filename, ...$args);
}

function file_get_contents($filename, ...$args) {
    if (zcheck($filename)) {
        echo "file_get_contents:zcheck: ".zcheck($filename)."\n";
    }

    return my_file_get_contents($filename, ...$args);
}


function test() {
	$a = __FILE__;
	zmark($a);
    $str = file($a);
	$str = file_get_contents($a);
}
test();


?>
--EXPECTF--
file:zcheck: 1
file_get_contents:zcheck: 1