<?php

function do_fcall_by_name($call, $params) {
    var_dump($call);
    var_dump($params);
}

zregister_opcode_callback(ZMARK_DO_FCALL_BY_NAME, 'do_fcall_by_name');


if (1 + 2) {
    function hello() {
        echo "hello";
    }
}


hello("aa", 1, array("x", 2));

