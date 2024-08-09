<?php

function do_ucall($call, $params) {
    var_dump($call);
    var_dump($params);
}


zregister_opcode_callback(ZMARK_DO_UCALL, 'do_ucall');


function x() {}

x("xxxx", 123, array('aaa'));

?>
