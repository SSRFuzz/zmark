--TEST--
Check Illegal string offset
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

$d = "1";
$x = "hello";

$d['where'] .= $x;

--EXPECTF--
Warning: Illegal string offset 'where' in %s008.php on line %d

Fatal error: Uncaught Error: Cannot use assign-op operators with overloaded objects nor string offsets in %s008.php:%d
Stack trace:
#0 {main}
  thrown in %s008.php on line %d