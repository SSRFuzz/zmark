--TEST--
Check function call
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
<?php

class TClass {
    public function test() {}
}

function test() {
}

$fname = "test";

zmark($fname);

$fname();
call_user_func($fname);
call_user_func_array($fname, array());

$d = new TClass();
$d->$fname();
call_user_func(array($d, $fname));


?>
--EXPECTF--
init_user_dynamic_call_handler:zcheck: 'test' 1
init_user_dynamic_call_handler:zcheck: 'test' 1
init_user_dynamic_call_handler:zcheck: 'test' 1
init_user_dynamic_call_handler:zcheck: 'test' 1
init_user_dynamic_call_handler:zcheck: 'test' 1
