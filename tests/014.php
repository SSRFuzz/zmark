<?php

function init_user_dynamic_call_handler($funcname) {
    var_dump($funcname);
}


zregister_opcode_callback(ZMARK_INIT_USER_CALL, 'init_user_dynamic_call_handler');

@call_user_func(array("my_class", "my_method"), "test");

