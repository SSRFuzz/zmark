--TEST--
Check do_call
--SKIPIF--
<?php if (!extension_loaded("zmark")) print "skip"; ?>
--INI--
zmark.enable=1
include_path={PWD}
auto_prepend_file=base.php
--FILE--
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
--EXPECTF--
string(25) "zregister_opcode_callback"
string(25) "zregister_opcode_callback"
string(5) "hallo"
now in hallo