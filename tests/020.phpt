--TEST--
Check ZEND_ROPE_END
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
zmark.enable_rename=1
--FILE--
<?php

$call_count = 0;

function rope_end_handler($params) {
    global $call_count;
    $call_count++;
    return implode($params);
}

zregister_opcode_callback(ZMARK_ROPE_END, 'rope_end_handler');


define("HELLO", "HELLO");

$x = "nihao";

for($i=0; $i<100; $i++) {
    $d = "hello from $i from $x".HELLO;
}

echo "count: $call_count\n";
var_dump($d);


$x = Array("1", "x", "f");
for($i=0; $i<100; $i++) {
    $d = @"hello from $i from $x".HELLO;
}

echo "count: $call_count\n";
var_dump($d);

?>
--EXPECTF--
count: 100
string(29) "hello from 99 from nihaoHELLO"
count: 201
string(29) "hello from 99 from ArrayHELLO"