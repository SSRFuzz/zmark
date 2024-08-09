<?php

function do_icall($call, $params) {
    var_dump($call);
    var_dump($params);
}

zregister_opcode_callback(ZMARK_DO_ICALL, 'do_icall');

stripos("test", "t");

