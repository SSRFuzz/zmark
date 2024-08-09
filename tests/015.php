<?php

function init_user_dynamic_call_handler($funcname) {
    var_dump($funcname);
}


zregister_opcode_callback(ZMARK_INIT_DYNAMIC_CALL, 'init_user_dynamic_call_handler');

function my_function() {}

$function = "my_function";
$function();

