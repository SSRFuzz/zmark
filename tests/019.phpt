--TEST--
Check ZEND_ASSIGN_CONCAT
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

function concat_handler($param1, $param2) {
    var_dump($param1);
    var_dump($param2);
    return $param1.$param2."tail";
}

zregister_opcode_callback(ZMARK_ASSIGN_CONCAT, 'concat_handler');


$result = "test";
$result .= " fun";

var_dump($result);
?>
--EXPECTF--
string(4) "test"
string(4) " fun"
string(12) "test funtail"