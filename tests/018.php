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

