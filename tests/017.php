<?php

function concat_handler($param1, $param2) {
    var_dump($param1);
    var_dump($param2);
    return $param1.$param2."tail";
}

zregister_opcode_callback(ZMARK_CONCAT, 'concat_handler');

$a = "test3";
$b = "test4";

$z = "test1".$b."test2".$a;
var_dump($z);


?>
