--TEST--
Check ZEND_INIT_DYNAMIC_CALL
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


zregister_opcode_callback(ZMARK_INIT_DYNAMIC_CALL, 'init_user_dynamic_call_handler');

function my_function() {}

$function = "my_function";
$function();

--EXPECTF--
string(11) "my_function"