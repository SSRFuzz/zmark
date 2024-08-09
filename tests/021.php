<?php

function do_fcall($call, $params) {
    var_dump($call);
    var_dump($params);
}


zregister_opcode_callback(ZMARK_DO_FCALL, 'do_fcall');


$stripos = "stripos";
$stripos("test", "t");


