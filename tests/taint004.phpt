--TEST--
Check Taint with eval
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$a = "tainted string" . ".";
zmark($a);

eval('$b = $a;');
die($b);

?>
--EXPECT--
exit_handler:zmark: 'tainted string.' 1
tainted string.