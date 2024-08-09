<?php


function zmark_do_fcall($call, $params) {
    var_dump($call);
}

function zmark_do_icall($call, $params) {
    var_dump($call);
}

function zmark_do_ucall($call, $params) {
    var_dump($call);
}

function zmark_do_fcall_by_name($call, $params) {
    var_dump($call);
}


zregister_opcode_callback(ZMARK_DO_FCALL, 'zmark_do_fcall');
zregister_opcode_callback(ZMARK_DO_ICALL, 'zmark_do_icall');
zregister_opcode_callback(ZMARK_DO_UCALL, 'zmark_do_ucall');
zregister_opcode_callback(ZMARK_DO_FCALL_BY_NAME, 'zmark_do_fcall_by_name');



function hallo(&$test1) {
    echo "now in hallo\n";
}

$d = "hallo";
$s = "xxxxxxaaaadd";
$d($s);



?>
