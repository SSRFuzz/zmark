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
