--TEST--
Check preg_replace_callback
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.rename_functions=preg_replace_callback:my_preg_replace_callback
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

function preg_replace_callback($pattern, $callback, $subject, $limit=-1) {
    if (zcheck($callback)) {
        echo "preg_replace_callback:zcheck: ".zcheck($callback)."\n";
    }

    return my_preg_replace_callback($pattern, $callback, $subject, $limit=-1);
}

function test() {
}

$fname = "test";
zmark($fname);

preg_replace_callback("/xxxx/", $fname, "xxxx");


?>
--EXPECTF--
preg_replace_callback:zcheck: 1