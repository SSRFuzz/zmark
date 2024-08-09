--TEST--
Check ZEND_INIT_USER_CALL
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function init_user_dynamic_call_handler($funcname) {
    var_dump($funcname);
}


zregister_opcode_callback(ZMARK_INIT_USER_CALL, 'init_user_dynamic_call_handler');

@call_user_func(array("my_class", "my_method"), "test");

--EXPECTF--
array(2) {
  [0]=>
  string(8) "my_class"
  [1]=>
  string(9) "my_method"
}