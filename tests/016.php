<?php


function include_or_eval_handler($param) {
    $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
    array_shift($bt);

    echo $bt[0]['function'].": ".gettype($param)." ".$param."\n";
}

zregister_opcode_callback(ZMARK_INCLUDE_OR_EVAL, 'include_or_eval_handler');



@include("hello.php");


class A {
    function __toString() {
        return "2+2;";
    }
}


eval("1+1;");
eval(new A());
?>
