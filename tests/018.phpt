--TEST--
Check ZEND_FAST_CONCAT
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

zregister_opcode_callback(ZMARK_FAST_CONCAT, 'concat_handler');


$a = "test";
$z = "$a hello";

var_dump($z);

--EXPECTF--
string(4) "test"
string(6) " hello"
string(14) "test hellotail"